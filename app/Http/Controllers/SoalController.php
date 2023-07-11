<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\TrQuiz;
use App\TrQuizDetail;
use Raju\Streamer\Helpers\VideoStream;
use Storage;


class SoalController extends Controller
{
    public function show_Gambar($a)
    {
            $quizdetail= DB::connection('MyEbadah')->table('Tr_Quiz_Detail')
           ->where([
                'Quiz_Detail_Id'=> $a
            ])->first();
        
            if ($quizdetail->Gambar != null) {
                $Gambar = base_path('storage/app/public/Soal/') . $quizdetail->Gambar;
                return response()->file($Gambar);
                $stream = new VideoStream($File_Upload);
                return response()->stream(function() use ($stream) {
                    $stream->start();
                });
            }
            else{
                alert()->warning('Data tidak ditemukan...', 'Maaf')->persistent('OK');
                return redirect()->route('quiz.soal');
            }
    }
    
    public function index($a)
    {
        $quizSubbab=DB::connection('MyEbadah')->table('Tr_Quiz_Detail')
            ->join('Tr_Quiz', 'Tr_Quiz_Detail.Quiz_Id', '=', 'Tr_Quiz.Quiz_Id')
             ->where(['Tr_Quiz_Detail.Quiz_Id'=>$a])
            ->get();
            //dd($quizId);
        $tesSubbab = DB::connection('MyEbadah')->table('Tr_Quiz')
            ->where(['Tr_Quiz.Quiz_Id'=>$a])
            ->first();

        //  dd($quizSubbab);

        return view('quiz.soal', 
        [
            'quizSubbab'=>$quizSubbab,
            'quizId'=>$a ,
            'mtrId'=>$tesSubbab->Materi_Id,
            'mtrdetailId'=>$tesSubbab->Materi_Detail_Id,
            'jenisQuiz' =>$tesSubbab->Jenis_Quiz_Id,
            'quizNama'=>$tesSubbab->Nama_Quiz,
            'tesSubbab' => $tesSubbab
        ]);
    }

   
    public function create()

    {
        return view('quiz.soal');
    }

    public function store(Request $request)
    {

        $Gambar = $request->file('Gambar');
        if ($Gambar){
            $nama_Gambar = $Gambar->getClientOriginalName();
            // $Gambar->move(storage_path('app/public/QuizBab'), $nama_Gambar);
            
        } else {
            $nama_Gambar = null;
        }

        $data = [
            'Quiz_Id' =>$request->Quiz_Id,
            'Pertanyaan' => $request->Pertanyaan,
            'Gambar' => $nama_Gambar
        ];

        $insert = DB::connection('MyEbadah')->table('Tr_Quiz_Detail')->insertGetId($data);
        if ($Gambar) {
            $extension = $Gambar->getClientOriginalExtension();
            $id = $insert;
            $new_name = ($id). "." . $extension;
            $Gambar->move(storage_path('app/public/Soal'),  $new_name);
            $update =  DB::connection('MyEbadah')->table('Tr_Quiz_Detail')->where('Quiz_Detail_Id',$insert)->update(['Gambar' =>$new_name]);
        }


        return redirect("/soal/{$request->Quiz_Id}") ->with ('status', 'Pertanyaan berhasil ditambahkan!!');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $Quiz_Detail_Id)
    {   
        $Tr_Quiz_Detail = TrQuizDetail::find($Quiz_Detail_Id);
        $Tr_Quiz_Detail->Pertanyaan = $request->Pertanyaan_Edit;
        if ($request->hasfile('Gambar_Edit')){
            if ($Tr_Quiz_Detail->Gambar != null) {
                unlink(storage_path('app/public/Soal/') . $Tr_Quiz_Detail->Gambar);
            }
            $Gambar = $request->file('Gambar_Edit');
            $nama_Gambar = $Gambar->getClientOriginalName();
            $extension = $Gambar->getClientOriginalExtension();
            $id = $request->Quiz_Detail_Id;
            $nama_Gambar = ($id). "." . $extension;
            $Gambar->move(storage_path('app/public/Soal'), $nama_Gambar);
            $Tr_Quiz_Detail->Gambar = $nama_Gambar;
        } else {
            $nama_Gambar = null;
        }
        $Tr_Quiz_Detail->save();
        
        return redirect () ->back() ->with ('status', 'Quiz Telah Berhasil Diubah!!');
    }

  
    public function delete(Request $request, $Quiz_Detail_Id)
    {
        $soalquiz = DB::connection('MyEbadah')->table('Tr_Quiz_Detail')
            ->where('Quiz_Detail_Id', $request->Quiz_Detail_Id_Delete)->count();
        $jwbn = DB::connection('MyEbadah')->table('Tr_Jawaban')
            ->where('Quiz_Detail_Id', $request->Quiz_Detail_Id_Delete)->count();    
        if ($soalquiz > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Quiz_Detail')->where('Quiz_Detail_Id', $request->Quiz_Detail_Id_Delete)->delete();
        }
        if ($jwbn > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Jawaban')->where('Quiz_Detail_Id', $request->Quiz_Detail_Id_Delete)->delete();
        }
        return redirect()->back()->with('status', 'Soal berhasil dihapus!');
    }
}

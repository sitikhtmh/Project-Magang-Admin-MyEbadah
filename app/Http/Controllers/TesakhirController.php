<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\TrQuiz;
use App\TrQuizDetail;
use App\Materi;
use App\MstrJenisQuiz;

class TesakhirController extends Controller
{
    
    public function index($a)
    {
 
        $tesakhir=DB::connection('MyEbadah')->table('Tr_Quiz')
            ->join('Mstr_Jenis_Quiz', 'Mstr_Jenis_Quiz.Jenis_Quiz_Id', '=', 'Tr_Quiz.Jenis_Quiz_Id')
            ->join('Tr_Materi', 'Tr_Materi.Materi_Id', '=', 'Tr_Quiz.Materi_Id')
            ->where(['Tr_Quiz.Jenis_Quiz_Id'=>'3'])
            ->where(['Tr_Materi.Materi_Id'=>$a])
            ->get();

            $materi = DB::connection('MyEbadah')->table('Tr_Materi')
            ->where(['Materi_Id'=>$a])
            ->first();

            $jenisquiz = DB::connection('MyEbadah')->table('Mstr_Jenis_Quiz')
            ->where(['Jenis_Quiz_Id'=>'3'])
            ->first();
        // dd($a);
        return view('quiz.tesakhir', 
            [
                'tesakhir'=>$tesakhir,
                'materiId' => $a, 
                'materiNama' => $materi ->Nama_Materi, 
                'jenisquizId'=>"3", 
                'jenisQuiz'=>$jenisquiz->Jenis_Quiz
            ]);
    }

   
    public function create()
    {
        return view('quiz.tesakhir');
    }

    
    public function store(Request $request)
    {
        $data1 = [
            'Kode_Quiz' => $request->Kode_Quiz,
            'Jenis_Quiz_Id' =>$request->Jenis_Quiz_Id,
            'Materi_Id'=>$request->Materi_Id,
            'Nama_Quiz' => $request->Nama_Quiz,
        ];
        $insert1 = DB::connection('MyEbadah')->table('Tr_Quiz')->insertGetId($data1);
        
        // dd($insert1);
        return redirect() ->back() ->with ('status', 'Quiz berhasil ditambahkan!!');
    }

    
    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        
        $quizakhir=[
            'Kode_Quiz' => $request->Kode_Quiz_Edit,
            'Nama_Quiz' => $request->Nama_Quiz_Edit
        ];
    
        $update = DB::connection('MyEbadah')->table('Tr_Quiz')
                    ->where('Quiz_Id',$request->Quiz_Id_Edit)->update($quizakhir);
        
        return redirect()->back()->with('status', 'Quiz Berhasil Diubah!');
        // return redirect ("tesakhir/{$request->Materi_Id_Edit}/index") ->with  ('status', 'Quiz Telah Berhasil Diubah!!'); 
    }

  
    public function delete(Request $request, $Quiz_Id)
    {
        $quiz = DB::connection('MyEbadah')->table('Tr_Quiz')
            ->where('Quiz_Id', $request->Quiz_Id_Delete)->count();
        $qakhir = DB::connection('MyEbadah')->table('Tr_Quiz_Detail')
            ->where('Quiz_Id', $request->Quiz_Id_Delete)->count();
        // dd($request->Materi_Id_Delete);
        
        if ($quiz > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Quiz')->where('Quiz_Id', $request->Quiz_Id_Delete)->delete();
        }
        if ($qakhir > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Quiz_Detail')->where('Quiz_Id', $request->Quiz_Id_Delete)->delete();
        }
        
        return redirect()->back()->with('status', 'Quiz berhasil dihapus!');
    }
}

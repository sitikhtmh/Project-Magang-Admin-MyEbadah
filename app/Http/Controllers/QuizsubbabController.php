<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Materi;
use App\TrQuiz;
use App\TrQuizDetail;

class QuizsubbabController extends Controller
{

    public function index($quizBabId)
    {
        $quizbab=DB::connection('MyEbadah')->table('Tr_Quiz')
        ->join('Tr_Materi_Detail','Tr_Materi_Detail.Materi_Detail_Id','=','Tr_Quiz.Materi_Detail_Id')
        ->where(['Tr_Quiz.Materi_Detail_Id'=>$quizBabId])
        ->where(['Tr_Quiz.Jenis_Quiz_Id'=>2])
        ->get();

        $materi=DB::connection('MyEbadah')->table('Tr_Materi_Detail')
        ->where('Materi_Detail_Id', $quizBabId)
        ->first()
        ->Materi_Id;

        $jenisQuiz = DB::connection('MyEbadah')->table('Mstr_Jenis_Quiz')
        ->where(['Jenis_Quiz_Id'=>'2'])
        ->first();

        // dd($materi);
        return view('quiz.quizsubbab',
            [
                'quizbab'=>$quizbab,
                'materiId' => $quizBabId,
                'materi' => $materi,
                'jenisQuizId' => '2',
                'jenisQuiz' => $jenisQuiz->Jenis_Quiz,
            ]);

    }


    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $data = [
            'Jenis_Quiz_Id' => $request->Jeniz_Quiz_Id = '2',
            'Materi_Detail_Id' => $request->Materi_Detail_Id,
            'Materi_Id'=>$request->Materi_Id,
            'Kode_Quiz' => $request->Kode_Quiz,
            'Nama_Quiz' => $request->Nama_Quiz,
        ];
        // dd($request->all());
        $insertquizbab = DB::connection('MyEbadah')->table('Tr_Quiz')->insertGetId($data);
        return redirect("/quizsubbab/{$request->Materi_Detail_Id}") ->with ('status', 'Quiz Telah Berhasil Ditambahkan!!');
    }

   
    public function show($Materi_Detail_Id)
    {
        $quizbab = Quizsubbab::find($Materi_Detail_Id);
        return view('quiz.quizsubbab', ['quizsubbab'=>$quizbab]);
    }

   
    public function edit($id)
    {
        //
    }

 
    public function update(Request $request)
    {   
        $dataEdit = [
            'Kode_Quiz' => $request->Kode_Quiz_Edit,
            'Nama_Quiz' => $request->Nama_Quiz_Edit,
        ];
        $update = DB::connection('MyEbadah')->table('Tr_Quiz')
                    ->where('Materi_Detail_Id',$request->Materi_Detail_Id_Edit)->update($dataEdit);
        // dd($update);
        return redirect ("quizsubbab/{$request->Materi_Detail_Id_Edit}") ->with ('status', 'Quiz Telah Berhasil Diubah!!');
    }

    
    public function delete(Request $request, $Quiz_Id)
    {
        //dd($mtrdid,$mtrid);
        $quiz = DB::connection('MyEbadah')->table('Tr_Quiz')
            ->where('Quiz_Id', $request->Quiz_Id_Delete)->count();
        $qsubbab = DB::connection('MyEbadah')->table('Tr_Quiz_Detail')
            ->where('Quiz_Id', $request->Quiz_Id_Delete)->count();
        // dd($request->Materi_Id_Delete);
        
        if ($quiz > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Quiz')->where('Quiz_Id', $request->Quiz_Id_Delete)->delete();
        }
        if ($qsubbab > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Quiz_Detail')->where('Quiz_Id', $request->Quiz_Id_Delete)->delete();
        }
        
        return redirect()->back()->with('status', 'Quiz berhasil dihapus!');
    }
}

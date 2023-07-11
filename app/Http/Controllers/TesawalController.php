<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\TrQuiz;
use App\TrQuizDetail;
use App\Materi;
use App\MstrJenisQuiz;

class TesawalController extends Controller
{
    
    public function index($a)
    {
 
        $tesawal=DB::connection('MyEbadah')->table('Tr_Quiz')
            ->join('Mstr_Jenis_Quiz', 'Mstr_Jenis_Quiz.Jenis_Quiz_Id', '=', 'Tr_Quiz.Jenis_Quiz_Id')
            ->join('Tr_Materi', 'Tr_Materi.Materi_Id', '=', 'Tr_Quiz.Materi_Id')
            ->where(['Tr_Quiz.Jenis_Quiz_Id'=>'1'])
            ->where(['Tr_Materi.Materi_Id'=>$a])
            ->get();

            $materi = DB::connection('MyEbadah')->table('Tr_Materi')
            ->where(['Materi_Id'=>$a])
            ->first();

            $jenisquiz = DB::connection('MyEbadah')->table('Mstr_Jenis_Quiz')
            ->where(['Jenis_Quiz_Id'=>'1'])
            ->first();
        // dd($a);
        return view('quiz.tesawal', 
            ['tesawal'=>$tesawal, 
            'materiId' => $a, 
            'materiNama' => $materi ->Nama_Materi, 
            'jenisquizId'=>"1", 
            'jenisQuiz'=>$jenisquiz->Jenis_Quiz
            ]);
    }

   
    public function create()
    {
        return view('quiz.tesawal');
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
        
        // dd($request);
        return redirect() ->back() ->with ('status', 'Quiz berhasil ditambahkan!!');
    }

    
    public function show()
    {
        //
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
                    ->where('Quiz_Id',$request->Quiz_Id_Edit)->update($dataEdit);

        return redirect()->back()->with('status', 'Quiz berhasil diubah!');
    }

  
    public function delete(Request $request, $Quiz_Id)
    {
        //dd($mtrdid,$mtrid);
        $quiz = DB::connection('MyEbadah')->table('Tr_Quiz')
            ->where('Quiz_Id', $request->Quiz_Id_Delete)->count();
        $qawal = DB::connection('MyEbadah')->table('Tr_Quiz_Detail')
            ->where('Quiz_Id', $request->Quiz_Id_Delete)->count();
        // dd($request->Materi_Id_Delete);
        
        if ($quiz > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Quiz')->where('Quiz_Id', $request->Quiz_Id_Delete)->delete();
        }
        if ($qawal > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Quiz_Detail')->where('Quiz_Id', $request->Quiz_Id_Delete)->delete();
        }
        
        return redirect()->back()->with('status', 'Quiz berhasil dihapus!');
    }
}

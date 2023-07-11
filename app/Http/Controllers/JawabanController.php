<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\TrQuizDetail;
use App\TrJawaban;

class JawabanController extends Controller
{
    
    public function index($a)
    {
        $keySoal=DB::connection('MyEbadah')->table('Tr_Jawaban')
            ->join('Tr_Quiz_Detail', 'Tr_Jawaban.Quiz_Detail_Id', '=', 'Tr_Quiz_Detail.Quiz_Detail_Id')
            ->where(['Tr_Quiz_Detail.Quiz_Detail_Id'=>$a])
            ->get();
        $quizSubbab=DB::connection('MyEbadah')->table('Tr_Quiz_Detail')
             ->where(['Tr_Quiz_Detail.Quiz_Detail_Id'=>$a])
            ->first();

        // dd($a);

        return view('jawaban.index', 
        [
            'keySoal'=> $keySoal, 
            'quizDetailId'=>$a,
            'quizId'=>$quizSubbab->Quiz_Id, 
            'pertanyaan'=>$quizSubbab->Pertanyaan,
        ]);
       
    }

   
    public function create()
    {
      
    }

    
    public function store(Request $request)
    {
        if ($request->optradio1 == 'on'){
            $jawaban = 1;
        }
        else{
            $jawaban = 0;
        }
        $data = [
            'Quiz_Detail_Id' => $request->Quiz_Detail_Id,
            'Jawaban' => $request->Jawaban,
            'Is_Jawaban' => $jawaban
        ];
        
        $insertjawaban = DB::connection('MyEbadah')->table('Tr_Jawaban')->insertGetId($data);
        return redirect() -> back() ->with ('status', 'Jawaban Telah Berhasil Ditambahkan!!');
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
        if ($request->optradio1 == 'on'){
            $jawabanEdit = 1;
        }
        else{
            $jawabanEdit = 0;
        }
        
        $dataEdit = [
            'Quiz_Detail_Id' => $request->Quiz_Detail_Id_Edit,
            'Jawaban' => $request->Jawaban_Edit,
            'Is_Jawaban' => $jawabanEdit
        ];
        $update = DB::connection('MyEbadah')->table('Tr_Jawaban')
                    ->where('Jawaban_Id',$request->Jawaban_Id_Edit)->update($dataEdit);

        return redirect()-> back() ->with ('status', 'Jawaban Telah Berhasil Diubah!!');
    }


    

    
    public function delete(Request $request, $Jawaban_Id)
    {
        $jawaban = DB::connection('MyEbadah')->table('Tr_Jawaban')
            ->where('Jawaban_Id', $request->Jawaban_Id_Delete)->count();
        $jawabanstudent = DB::connection('MyEbadah')->table('Tr_Jawaban_Student')
            ->where('Jawaban_Id', $request->Jawaban_Id_Delete)->count();    
        if ($jawaban > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Jawaban')->where('Jawaban_Id', $request->Jawaban_Id_Delete)->delete();
        }
        if ($jawabanstudent > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Jawaban_Student')->where('Jawaban_Id', $request->Jawaban_Id_Delete)->delete();
        }
        return redirect()->back()->with('status', 'Pertanyaan berhasil dihapus!');
        // DB::table('Tr_Jawaban')->where('Jawaban_Id',$request->Jawaban_Id_Delete)->delete();
        // return redirect()->back()->with('status', 'Jawaban berhasil dihapus!');
    }
}

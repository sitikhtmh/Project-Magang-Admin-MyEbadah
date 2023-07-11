<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstrStudent;
use App\StudentHistory;
use App\TrMateriDetail;
use App\TrQuiz;
use App\MstrJenisQuiz;
use App\Materi;
use DB;
use Session;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $prodi_id = $request->prodi_id;

        if (Session::get('login')) {
            if($request->prodi_id != null){
                $mahasiswa=DB::connection('MyEbadah')->table('Mstr_Student')
                ->join('V_Mahasiswa','V_Mahasiswa.STUDENTID','=','Mstr_Student.Nim')
                ->join('Mstr_Gender','Mstr_Student.Gender_Id','=','Mstr_Gender.Gender_Id')
                ->join('Mstr_Student_Status','Mstr_Student.Student_Status_Id','=','Mstr_Student_Status.Student_status_Id')
                ->where('Mstr_Student.Nim','!=',null)
                ->where('V_Mahasiswa.DEPARTMENT_ID',$request->prodi_id)
                ->get();
                }else{
                    $mahasiswa = [];
                }

                $datadropdown=DB::connection('MyEbadah')->table('V_Department')->get();
                
                return view('laporan.mahasiswa', ['mahasiswa'=>$mahasiswa,'prodi'=>$datadropdown, 'prodi_id'=> $prodi_id]);
            } 
            else {
                return view ('login')->with('error','password atau email anda salah !');
            }
        

    }

    // public function filter(Request $request)
    // {
    //     // dd($request->all());
    //     if ($request->prodi != '') {
           
    //         $mahasiswa=DB::connection('MyEbadah')->table('Mstr_Student')
    //         ->join('V_Mahasiswa','V_Mahasiswa.STUDENTID','=','Mstr_Student.Nim')
    //         ->join('Mstr_Gender','Mstr_Student.Gender_Id','=','Mstr_Gender.Gender_Id')
    //         ->join('Mstr_Student_Status','Mstr_Student.Student_Status_Id','=','Mstr_Student_Status.Student_status_Id')
    //         // ->where('Mstr_Student.Student_Status_Id','2')
    //         ->where('Mstr_Student.Nim','!=',null)
    //         ->where('V_Mahasiswa.DEPARTMENT_ID',$request->prodi)
    //         ->get();
           
    //     } 
    //     else {
    //         $mahasiswa=DB::connection('MyEbadah')->table('Mstr_Student')
    //         ->join('Mstr_Gender','Mstr_Student.Gender_Id','=','Mstr_Gender.Gender_Id')
    //         ->join('Mstr_Student_Status','Mstr_Student.Student_Status_Id','=','Mstr_Student_Status.Student_status_Id')
    //         ->where('Mstr_Student.Nim','!=',null)
    //         ->get();
    //     }
        
    //     $datadropdown=DB::connection('MyEbadah')->table('V_Department')->get();

    //     return view('laporan.mahasiswa', ['mahasiswa'=>$mahasiswa,'prodi'=>$datadropdown, 'filter'=>$request->prodi]);
    // }

    public function show($studentid)
    {
        
        $mahasiswahistori=DB::connection('MyEbadah')->table('Tr_Student_History')
        ->join('Mstr_Student','Tr_Student_History.Student_Id','=','Mstr_Student.Student_Id')
        ->join('Tr_Materi','Tr_Student_History.Materi_Id','=','Tr_Materi.Materi_Id')
        ->where(['Mstr_Student.Student_Id'=>$studentid])  
        ->get();

        $nama=DB::connection('MyEbadah')->table('Mstr_Student')
        ->where(['Student_Id'=>$studentid])  
        ->first();
        // dd($stdid);
        return view('laporan.mahasiswahistory', ['mahasiswahistory'=>$mahasiswahistori, 'mahasiswaNama'=>$nama->Nama_Lengkap, 'stdid'=>$nama->Student_Id]);
    }

    public function detail($studentdet, $materiId)
    {
        $mahasiswadetaill=DB::connection('MyEbadah')->table('Tr_Student_History_Detail')
        ->join('Tr_Student_History','Tr_Student_History_Detail.Student_History_Id','=','Tr_Student_History.Student_History_Id')
        ->join('Tr_Materi_Detail','Tr_Student_History_Detail.Materi_Detail_Id','=','Tr_Materi_Detail.Materi_Detail_Id')
        ->join('Mstr_Student','Tr_Student_History.Student_Id','=','Mstr_Student.Student_Id')
        ->where(['Mstr_Student.Student_Id'=>$studentdet]) 
        ->where(['Tr_Materi_Detail.Materi_Id'=>$materiId])
        ->get();
        
        

        $materi=DB::connection('MyEbadah')->table('Tr_Materi')
        ->where(['Materi_Id'=>$studentdet])  
        ->first();

        $nama=DB::connection('MyEbadah')->table('Mstr_Student')
        ->where(['Student_Id'=>$studentdet])  
        ->first();

        // dd($nama);
        return view('laporan.mahasiswadetail', ['mahasiswadetail'=>$mahasiswadetaill, 'mahasiswaNama'=>$nama->Nama_Lengkap, 'stdid'=>$nama->Student_Id]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

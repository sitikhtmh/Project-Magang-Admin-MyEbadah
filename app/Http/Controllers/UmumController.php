<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;


class UmumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Session::get('login')) {
        $umumm=DB::connection('MyEbadah')->table('Mstr_Student')
        ->join('Mstr_Gender','Mstr_Student.Gender_Id','=','Mstr_Gender.Gender_Id')
        ->join('Mstr_Student_Status','Mstr_Student.Student_Status_Id','=','Mstr_Student_Status.Student_status_Id')
        ->where(['Mstr_Student.Student_Status_Id'=>'1'])
        ->orwhere(['Mstr_Student.Student_Status_Id'=>'4'])
        ->orwhere(['Mstr_Student.Student_Status_Id'=>'5'])
        ->get();
        return view('laporan.umum', ['umum'=>$umumm]);
        }
        else {
            return view ('login')->with('error','password atau email anda salah !');
        }
    }

    public function show($umumhis)
    {
        $umumhistori=DB::connection('MyEbadah')->table('Tr_Student_History')
        ->join('Mstr_Student','Tr_Student_History.Student_Id','=','Mstr_Student.Student_Id')
        ->join('Tr_Materi','Tr_Student_History.Materi_Id','=','Tr_Materi.Materi_Id')
        ->where(['Mstr_Student.Student_Id'=>$umumhis])  
        ->get();
        $nama=DB::connection('MyEbadah')->table('Mstr_Student')
        ->where(['Student_Id'=>$umumhis])  
        ->first();
        return view('laporan.umumhistory', ['umumhistory'=>$umumhistori, 'mahasiswaNama'=>$nama->Nama_Lengkap]);
    }

    public function detail($umumdet, $materiId)
    {
        $umumdetaill=DB::connection('MyEbadah')->table('Tr_Student_History_Detail')
        ->join('Tr_Student_History','Tr_Student_History_Detail.Student_History_Id','=','Tr_Student_History.Student_History_Id')
        ->join('Tr_Materi_Detail','Tr_Student_History_Detail.Materi_Detail_Id','=','Tr_Materi_Detail.Materi_Detail_Id')
        ->join('Mstr_Student','Tr_Student_History.Student_Id','=','Mstr_Student.Student_Id')
        ->where(['Mstr_Student.Student_Id'=>$umumdet]) 
        ->where(['Tr_Materi_Detail.Materi_Id'=>$materiId])
        ->get();
        $nama=DB::connection('MyEbadah')->table('Mstr_Student')
        ->where(['Student_Id'=>$umumdet])  
        ->first();
        return view('laporan.umumdetail', ['umumdetail'=>$umumdetaill, 'mahasiswaNama'=>$nama->Nama_Lengkap, 'stdid'=>$nama->Student_Id]);
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

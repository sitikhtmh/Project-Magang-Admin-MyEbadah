<?php

namespace App\Http\Controllers;
use App\Materi;
use App\Materi_Detail;
use Illuminate\Http\Request;
use DB;
use Session;


class MateriController extends Controller
{
    public function show_thumbnail(Materi $mtr)
    {
        $materi= DB::connection('MyEbadah')->table('Tr_Materi')
        ->where([
            'Materi_Id'=> $mtr->Materi_Id
        ])->first();

        if ($materi->Thumbnail != null) {
            $Thumbnail = base_path('storage/app/public/Thumbnail/') . $materi->Thumbnail;
            return response()->file($Thumbnail);
        }
        else{
            alert()->warning('Data tidak ditemukan...', 'Maaf')->persistent('OK');
            return redirect()->route('materi.index');
        }
    }

    public function index()
    {
        if (Session::get('login')) {
        $materi = Materi::all();
        return view('materi.index', ['materi'=>$materi]);
        }
        else {
            return view ('login')->with('error','password atau email anda salah !');
        }

    }                                                                                                                                                                                       
    
    public function create()
    {
        
        return view('materi.index');
    }

    public function store(Request $request)
    {
        
        $Thumbnail = $request->file('Thumbnail');

        if ($Thumbnail!=null){
            $nama_Thumbnail = $Thumbnail->getClientOriginalName();
            //$Thumbnail->move(storage_path('app/public/Thumbnail'), $nama_Thumbnail);
            
        } else {
            $nama_Thumbnail = null;
        }
        
        $data=[
            'Urut' => $request->Urut,
            'Kode_Materi' => $request->Kode_Materi,
            'Nama_Materi' => $request->Nama_Materi,
            'Deskripsi' => $request->Deskripsi,
            'Thumbnail' => $nama_Thumbnail,
        ];
    
        $insert2 = DB::connection('MyEbadah')->table('Tr_Materi')->insertGetId($data);  

      
        $extension = $Thumbnail->getClientOriginalExtension();
        $id = $insert2;
        $new_name = ($id). "." . $extension;
        $Thumbnail->move(storage_path('app/public/Thumbnail'),  $new_name);
        $update =  DB::connection('MyEbadah')->table('Tr_Materi')->where('Materi_Id',$insert2)->update(['Thumbnail' =>$new_name]);

        return redirect('/materi') ->with ('status', 'Materi Telah Berhasil Ditambahkan!!');

    }

    public function update(Request $request)
    {
        $Thumbnail = $request->file('Thumbnail_Edit');
        if ($Thumbnail!=null){
            $nama_Thumbnail = $Thumbnail->getClientOriginalName();
            // $Thumbnail->move(storage_path('app/public/Thumbnail/'), $nama_Thumbnail);
            $extension = $Thumbnail->getClientOriginalExtension();
            $id = $request->Materi_Id_Edit;
            $nama_Thumbnail = ($id). "." . $extension;
            $Thumbnail->move(storage_path('app/public/Thumbnail'),  $nama_Thumbnail);
           
        } else {
            $nama_Thumbnail = null;
        }
        
        if ($request->Thumbnail_Save !=null)
        {
            $materi=[
                'Urut' => $request->Urut_Edit,
                'Kode_Materi' => $request->Kode_Materi_Edit,
                'Nama_Materi' => $request->Nama_Materi_Edit,
                'Deskripsi' => $request->Deskripsi_Edit,
                'Thumbnail' => $request->Thumbnail_Save
            ];
        }
        else
        {
            $materi=[
            'Urut' => $request->Urut_Edit,
            'Kode_Materi' => $request->Kode_Materi_Edit,
            'Nama_Materi' => $request->Nama_Materi_Edit,
            'Deskripsi' => $request->Deskripsi_Edit,
            'Thumbnail' => $nama_Thumbnail,
            ];
        }
        $update = DB::connection('MyEbadah')->table('Tr_Materi')
                    ->where('Materi_Id',$request->Materi_Id_Edit)->update($materi);

       
        return redirect('/materi') ->with ('status', 'Materi Telah Berhasil Diubah!!'); 
    }
    
    public function delete(Request $request)
    {
        $studenthistory = DB::connection('MyEbadah')->table('Tr_Student_History')
            ->where('Materi_Id', $request->Materi_Id_Delete)->count();

        $quiz = DB::connection('MyEbadah')->table('Tr_Quiz')
            ->where('Materi_Id', $request->Materi_Id_Delete)->count();

        $subbab = DB::connection('MyEbadah')->table('Tr_Materi_Detail')
        ->where('Materi_Id', $request->Materi_Id_Delete)->count();

        $materi = DB::connection('MyEbadah')->table('Tr_Materi')
            ->where('Materi_Id', $request->Materi_Id_Delete)->count();
            
         
        if ($studenthistory > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Student_History')->where('Materi_Id', $request->Materi_Id_Delete)->delete();
        }
        
        if ($quiz > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Quiz')->where('Materi_Id', $request->Materi_Id_Delete)->delete();
        }
       
        if ($subbab > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Materi_Detail')->where('Materi_Id', $request->Materi_Id_Delete)->delete();
        }
        
        if ($materi > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Materi')->where('Materi_Id', $request->Materi_Id_Delete)->delete();
        }

        return redirect('/materi') ->with ('status', 'Materi Telah Berhasil Dihapus!'); 
    }
}

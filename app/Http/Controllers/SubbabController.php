<?php

namespace App\Http\Controllers;
use App\Materi_Detail;
use App\Materi;
use Illuminate\Http\Request;
use DB;
use App\TrMateriDetail;
use Raju\Streamer\Helpers\VideoStream;

class SubbabController extends Controller
{
    public function show_file_upload(Materi_Detail $bab)
    {
        $subbab= DB::connection('MyEbadah')->table('Tr_Materi_Detail')
            ->where([
                    'Materi_Detail_Id'=> $bab->Materi_Detail_Id
        ])->first();


        if ($subbab->File_Upload != null) {
            $File_Upload = base_path('storage/app/public/File/') . $subbab->File_Upload;
            $stream = new VideoStream($File_Upload);
            return response()->stream(function() use ($stream) {
                $stream->start();
            });
        }
        else{
            alert()->warning('Data tidak ditemukan...', 'Maaf')->persistent('OK');
            return redirect()->route('subbab.index');
        }
    }


    public function index (Materi $mtr)
    {
        $subbab=DB::connection('MyEbadah')->table('Tr_Materi')
        ->join('Tr_Materi_Detail','Tr_Materi.Materi_Id','=','Tr_Materi_Detail.Materi_Id')
        ->where(['Tr_Materi.Materi_Id'=>$mtr->Materi_Id])
        ->get();
        $materi = DB::connection('MyEbadah')->table('Tr_Materi')
        ->where(['Materi_Id'=>$mtr->Materi_Id])
        ->first();
        return view('subbab.index', ['subbab'=>$subbab, 'materiId' => $mtr->Materi_Id, 'materiNama' => $materi->Nama_Materi]);
    
    }


    public function create()
    {
      return view('subbab.index');
    }


    public function store(Request $request)
    
    {
        $File_Upload = $request->file('File_Upload');

        if ($File_Upload){
            $nama_File_Upload = $File_Upload->getClientOriginalName();
            //$File_Upload->move(storage_path('app/public/File'), $nama_File_Upload);
        } else {
            $nama_File_Upload = null;
        }
       
        $data = [
            'Urut' => $request->Urut,
            'Materi_Id' => $request->Materi_Id,
            'Deskripsi' => $request->Deskripsi,
            'File_Upload' => $nama_File_Upload,
        ];
    
       
        $insert2 = DB::connection('MyEbadah')->table('Tr_Materi_Detail')->insertGetId($data);
        if ($File_Upload){
            $extension = $File_Upload->getClientOriginalExtension();
            $id = $insert2;
            $new_name = ($id). "." . $extension;
            $File_Upload->move(storage_path('app/public/File'),  $new_name);
            $update =  DB::connection('MyEbadah')->table('Tr_Materi_Detail')->where('Materi_Detail_Id',$insert2)->update(['File_Upload' =>$new_name]);
        }
        

        return redirect("/subbab/{$request->Materi_Id}/index") ->with ('status', 'Sub Bab Telah Berhasil Ditambahkan!!');

    }


  
    public function update(Request $request)
    {
       
        $File_Upload = $request->file('fileuplod_Edit');
        if ($File_Upload!=null){
            $nama_File_Upload = $File_Upload->getClientOriginalName();
            $extension = $File_Upload->getClientOriginalExtension();
            $id = $request->Materi_Detail_Id_Edit;
            $nama_File_Upload = ($id). "." . $extension;
            $File_Upload->move(storage_path('app/public/File'), $nama_File_Upload);
        } else {
            $nama_File_Upload = null;
        }
        
        if ($request->File_Upload_Save !=null)
        {
            
            $subbab=[           
                'Urut' => $request->Urut_Edit,     
                'Deskripsi' => $request->Deskripsi_Edit,
                'File_Upload' => $request->File_Upload_Save
            ];
        }
        else
        {
            $subbab=[   
                'Urut' => $request->Urut_Edit,              
                'Deskripsi' => $request->Deskripsi_Edit,
                'File_Upload' => $nama_File_Upload
            ];
        }

        $update = DB::connection('MyEbadah')->table('Tr_Materi_Detail')
                    ->where('Materi_Detail_Id',$request->Materi_Detail_Id_Edit)->update($subbab);
     
        return redirect ("subbab/{$request->Materi_Id_Edit}/index") ->with  ('status', 'Sub Bab Telah Berhasil Diubah!!'); 
      
    }

    public function delete(Request $request, $Materi_Id)
    {
    
        $quiz = DB::connection('MyEbadah')->table('Tr_Quiz')
            ->where('Materi_Detail_Id', $request->Materi_Id_Delete)->count();
        $historydetail = DB::connection('MyEbadah')->table('Tr_Student_History_Detail')
            ->where('Materi_Detail_Id', $request->Materi_Id_Delete)->count();
        $subbab = DB::connection('MyEbadah')->table('Tr_Materi_Detail')
            ->where('Materi_Detail_Id', $request->Materi_Id_Delete)->count();
      
        
        if ($quiz > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Quiz')->where('Materi_Detail_Id', $request->Materi_Id_Delete)->delete();
        }
        if ($historydetail > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Student_History_Detail')->where('Materi_Detail_Id', $request->Materi_Id_Delete)->delete();
        }
        if ($subbab > 0) {
            $hapus = DB::connection('MyEbadah')->table('Tr_Materi_Detail')->where('Materi_Detail_Id', $request->Materi_Id_Delete)->delete();
        }
        

        return redirect("/subbab/{$Materi_Id}/index") ->with('status', 'Sub Bab berhasil dihapus!');
    }
}

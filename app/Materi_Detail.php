<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi_Detail extends Model
{
    protected $table = 'Tr_Materi_Detail';
    protected $primaryKey = 'Materi_Detail_Id';

    protected $fillable = ['Materi_Id', 'Urut', 'Deskripsi', 'File_Upload']; 
    
}
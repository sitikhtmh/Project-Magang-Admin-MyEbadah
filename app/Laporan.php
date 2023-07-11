<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'Mstr_Student';
    protected $fillable = ['Nim', 'Nama', 'Email'];
}

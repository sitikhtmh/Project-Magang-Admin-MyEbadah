<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $Student_Id
 * @property string $Nim
 * @property int $Id_Pegawai
 * @property string $Email
 * @property string $Nama_Lengkap
 * @property integer $Gender_Id
 * @property string $Tanggal_Lahir
 * @property integer $Student_Status_Id
 * @property string $Password
 * @property boolean $Is_Sso
 * @property string $Created_By
 * @property string $Created_Date
 * @property string $Modified_By
 * @property string $Modified_Date
 * @property MstrGender $mstrGender
 * @property MstrStudentStatus $mstrStudentStatus
 * @property TrJawabanStudent[] $trJawabanStudents
 * @property TrStudentHistory[] $trStudentHistories
 */
class MstrStudent extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Mstr_Student';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'Student_Id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['Nim', 'Id_Pegawai', 'Email', 'Nama_Lengkap', 'Gender_Id', 'Tanggal_Lahir', 'Student_Status_Id', 'Password', 'Is_Sso', 'Created_By', 'Created_Date', 'Modified_By', 'Modified_Date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mstrGender()
    {
        return $this->belongsTo('App\MstrGender', 'Gender_Id', 'Gender_Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mstrStudentStatus()
    {
        return $this->belongsTo('App\MstrStudentStatus', 'Student_Status_Id', 'Student_Status_Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trJawabanStudent()
    {
        return $this->hasMany('App\TrJawabanStudent', 'Student_Id', 'Student_Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trStudentHistori()
    {
        return $this->hasMany('App\TrStudentHistory', 'Student_Id', 'Student_Id');
    }
}

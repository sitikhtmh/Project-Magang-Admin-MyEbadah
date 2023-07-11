<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $Materi_Id
 * @property string $Kode_Materi
 * @property string $Nama_Materi
 * @property string $Deskripsi
 * @property string $Thumbnail
 * @property string $Created_By
 * @property string $Created_Date
 * @property string $Modified_By
 * @property string $Modified_Date
 * @property TrMateriDetail[] $trMateriDetails
 * @property TrQuiz[] $trQuizzes
 * @property TrStudentHistory[] $trStudentHistories
 */
class TrMateri extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Tr_Materi';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'Materi_Id';

    /**
     * @var array
     */
    protected $fillable = ['Kode_Materi', 'Nama_Materi', 'Deskripsi', 'Thumbnail', 'Created_By', 'Created_Date', 'Modified_By', 'Modified_Date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trMateriDetails()
    {
        return $this->hasMany('App\TrMateriDetail', 'Materi_Id', 'Materi_Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trQuizzes()
    {
        return $this->hasMany('App\TrQuiz', 'Materi_Id', 'Materi_Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trStudentHistories()
    {
        return $this->hasMany('App\TrStudentHistory', 'Materi_Id', 'Materi_Id');
    }
}

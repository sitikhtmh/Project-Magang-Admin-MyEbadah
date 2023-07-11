<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $Materi_Detail_Id
 * @property int $Materi_Id
 * @property string $Deskripsi
 * @property string $File_Upload
 * @property string $Created_By
 * @property string $Created_Date
 * @property string $Modified_By
 * @property string $Modified_Date
 * @property integer $Urut
 * @property TrMateri $trMateri
 * @property TrQuiz[] $trQuizzes
 * @property TrStudentHistoryDetail[] $trStudentHistoryDetails
 */
class TrMateriDetail extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Tr_Materi_Detail';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'Materi_Detail_Id';

    /**
     * @var array
     */
    protected $fillable = ['Materi_Id', 'Deskripsi', 'File_Upload', 'Created_By', 'Created_Date', 'Modified_By', 'Modified_Date', 'Urut'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trMateri()
    {
        return $this->belongsTo('App\TrMateri', 'Materi_Id', 'Materi_Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trQuiz()
    {
        return $this->hasMany('App\TrQuiz', 'Materi_Detail_Id', 'Materi_Detail_Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trStudentHistoryDetail()
    {
        return $this->hasMany('App\TrStudentHistoryDetail', 'Materi_Detail_Id', 'Materi_Detail_Id');
    }
}

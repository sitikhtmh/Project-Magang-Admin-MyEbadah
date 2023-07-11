<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $Student_History_Id
 * @property integer $Student_Id
 * @property int $Materi_Id
 * @property string $Mulai_Tes_Awal
 * @property string $Selesai_Tes_Awal
 * @property string $Mulai_Tes_Akhir
 * @property string $Selesai_Tes_Akhir
 * @property integer $Score_Tes_Awal
 * @property integer $Score_Tes_Akhir
 * @property string $Created_By
 * @property string $Created_Date
 * @property string $Modified_By
 * @property string $Modified_Date
 * @property MstrStudent $mstrStudent
 * @property TrMateri $trMateri
 * @property TrStudentHistoryDetail[] $trStudentHistoryDetails
 */
class StudentHistory extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Tr_Student_History';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'Student_History_Id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['Student_Id', 'Materi_Id', 'Mulai_Tes_Awal', 'Selesai_Tes_Awal', 'Mulai_Tes_Akhir', 'Selesai_Tes_Akhir', 'Score_Tes_Awal', 'Score_Tes_Akhir', 'Created_By', 'Created_Date', 'Modified_By', 'Modified_Date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mstrStudent()
    {
        return $this->belongsTo('App\MstrStudent', 'Student_Id', 'Student_Id');
    }

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
    public function trStudentHistoryDetail()
    {
        return $this->hasMany('App\TrStudentHistoryDetail', 'Student_History_Id', 'Student_History_Id');
    }
}

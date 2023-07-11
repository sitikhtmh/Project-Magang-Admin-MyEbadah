<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $Student_History_Detail_Id
 * @property integer $Student_History_Id
 * @property int $Materi_Detail_Id
 * @property string $Mulai_Belajar
 * @property string $Mulai_Tes
 * @property string $Selesai_Tes
 * @property integer $Score_Tes
 * @property string $Created_By
 * @property string $Created_Date
 * @property string $Modified_By
 * @property string $Modified_Date
 * @property TrStudentHistory $trStudentHistory
 * @property TrMateriDetail $trMateriDetail
 */
class StudentHistoryDetail extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Tr_Student_History_Detail';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'Student_History_Detail_Id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['Student_History_Id', 'Materi_Detail_Id', 'Mulai_Belajar', 'Mulai_Tes', 'Selesai_Tes', 'Score_Tes', 'Created_By', 'Created_Date', 'Modified_By', 'Modified_Date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trStudentHistory()
    {
        return $this->belongsTo('App\TrStudentHistory', 'Student_History_Id', 'Student_History_Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trMateriDetail()
    {
        return $this->belongsTo('App\TrMateriDetail', 'Materi_Detail_Id', 'Materi_Detail_Id');
    }
}

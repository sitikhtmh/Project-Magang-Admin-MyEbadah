<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $Jawaban_Student_Id
 * @property int $Jawaban_Id
 * @property integer $Student_Id
 * @property string $Created_By
 * @property string $Created_Date
 * @property string $Modified_By
 * @property string $Modified_Date
 * @property TrJawaban $trJawaban
 * @property MstrStudent $mstrStudent
 */
class TrJawabanStudent extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Tr_Jawaban_Student';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'Jawaban_Student_Id';

    /**
     * @var array
     */
    protected $fillable = ['Jawaban_Id', 'Student_Id', 'Created_By', 'Created_Date', 'Modified_By', 'Modified_Date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trJawaban()
    {
        return $this->belongsTo('App\TrJawaban', 'Jawaban_Id', 'Jawaban_Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mstrStudent()
    {
        return $this->belongsTo('App\MstrStudent', 'Student_Id', 'Student_Id');
    }
}

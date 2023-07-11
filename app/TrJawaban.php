<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $Jawaban_Id
 * @property int $Quiz_Detail_Id
 * @property string $Jawaban
 * @property boolean $Is_Jawaban
 * @property string $Created_By
 * @property string $Created_Date
 * @property string $Modified_By
 * @property string $Modified_Date
 * @property TrQuizDetail $trQuizDetail
 * @property TrJawabanStudent[] $trJawabanStudents
 */
class TrJawaban extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Tr_Jawaban';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'Jawaban_Id';

    /**
     * @var array
     */
    protected $fillable = ['Quiz_Detail_Id', 'Jawaban', 'Is_Jawaban', 'Created_By', 'Created_Date', 'Modified_By', 'Modified_Date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trQuizDetail()
    {
        return $this->belongsTo('App\TrQuizDetail', 'Quiz_Detail_Id', 'Quiz_Detail_Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trJawabanStudents()
    {
        return $this->hasMany('App\TrJawabanStudent', 'Jawaban_Id', 'Jawaban_Id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $Quiz_Detail_Id
 * @property int $Quiz_Id
 * @property string $Pertanyaan
 * @property string $Gambar
 * @property string $Created_By
 * @property string $Created_Date
 * @property string $Modified_By
 * @property string $Modified_Date
 * @property TrQuiz $trQuiz
 * @property TrJawaban[] $trJawaban
 */
class TrQuizDetail extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Tr_Quiz_Detail';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'Quiz_Detail_Id';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['Quiz_Id', 'Pertanyaan', 'Gambar', 'Created_By', 'Created_Date', 'Modified_By', 'Modified_Date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trQuiz()
    {
        return $this->belongsTo('App\TrQuiz', 'Quiz_Id', 'Quiz_Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trJawaban()
    {
        return $this->hasMany('App\TrJawaban', 'Quiz_Detail_Id', 'Quiz_Detail_Id');
    }
}

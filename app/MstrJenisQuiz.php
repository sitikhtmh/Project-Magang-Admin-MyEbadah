<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $Jenis_Quiz_Id
 * @property string $Jenis_Quiz_Code
 * @property string $Jenis_Quiz
 * @property string $Created_By
 * @property string $Created_Date
 * @property string $Modified_By
 * @property string $Modified_Date
 * @property TrQuiz[] $trQuizzes
 */
class MstrJenisQuiz extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Mstr_Jenis_Quiz';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'Jenis_Quiz_Id';

    /**
     * @var array
     */
    protected $fillable = ['Jenis_Quiz_Code', 'Jenis_Quiz', 'Created_By', 'Created_Date', 'Modified_By', 'Modified_Date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trQuiz()
    {
        return $this->hasMany('App\TrQuiz', 'Jenis_Quiz_Id', 'Jenis_Quiz_Id');
    }
}

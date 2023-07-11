<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $Quiz_Id
 * @property string $Kode_Quiz
 * @property int $Jenis_Quiz_Id
 * @property int $Materi_Detail_Id
 * @property int $Materi_Id
 * @property string $Nama_Quiz
 * @property string $Created_By
 * @property string $Created_Date
 * @property string $Modified_By
 * @property string $Modified_Date
 * @property MstrJenisQuiz $mstrJenisQuiz
 * @property TrMateriDetail $trMateriDetail
 * @property TrMateri $trMateri
 * @property TrQuizDetail[] $trQuizDetail
 */
class TrQuiz extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'Tr_Quiz';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'Quiz_Id';

    /**
     * @var array
     */
    protected $fillable = ['Kode_Quiz', 'Jenis_Quiz_Id', 'Materi_Detail_Id', 'Materi_Id', 'Nama_Quiz', 'Created_By', 'Created_Date', 'Modified_By', 'Modified_Date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mstrJenisQuiz()
    {
        return $this->belongsTo('App\MstrJenisQuiz', 'Jenis_Quiz_Id', 'Jenis_Quiz_Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trMateriDetail()
    {
        return $this->belongsTo('App\TrMateriDetail', 'Materi_Detail_Id', 'Materi_Detail_Id');
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
    public function trQuizDetail()
    {
        return $this->hasMany('App\TrQuizDetail', 'Quiz_Id', 'Quiz_Id');
    }
}
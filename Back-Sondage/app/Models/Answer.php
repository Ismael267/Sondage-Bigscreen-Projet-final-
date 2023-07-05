<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['answer','question_id', 'survey_token_id'];

     /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'answer' => 'array',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function surveyToken()
{
    return $this->belongsTo(SurveyToken::class);
}

}

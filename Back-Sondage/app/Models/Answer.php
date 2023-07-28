<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<string>
     */
    protected $fillable = ['answer', 'question_id', 'survey_token_id'];

    /**
     * Les attributs qui devraient être convertis.
     *
     * @var array
     */
    protected $casts = [
        'answer' => 'array', // L'attribut 'answer' sera converti en un tableau associatif lors de la récupération des données de la base de données.
    ];

    /**
     * Relation avec le modèle Question.
     * Chaque réponse (Answer) appartient à une question (Question).
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Relation avec le modèle SurveyToken.
     * Chaque réponse (Answer) appartient à un token d'enquête (SurveyToken).
     */
    public function surveyToken()
    {
        return $this->belongsTo(SurveyToken::class);
    }
}

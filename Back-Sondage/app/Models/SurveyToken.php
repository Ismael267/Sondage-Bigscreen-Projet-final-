<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyToken extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = ['token'];

    /**
     * Relation avec le modèle Answer.
     * Un token d'enquête (SurveyToken) peut avoir plusieurs réponses (Answer).
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}

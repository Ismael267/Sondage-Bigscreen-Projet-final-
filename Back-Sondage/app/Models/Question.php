<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<string>
     */
    protected $fillable = ["title", "choices", "type", "body"];

    /**
     * Les attributs qui devraient être convertis.
     *
     * @var array
     */
    protected $casts = ['choices' => 'array'];

    /**
     * Relation avec le modèle Answer.
     * Une question (Question) peut avoir plusieurs réponses (Answer).
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    // Cette partie a été commentée, mais si elle était décommentée, elle représenterait une relation inverse avec le modèle Survey.
    // public function surveys()
    // {
    //     return $this->belongsTo(Survey::class);
    // }
}

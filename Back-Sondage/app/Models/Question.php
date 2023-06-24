<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ["title", "choices", "type", "body"];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = ['choices' => 'array'];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function surveys()
    {
        return $this->belongsTo(Survey::class);
    }
}

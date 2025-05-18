<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'duration',
        'is_active',
    ];

    /**
     * Get the questions for the quiz.
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Get the quiz attempts for the quiz.
     */
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'quiz_attempt_id',
        'question_id',
        'option_id',
        'is_correct',
    ];

    /**
     * Get the quiz attempt that owns the user answer.
     */
    public function quizAttempt()
    {
        return $this->belongsTo(QuizAttempt::class);
    }

    /**
     * Get the question that owns the user answer.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Get the option that owns the user answer.
     */
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}

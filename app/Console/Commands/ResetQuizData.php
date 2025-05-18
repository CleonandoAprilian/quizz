<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\QuizAttempt;
use App\Models\UserAnswer;

class ResetQuizData extends Command
{
    protected $signature = 'quiz:reset {--keep-attempts : Keep user attempts}';
    protected $description = 'Reset quiz data and seed fresh quizzes';

    public function handle()
    {
        if ($this->confirm('Are you sure you want to reset all quiz data? This cannot be undone.')) {
            $this->info('Resetting quiz data...');
            
            \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            
            if (!$this->option('keep-attempts')) {
                UserAnswer::truncate();
                QuizAttempt::truncate();
                $this->info('User attempts have been cleared.');
            }
            
            Option::truncate();
            Question::truncate();
            Quiz::truncate();
            
            \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            
            $this->info('Database cleaned. Seeding fresh quizzes...');
            
            $this->call('db:seed', [
                '--class' => 'QuizSeeder',
            ]);
            
            $this->info('Quiz data has been reset successfully!');
        }
    }
}
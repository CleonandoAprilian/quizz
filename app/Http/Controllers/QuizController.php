<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuizController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the quizzes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::all();
        $user = Auth::user();
        
        // Get the user's quiz attempts
        $quizAttempts = QuizAttempt::where('user_id', $user->id)
            ->orderBy('completed_at', 'desc')
            ->get()
            ->groupBy('quiz_id');
        
        return view('quizzes.index', compact('quizzes', 'quizAttempts'));
    }

    /**
     * Display the specified quiz.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($id);
        
        return view('quizzes.show', compact('quiz'));
    }

    /**
     * Submit a quiz attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request, $id)
    {
        $request->validate([
            'answers' => 'required|array',
            'time_taken' => 'required|integer',
        ]);
        
        $quiz = Quiz::with('questions.options')->findOrFail($id);
        $user = Auth::user();
        $answers = $request->input('answers');
        $timeTaken = $request->input('time_taken');
        
        // Calculate score
        $totalQuestions = $quiz->questions->count();
        $correctAnswers = 0;
        
        // Create quiz attempt
        $quizAttempt = QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'score' => 0, // Will be updated after calculating
            'time_taken' => $timeTaken,
            'completed_at' => Carbon::now(),
        ]);
        
        // Process each answer
        foreach ($answers as $questionId => $optionId) {
            $question = $quiz->questions->find($questionId);
            
            if (!$question) {
                continue;
            }
            
            $option = $question->options->find($optionId);
            
            if (!$option) {
                continue;
            }
            
            $isCorrect = $option->is_correct;
            
            if ($isCorrect) {
                $correctAnswers++;
            }
            
            // Save user answer
            UserAnswer::create([
                'quiz_attempt_id' => $quizAttempt->id,
                'question_id' => $questionId,
                'option_id' => $optionId,
                'is_correct' => $isCorrect,
            ]);
        }
        
        // Calculate and update score
        $score = ($correctAnswers / $totalQuestions) * 100;
        $quizAttempt->update(['score' => $score]);
        
        return redirect()->route('quiz.result', $quizAttempt->id);
    }

    /**
     * Display the quiz result.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function result($id)
    {
        $quizAttempt = QuizAttempt::with(['quiz', 'userAnswers.question.options', 'userAnswers.option'])
            ->findOrFail($id);
        
        return view('quizzes.result', compact('quizAttempt'));
    }
}
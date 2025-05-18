<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user's quiz attempts
        $quizAttempts = QuizAttempt::where('user_id', $user->id)
            ->orderBy('completed_at', 'desc')
            ->take(5)
            ->get();
        
        // Get total quizzes completed
        $totalCompleted = QuizAttempt::where('user_id', $user->id)
            ->select('quiz_id')
            ->distinct()
            ->count();
        
        // Get best score
        $bestScore = QuizAttempt::where('user_id', $user->id)
            ->max('score') ?? 0;
        
        // Get user's rank
        $userRank = 0;
        $userCount = DB::table('users')->count();
        
        if ($userCount > 0) {
            $ranks = DB::table('quiz_attempts')
                ->select('user_id')
                ->groupBy('user_id')
                ->orderByRaw('AVG(score) DESC, AVG(time_taken) ASC')
                ->pluck('user_id')
                ->toArray();
            
            $userRank = array_search($user->id, $ranks) !== false ? array_search($user->id, $ranks) + 1 : $userCount;
        } else {
            $userRank = 1;
        }
        
        return view('dashboard.index', compact('quizAttempts', 'totalCompleted', 'bestScore', 'userRank'));
    }

    /**
     * Show the profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
{
    $user = Auth::user();
    
    // Mengambil semua quiz attempts dari user yang sedang login
    $quizAttempts = QuizAttempt::where('user_id', $user->id)
        ->with('quiz')
        ->orderBy('completed_at', 'desc')
        ->get();
    
    // Menghitung total quiz yang telah diselesaikan
    $totalCompleted = $quizAttempts->count();
    
    // Menghitung rata-rata skor
    $averageScore = $quizAttempts->avg('score') ?? 0;
    
    // Mendapatkan skor tertinggi
    $bestScore = $quizAttempts->max('score') ?? 0;
    
    // Mendapatkan peringkat user
    $userRank = DB::table('users')
        ->join('quiz_attempts', 'users.id', '=', 'quiz_attempts.user_id')
        ->select('users.id')
        ->groupBy('users.id')
        ->orderByRaw('AVG(quiz_attempts.score) DESC')
        ->get()
        ->search(function($user) {
            return $user->id === Auth::id();
        }) + 1; // +1 karena index dimulai dari 0
    
    return view('dashboard.profile', compact(
        'quizAttempts',
        'totalCompleted',
        'averageScore',
        'bestScore',
        'userRank'
    ));
}

    /**
     * Show the leaderboard page.
     *
     * @return \Illuminate\Http\Response
     */
    public function leaderboard()
    {
        // Get top users by average score and time
        $leaderboard = DB::table('quiz_attempts')
            ->join('users', 'quiz_attempts.user_id', '=', 'users.id')
            ->select(
                'users.id',
                'users.name',
                'users.school',
                DB::raw('AVG(quiz_attempts.score) as average_score'),
                DB::raw('AVG(quiz_attempts.time_taken) as average_time'),
                DB::raw('COUNT(DISTINCT quiz_attempts.quiz_id) as quizzes_completed')
            )
            ->groupBy('users.id', 'users.name', 'users.school')
            ->orderByRaw('average_score DESC, average_time ASC')
            ->take(10)
            ->get();
        
        // Get top score
        $topScore = DB::table('quiz_attempts')
            ->join('users', 'quiz_attempts.user_id', '=', 'users.id')
            ->select('users.name', 'quiz_attempts.score')
            ->orderBy('quiz_attempts.score', 'desc')
            ->first();
        
        // Get fastest time
        $fastestTime = DB::table('quiz_attempts')
            ->join('users', 'quiz_attempts.user_id', '=', 'users.id')
            ->select('users.name', 'quiz_attempts.time_taken')
            ->orderBy('quiz_attempts.time_taken', 'asc')
            ->first();
        
        // Get most quizzes completed
        $mostQuizzes = DB::table('quiz_attempts')
            ->join('users', 'quiz_attempts.user_id', '=', 'users.id')
            ->select('users.name', DB::raw('COUNT(DISTINCT quiz_attempts.quiz_id) as quizzes_completed'))
            ->groupBy('users.id', 'users.name')
            ->orderBy('quizzes_completed', 'desc')
            ->first();
        
        return view('dashboard.leaderboard', compact('leaderboard', 'topScore', 'fastestTime', 'mostQuizzes'));
    }

    /**
     * Show the history page.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $user = Auth::user();
        
        // Get all user's quiz attempts
        $quizAttempts = QuizAttempt::where('user_id', $user->id)
            ->orderBy('completed_at', 'desc')
            ->get();
        
        // Get average score
        $averageScore = QuizAttempt::where('user_id', $user->id)
            ->avg('score') ?? 0;
        
        // Get best score
        $bestScore = QuizAttempt::where('user_id', $user->id)
            ->max('score') ?? 0;
        
        return view('dashboard.history', compact('quizAttempts', 'averageScore', 'bestScore'));
    }
}
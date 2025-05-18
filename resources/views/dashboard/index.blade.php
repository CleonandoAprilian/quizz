@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0" data-aos="fade-right">Dashboard</h1>
        <div class="d-flex align-items-center" data-aos="fade-left">
            <span class="text-muted me-2">Welcome back,</span>
            <span class="fw-bold">{{ Auth::user()->name }}</span>
        </div>
    </div>
    
    <div class="row g-4 mb-4">
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card bg-white">
                <div class="icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="number">{{ $totalCompleted }}</div>
                <div class="label">Quizzes Completed</div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card bg-white">
                <div class="icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="number">{{ $bestScore }}%</div>
                <div class="label">Best Score</div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-card bg-white">
                <div class="icon">
                    <i class="fas fa-medal"></i>
                </div>
                <div class="number">#{{ $userRank }}</div>
                <div class="label">Your Rank</div>
            </div>
        </div>
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
            <div class="stat-card bg-white">
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="number">{{ count($quizAttempts) }}</div>
                <div class="label">Recent Activities</div>
            </div>
        </div>
    </div>
    
    <div class="row g-4">
        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Activity</h5>
                    <a href="{{ route('dashboard.history') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    @if(count($quizAttempts) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Quiz</th>
                                        <th>Score</th>
                                        <th>Time</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quizAttempts as $attempt)
                                        <tr class="slide-in-right" style="animation-delay: {{ $loop->index * 0.1 }}s">
                                            <td>{{ $attempt->quiz->title }}</td>
                                            <td>
                                                <span class="badge bg-{{ $attempt->score >= 80 ? 'success' : ($attempt->score >= 60 ? 'warning' : 'danger') }} rounded-pill px-3">
                                                    {{ $attempt->score }}%
                                                </span>
                                            </td>
                                            <td>{{ gmdate('i:s', $attempt->time_taken) }}</td>
                                            <td>{{ $attempt->completed_at->format('M d, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <img src="https://img.freepik.com/free-vector/no-data-concept-illustration_114360-536.jpg" alt="No Data" class="img-fluid mb-3" style="max-height: 200px;">
                            <h5>No quiz attempts yet</h5>
                            <p class="text-muted">Start taking quizzes to see your activity here.</p>
                            <a href="{{ route('quizzes.index') }}" class="btn btn-primary">Take a Quiz</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('quizzes.index') }}" class="btn btn-primary">
                            <i class="fas fa-question-circle me-2"></i> Take a Quiz
                        </a>
                        <a href="{{ route('dashboard.leaderboard') }}" class="btn btn-outline-primary">
                            <i class="fas fa-trophy me-2"></i> View Leaderboard
                        </a>
                        <a href="{{ route('dashboard.profile') }}" class="btn btn-outline-primary">
                            <i class="fas fa-user me-2"></i> Update Profile
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card-header">
                    <h5 class="mb-0">Your Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Quizzes Completed</span>
                            <span>{{ $totalCompleted }}/5</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ ($totalCompleted / 5) * 100 }}%" aria-valuenow="{{ $totalCompleted }}" aria-valuemin="0" aria-valuemax="5"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Average Score</span>
                            <span>{{ round($quizAttempts->avg('score') ?? 0) }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $quizAttempts->avg('score') ?? 0 }}%" aria-valuenow="{{ round($quizAttempts->avg('score') ?? 0) }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Best Score</span>
                            <span>{{ $bestScore }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $bestScore }}%" aria-valuenow="{{ $bestScore }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
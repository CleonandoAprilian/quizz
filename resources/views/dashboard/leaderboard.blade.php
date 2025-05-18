@extends('layouts.app')

@section('title', 'Leaderboard')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Leaderboard</h1>
    
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card bg-gradient-primary text-white" style="background: linear-gradient(45deg, #FFD700, #FFA500);">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-trophy fa-3x"></i>
                    </div>
                    <h5 class="card-title">Top Score</h5>
                    <div class="display-6 mb-2">{{ $topScore->score ?? 0 }}%</div>
                    <p class="mb-0">{{ $topScore->name ?? 'No data yet' }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-gradient-info text-white" style="background: linear-gradient(45deg, #4CC9F0, #4361EE);">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-clock fa-3x"></i>
                    </div>
                    <h5 class="card-title">Fastest Time</h5>
                    <div class="display-6 mb-2">{{ $fastestTime ? gmdate('i:s', $fastestTime->time_taken) : '00:00' }}</div>
                    <p class="mb-0">{{ $fastestTime->name ?? 'No data yet' }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-gradient-success text-white" style="background: linear-gradient(45deg, #4CAF50, #2E7D32);">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-medal fa-3x"></i>
                    </div>
                    <h5 class="card-title">Most Quizzes</h5>
                    <div class="display-6 mb-2">{{ $mostQuizzes->quizzes_completed ?? 0 }}</div>
                    <p class="mb-0">{{ $mostQuizzes->name ?? 'No data yet' }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Top Performers</h5>
        </div>
        <div class="card-body p-0">
            @if(count($leaderboard) > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Student</th>
                                <th>School</th>
                                <th>Average Score</th>
                                <th>Average Time</th>
                                <th>Quizzes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leaderboard as $index => $user)
                                <tr class="{{ $user->id == Auth::id() ? 'table-primary' : '' }}">
                                    <td>
                                        @if($index == 0)
                                            <span class="badge rounded-pill bg-warning text-dark">
                                                <i class="fas fa-trophy"></i> 1
                                            </span>
                                        @elseif($index == 1)
                                            <span class="badge rounded-pill bg-secondary">
                                                <i class="fas fa-trophy"></i> 2
                                            </span>
                                        @elseif($index == 2)
                                            <span class="badge rounded-pill" style="background-color: #CD7F32;">
                                                <i class="fas fa-trophy"></i> 3
                                            </span>
                                        @else
                                            {{ $index + 1 }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=4361ee&color=fff" class="avatar me-2">
                                            <span>{{ $user->name }}</span>
                                            @if($user->id == Auth::id())
                                                <span class="badge bg-primary ms-2">You</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $user->school }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $user->average_score }}%"></div>
                                            </div>
                                            <span>{{ round($user->average_score) }}%</span>
                                        </div>
                                    </td>
                                    <td>{{ gmdate('i:s', $user->average_time) }}</td>
                                    <td>{{ $user->quizzes_completed }}/5</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <img src="https://img.freepik.com/free-vector/no-data-concept-illustration_114360-536.jpg" alt="No Data" class="img-fluid mb-3" style="max-height: 200px;">
                    <h5>No leaderboard data yet</h5>
                    <p class="text-muted">Start taking quizzes to appear on the leaderboard.</p>
                    <a href="{{ route('quizzes.index') }}" class="btn btn-primary">Take a Quiz</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
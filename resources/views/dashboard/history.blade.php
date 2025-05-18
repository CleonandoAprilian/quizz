@extends('layouts.app')

@section('title', 'History')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Quiz History</h1>
    
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-question-circle fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title">Quizzes Completed</h5>
                    <div class="display-6 mb-2">{{ count($quizAttempts) }}</div>
                    <p class="text-muted mb-0">out of 5 available quizzes</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-chart-line fa-3x text-success"></i>
                    </div>
                    <h5 class="card-title">Average Score</h5>
                    <div class="display-6 mb-2">{{ round($averageScore) }}%</div>
                    <p class="text-muted mb-0">across all quizzes</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-trophy fa-3x text-warning"></i>
                    </div>
                    <h5 class="card-title">Best Score</h5>
                    <div class="display-6 mb-2">{{ $bestScore }}%</div>
                    <p class="text-muted mb-0">your highest achievement</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Quiz Attempts</h5>
            <a href="{{ route('quizzes.index') }}" class="btn btn-sm btn-primary">Take New Quiz</a>
        </div>
        <div class="card-body">
            @if(count($quizAttempts) > 0)
                <div class="accordion" id="quizAttemptsAccordion">
                    @foreach($quizAttempts as $index => $attempt)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                    <div class="d-flex align-items-center justify-content-between w-100">
                                        <div>
                                            <span class="fw-bold">{{ $attempt->quiz->title }}</span>
                                            <span class="text-muted ms-2">{{ $attempt->completed_at->format('M d, Y') }}</span>
                                        </div>
                                        <div>
                                            <span class="badge bg-{{ $attempt->score >= 80 ? 'success' : ($attempt->score >= 60 ? 'warning' : 'danger') }} me-2">
                                                {{ $attempt->score }}%
                                            </span>
                                            <span class="badge bg-info">{{ gmdate('i:s', $attempt->time_taken) }}</span>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#quizAttemptsAccordion">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="mb-3">Performance</h6>
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span>Score</span>
                                                    <span>{{ $attempt->score }}%</span>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-{{ $attempt->score >= 80 ? 'success' : ($attempt->score >= 60 ? 'warning' : 'danger') }}" role="progressbar" style="width: {{ $attempt->score }}%" aria-valuenow="{{ $attempt->score }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between mb-1">
                                                    <span>Correct Answers</span>
                                                    <span>{{ round(($attempt->score / 100) * 5) }}/5</span>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ ($attempt->score / 100) * 100 }}%" aria-valuenow="{{ round(($attempt->score / 100) * 5) }}" aria-valuemin="0" aria-valuemax="5"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="mb-3">Details</h6>
                                            <ul class="list-group">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>Quiz</span>
                                                    <span>{{ $attempt->quiz->title }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>Date</span>
                                                    <span>{{ $attempt->completed_at->format('M d, Y') }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>Time Taken</span>
                                                    <span>{{ gmdate('i:s', $attempt->time_taken) }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>Questions</span>
                                                    <span>5</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <a href="{{ route('quiz.result', $attempt->id) }}" class="btn btn-primary">View Details</a>
                                        <a href="{{ route('quizzes.show', $attempt->quiz_id) }}" class="btn btn-outline-primary ms-2">Retake Quiz</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <img src="https://img.freepik.com/free-vector/no-data-concept-illustration_114360-536.jpg" alt="No Data" class="img-fluid mb-3" style="max-height: 200px;">
                    <h5>No quiz attempts yet</h5>
                    <p class="text-muted">Start taking quizzes to see your history here.</p>
                    <a href="{{ route('quizzes.index') }}" class="btn btn-primary">Take a Quiz</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
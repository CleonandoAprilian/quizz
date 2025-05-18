@extends('layouts.app')

@section('title', 'Quiz Result')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Quiz Result</h1>
        <a href="{{ route('quizzes.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Back to Quizzes
        </a>
    </div>
    
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center p-4">
                    <h5 class="card-title mb-4">{{ $quizAttempt->quiz->title }}</h5>
                    
                    <div class="position-relative d-inline-block mb-4">
                        <div class="position-relative" style="width: 150px; height: 150px;">
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                <div>
                                    <div class="display-4 fw-bold">{{ $quizAttempt->score }}%</div>
                                    <div class="text-muted">Your Score</div>
                                </div>
                            </div>
                            <svg width="150" height="150" viewBox="0 0 36 36" class="circular-chart">
                                <path class="circle-bg" d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831
                                    a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#eee" stroke-width="2" />
                                <path class="circle" d="M18 2.0845
                                    a 15.9155 15.9155 0 0 1 0 31.831
                                    a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="{{ $quizAttempt->score >= 80 ? '#4CAF50' : ($quizAttempt->score >= 60 ? '#FF9800' : '#F44336') }}" stroke-width="2" stroke-dasharray="{{ $quizAttempt->score }}, 100" />
                            </svg>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Correct Answers</span>
                            <span>{{ round(($quizAttempt->score / 100) * count($quizAttempt->quiz->questions)) }}/{{ count($quizAttempt->quiz->questions) }}</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $quizAttempt->score }}%" aria-valuenow="{{ $quizAttempt->score }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <div class="text-center">
                            <div class="h5 mb-0">{{ gmdate('i:s', $quizAttempt->time_taken) }}</div>
                            <div class="small text-muted">Time Taken</div>
                        </div>
                        <div class="text-center">
                            <div class="h5 mb-0">{{ $quizAttempt->completed_at->format('M d, Y') }}</div>
                            <div class="small text-muted">Completion Date</div>
                        </div>
                    </div>
                    
                    <a href="{{ route('quizzes.show', $quizAttempt->quiz_id) }}" class="btn btn-primary w-100">
                        <i class="fas fa-redo me-2"></i> Retake Quiz
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Question Review</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="questionReviewAccordion">
                        @foreach($quizAttempt->userAnswers as $index => $userAnswer)
                            <div class="accordion-item mb-3 border rounded">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                        <div class="d-flex align-items-center w-100">
                                            <div class="me-3">
                                                @if($userAnswer->is_correct)
                                                    <span class="badge rounded-pill bg-success">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger">
                                                        <i class="fas fa-times"></i>
                                                    </span>
                                                @endif
                                            </div>
                                            <div>Question {{ $index + 1 }}</div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#questionReviewAccordion">
                                    <div class="accordion-body">
                                        <p class="fw-bold mb-3">{{ $userAnswer->question->question_text }}</p>
                                        
                                        <div class="options">
                                            @foreach($userAnswer->question->options as $option)
                                                <div class="p-3 rounded mb-2 {{ $option->is_correct ? 'bg-success bg-opacity-10 border border-success' : ($option->id === $userAnswer->option_id && !$userAnswer->is_correct ? 'bg-danger bg-opacity-10 border border-danger' : 'bg-light') }}">
                                                    <div class="d-flex align-items-center">
                                                        @if($option->is_correct)
                                                            <span class="badge rounded-pill bg-success me-2">
                                                                <i class="fas fa-check"></i>
                                                            </span>
                                                        @elseif($option->id === $userAnswer->option_id && !$userAnswer->is_correct)
                                                            <span class="badge rounded-pill bg-danger me-2">
                                                                <i class="fas fa-times"></i>
                                                            </span>
                                                        @else
                                                            <span class="badge rounded-pill bg-light text-dark me-2">
                                                                <i class="fas fa-circle"></i>
                                                            </span>
                                                        @endif
                                                        
                                                        <span>{{ $option->option_text }}</span>
                                                        
                                                        @if($option->id === $userAnswer->option_id)
                                                            <span class="badge bg-primary ms-2">Your Answer</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .circular-chart {
        display: block;
        margin: 0 auto;
    }
    
    .circle-bg {
        fill: none;
        stroke-width: 2;
    }
    
    .circle {
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        animation: progress 1s ease-out forwards;
    }
    
    @keyframes progress {
        0% {
            stroke-dasharray: 0, 100;
        }
    }
</style>
@endsection

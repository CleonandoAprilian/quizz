@extends('layouts.app')

@section('title', 'Practice Questions')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0" data-aos="fade-right">Practice Questions</h1>
        <div data-aos="fade-left">
            <span class="badge bg-primary rounded-pill px-3 py-2">{{ count($quizzes) }} Quizzes Available</span>
        </div>
    </div>
    
    <div class="row g-4">
        @foreach($quizzes as $quiz)
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="quiz-card card h-100">
                    <div class="card-img-top position-relative" style="background: linear-gradient(45deg, {{ ['#7c3aed, #ec4899', '#10b981, #3b82f6', '#f59e0b, #ef4444', '#06b6d4, #8b5cf6', '#ec4899, #f59e0b'][$loop->index % 5] }}); height: 120px;">
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-white text-dark rounded-pill px-3 py-2">
                                <i class="fas fa-clock me-1"></i> {{ $quiz->duration }} min
                            </span>
                        </div>
                        <div class="position-absolute bottom-0 start-0 m-3">
                            <span class="badge bg-white text-dark rounded-pill px-3 py-2">
                                <i class="fas fa-question-circle me-1"></i> {{ $quiz->questions->count() }} Questions
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $quiz->title }}</h5>
                        <p class="card-text">{{ $quiz->description }}</p>
                        
                        @if(isset($quizAttempts[$quiz->id]) && count($quizAttempts[$quiz->id]) > 0)
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small">Best Score</span>
                                    <span class="small fw-bold">{{ $quizAttempts[$quiz->id]->max('score') }}%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $quizAttempts[$quiz->id]->max('score') }}%" aria-valuenow="{{ $quizAttempts[$quiz->id]->max('score') }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            @if(isset($quizAttempts[$quiz->id]) && count($quizAttempts[$quiz->id]) > 0)
                                <span class="text-muted small">Last attempt: {{ $quizAttempts[$quiz->id]->first()->completed_at->format('M d, Y') }}</span>
                                <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-redo me-1"></i> Retake
                                </a>
                            @else
                                <span class="text-muted small">Not attempted yet</span>
                                <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-primary">
                                    <i class="fas fa-play me-1"></i> Start
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
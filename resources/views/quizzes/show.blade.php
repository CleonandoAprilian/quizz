@extends('layouts.app')

@section('title', $quiz->title)

@section('styles')
<style>
    .quiz-option input[type="radio"] {
        display: none;
    }
    
    .quiz-option {
        cursor: pointer;
        border: 2px solid #e9ecef;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    
    .quiz-option::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(124, 58, 237, 0.05), rgba(236, 72, 153, 0.05));
        opacity: 0;
        transition: opacity 0.3s;
    }
    
    .quiz-option:hover {
        border-color: var(--primary-light);
        transform: translateX(5px);
    }
    
    .quiz-option:hover::before {
        opacity: 1;
    }
    
    .quiz-option.selected {
        background: linear-gradient(45deg, rgba(124, 58, 237, 0.1), rgba(236, 72, 153, 0.1));
        border-color: var(--primary-color);
        transform: scale(1.02);
    }
    
    .quiz-option.selected .option-check {
        color: var(--primary-color);
    }
    
    .option-check {
        color: transparent;
    }
    
    .quiz-timer.warning {
        background: linear-gradient(45deg, var(--warning-color), var(--secondary-color));
        animation: pulse 1s infinite;
    }
    
    .quiz-timer.danger {
        background: linear-gradient(45deg, var(--danger-color), var(--secondary-color));
        animation: pulse 0.5s infinite;
    }
    
    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }
    
    .progress-container {
        position: relative;
        height: 10px;
        background-color: #e9ecef;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .progress-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, 
            rgba(124, 58, 237, 0.2) 0%, 
            rgba(236, 72, 153, 0.2) 50%, 
            rgba(124, 58, 237, 0.2) 100%);
        background-size: 200% 100%;
        animation: shimmer 2s infinite linear;
    }
    
    @keyframes shimmer {
        0% {
            background-position: 100% 0;
        }
        100% {
            background-position: -100% 0;
        }
    }
    
    .progress-bar {
        position: relative;
        z-index: 1;
        height: 100%;
        border-radius: 10px;
        transition: width 0.5s ease;
    }
    
    /* Perbaikan untuk menampilkan semua pertanyaan */
    .quiz-question {
        display: none; /* Semua pertanyaan disembunyikan secara default */
    }
    
    .quiz-question.active {
        display: block; /* Hanya pertanyaan aktif yang ditampilkan */
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0" data-aos="fade-right">{{ $quiz->title }}</h1>
        <div id="quiz-timer" class="quiz-timer" data-aos="fade-left">
            <i class="fas fa-clock me-2"></i>
            <span id="timer">{{ $quiz->duration }}:00</span>
        </div>
    </div>
    
    <div class="card mb-4" data-aos="fade-up">
        <div class="card-body">
            <p>{{ $quiz->description }}</p>
            <div class="d-flex justify-content-between">
                <div>
                    <span class="badge bg-light text-dark me-2">
                        <i class="fas fa-question-circle me-1"></i> {{ $quiz->questions->count() }} Questions
                    </span>
                    <span class="badge bg-light text-dark">
                        <i class="fas fa-clock me-1"></i> {{ $quiz->duration }} Minutes
                    </span>
                </div>
                <div>
                    <span class="badge bg-primary rounded-pill px-3" id="progress-text">Question 1 of {{ $quiz->questions->count() }}</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="progress-container mb-4" data-aos="fade-up">
        <div class="progress-bar" role="progressbar" style="width: {{ $quiz->questions->count() > 0 ? (1 / $quiz->questions->count()) * 100 : 0 }}%" aria-valuenow="{{ $quiz->questions->count() > 0 ? (1 / $quiz->questions->count()) * 100 : 0 }}" aria-valuemin="0" aria-valuemax="100" id="progress-bar"></div>
    </div>
    
    <form id="quiz-form" action="{{ route('quizzes.submit', $quiz->id) }}" method="POST">
        @csrf
        <input type="hidden" name="time_taken" id="time-taken" value="0">
        
        @foreach($quiz->questions as $index => $question)
            <div class="quiz-question {{ $index === 0 ? 'active' : '' }}" id="question-{{ $index }}" data-aos="fade-up">
                <h5 class="question-number">Question {{ $index + 1 }}</h5>
                <p class="question-text">{{ $question->question_text }}</p>
                
                <div class="options">
                    @foreach($question->options as $option)
                        <label class="quiz-option d-flex align-items-center p-3 rounded mb-3">
                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" class="option-input">
                            <span class="option-check me-3">
                                <i class="fas fa-check-circle fa-lg"></i>
                            </span>
                            <span class="option-text">{{ $option->option_text }}</span>
                        </label>
                    @endforeach
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    @if($index > 0)
                        <button type="button" class="btn btn-outline-primary prev-btn" data-question="{{ $index }}">
                            <i class="fas fa-arrow-left me-2"></i> Previous
                        </button>
                    @else
                        <div></div>
                    @endif
                    
                    @if($index < count($quiz->questions) - 1)
                        <button type="button" class="btn btn-primary next-btn" data-question="{{ $index }}">
                            Next <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    @else
                        <button type="button" class="btn btn-success" id="submit-btn">
                            Submit Quiz <i class="fas fa-check ms-2"></i>
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </form>
    
    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submit Quiz</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to submit your quiz?</p>
                    <div id="unanswered-warning" class="alert alert-warning d-none">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        You have unanswered questions. Are you sure you want to continue?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirm-submit">Yes, Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        console.log('Quiz loaded with {{ $quiz->questions->count() }} questions');
        
        // Timer
        let duration = {{ $quiz->duration * 60 }};
        let timeTaken = 0;
        let timer = setInterval(function() {
            timeTaken++;
            duration--;
            
            if (duration <= 0) {
                clearInterval(timer);
                submitQuiz();
            }
            
            const minutes = Math.floor(duration / 60);
            const seconds = duration % 60;
            
            $('#timer').text(minutes + ':' + (seconds < 10 ? '0' : '') + seconds);
            $('#time-taken').val(timeTaken);
            
            // Add warning classes
            if (duration <= 60) {
                $('#quiz-timer').addClass('danger');
            } else if (duration <= 120) {
                $('#quiz-timer').addClass('warning');
            }
        }, 1000);
        
        // Option selection
        $('.quiz-option').click(function() {
            $(this).siblings().removeClass('selected');
            $(this).addClass('selected');
            $(this).find('input[type="radio"]').prop('checked', true);
        });
        
        // Navigation - Perbaikan untuk menampilkan pertanyaan dengan benar
        $('.next-btn').click(function() {
            const currentQuestion = parseInt($(this).data('question'));
            const nextQuestion = currentQuestion + 1;
            
            console.log('Moving from question', currentQuestion, 'to', nextQuestion);
            
            // Sembunyikan pertanyaan saat ini dan tampilkan pertanyaan berikutnya
            $('#question-' + currentQuestion).removeClass('active');
            $('#question-' + nextQuestion).addClass('active');
            
            updateProgress(nextQuestion + 1);
        });
        
        $('.prev-btn').click(function() {
            const currentQuestion = parseInt($(this).data('question'));
            const prevQuestion = currentQuestion - 1;
            
            console.log('Moving from question', currentQuestion, 'to', prevQuestion);
            
            // Sembunyikan pertanyaan saat ini dan tampilkan pertanyaan sebelumnya
            $('#question-' + currentQuestion).removeClass('active');
            $('#question-' + prevQuestion).addClass('active');
            
            updateProgress(prevQuestion + 1);
        });
        
        // Update progress
        function updateProgress(questionNumber) {
            const totalQuestions = {{ $quiz->questions->count() ?: 1 }}; // Hindari division by zero
            const progress = (questionNumber / totalQuestions) * 100;
            
            console.log('Updating progress:', questionNumber, 'of', totalQuestions, '=', progress + '%');
            
            $('#progress-bar').css('width', progress + '%');
            $('#progress-bar').attr('aria-valuenow', progress);
            $('#progress-text').text('Question ' + questionNumber + ' of ' + totalQuestions);
        }
        
        // Submit quiz
        $('#submit-btn').click(function() {
            // Check if all questions are answered
            const totalQuestions = {{ $quiz->questions->count() ?: 1 }}; // Hindari division by zero
            const answeredQuestions = $('input[type="radio"]:checked').length;
            
            console.log('Submitting quiz:', answeredQuestions, 'of', totalQuestions, 'questions answered');
            
            if (answeredQuestions < totalQuestions) {
                $('#unanswered-warning').removeClass('d-none');
            } else {
                $('#unanswered-warning').addClass('d-none');
            }
            
            $('#confirmSubmitModal').modal('show');
        });
        
        $('#confirm-submit').click(function() {
            submitQuiz();
        });
        
        function submitQuiz() {
            console.log('Submitting quiz form');
            $('#quiz-form').submit();
        }
    });
</script>
@endsection
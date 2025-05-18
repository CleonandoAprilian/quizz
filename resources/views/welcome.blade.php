<!-- resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="container-fluid p-0">
    <div class="row g-0">
        <div class="col-lg-6">
            <div class="d-flex flex-column justify-content-center align-items-center min-vh-100 p-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);">
                <div class="text-center text-white mb-5">
                    <h1 class="display-3 fw-bold mb-4">Quiz App</h1>
                    <p class="lead mb-4">Improve your knowledge with our interactive quizzes and track your progress.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4 py-2">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4 py-2">
                            <i class="fas fa-user-plus me-2"></i> Register
                        </a>
                    </div>
                </div>
                <div class="text-white text-center mt-5">
                    <h4 class="mb-4">Features</h4>
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="p-4 rounded" style="background-color: rgba(255, 255, 255, 0.1); backdrop-filter: blur(5px); transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <i class="fas fa-question-circle fa-2x mb-3"></i>
                                <h5>Practice Questions</h5>
                                <p class="small">Multiple quizzes with various topics</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 rounded" style="background-color: rgba(255, 255, 255, 0.1); backdrop-filter: blur(5px); transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <i class="fas fa-trophy fa-2x mb-3"></i>
                                <h5>Leaderboard</h5>
                                <p class="small">Compete with other students</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-4 rounded" style="background-color: rgba(255, 255, 255, 0.1); backdrop-filter: blur(5px); transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <i class="fas fa-history fa-2x mb-3"></i>
                                <h5>Progress Tracking</h5>
                                <p class="small">Monitor your performance</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-flex justify-content-center align-items-center min-vh-100 bg-white p-5">
                <div>
                    <img src="https://img.freepik.com/free-vector/online-certification-illustration_23-2148575636.jpg" alt="Quiz Illustration" class="img-fluid" style="max-width: 80%;">
                    <div class="text-center mt-5">
                        <h3 class="text-primary mb-3">Start Learning Today</h3>
                        <p class="text-muted">Join thousands of students improving their knowledge through our interactive quizzes.</p>
                        <div class="d-flex justify-content-center gap-3 mt-4">
                            <div class="text-center">
                                <div class="h2 fw-bold" style="color: var(--primary-color);">5+</div>
                                <div class="small text-muted">Quiz Categories</div>
                            </div>
                            <div class="text-center">
                                <div class="h2 fw-bold" style="color: var(--secondary-color);">100+</div>
                                <div class="small text-muted">Questions</div>
                            </div>
                            <div class="text-center">
                                <div class="h2 fw-bold" style="color: var(--accent-color);">1000+</div>
                                <div class="small text-muted">Students</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
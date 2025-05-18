<!-- resources/views/dashboard/profile.blade.php -->
@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Profile</h1>
    
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=4361ee&color=fff&size=200" class="rounded-circle img-fluid mb-4" style="width: 150px; height: 150px;">
                    <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                    <p class="text-muted mb-3">{{ Auth::user()->school }}</p>
                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <span class="badge bg-primary">Rank #{{ $userRank }}</span>
                        <span class="badge bg-success">{{ round($averageScore) }}% Avg. Score</span>
                    </div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="fas fa-edit me-2"></i> Edit Profile
                    </button>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Personal Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-envelope text-primary me-3"></i>
                            <div>
                                <p class="text-muted mb-0 small">Email</p>
                                <p class="mb-0">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-school text-primary me-3"></i>
                            <div>
                                <p class="text-muted mb-0 small">School</p>
                                <p class="mb-0">{{ Auth::user()->school }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-3"></i>
                            <div>
                                <p class="text-muted mb-0 small">Address</p>
                                <p class="mb-0">{{ Auth::user()->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Quiz Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <div class="p-3 border rounded text-center">
                                <div class="display-5 text-primary mb-2">{{ $totalCompleted }}</div>
                                <div class="text-muted">Quizzes Taken</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded text-center">
                                <div class="display-5 text-success mb-2">{{ round($averageScore) }}%</div>
                                <div class="text-muted">Average Score</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded text-center">
                                <div class="display-5 text-warning mb-2">{{ $bestScore }}%</div>
                                <div class="text-muted">Highest Score</div>
                            </div>
                        </div>
                    </div>
                    
                    <h5 class="mb-3">Recent Quiz Attempts</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Quiz</th>
                                    <th>Score</th>
                                    <th>Time</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($quizAttempts) > 0)
                                    @foreach($quizAttempts as $attempt)
                                        <tr>
                                            <td>{{ $attempt->quiz->title }}</td>
                                            <td>
                                                <span class="badge bg-{{ $attempt->score >= 80 ? 'success' : ($attempt->score >= 60 ? 'warning' : 'danger') }}">
                                                    {{ $attempt->score }}%
                                                </span>
                                            </td>
                                            <td>{{ gmdate('i:s', $attempt->time_taken) }}</td>
                                            <td>{{ $attempt->completed_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('quiz.result', $attempt->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-3">
                                            <p class="text-muted mb-0">No quiz attempts yet</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    @if(count($quizAttempts) > 0)
                        <div class="text-end mt-3">
                            <a href="{{ route('dashboard.history') }}" class="btn btn-outline-primary">
                                <i class="fas fa-history me-2"></i> View All History
                            </a>
                        </div>
                    @else
                        <div class="text-center mt-3">
                            <a href="{{ route('quizzes.index') }}" class="btn btn-primary">
                                <i class="fas fa-question-circle me-2"></i> Take a Quiz
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="school" class="form-label">School</label>
                        <input type="text" class="form-control" id="school" value="{{ Auth::user()->school }}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" rows="3">{{ Auth::user()->address }}</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('website.layouts.master')

@section('title', 'Create profile tariner')

@section('main-content')

<style>
   .container {
    max-width: 700px;
    margin: auto;
    border-radius: 15px;
    overflow: hidden;
    min-height:200px;
    padding: 20px;
}

.card-custom {
    background: linear-gradient(135deg, #ffffff, #f7f7f7);
    border-radius: 15px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 20px;
    border: 1px solid #1ead19;;
}

.card-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}

.card-header {
    background-color: #ffffff;
    color: #fff;
    text-align: center;
    padding: 20px;
    font-size: 1.5rem;
    font-weight: bold;
    border-bottom: 1px solid #1ead19;
}

.card-body {
    padding: 20px;
    background-color: #ffffff;
}

.card-title {
    text-align: center;
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-label {
    font-weight: bold;
    color: #333;
}

.form-control {
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
    color:#0808089a;
}

.form-control:hover {
    border-color:#1ead19;
    box-shadow: 0 0 5px #1ead19;
}

.form-select {
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-select:hover {
    border-color: #1ead19;
    box-shadow: 0 0 5px #1ead19;
}

.btn-custom2,
.btn-custom2-reset,
.btn-custom2-go {
    display: inline-block;
    border-radius: 30px;
    font-size: 1rem;
    padding: 10px 20px;
    font-weight: bold;
    text-align: center;
    border: none;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-right: 10px;
}

.btn-custom2 {
    background-color: #198754;
}

.btn-custom2:hover {
    background-color: #145c32;
}

.btn-custom2-reset {
    background-color: #dc3545;
}

.btn-custom2-reset:hover {
    background-color: #a71d2a;
}

.btn-custom2-go {
    background-color: #6c757d;
}

.btn-custom2-go:hover {
    background-color: #495057;
}

.invalid-feedback {
    font-size: 0.875rem;
    color: #dc3545;
}

.text-danger {
    color: #dc3545 !important;
}

    </style>

<div class="container">
@if ($errors->any())
                     <div class="alert alert-danger">
                       <ul>
                         @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                         @endforeach
                        </ul>
                     </div>
                    @endif
    <div class="row justify-content-center">
        
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <strong class="card-title fs-2">
                        Create Profile 
                    </strong>
                </div>
    <form action="{{ route('trainerprofile.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
    
    <!-- Full Name and Email from user -->
    <div class="form-group mb-3">
        <label for="fullname" class="form-label text-black">Full Name</label>
        <input type="text" name="fullname" id="fullname" 
               value="{{ old('fullname', $user->fullname) }}" 
               class="form-control @error('fullname') is-invalid @enderror" required>
        @error('fullname')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="email" class="form-label text-black">Email</label>
        <input type="email" name="email" id="email" 
               value="{{ old('email', $user->email) }}" 
               class="form-control @error('email') is-invalid @enderror" required>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <!-- TrainerProfile fields -->
     <div class="form-group">
        <label for="specialization">Specialization</label>
        <input type="text" name="specialization" id="specialization"
               value="{{ old('specialization') }}"
               class="form-control @error('specialization') is-invalid @enderror" required>
        @error('specialization')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="bio" class="form-label text-black">Bio</label>
        <textarea name="bio" id="bio" class="form-control @error('bio') is-invalid @enderror" required>{{ old('bio') }}</textarea>
        @error('bio')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="profile_picture" class="form-label text-black">Profile Picture</label>
        <input type="file" name="profile_picture" id="profile_picture" 
               class="form-control @error('profile_picture') is-invalid @enderror">
        @error('profile_picture')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="rating" class="form-label text-black">Rating</label>
        <input type="number" name="rating" id="rating" 
               value="{{ old('rating') }}" 
               class="form-control @error('rating') is-invalid @enderror" step="0.1" min="0" max="5" required>
        @error('rating')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="followers_count" class="form-label text-black">Followers Count</label>
        <input type="number" name="followers_count" id="followers_count" 
               value="{{ old('followers_count') }}" 
               class="form-control @error('followers_count') is-invalid @enderror" required>
        @error('followers_count')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="private_classes_count" class="form-label text-black">Private Classes Count</label>
        <input type="number" name="private_classes_count" id="private_classes_count" 
               value="{{ old('private_classes_count') }}" 
               class="form-control @error('private_classes_count') is-invalid @enderror" required>
        @error('private_classes_count')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="group_classes_count" class="form-label text-black">Group Classes Count</label>
        <input type="number" name="group_classes_count" id="group_classes_count" 
               value="{{ old('group_classes_count') }}" 
               class="form-control @error('group_classes_count') is-invalid @enderror" required>
        @error('group_classes_count')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="certifications" class="form-label text-black">Certifications</label>
        <textarea name="certifications" id="certifications" class="form-control @error('certifications') is-invalid @enderror">{{ old('certifications') }}</textarea>
        @error('certifications')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="d-flex flex-column flex-md-row justify-content-between">
        <button type="submit" class="btn btn-success mb-2 mb-md-3">
            <i class="fas fa-save"></i> Submit
        </button>
        <button type="reset" class="btn btn-danger mb-2 mb-md-3">
            <i class="fas fa-undo"></i> Reset
        </button>
        <a href="{{ route('home') }}" class="btn btn-success mb-2 mb-md-3 d-flex align-items-center justify-content-center" 
         style="background-color: #29a147; border-radius: 20px; border: none; text-align: center;">
            <i class="fas fa-home me-2"></i> 
                    Home
        </a>
        </div>
</form>
     
                
            </div>
       
    </div>
</div>


@endsection

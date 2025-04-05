
@extends('website.layouts.master')

@section('title', 'create Profile Data')

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
            <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group mb-3">
                      <label for="fullname" class="form-label text-black">Full Name</label>
                       <input type="text" name="fullname" id="fullname" 
                        value="{{ old('fullname', $user->fullname ) }}" 
                         class="form-control @error('fullname') is-invalid @enderror" required>
                       @error('fullname')
                         <span class="invalid-feedback" role="alert">
                          <strong class="text-danger">{{ $message }}</strong>
                          </span>
                       @enderror
                    </div>

                  <div class="form-group mb-3">
                    <label for="username" class="form-label text-black">Username</label>
                    <input type="text" name="username" id="username" 
                        value="{{ old('username', $user->username) }}" 
                        class="form-control @error('username') is-invalid @enderror" required>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                    {{-- Image --}}
                    <div class="form-group mb-3">
                        <label for="image" class="form-label text-black">Image</label>
                        <input type="file" name="image" id="image" 
                               class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    {{-- Membership --}}
                    <div class="form-group mb-3">
                        <label for="membership" class="form-label text-black">Membership</label>
                        <select name="membership" id="membership" 
                                class="form-select @error('membership') is-invalid @enderror" required>
                            <option value="" disabled selected>Membership</option>
                            <option value="Silver" {{ old('membership') === "Silver" ? "selected" : '' }}>Silver</option>
                            <option value="Gold" {{ old('membership') === "Gold" ? "selected" : '' }}>Gold</option>
                            <option value="Platinum" {{ old('membership') === "Platinum" ? "selected" : '' }}>Platinum</option>
                        </select>
                        @error('membership')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    {{-- Body Fats Percentage --}}
                    <div class="form-group mb-3">
                        <label for="body_fats_percentage" class="form-label text-black">Body Fats Percentage</label>
                        <input type="number" name="body_fats_percentage" id="body_fats_percentage" 
                               value="{{ old('body_fats_percentage', 0) }}" 
                               class="form-control @error('body_fats_percentage') is-invalid @enderror" 
                               step="0.01" required>
                        @error('body_fats_percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    {{-- Muscle Mass Percentage --}}
                    <div class="form-group mb-3">
                        <label for="muscle_mass_percentage" class="form-label text-black">Muscle Mass Percentage</label>
                        <input type="number" name="muscle_mass_percentage" id="muscle_mass_percentage" 
                               value="{{ old('muscle_mass_percentage', 0) }}" 
                               class="form-control @error('muscle_mass_percentage') is-invalid @enderror" 
                               step="0.01" required>
                        @error('muscle_mass_percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    {{-- Water Percentage --}}
                    <div class="form-group mb-3">
                        <label for="water_percentage" class="form-label text-black">Water Percentage</label>
                        <input type="number" name="water_percentage" id="water_percentage" 
                               value="{{ old('water_percentage', 0) }}" 
                               class="form-control @error('water_percentage') is-invalid @enderror" 
                               step="0.01" required>
                        @error('water_percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    {{-- Bone Mass Percentage --}}
                    <div class="form-group mb-3">
                        <label for="bone_mass_percentage" class="form-label text-black">Bone Mass Percentage</label>
                        <input type="number" name="bone_mass_percentage" id="bone_mass_percentage" 
                               value="{{ old('bone_mass_percentage', 0) }}" 
                               class="form-control @error('bone_mass_percentage') is-invalid @enderror" 
                               step="0.01" required>
                        @error('bone_mass_percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    {{-- Other Composition Percentage --}}
                    <div class="form-group mb-3">
                        <label for="other_composition_percentage" class="form-label text-black">Other Composition Percentage</label>
                        <input type="number" name="other_composition_percentage" id="other_composition_percentage" 
                               value="{{ old('other_composition_percentage', 0) }}" 
                               class="form-control @error('other_composition_percentage') is-invalid @enderror" 
                               step="0.01" required>
                        @error('other_composition_percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    {{-- Cardio Percentage 
                    <div class="form-group mb-3">
                        <label for="cardio_percentage" class="form-label text-black">Cardio Percentage</label>
                        <input type="number" name="cardio_percentage" id="cardio_percentage" 
                               value="{{ old('cardio_percentage', 0) }}" 
                               class="form-control @error('cardio_percentage') is-invalid @enderror" 
                               step="0.01" required>
                        @error('cardio_percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    {{-- Daily Goal Percentage 
                    <div class="form-group mb-3">
                        <label for="daily_goal_percentage" class="form-label text-black">Daily Goal Percentage</label>
                        <input type="number" name="daily_goal_percentage" id="daily_goal_percentage" 
                               value="{{ old('daily_goal_percentage', 0) }}" 
                               class="form-control @error('daily_goal_percentage') is-invalid @enderror" 
                               step="0.01" required>
                        @error('daily_goal_percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    {{-- Calories Percentage 
                    <div class="form-group mb-3">
                        <label for="calories_percentage" class="form-label text-black">Calories Percentage</label>
                        <input type="number" name="calories_percentage" id="calories_percentage" 
                               value="{{ old('calories_percentage', 0) }}" 
                               class="form-control @error('calories_percentage') is-invalid @enderror" 
                               step="0.01" required>
                        @error('calories_percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    {{-- Plan Progress Percentage 
                    <div class="form-group mb-3">
                        <label for="plan_progress_percentage" class="form-label text-black">Plan Progress Percentage</label>
                        <input type="number" name="plan_progress_percentage" id="plan_progress_percentage" 
                               value="{{ old('plan_progress_percentage', 0) }}" 
                               class="form-control @error('plan_progress_percentage') is-invalid @enderror" 
                               step="0.01" required>
                        @error('plan_progress_percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    --}}
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <button type="submit" class="btn mb-2 mb-md-3">
                            <i class="fas fa-save"></i> Submit
                        </button>
                        <button type="reset" class="btn  mb-2 mb-md-3">
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
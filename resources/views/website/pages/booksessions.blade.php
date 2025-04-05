@extends('website.layouts.master')

@section('title', 'Book Sessions')

@section('main-content')
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
}

.container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
    margin-bottom: 2rem;
}

.plans-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.plan {
    padding: 1.5rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.plan:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.plan.selected {
    border-color: #4CAF50;
    background-color: #f8fff8;
}

.plan h3 {
    color: #333;
    margin-bottom: 1rem;
}

.price {
    font-size: 1.5rem;
    color: #4CAF50;
    margin-bottom: 1rem;
}

.plan ul {
    list-style: none;
    margin-bottom: 1rem;
}

.plan h6 {
    margin: 0.5rem 0;
    color: #666;
   
}

.booking-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

label {
    font-weight: bold;
    color: #555;
}

input, select {
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
}

input[readonly] {
    background-color: #f8f8f8;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.1rem;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #45a049;
}

.confirmation {
    margin-top: 2rem;
    padding: 1rem;
    background-color: #dff0d8;
    border-radius: 5px;
    text-align: center;
}

.hidden {
    display: none;
}

@media (max-width: 600px) {
    .container {
        margin: 1rem;
        padding: 1rem;
    }
    
    .plans-container {
        grid-template-columns: 1fr;
    }
}
    </style>

@if(session('success'))
<div class="alert  text-center mx-auto shadow-lg" style="max-width: 80%; margin-top: 3%; border-radius: 15px; padding: 20px; background-color: #4CAF50; color: black; position: relative; overflow: hidden; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); transition: transform 0.3s; animation: scaleUp 1.5s infinite;">
    <h4 class="font-weight-bold">
        <i class="fas fa-exclamation-triangle" style="display: inline-block; animation: bounceIcon 1.5s infinite;"></i>
        <span style="display: inline-block; animation: flashText 2s infinite;">
            {{ session()->get('success') }}
        </span>
    </h4>
</div>
@endif
<div class="container">
   
    <h1>Book Your Gym Session</h1>

    <div class="plans-container">
        <div class="plan" onclick="selectPlan('basic')" style="border-radius: 10px; border-color:rgb(34, 184, 34);">
            <h3>Basic Plan</h3>
            <p class="price">$30/month</p>
            
                <h6>Access to gym equipment</h6>
                <h6>Locker room access</h6>
                <h6>2 sessions per week</h6>
            
        </div>
       
        <div class="plan" onclick="selectPlan('premium')" style="border-radius: 10px; border-color:rgb(34, 184, 34);">
            <h3>Premium Plan</h3>
            <p class="price">$50/month</p>
            
                <h6>Unlimited gym access</h6>
                <h6>1 free PT session/month</h6>
                <h6>Group classes included</h6>
            
        </div>
        
        <div class="plan" onclick="selectPlan('elite')" style="border-radius: 10px; border-color:rgb(34, 184, 34);">
            <h3>Elite Plan</h3>
            <p class="price">$80/month</p>
            
                <h6>24/7 gym access</h6>
                <h6>4 PT sessions/month</h6>
                <h6>Nutrition consultation</h6>
            
        </div>

        <div class="plan" onclick="selectPlan('basic')" style="border-radius: 10px; border-color:rgb(34, 184, 34);">
            <h3>Basic Plan</h3>
            <p class="price">$30/month</p>
            
                <h6>Access to gym equipment</h6>
                <h6>Locker room access</h6>
                <h6>2 sessions per week</h6>
            
        </div>
    </div>
    <form action="{{ route('book-session.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    {{-- Plan Selection --}}
    <div class="form-group mb-3">
        <label for="plan" class="form-label text-black">Plan <span class="text-danger">*</span></label>
        <select name="plan" id="plan" class="form-control @error('plan') is-invalid @enderror" required>
            <option value="">Select a Plan</option>
            <option value="Basic">Basic</option>
            <option value="Premium">Premium</option>
            <option value="Elite">Elite</option>
        </select>
        @error('plan')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- Session Title --}}
    <div class="form-group mb-3">
        <label for="session_title" class="form-label text-black">Session Title <span class="text-danger">*</span></label>
        <input type="text" name="session_title" id="session_title" class="form-control @error('session_title') is-invalid @enderror" required>
        @error('session_title')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- Description --}}
    <div class="form-group mb-3">
        <label for="description" class="form-label text-black">Description</label>
        <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" required></textarea>
        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- Session Image --}}
    <div class="form-group mb-3">
        <label for="session_image" class="form-label text-black">Choose Gym Image</label>
        <input type="file" name="session_image" id="session_image" class="form-control @error('session_image') is-invalid @enderror" accept="image/*">
        @error('session_image')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- Session Date --}}
    <div class="form-group mb-3">
        <label for="date" class="form-label text-black">Date <span class="text-danger">*</span></label>
        <input type="date" id="date" name="session_date" class="form-control @error('session_date') is-invalid @enderror" required>
        @error('session_date')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- Time Slot --}}
    <div class="form-group mb-3">
        <label for="time" class="form-label text-black">Time Slot <span class="text-danger">*</span></label>
        <select id="time" name="session_time" class="form-control @error('session_time') is-invalid @enderror" required>
            <option value="">Select a time</option>
            <option value="6:00 AM - 9:00 AM">6:00 AM - 9:00 AM</option>
            <option value="12:00 PM - 3:00 PM">12:00 PM - 3:00 PM</option>
            <option value="6:00 PM - 9:00 PM">6:00 PM - 9:00 PM</option>
        </select>
        @error('session_time')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>
    {{-- Personal Trainer --}}
    <div class="form-group mb-3">
        <label for="trainer" class="form-label text-black">Personal Trainer (Optional)</label>
        <select id="trainer" name="trainer" class="form-control @error('trainer') is-invalid @enderror">
            <option value="">No trainer</option>
            @foreach ( $trainers as $trainer)
                <option value="{{ $trainer->id }}">{{ $trainer->fullname}}</option>
            @endforeach
        </select>
        @error('trainer')
            <span class="invalid-feedback" role="alert">
                <strong class="text-danger">{{ $message }}</strong>
            </span>
        @enderror
    </div>


    
    <div class="d-flex">
        <button onclick="bookSession()" class="btn btn-primary btn-sm flex-grow-1 me-4">Book Now</button>
        <button onclick="window.location.href='{{route('home')}}'" class="btn btn-secondary btn-sm flex-grow-1 ms-4">Home</button>
      </div>
      
        
        {{-- Confirmation Message --}}
        <div id="confirmation" class="confirmation hidden">
            <h2>Booking Confirmed!</h2>
            <p id="booking-details"></p>
        </div>
    
</form>


</div>
@endsection

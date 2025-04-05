@extends('website.layouts.master')

@section('title' , 'Join Us')  

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
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

header {
    text-align: center;
    margin-bottom: 4rem;
}

header h1 {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 1rem;
}

header p {
    color: #666;
    font-size: 1.2rem;
}


section {
    margin-bottom: 4rem;
}

h2 {
    text-align: center;
    margin-bottom: 2rem;
    color: #333;
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.benefit-card {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: transform 0.3s;
}

.benefit-card:hover {
    transform: translateY(-5px);
}

.icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.benefit-card h3 {
    margin-bottom: 1rem;
    color: #333;
}

.join-form {
    max-width: 600px;
    margin: 0 auto;
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.form-group {
    position: relative;
    margin-bottom: 1.5rem;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    background: transparent;
}

.form-group label {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #666;
    transition: all 0.3s;
    pointer-events: none;
}

.form-group input:focus + label,
.form-group input:valid + label {
    top: -0.5rem;
    left: 0.5rem;
    font-size: 0.8rem;
    background: white;
    padding: 0 0.5rem;
}

button {
    width: 100%;
    padding: 1rem;
    background: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background 0.3s;
}

button:hover {
    background: #45a049;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.testimonial {
    text-align: center;
    padding: 2rem;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.testimonial img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 1rem;
}

.testimonial p {
    font-style: italic;
    margin-bottom: 1rem;
    color: #666;
}

.testimonial h4 {
    color: #333;
}

@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }
    
    header h1 {
        font-size: 2rem;
    }
    
    .benefits-grid {
        grid-template-columns: 1fr;
    }
}
    </style>

<div class="container">
    <a href="{{ route('home') }}" class="btn" style="font-size: 20px">
           <i class="fas fa-home me-2"></i> 
                   Home
       </a>
    <header>
        <h1>Join Our Fitness Community</h1>
        <p>Start your fitness journey today</p>
    </header>

    <section class="benefits">
        <h2>Why Choose Us?</h2>
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="icon">💪</div>
                <h3>State-of-the-art Equipment</h3>
                <p>Latest fitness machines and free weights</p>
            </div>
            <div class="benefit-card">
                <div class="icon">👥</div>
                <h3>Expert Trainers</h3>
                <p>Certified professionals to guide you</p>
            </div>
            <div class="benefit-card">
                <div class="icon">🎯</div>
                <h3>Flexible Plans</h3>
                <p>Options that fit your schedule and budget</p>
            </div>
            <div class="benefit-card">
                <div class="icon">🌟</div>
                <h3>Community Events</h3>
                <p>Regular fitness challenges and workshops</p>
            </div>
        </div>
    </section>

    <section class="join-form">
        <h2>Get Started Now</h2>
        <form id="joinForm" onsubmit="handleSubmit(event)">
            <div class="form-group">
                <input type="text" id="fullName" required>
                <label for="fullName">Full Name</label>
            </div>
            <div class="form-group">
                <input type="email" id="email" required>
                <label for="email">Email</label>
            </div>
            <div class="form-group">
                <input type="tel" id="phone" required>
                <label for="phone">Phone Number</label>
            </div>
            <div class="form-group">
                <select id="membership" required>
                    <option value="">Select Membership</option>
                    <option value="starter">Starter Plan - $20/month</option>
                    <option value="basic">Basic Plan - $40/month</option>
                    <option value="premium">Premium Plan - $60/month</option>
                    <option value="elite">Elite Plan - $100/month</option>
                </select>
            </div>
            <button type="submit">Join Now</button>
        </form>
    </section>

    <section class="testimonials">
        <h2>Member Success Stories</h2>
        <div class="testimonials-grid">
            <div class="testimonial">
                <img src="/api/placeholder/100/100" alt="Member photo">
                <p>"Lost 30 pounds in 6 months. Best decision ever!"</p>
                <h4>Sarah M.</h4>
            </div>
            <div class="testimonial">
                <img src="/api/placeholder/100/100" alt="Member photo">
                <p>"Great community and amazing trainers!"</p>
                <h4>John D.</h4>
            </div>
        </div>
    </section>
</div>
<script src="{{asset('assets/js/joinus.js')}}"></script>
@endsection
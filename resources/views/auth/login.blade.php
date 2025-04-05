@extends('layouts.app')
@section('title' , 'Login')  
@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
  
    body {
        margin: 0;
        font-family: "Poppins", sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(208deg, rgb(7, 23, 9) 12.95%, rgb(162, 184, 165) 59.12%, rgb(43, 56, 43) 71.18%, rgb(41, 161, 71) 85.29%);
    }
    
    .container {
        display: flex;
        max-width: 900px;
        max-width: 850px;
    }
    
    .forms {
        background-color: #ffffff;
        width: 50%;
        padding: 40px 20px;
        box-sizing: border-box;
    }
    
    .title {
        font-size: 25px; 
        font-weight: 500;
        color: #222;
        margin-bottom: 40px;
        position: relative;
    }
    
    .title::after {
        content: "";
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 25px;
        height: 3px;
        background-color: #29a147;
    }

    .input-box {
        position: relative;
        margin-bottom: 15px;
    }
    
    .input-box input {
        width: 100%;
        padding: 10px 25px;
        font-size: 16px;
        font-weight: 500;
        border: none;
        border-bottom: 2px solid #ccc;
        color: #222;
        transition: 0.3s;
    }
    
    .input-box input:focus {
        border-bottom-color: #29a147;
        outline: none;
    }
    
    .input-box i {
        position: absolute;
        
        top: 50%;
        transform: translateY(-50%);
        color: #29a147;
        font-size: 18px; 
    }

    .text {
        text-align: left;
        margin-top: 10px;
    }
    
    .text a {
        color: #29a147;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
    }
    
    .text a:hover {
        text-decoration: underline;
    }

    .button {
    margin-top: 30px;
}

.button input[type="submit"] {
    width: 100%;
    padding: 10px;
    color: #fff;
    background: #0b491b79;
    font-size: 15px;
    font-weight: 500;
    border: none; 
    border-bottom: 2px solid #29a147;
    border-radius: 6px;
    box-shadow: 0 4px 6px rgba(41, 161, 71, 0.4);
    cursor: pointer;
    transition: all 0.3s ease;
}

.button input[type="submit"]:hover {
    background-color: #29a147;
    color: #fff; 
}

.button input[type="submit"]:active {
    background-color: #1b6e2f; 
    box-shadow: inset 0 4px 6px rgba(0, 0, 0, 0.2); 
    transform: translateY(2px); 
}


    .sign-up-text {
        text-align: center;
        margin-top: 10px;
        font-size: 14px;
    }

    .cover {
        position: relative;
        background-color: #29a147; 
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(1.2); 
    }

    .cover::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(14, 92, 14, 0.5);
        z-index: 2;
    }

    .text-1 {
        position: absolute;
        color: #fff;
        font-size: 28px;
        font-weight: bold;
        text-align: center;
    }

    .text-2 {
        position: absolute;
        top: 65%;
        color: #fff;
        font-size: 18px;
        font-weight: 300;
    }
</style>


<div class="container">
    <div class="forms">
        <div class="form-content">
            <div class="login-form">
                <div class="title">Login</div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-boxes">
                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" placeholder=" E-mail or username or phone" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="text">
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        </div>
                        <div class="button input-box">
                            <input type="submit" value="SIGN IN">
                        </div>
                        <div class="text sign-up-text">Don't have an account? 
                            <a href="{{ route('register') }}">Sign up now</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="cover">
        <img src="{{ asset('assets/images/login/login.jpg') }}" alt="cover image">
        <div class="text-1">Every decision is a <br> new adventure</div>
        <div class="text-2">Start it</div>
    </div>
</div>
@endsection

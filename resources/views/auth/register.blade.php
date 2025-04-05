@extends('layouts.app')
@section('title' , 'Register') 
@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Roboto', sans-serif;
}

body {
  height: 100vh;
  background-image: url("/images/signUp/signup.jpg");
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 10px;
  opacity: 0.95;
  background: linear-gradient(208deg, rgb(7, 23, 9) 12.95%, rgb(162, 184, 165) 59.12%, rgb(43, 56, 43) 71.18%, rgb(41, 161, 71) 85.29%);
}

.container {
  max-width: 700px;
  width: 100%;
  background-color: #fff;
  padding: 25px 30px;
  border-radius: 5px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
}

.container .title {
  font-size: 25px;
  font-weight: 500;
  position: relative;
}

.container .title::before {
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 30px;
  border-radius: 5px;
  background: linear-gradient(135deg, #d5dee4, #43bb43);
}

.content form .user-details {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 20px 0 12px 0;
}

form .user-details .input-box {
  margin-bottom: 15px;
  width: calc(100% / 2 - 20px);
}

form .input-box span.details {
  display: block;
  font-weight: 500;
  margin-bottom: 5px;
}

.user-details .input-box input {
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
}

.user-details .input-box input:focus,
.user-details .input-box input:valid {
  border-color: #27a827;
}

form .gender-details .gender-title {
  font-size: 20px;
  font-weight: 500;
}

form .category {
  display: flex;
  width: 80%;
  margin: 14px 0;
  justify-content: space-between;
}

form .category label {
  display: flex;
  align-items: center;
  cursor: pointer;
}

form .category label .dot {
  height: 18px;
  width: 18px;
  border-radius: 50%;
  margin-right: 10px;
  background: #d9d9d9;
  border: 5px solid transparent;
  transition: all 0.3s ease;
}

#dot-1:checked~.category label .one,
#dot-2:checked~.category label .two,
#dot-3:checked~.category label .three {
  background: #3ba83b;
  border-color: #d9d9d9;
}

form input[type="radio"] {
  display: none;
}

form .button {
  height: 45px;
  margin: 35px 0
}

form .button input {
  height: 100%;
  width: 100%;
  border-radius: 5px;
  border: none;
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  letter-spacing: 1px;
  cursor: pointer;
  transition: all 0.3s ease;
  background: #3ba83b;
}
form .button input:hover {
  background: #214721;
}

/* Responsive media query code for mobile devices */
@media(max-width: 584px) {
  .container {
    max-width: 100%;
  }

  form .user-details .input-box {
    margin-bottom: 15px;
    width: 100%;
  }

  form .category {
    width: 100%;
  }

  .content form .user-details {
    max-height: 300px;
    overflow-y: scroll;
  }

  .user-details::-webkit-scrollbar {
    width: 5px;
  }
}

/* Responsive media query code for mobile devices */
@media(max-width: 459px) {
  .container .content .category {
    flex-direction: column;
  }
}

/* Style the container for password and eye icon */
.password-container {
  position: relative;
  width: 100%;
}

.password-container input {
  padding-right: 30px; /* Add space for the icon */
}

.password-container i {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
}
</style>

<div class="container">
  <!-- Title section -->
  <div class="title">Registration</div>
  <div class="content">
    <!-- Registration form -->
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="user-details">
        <!-- Input for Full Name -->
        <div class="input-box">
          <span class="details">Full Name</span>
          <input type="text" name="fullname" class="@error('fullname') is-invalid @enderror" placeholder="Enter your fullname" value="{{ old('fullname') }}">
          @error('fullname')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <!-- Input for Username -->
        <div class="input-box">
          <span class="details">Username</span>
          <input type="text" name="username" class="@error('username') is-invalid @enderror" placeholder="Enter your username" value="{{ old('username') }}" required>
          @error('username')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <!-- Input for Email -->
        <div class="input-box">
          <span class="details">Email</span>
          <input type="email" name="email" class="@error('email') is-invalid @enderror" placeholder="Enter your email" value="{{ old('email') }}" required>
          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <!-- Input for Phone Number -->
        <div class="input-box">
          <span class="details">Phone Number</span>
          <input type="text" name="phone" class="@error('phone') is-invalid @enderror" placeholder="Enter your number" value="{{ old('phone') }}" required>
          @error('phone')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <!-- Input for Password -->
        <div class="input-box">
          <span class="details">Password</span>
          <div class="password-container">
            <input type="password" name="password" id="password" class="@error('password') is-invalid @enderror" placeholder="Enter your password" required>
            <i class="fas fa-eye" id="toggle-password"></i>
          </div>
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <!-- Input for Confirm Password -->
        <div class="input-box">
          <span class="details">Confirm Password</span>
          <div class="password-container">
            <input type="password" name="password_confirmation" id="confirm-password" placeholder="Confirm your password" required>
            <i class="fas fa-eye" id="toggle-confirm-password"></i>
          </div>
        </div>
      </div>

      <div class="gender-details">
        <!-- Radio buttons for gender selection -->
        <input type="radio" name="gender" id="dot-1" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} >
        <input type="radio" name="gender" id="dot-2" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} >
        <input type="radio" name="gender" id="dot-3" value="prefer_not_to_say" {{ old('gender') == 'prefer_not_to_say' ? 'checked' : '' }} >
        
        <span class="gender-title">Gender</span>
        <div class="category">
          <!-- Label for Male -->
          <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <!-- Label for Female -->
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>      
          <!-- Label for Prefer not to say -->
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
          </label>
        </div>
      </div>
      
      


      <!-- Submit button -->
      <div class="button">
        <input type="submit" value="Register">
      </div>
    </form>
  </div>
</div>



<script>
  // Toggle password visibility
  document.getElementById("toggle-password").addEventListener("click", function () {
    var passwordField = document.getElementById("password");
    var type = passwordField.type === "password" ? "text" : "password";
    passwordField.type = type;
    this.classList.toggle("fa-eye-slash");
  });

  // Toggle confirm password visibility
  document.getElementById("toggle-confirm-password").addEventListener("click", function () {
    var confirmPasswordField = document.getElementById("confirm-password");
    var type = confirmPasswordField.type === "password" ? "text" : "password";
    confirmPasswordField.type = type;
    this.classList.toggle("fa-eye-slash");
  });
</script>

@endsection

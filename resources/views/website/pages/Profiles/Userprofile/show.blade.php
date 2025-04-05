@extends('website.layouts.master')

@section('title', 'profile user')

@section('main-content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

:root {
  --color-primary: #29a147;
}


body {
  font-family: 'Roboto', sans-serif;
  margin: 0;
  padding: 0;
}

.profile-container {
  max-width: 800px;
  margin: 20px auto;
  background: #edf0f6;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.profile-header {
  text-align: center;
  margin-bottom: 20px;
}

.opp{
  font-style: italic;
  font-size: x-small;
  font-weight: lighter;
}

#profile-pic {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  margin-bottom: 10px;
}

#edit-profile-btn {
  padding: 8px 16px;
  background-color: #29a147;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.profile-details {
  display: grid;
  grid-area: auto;
  position: relative;
  justify-content: center;
  align-items: center;
  text-align: center;

}

.booked-sessions::after,
.performance-tracking::after {
  content: "";
  display: table;
  justify-content: center;
  clear: both;
}
.performance-tracking h2{
  
  text-align: center;
}

.booked-sessions h2{
  
  text-align: center;
}
.card {
  float: left;
  width: 33.33%;
  margin-left: 1.5%;
}

.booked-sessions,
.performance-tracking,
.plan-progress {
  margin-bottom: 20px;
  box-shadow: 10px 10px 10px -1px rgba(10, 99, 169, 0.16),
    -10px -10px 10px -1px rgba(255, 255, 255, 0.7);
  border-radius: 10px;
  padding: 0px;
  justify-content: center;
}

.chartBox {
  float: left;
  width: 40%;
}

.wrapper {
  position: relative;
  width: 50%;
  max-width: 500px;
  background-color: #ebeef1;
  border-radius: 10px;
  float: right;
}


.skills-wrapper {
  padding: 0 20px;
}

.skills-wrapper .bar {
  margin: 20px 0;
}

.skills-wrapper .bar .info {
  margin-bottom: 10px;
}

.skills-wrapper .bar .info span {
  letter-spacing: 1px;
  text-transform: uppercase;
}

.skills-wrapper .bar .progress-bar {
  width: 100%;
  height: 15px;
  background-color: #dddddd;
  border-radius: 10px;
  position: relative;
  overflow: hidden;
}

.skills-wrapper .bar .progress-bar span {
  position: absolute;
  height: 100%;
  border-radius: 10px;
  transform: scale(0);
  background-color: var(--color-primary);
  animation: animate 1s cubic-bezier(1, 0, 0.5, 1) forwards;
}

@keyframes animate {
  100% {
    transform: scale(1);
  }
}


.skills-wrapper .bar .progress-bar span.cardio {
  width: 90%;
}

.skills-wrapper .bar .progress-bar span.daily {
  width: 60%;
}


.skills-wrapper .bar .progress-bar span.calories {
  width: 85%;
}

.skills-wrapper .bar .progress-bar span.plan {
  width: 70%;
}
.badge {
  content: "";
  display: block;
  text-align: center; 
  margin-bottom: 20px;
}

.badge h2 {
  color: #171717;
  text-align: center;
}

.badge .badge-images {
  display: flex;
  justify-content: center; 
  gap: 20px; 
  flex-wrap: wrap; 
}

.badge img {
  height: auto;
  max-width: 150px; 
  max-height: 150px; 
  transition: transform 0.3s;
}

.badge img:hover {
  transform: scale(1.1); 
}

.badge p {
  color: #171717;
  text-align: center; 
  margin-top: 10px;
}

    </style>

<div class="profile-container">

    <div class="profile-header">
        <img src="{{ asset('storage/profiles/' . $profileUser->image) }}" alt="Profile Picture" id="profile-pic">
        <h1 id="user-name">{{ $user->fullname }}</h1>
        <a href="{{ route('profile.edit', $user->username) }}" id="edit-profile-btn" class="btn btn-primary">
          <i class="fas fa-pencil-alt me-2"></i>Edit 
      </a>
      <a href="{{ route('home') }}" class="btn btn-success" style="background-color:#29a147; border-radius: 5px; border: none; width:100px; height:40px;">
        <i class="fas fa-home me-2"></i> Home
      </a>
      <a href="{{ route('video.gym') }}" class="btn btn-success" style="background-color:#29a147; border-radius: 5px; border: none; width:100px; height:40px;">
        <i class="fas fa-eye me-2"></i> Watch
      </a>
    </div>
    <div class="profile-details">
        <p><strong>Username:</strong> <span id="user-username">{{ $user->username }}</span></p>
        <p><strong>Membership:</strong> <span id="user-membership">{{ $profileUser->membership }}</span></p>
        <p> <strong><i class="fas fa-eye me-2"></i> :</strong> <span> {{$profileUser->videos_watched }}</span></p>
    </div>
    
    <div class="performance-tracking">
    


        <div class="chartBox">
            <canvas id="body-composition-chart" style="width:50%"></canvas>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const bodyCompositionCtx = document.getElementById("body-composition-chart").getContext("2d");
                    const xValues = ["Fats", "Muscles", "Water", "Bones", "Other"];
                    const yValues = [
                        {{ $profileUser->body_fats_percentage ?? 0 }},
                        {{ $profileUser->muscle_mass_percentage ?? 0 }},
                        {{ $profileUser->water_percentage ?? 0 }},
                        {{ $profileUser->bone_mass_percentage ?? 0 }},
                        {{ $profileUser->other_composition_percentage ?? 0 }}
                    ];
                    const barColors = ["#b91d47", "#00aba9", "#2b5797", "#e8c3b9", "#1e7145"];
                    
                    new Chart(bodyCompositionCtx, {
                        type: "doughnut",
                        data: {
                            labels: xValues,
                            datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true
                                }
                            }
                        }
                    });
                });
            </script>
            
        </div>
    
        <div class="wrapper">
            <div class="skills-wrapper">
                <div class="bar">
                    <div class="info">
                        <span>Cardio</span>
                    </div>
                    <div class="progress-bar">
                        <span class="cardio" style="width: {{ $profileUser->cardio_percentage ?? 0 }}%;"></span>
                    </div>
                </div>
    
                <div class="bar">
                    <div class="info">
                        <span>Daily Goal</span>
                    </div>
                    <div class="progress-bar">
                        <span class="daily" style="width: {{ $profileUser->daily_goal_percentage ?? 0 }}%;"></span>
                    </div>
                </div>
    
                <div class="bar">
                    <div class="info">
                        <span>Calories</span>
                    </div>
                    <div class="progress-bar">
                        <span class="calories" style="width: {{ $profileUser->calories_percentage ?? 0 }}%;"></span>
                    </div>
                </div>
    
                <div class="bar">
                    <div class="info">
                        <span>Plan Progress</span>
                    </div>
                    <div class="progress-bar">
                        <span class="plan" style="width: {{ $profileUser->plan_progress_percentage ?? 0 }}%;"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="booked-sessions">
        <h2>Booked Sessions</h2>
        <div>
            @foreach($bookedSessions as $session)
            <div class="card grid" style="width: 15rem;">
              <img src="{{ asset('storage/profiles/' . $profileUser->image) }}" alt="Profile Picture">
                <div class="card-body">
                    <h5 class="card-title">{{ $session->session_title }} <span class="opp">{{ $session->session_time }}</span></h5>
                    <h5 class="card-title">{{ $session->plan }}</h5>
                    <p class="card-text">{{ $session->description }}</p>
                    <form action="{{ route('book-session.destroy', $session->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this session?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="badge">
      <h2>Badges</h2>
      <div class="badge-images">
        @foreach($profileUser->badges as $badge)
          @php
              // حساب الحجم بناءً على التقدم
              $percentage = $badge->progress_threshold;
              $size = $percentage + 50;
          @endphp
          <div>
            <img src="{{ asset($badge->image) }}" 
                 alt="{{ $badge->name }} badge" 
                 style="max-width: 150px; max-height: 150px; width: auto; height: auto;">
            <p>{{ $badge->name }}</p>
          </div>
        @endforeach
      </div>
    </div>
    
  </div>  
    </div>
    
    {{-- <script>
    .then(data => {
    if (data.success) {
        document.querySelector('.cardio').style.width = data.progress.cardio + '%';

        // تحديث الشارات
        const badgeContainer = document.querySelector('.badge-images');
        badgeContainer.innerHTML = '';
        data.badges.forEach(badge => {
            const badgeElement = document.createElement('div');
            badgeElement.innerHTML = `
                <img src="${badge.badge_image}" alt="${badge.badge_name} badge" style="max-width: 150px;">
                <p>${badge.badge_name}</p>
            `;
            badgeContainer.appendChild(badgeElement);
        });
    }
});


  
     
  </script> --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
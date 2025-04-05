@extends('website.layouts.master')

@section('title', 'profile tariner')

@section('main-content')
<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");
body {
  width: 100%;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  min-height: 100vh;
  font-family: "Poppins", sans-serif;

}

body::-webkit-scrollbar{
    display: none;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  display: flex;
  align-items: center;
}

a {
  text-decoration: none;
}

.header__wrapper header {
  width: 100%;
  background: url("/images/HeroImage.jpg") no-repeat 50% 20% / cover;
  min-height: calc(100px + 15vw);
}

.header__wrapper .cols__container .left__col {
  padding: 25px 20px;
  text-align: center;
  max-width: 350px;
  position: relative;
  margin: 0 auto;
}

.reservationbtn{
  background: #29a147;
  color: #fff;
  border: none;
  padding: 10px 25px;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 20px;
}
.header__wrapper .cols__container .left__col .img__container {
  position: absolute;
  top: -60px;
  left: 50%;
  transform: translatex(-50%);
}
.header__wrapper .cols__container .left__col .img__container img {
  width: 120px;
  height: 120px;
  object-fit: cover;
  border-radius: 50%;
  display: block;
  box-shadow: 1px 3px 12px rgba(0, 0, 0, 0.18);
}
.header__wrapper .cols__container .left__col .img__container span {
  position: absolute;
  background: #2afa6a;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  bottom: 3px;
  right: 11px;
  border: 2px solid #fff;
}
.header__wrapper .cols__container .left__col h2 {
  margin-top: 60px;
  font-weight: 600;
  font-size: 22px;
  margin-bottom: 5px;
}
.header__wrapper .cols__container .left__col p {
  font-size: 0.9rem;
  color: #818181;
  margin: 0;
}
.header__wrapper .cols__container .left__col .about {
  justify-content: space-between;
  position: relative;
  margin: 35px 0;
}
.header__wrapper .cols__container .left__col .about li {
  display: flex;
  flex-direction: column;
  color: #818181;
  font-size: 0.9rem;
}
.header__wrapper .cols__container .left__col .about li span {
  color: #1d1d1d;
  font-weight: 600;
}
.header__wrapper .cols__container .left__col .about:after {
  position: absolute;
  content: "";
  bottom: -16px;
  display: block;
  background: #cccccc;
  height: 1px;
  width: 100%;
}
.header__wrapper .cols__container .bio p {
  font-size: 1rem;
  color: #1d1d1d;
  line-height: 1.8em;
  text-align: left;
}
.header__wrapper .cols__container .bio ul {
  gap: 30px;
  justify-content: center;
  align-items: center;
  margin-top: 25px;
}
.header__wrapper .cols__container .bio ul li {
  display: flex;
}
.header__wrapper .cols__container .bio ul i {
  font-size: 1.3rem;
}
.header__wrapper .cols__container .right__col nav {
  display: flex;
  align-items: center;
  padding: 20px 0;
  justify-content: space-between;
  flex-direction: column;
}
.header__wrapper .cols__container .right__col nav ul {
  display: flex;
  gap: 10px;
  flex-direction: column;
}
.header__wrapper .cols__container .right__col nav ul li a {
  text-transform: uppercase;
  color: #818181;
}
.header__wrapper .cols__container .right__col nav ul li:nth-child(1) a {
  color: #1d1d1d;
  font-weight: 600;
}
.header__wrapper .cols__container .right__col nav button {
  background: #29a147;
  color: #fff;
  border: none;
  padding: 8px 25px;
  border-radius: 4px;
  cursor: pointer;
  margin-top: 20px;
}
.header__wrapper .cols__container .right__col nav button:hover {
  opacity: 0.8;
}
.photos::-webkit-scrollbar{
    display: none;

}
.header__wrapper .cols__container .right__col .photos {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
  gap: 10px;
}
.header__wrapper .cols__container .right__col .photos img {
  max-width: 80%;
  display:block;
  height: 90%;
  object-fit: cover;
}


.header__wrapper .cols__container .right__col .private-classes{
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
    gap: 10px;
  }
  .header__wrapper .cols__container .right__col .private-classes img {
    max-width: 80%;
    display:block;
    height: 90%;
    object-fit: cover;
  }


  .header__wrapper .cols__container .right__col .group-classes{
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
    gap: 10px;
  }
  .header__wrapper .cols__container .right__col .group-classes img {
    max-width: 80%;
    display:block;
    height: 90%;
    object-fit: cover;
  }

  
.header__wrapper .cols__container .right__col .certifications{
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
    gap: 10px;
  }
  .header__wrapper .cols__container .right__col .certifications img {
      max-width: 80%;
      display:block;
      height: 90%;
      object-fit: cover;
    }
    
/* Responsiveness */

@media (min-width: 868px) {
  .header__wrapper .cols__container {
    max-width: 1200px;
    margin: 0 auto;
    width: 90%;
    justify-content: space-between;
    display: grid;
    grid-template-columns: 1fr 2fr;
    gap: 50px;
  }
  .header__wrapper .cols__container .left__col {
    padding: 25px 0px;
  }
  .header__wrapper .cols__container .right__col nav ul {
    flex-direction: row;
    gap: 30px;
  }
  .header__wrapper .cols__container .right__col .photos {
    height: 365px;
    overflow: auto;
    padding: 0 0 30px;
  }
}

@media (min-width: 1017px) {
  .header__wrapper .cols__container .left__col {
    margin: 0;
    margin-right: auto;
  }
  .header__wrapper .cols__container .right__col nav {
    flex-direction: row;
  }
  .header__wrapper .cols__container .right__col nav button {
    margin-top: 0;
    
  }
}

</style>

<div class="header__wrapper" style="max-height: 100vh; overflow-y: auto;">
  <header></header>
  <div class="cols__container">

    <!-- Left Column -->
    <div class="left__col">
      <div class="img__container">
        @if(isset($trainerProfile) && $trainerProfile->profile_picture)
          <img src="{{ asset('storage/trainers/' . $trainerProfile->profile_picture) }}" alt="Trainer Image" />
        @elseif(isset($trainerProfile))
          <img src="images/trainers/default.jpg" alt="Default Trainer Image" />
        @else
          <img src="images/trainers/default.jpg" alt="No Trainer Data" />
        @endif
        <span></span>
      </div>
      <h2>{{ $user->fullname }}</h2>  
      <p>{{ $trainerProfile->specialization ?? '' }}</p>
      <p>{{ $user->email }}</p>  

      <!-- Buttons Section -->
      <div style="display: flex; gap: 10px; justify-content: center;">
        <a href="{{ route('trainerprofile.edit', ['id' => $user->id]) }}">
          <button class="reservationbtn">
            <i class="fas fa-pencil-alt me-2"></i>Edit 
          </button>
        </a>
        <button id="follow-btn" style="background-color: #28a745; color: #fff; border: none; border-radius: 5px; width:100px; height:44px; margin-top:20px">
          <i class="fas fa-plus"></i> Follow
        </button>
      </div>

      <ul class="about">
        <li style="margin-left: 10px;">
          <span>
            @php
                $totalClasses = $trainerProfile 
                    ? ($trainerProfile->private_classes_count + $trainerProfile->group_classes_count) 
                    : 0;
            @endphp
            {{ $totalClasses }}
          </span>
          Classes
        </li>
        <li style="margin-left: 10px;">
          <span id="followers-count">{{ $trainerProfile->followers_count ?? 0 }}</span> Followers
        </li>
        <li style="display: inline; align-items: center; gap: 5px; margin-left: 10px; margin-bottom:10px">
          @php
            $rating = $trainerProfile->rating ?? 0;
            $fullStars = floor($rating);
            $emptyStars = 4 - $fullStars;
          @endphp
          @for ($i = 0; $i < $fullStars; $i++)
            <span>⭐</span>
          @endfor
          @for ($i = 0; $i < $emptyStars; $i++)
            <span>☆</span>
          @endfor
        </li>
      </ul>

      <div class="bio">
        <p>{{ $trainerProfile->bio ?? 'No bio available' }}</p>
        <ul>
          <li><i class="fab fa-twitter"></i></li>
          <li><i class="fab fa-facebook"></i></li>
        </ul>
      </div>
    </div>

    <!-- Right Column -->
    <div class="right__col">
      <nav>
        <ul style="display: flex; align-items: center; gap: 15px;">
          <li><a href="#">Snaps</a></li>
          <li><a href="#">Private Classes <span>{{ $trainerProfile->private_classes_count ?? 0 }}</span></a></li>
          <li><a href="#">Group Classes <span>{{ $trainerProfile->group_classes_count ?? 0 }}+</span></a></li>
          <li><a href="#">Certifications</a></li>
          <li>
            <a href="{{ route('home') }}" style="text-decoration: none;">
              <button style="padding: 5px 15px;background-color: #28a745; color: #fff; border: none; border-radius: 5px; width:100px">
                <i class="fas fa-home"></i> Home
              </button>
            </a>
          </li>
        </ul>
      </nav>
      
      <!-- Content Divs -->
      <div class="photos">
        <img src="{{asset('assets/images/trainer_profile/training_1.jpg')}}" alt="Photo" />
        <img src="{{asset('assets/images/trainer_profile/training_2.jpg')}}" alt="Photo" />
        <img src="{{asset('assets/images/trainer_profile/training_3.jpeg')}}" alt="Photo" />
        <img src="{{asset('assets/images/trainer_profile/training_4.jpeg')}}" alt="Photo" />
        <img src="{{asset('assets/images/trainer_profile/training_5.jpg')}}" alt="Photo" />
        <img src="{{asset('assets/images/trainer_profile/training_6.jpeg')}}" alt="Photo" />
      </div>
      <div class="private-classes" style="display: none;">
        <h3>Private Classes</h3>
        <p>Explore our one-on-one tailored sessions for personalized training.</p>
      </div>
      <div class="group-classes" style="display: none;">
        <h3>Group Classes</h3>
        <p>Join group sessions to train with others and foster a team spirit.</p>
      </div>
      <div class="certifications" style="display: none;">
        <h3>Certifications</h3>
        <ul>
          @if ($trainerProfile && $trainerProfile->certifications)
            @foreach (explode(',', $trainerProfile->certifications) as $certification)
              <li>{{ $certification }}</li>
            @endforeach
          @else
            <li>No certifications available</li>
          @endif
        </ul>
      </div>
    </div>
  </div>
</div>


    <script>
       $(document).ready(function() {
    $('#follow-btn').click(function(event) {
        event.preventDefault(); 

        
        $.ajax({
            url: '/follow',  
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), 
            },
            success: function(response) {
                alert('تم المتابعة بنجاح');
                
            },
            error: function(xhr, status, error) {
                console.log('حدث خطأ: ' + error);
            }
        });
    });
});

    </script>

    <script src="{{asset('assets/js/trainer_profile.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
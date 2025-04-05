<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- booked sessions-->
    {{-- <link rel="stylesheet" href="{{asset('assets/css/booking.css')}}"> --}}
      <!-- profile user-->
   {{-- <!--<link rel="stylesheet" href="{{asset('assets/css/user_profile.css')}}""--}}
     <!-- profile trainer-->
     {{-- <link rel="stylesheet" href="{{asset('assets/css/trainer_profile.css')}}"/> --}}

    <title>@yield('title')</title>
    {{-- <title></title> --}}
</head>
<body>
  
  @unless (
    request()->is('book-session') || 
    request()->is('user/profile*') || 
    request()->is('profiletrainer') || 
    request()->routeIs('profile.create') || 
    request()->routeIs('profile.store') || 
    request()->routeIs('profileuser.show') || 
    request()->routeIs('profile.edit') || 
    request()->routeIs('profile.update') || 
    request()->routeIs('joinus') || 
    request()->routeIs('trainerprofile.create') || 
    request()->routeIs('trainerprofile.store') || 
    request()->routeIs('trainerprofile.show') ||
    request()->routeIs('trainerprofile.edit') || 
    request()->routeIs('trainerprofile.update')||
    request()->routeIs('chat.index') ||
    request()->routeIs('chat.messages') || 
    request()->routeIs('chat.store') ||
    request()->routeIs('checkout') ||
    request()->routeIs('checkout.processed') ||
    request()->routeIs('video.gym') ||
    request()->routeIs('video.watched') 
)
  {{-- navbar include --}}
  @include('website.includes.navbar') 
@endunless

{{-- Main content --}}
@section('main-content')
@show

@unless (
    request()->is('book-session') || 
    request()->is('user/profile*') || 
    request()->is('profiletrainer') || 
    request()->routeIs('profile.create') || 
    request()->routeIs('profile.store') || 
    request()->routeIs('profileuser.show') || 
    request()->routeIs('profile.edit') || 
    request()->routeIs('profile.update') || 
    request()->routeIs('joinus') || 
    request()->routeIs('trainerprofile.create') || 
    request()->routeIs('trainerprofile.store') || 
    request()->routeIs('trainerprofile.show')  ||
    request()->routeIs('trainerprofile.edit') || 
    request()->routeIs('trainerprofile.update')||
    request()->routeIs('chat.index') ||
    request()->routeIs('chat.messages') || 
    request()->routeIs('chat.store')||
    request()->routeIs('checkout') ||
    request()->routeIs('checkout.processed') ||
    request()->routeIs('video.gym') ||
    request()->routeIs('video.watched') 
)
  {{-- footer include --}}
  @include('website.includes.footer') 
@endunless




<!--   *** Link To Custom Script File ***   -->
<script type="text/javascript" src="{{asset('assets/js/script.js')}}"></script>
<!--booked-->
<script type="" src="{{asset('assets/js/booking.js')}}"></script>
<!-- profile user-->
<script src="{{asset('assets/js/user_profile.js')}}"></script>

{{-- <script src="{{asset('assets/scripts.js')}}"></script>
<script src="{{asset('assets/js/scripts.js')}}"></script> --}}

</body>
</html>

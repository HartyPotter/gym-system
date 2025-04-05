<!--   *** Navbar with Dynamic Chat Icon (ID Dynamic) ***   -->
<section class="home" id="home">
    <div class="home-overlay"></div>
    <!--   === Main Navbar Starts ===   -->
    <nav class="main-navbar">
        <div class="logo">
            <img src="{{asset('assets/images/home/logo.png')}}">
        </div>
        <ul class="nav-list">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#our_team">Trainers</a></li>
            <li><a href="#pricing">Prices</a></li>
            <li><a href="#blog">Blog</a></li>
           
        </ul>
        <a href="{{route('joinus')}}" class="join-us-btn-wrapper" style="margin-left:20px;">
            <button class="btn join-us-btn">Join Us</button>
        </a>
        <div class="hamburger-btn">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="col-6 col-md-4 order-3 order-md-3 text-right">
            <div class="site-top-icons">
                <ul style="list-style: none; margin: 0; padding: 0; display: flex; gap: 10px; margin-left: 20px;">
                    @auth
                    <li>
                        <a href="javascript:void(0)" style="text-decoration: none; font-weight: bold; color: #29a147;">
                            {{ auth()->user()->name ?? auth()->user()->username }}
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" style="text-decoration: none; cursor: pointer;" onclick="toggleDropdown()">
                            <span style="font-size: 18px;" class="fas fa-user icon-color"></span>
                        </a>
                        <ul class="dropdown-menu" style="display: none; padding: 3px; font-size: 14px; min-width:150px;margin-right: 20px;">
                            @if(auth()->user()->user_type === 'admin')
                            <li><button onclick="window.location.href='{{ route('admin.profile.show', ['username' => $user->username]) }}'" style="font-size: 14px; color: #29a147; text-align: left; padding: 6px;">
                                <i class="fas fa-user-cog" style="margin-right: 8px;"></i> Profile Admin
                            </button></li>
                            <li><button onclick="window.location.href='{{ route('dashboard') }}'" style="font-size: 14px; color: #29a147; text-align: left; padding: 6px;">
                                <i class="fas fa-tachometer-alt" style="margin-right: 8px;"></i> Dashboard
                            </button></li>
                            @elseif(auth()->user()->user_type === 'customer')
                            <li>
                                <button onclick="window.location.href='{{ auth()->user()->profile ? route('profileuser.show', ['username' => auth()->user()->username]) : route('profile.create') }}'" style="font-size: 14px; color: #29a147; text-align: left; padding: 6px;">
                                    <i class="fas fa-user" style="margin-right: 8px;"></i>
                                    Profile User
                                </button>
                            </li>
                            @elseif(auth()->user()->user_type === 'trainer')
                            <li>
                                <button onclick="window.location.href='{{ auth()->user()->trainer ? route('trainerprofile.show', ['id' => auth()->user()->id]) : route('trainerprofile.create') }}'" style="font-size: 14px; color: #29a147; text-align: left; padding: 6px;">
                                    <i class="fas fa-chalkboard-teacher" style="margin-right: 8px;"></i>
                                    Profile Trainer
                                </button>
                            </li>
                            @endif
                            <li><a href="{{ route('logout') }}" style="color: #29a147; font-size: 14px; text-decoration: none; display: flex; align-items: center; padding: 6px;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i> Logout
                            </a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                    @else
                    <li class="dropdown">
                        <a href="javascript:void(0)" style="text-decoration: none; cursor: pointer;" onclick="toggleDropdown()">
                            <span style="font-size: 18px;" class="fas fa-user icon-color"></span>
                        </a>
                        <ul class="dropdown-menu" style="display: none; padding: 5px; font-size: 14px; min-width: 180px;">
                            <li><a href="{{ route('login') }}" style="text-decoration: none; color: #29a147; font-size: 14px; padding: 6px;">
                                <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> Login
                            </a></li>
                            <li><a href="{{ route('register') }}" style="text-decoration: none; color: #29a147; font-size: 14px; padding: 6px;">
                                <i class="fas fa-user-plus" style="margin-right: 8px;"></i> Register
                            </a></li>
                        </ul>
                    </li>
                    @endauth

					@auth
                        @if(Auth::user()->user_type === 'customer' || Auth::user()->user_type === 'trainer')
                            <li>
                                <a href="{{ route('chat.index') }}" style="text-decoration: none; color: #29a147; font-size: 14px; margin-left:20px;">
                                    <i class="fas fa-comment-dots icon-color" style="font-size: 18px;"></i>
                                </a>
                            </li>
                        @endif 
                    @endauth
                    @auth
                    @if(Auth::user()->user_type === 'customer' || Auth::user()->user_type === 'admin')
                        <li>
                            <a href="{{ route('checkout') }}" style="text-decoration: none; color:#29a147; font-size: 14px; margin-left:20px;">
                                <i class="fas fa-money-check-alt icon-color" style="font-size: 18px;"></i> Payment
                            </a>
                        </li>
                    @endif 
                @endauth
                
                

                    
					
                </ul>
            </div>
        </div>
    </nav>
    <!--   === Main Navbar Ends ===   -->
    <!--   === Banner Starts ===   -->
    <div class="banner">
        <div class="banner-contents">
            <h2>Start your training at ProLife</h2>
            <h1>Fit body needs more training</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo.</p>
            
                @if(Auth::user() && (Auth::user()->user_type == 'customer' || Auth::user()->user_type == 'admin'))
                <button class="btn read-more-btn">
                    <a href="{{ route('book-session.create') }}" style="color:#edf0f6; text-decoration:none;">
                        Book Session
                    </a>
                </button>
                @endif
        </div>
    </div>
    <!--   === Banner Ends ===   -->
</section>
<!--   *** Home Section Ends ***   -->

<style>
    .icon-color {
        color: #edf0f6;
        transition: color 0.3s ease;
    }

    .icon-color:hover,
    .icon-color:focus {
        color: #29a147;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 60px;
        right: 0;
        background-color: #fff;
        border: 2px solid #29a147;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        padding: 10px;
        z-index: 10;
        list-style: none;
    }

    .dropdown-menu li {
        margin-bottom: 10px;
    }

    .dropdown-menu button,
    .dropdown-menu a {
        color: #29a147;
        text-decoration: none;
        font-weight: bold;
        width: 100%;
        padding: 8px;
        background: none;
        border: none;
        text-align: left;
        cursor: pointer;
    }

    .dropdown-menu button:hover,
    .dropdown-menu a:hover {
        background-color: #f5f5f5;
    }
</style>

<script>
    function toggleDropdown() {
        const dropdown = document.querySelector('.dropdown-menu');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }
</script>

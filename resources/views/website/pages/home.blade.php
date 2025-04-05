@extends('website.layouts.master')

@section('title' , 'Golden Fitness')  

@section('main-content') 

<!--   *** Website Wrapper Starts ***   -->
<div class="website-wrapper">
   
<!--   *** Facilities Section Starts ***   -->
<section class="facilities">
	<div class="facilities-contents">
		
		<div class="facility-item">
			<div class="facility-icon">
				<i class="fa-solid fa-dumbbell"></i>
			</div>
			<div class="facility-desc">
				<h2>Quality Equipment</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			</div>
		</div>

		<div class="facility-item">
			<div class="facility-icon">
				<i class="fa-solid fa-wifi"></i>
			</div>
			<div class="facility-desc">
				<h2>Free Wifi</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			</div>
		</div>

		<div class="facility-item">
			<div class="facility-icon">
				<i class="fa-solid fa-person-swimming"></i>
			</div>
			<div class="facility-desc">
				<h2>Swimming Pool</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			</div>
		</div>

	</div>
</section>
<!--   *** Facilities Section Ends ***   -->

<!--   *** About Section Starts ***   -->
<section class="about" id="about">
	<div class="about-contents">
		
		<div class="about-left-col">
			<img src="{{asset('assets/images/about/about.jpg')}}">
		</div>

		<div class="about-right-col">
			<h4>About Us</h4>
			<h1>Best Facilities and Experienced Trainers</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			<div class="about-states">
				<div class="about-state about-state-1">
					<i class="fa-solid fa-person"></i>
					<h2>Best Trainers</h2>
				</div>
				<div class="about-state about-state-2">
					<i class="fa-solid fa-medal"></i>
					<h2>Award Winning</h2>
				</div>
			</div>
		</div>

	</div>
</section>
<!--   *** About Section Ends ***   -->

<!--   *** Services Section Starts ***   -->
<section class="services" id="services">
	
	<!--   === Services Header Starts ===   -->
	<header class="section-header">
		<h3>Services</h3>
		<h1>Services Which We Offer</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	</header>
	<!--   === Services Header Ends ===   -->

	<!--   === Services Contents Starts ===   -->
	<div class="services-contents">
		
		<div class="service-box">
			<div class="service-icon-box">
				<i class="fa-solid fa-dumbbell"></i>
			</div>
			<div class="service-desc">
				<h2>Body Building</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
			</div>
		</div>

		<div class="service-box">
			<div class="service-icon-box">
				<i class="fa-solid fa-person-walking"></i>
			</div>
			<div class="service-desc">
				<h2>Fitness</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
			</div>
		</div>

		<div class="service-box">
			<div class="service-icon-box">
				<i class="fa-solid fa-weight-hanging"></i>
			</div>
			<div class="service-desc">
				<h2>Boxing</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
			</div>
		</div>

		<div class="service-box">
			<div class="service-icon-box">
				<i class="fa-solid fa-dumbbell"></i>
			</div>
			<div class="service-desc">
				<h2>Crossfit</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
			</div>
		</div>

	</div>
	<!--   === Services Contents Ends ===   -->

</section>
<!--   *** Services Section Ends ***   -->

<!--   *** Offer Section Starts ***   -->
<section class="offer">
	<div class="offer-overlay"></div>
	<div class="offer-contents">
		<h1>Start Your Training Today</h1>
		<span>&</span>
		<h3>Get 30% Discount</h3>
		<a href="{{route('joinus')}}" class="join-us-btn-wrapper">
			<button class="btn start-training-btn">Join Now</button>
		</a>
	</div>
</section>
<!--   *** Offer Section Ends ***   -->

<!--   *** Team Section Starts ***   -->
<section class="our-team" id="our_team">
    <!--   === Team Header Starts ===   -->
    <header class="section-header">
        <h3>Our Trainers</h3>
        <h1>Meet Our Experienced Trainers</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </header>
    <!--   === Team Header Ends ===   -->
    <!--   === Team Contents Starts ===   -->
    <div class="team-contents">
        @foreach ($trainers as $trainer)
        <div class="trainer-card">
            <div class="trainer-image">
                <!-- عرض صورة المدرب -->
                <img src="{{ asset('storage/profiles/' . $trainer->image) }}" alt="{{ $trainer->fullname }}">
            </div>
            <div class="trainer-desc">
                <!-- عرض اسم المدرب -->
                <h2>{{ $trainer->fullname }}</h2>
                <p>{{ $trainer->specialization}}</p> 
            </div>
            <div class="trainer-contact">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
        @endforeach
    </div>
    <!--   === Team Contents Ends ===   -->
</section>
<!--   *** Team Section Ends ***   -->


<!--   *** Pricing Section Starts ***   -->
<section class="pricing" id="pricing">

    <!--   === Pricing Header Starts ===   -->
    <header class="section-header">
        <h3>Pricing</h3>
        <h1>Join Suitable Plan</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </header>
    <!--   === Pricing Header Ends ===   -->

    <!--   === Pricing Contents Starts ===   -->
    <div class="pricing-contents">
        @foreach ($plans as $plan)
            <div class="pricing-card">
                <div class="pricing-card-header">
                    @if ($plan->membership == 'Gold')
                        <div class="tag-box">
                            <span class="tag">Recommend</span>
                        </div>
                    @endif
                    <span class="pricing-card-title">{{ $plan->membership }}</span>
                    <div class="price-circle">
                        <span class="price"><i>$</i>{{ $plan->price }}</span>
                        <span class="desc">/ {{ $plan->duration }}</span>
                    </div>
                </div>

                <div class="pricing-card-body">
                    <ul>
                        @foreach (explode('\r\n', $plan->features) as $feature) <!-- إذا كانت الخصائص مخزنة كنص مفصول بفواصل -->
                            <li><i class="fa-solid fa-check"></i>{{ $feature }}</li>
                        @endforeach
                    </ul>
                    <form action="{{ route('checkout') }}" method="POST">
						@csrf
						<button type="submit" class="btn price-plan-btn">Checkout</button>
					</form>
                </div>
            </div>
        @endforeach
    </div>
    <!--   === Pricing Contents Ends ===   -->

</section>
<!--   *** Pricing Section Ends ***   -->



<!--   *** Blog Section Starts ***   -->
<section class="blog" id="blog">
	<!--   === Blog Header Starts ===   -->
	<header class="section-header">
		<h3>Our Blog</h3>
		<h1>Latest From Our Blog</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	</header>
	<!--   === Blog Header Ends ===   -->

	<!--   === Blog Contents Starts ===   -->
	<div class="blog-contents">
		@foreach($blogs as $blog)
		<div class="article-card">
			<img src="{{ asset('storage/profiles/' . $blog->image) }}" alt="{{ $blog->title }}">
			<div class="category">
				<div class="subject"><h3>{{ $blog->category }}</h3></div>
				<span>{{ $blog->publish_date ? $blog->publish_date->format('d/m/Y') : 'No Date' }}</span>
			</div>
			<h2 class="article-title">{{ $blog->title }}</h2>
			<p class="article-desc">{{ \Illuminate\Support\Str::limit($blog->description, 100) }}</p>
			<div class="article-views">
				<span>2.5k <i class="fa-solid fa-eye"></i></span>
				<span>352 <i class="fa-solid fa-comment"></i></span>
			</div>
		</div>
		@endforeach
	</div>
	<!--   === Blog Contents Ends ===   -->
	<div class="view-more-btn-container">
		{{ $blogs->links() }} <!-- Pagination Links -->
	</div>
</section>
<!--   *** Blog Section Ends ***   -->


</div>

<!--   *** Website Wrapper Ends ***   -->



@endsection
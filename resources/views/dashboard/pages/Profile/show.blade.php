@extends('dashboard.layouts.master')

@section('title','show')

@section('main-content')

<div class="container mt-5">
    
    @if(session('success'))
        <div class="alert alert-success text-center" style="background-color: #f8f9fa; font-weight: bold; font-size: 1.1rem; border-radius: 8px;">
            <i class="fas fa-check-circle" style="margin-right: 8px;"></i>
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center" style"background-color: #ffffff;">
        <div class="col-md-6">
            <div class="card mb-4 rounded-lg shadow-lg" style="border: none; border-radius: 20px; background-color: #ffffff;">
                <div class="card-body text-center" style="padding-top:10px;">
                    <img src="{{ $user->image && Storage::exists('public/profiles/' . $user->image) 
            ? Storage::url('public/profiles/' . $user->image) 
            : asset('images/default-profile.png') }}" 
    class="rounded-circle" 
    style="width: 150px; height: 150px; border: 4px solid #0bb13d;" 
    alt="Profile Image">
                    <h5 class="card-title mt-3" style=" font-size:25px; color: #0bb13d;">{{ $user->fullname }}</h5>
                    
                    <div class="row mt-4">
                        <div class="col-md-12">

                            <!-- Add Username -->
                            <div class="card border-light shadow-sm mb-3">
                                <div class="card-body">
                                    <h6 style="color: #0bb13d; font-weight: bold; font-size: 1.2rem;">
                                        <i class="fas fa-user"></i> Username:
                                    </h6>
                                    <p class="card-text" style="font-size: 1.1rem; line-height: 1.6;">
                                        {{ $user->username }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Add Email -->
                            <div class="card border-light shadow-sm mb-3">
                                <div class="card-body">
                                    <h6 style="color: #0bb13d; font-weight: bold; font-size: 1.2rem;">
                                        <i class="fas fa-envelope"></i> Email:
                                    </h6>
                                    <p class="card-text" style="font-size: 1.1rem; line-height: 1.6;">
                                        {{ $user->email }}
                                    </p>
                                </div>
                            </div>

                            <div class="card border-light shadow-sm mb-3">
                                <div class="card-body">
                                    <h6 style="color: #0bb13d; font-weight: bold; font-size: 1.2rem;">
                                        <i class="fas fa-phone"></i> Phone:
                                    </h6>
                                    <p class="card-text" style="font-size: 1.1rem; line-height: 1.6;">
                                        {{ $user->phone }}
                                    </p>
                                </div>
                            </div>
                           
                            <div class="card border-light shadow-sm mb-3">
                                <div class="card-body">
                                    <h6 style="color: #0bb13d; font-weight: bold; font-size: 1.2rem;">
                                        <i class="fas fa-venus-mars"></i> Gender:
                                    </h6>
                                    <p class="card-text" style="font-size: 1.1rem; line-height: 1.6;">
                                        <strong>{{ ucfirst($user->gender) }}</strong>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-around">
                        <a href="{{ route('admin.profile.edit', $user->username) }}" class="btn rounded-pill shadow-sm" style=" color:white; background-color:#0bb13d; padding: 10px 20px; border-radius: 20px;">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

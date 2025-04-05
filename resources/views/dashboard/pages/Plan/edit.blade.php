@extends('dashboard.layouts.master')
@section('title', 'Edit Plan Data')

@section('main-content')

<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <strong class="card-title fs-2">
                        @if(auth()->user()->id !== ($plan->create_user->id ?? null))
                            {{ $plan->plan }}
                        @else
                            Edit your plan
                        @endif
                    </strong>
                </div>
                <div class="card-body card-body-custom">
                    <form action="{{ route('plans.update', $plan->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        
                        @include('dashboard.pages.plan.form')
                        
                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-lg btn-custom2">
                                    Update
                            </button>
                            <div>
                                <a href="{{ route('plans.index') }}" class="btn btn-lg  btn-custom2-reset">
                                    Return to Plans
                                </a>
                                <a href="{{ url()->previous() }}" class="btn btn-lg btn-custom2-go">
                                    Go Back
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

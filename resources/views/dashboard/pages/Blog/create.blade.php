@extends('dashboard.layouts.master') 
@section('title' ,'create Blog')

@inject('user', 'App\Models\Blog')  

@section('main-content')

<div class="container container-custom my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card card-custom mb-4">
                
                <div class="card-header">
                    <strong>
                        Create Blog
                    </strong>
                </div>
                
                <div class="card-body card-body-custom">
                    {{-- Display session messages --}}
                    @if(session()->has('success'))
                        <div class="alert alert-success text-center">
                            {{ session()->get('success') }}
                        </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger text-center">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('dashboard.pages.Blog.form')
                                   
                        <div class="d-flex flex-column flex-md-row justify-content-between">
                            <button type="submit" class="btn btn-custom mb-2 mb-md-0">
                                <i class="fas fa-save"></i> Submit
                            </button>
                            <button type="reset" class="btn btn-custom-reset">
                                <i class="fas fa-undo"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

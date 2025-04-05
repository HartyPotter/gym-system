@extends('dashboard.layouts.master')
@section('title', 'Edit Blog Data')

@section('main-content')

<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card card-custom mb-4">
                <div class="card-header">
                    <strong class="card-title fs-2">
                        @if(auth()->user()->id !== ($blog->create_user->id ?? null))
                            {{ $blog->title }}
                        @else
                            Edit your blog
                        @endif
                    </strong>
                </div>
                <div class="card-body card-body-custom">
                    <form action="{{ route('blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        {{-- Include the form --}}
                        @include('dashboard.pages.blog.form')

                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-lg btn-custom2">
                                    Update Blog
                            </button>
                            <div>
                                <a href="{{ route('blogs.index') }}" class="btn btn-lg btn-custom2-reset">
                                    Return to Blogs
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

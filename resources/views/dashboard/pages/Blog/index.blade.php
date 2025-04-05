@extends('dashboard.layouts.master')
@section('title','Blog Index Page')
@section('main-content')

<div class="row">
    <div class="col-12 grid-margin">
        <div class="d-flex justify-content-end flex-wrap">
            <div class="d-flex justify-content-between align-items-end flex-wrap">
                <a href="{{ route('blogs.create') }}" class="btn btn-custom1 my-3 text-light font-weight-bold">
                    <span>Add Blog</span>
                </a>
            </div>
        </div>
    </div>
</div>

@include('dashboard.pages.User.indexmessages.messages')

<!-- Table with stripped rows -->
<table class="table table-striped-custom w-100 mx-auto">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Image</th>
        <th scope="col">Publish Date</th>
        <th scope="col">Category</th>
        <th scope="col">Status</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    
    <tbody>
        @forelse ($blogs as $blog)
        <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $blog->title }}</td>
            <td>{{ $blog->description }}</td>
            <td>
                @if ($blog->image)
                    <img src="{{ asset('storage/profiles/'.$blog->image) }}" alt="Blog Image" class="img-thumbnail" width="100">
                @else
                    No image
                @endif
            </td>            
            <td>{{ $blog->publish_date ? \Carbon\Carbon::parse($blog->publish_date)->format('Y-m-d') : 'N/A' }}</td>
            <td>{{ $blog->category }}</td>
            <td>{{ ucfirst($blog->status) }}</td>
            <td>{{ $blog->created_at->format('Y-m-d H:i') }}</td>
            <td>
                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-flex justify-content-between align-items-center">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-warning btn-sm font-weight-bold fs-6 custom-btn-space">Show</a>
                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-success btn-sm font-weight-bold fs-6 custom-btn-space">Edit</a>
                    <button type="submit" class="btn btn-danger btn-sm font-weight-bold fs-6 custom-btn-space">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" class="text-center">
                <div class="alert alert-danger-custom my-5 w-50 mx-auto">
                    <span>There are no blogs yet! <a href="{{ route('blogs.create') }}" class="fw-bold text-danger">Add Blog From Here</a></span>
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination -->
<div class="my-4 pagination-custom d-flex justify-content-center">
    {{ $blogs->links() }}
</div>

@endsection

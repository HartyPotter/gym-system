@extends('dashboard.layouts.master')

@section('title','Deleted Blog')

@section('main-content')

@include('dashboard.pages.User.indexmessages.messages')

<!-- Table with stripped rows -->
<div class="table-responsive">
    <table class="table table-striped w-100 m-auto">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col" style="white-space: nowrap;">Publish Date</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
                <th scope="col" style="white-space: nowrap;">Created At</th>
                <th scope="col" style="white-space: nowrap;">Updated At</th>
                <th scope="col" style="white-space: nowrap;">Deleted At</th>

                @if(auth()->user()->user_type == "admin")
                <th scope="col">Action</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @forelse ($blogs as $blog)
            <tr>
                <td class="font-weight-bold">{{ $loop->iteration }}</td>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->description }}</td>
                <td>
                    @if($blog->image)
                        <img src="{{ asset('storage/images/' . $blog->image) }}" alt="Blog Image" style="width: 100px; height: auto;">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $blog->publish_date ? \Carbon\Carbon::parse($blog->publish_date)->format('Y-m-d') : 'N/A' }}</td>
                <td>{{ $blog->category }}</td>
                <td>{{ $blog->status }}</td>
                <td>{{ $blog->created_at->format('Y-m-d H:i') }}</td>
                <td>{{ $blog->updated_at ? $blog->updated_at->format('Y-m-d H:i') : 'N/A' }}</td>
                <td>{{ $blog->deleted_at ? $blog->deleted_at->format('Y-m-d H:i') : 'N/A' }}</td>

                @if(auth()->user()->user_type == "admin")
                <td class="text-center">
                    <div class="d-flex justify-content-between">
                        <!-- Restore Blog Form -->
                        <form action="{{ route('blogs.restore', $blog->id) }}" method="GET">
                            <button type="submit" class="btn btn-sm btn-success font-weight-bold fs-6 mx-1">Restore</button>
                        </form>

                        <!-- Force Delete Blog Form -->
                        <form action="{{ route('blogs.forceDelete', $blog->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger font-weight-bold fs-6 mx-1">Delete</button>
                        </form>
                    </div>
                </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="{{ auth()->user()->user_type == 'admin' ? 11 : 10 }}" class="text-center">
                    <div class="alert alert-danger my-5 w-50 mx-auto">
                        <span>There are no deleted blogs yet!</span>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center my-4">
    <div class="me-6">
        {{ $blogs->links() }}
    </div>
</div>

<!-- End Table with stripped rows -->
@endsection

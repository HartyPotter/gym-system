@extends('dashboard.layouts.master')

@section('title', 'Edit Profile Admin')

@section('main-content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success text-center">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.profile.update', $user->username) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="fullname">Full Name:</label>
                            <input type="text" name="fullname" class="form-control" value="{{ $user->fullname }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="username">Username:</label>
                            <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Phone:</label>
                            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">E-mail:</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="gender">Gender:</label>
                            <select name="gender" class="form-control">
                                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Image:</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sync-alt"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

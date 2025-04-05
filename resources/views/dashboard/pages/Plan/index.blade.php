@extends('dashboard.layouts.master')
@section('title','Index Page')
@section('main-content')

<div class="row">
    <div class="col-12 grid-margin">
        <div class="d-flex justify-content-end flex-wrap">
            <div class="d-flex justify-content-between align-items-end flex-wrap">
                <a href="{{ route('plans.create') }}" class="btn btn-custom1 my-3 text-light font-weight-bold">
                    <span>Add Plan</span>
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
        <th scope="col">Membership</th>
        <th scope="col">Plan</th>
        <th scope="col">Price</th>
        <th scope="col">Duration</th> <!-- Added Membership column -->
        <th scope="col">Features</th>
        <th scope="col">Created At</th>
        <th scope="col">Updated At</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    
    <tbody>
        @forelse ($plans as $plan)
        <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $plan->plan }}</td>
            <td>{{ $plan->price }}</td>
            <td>{{ $plan->duration }}</td>
            <td>{{ $plan->membership }}</td> <!-- Displaying Membership value -->
            <td>{{ $plan->features }}</td> <!-- Displaying Features as string -->
            <td>{{ $plan->created_at->format('Y-m-d H:i') }}</td>
            <td>{{ $plan->updated_at ? $plan->updated_at->format('Y-m-d H:i') : 'N/A' }}</td>
            <td>
                <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" class="d-flex justify-content-between align-items-center">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('plans.show', $plan->id) }}" class="btn btn-warning btn-sm font-weight-bold fs-6 custom-btn-space">Show</a>
                    <a href="{{ route('plans.edit', $plan->id) }}" class="btn btn-success btn-sm font-weight-bold fs-6 custom-btn-space">Edit</a>
                    <button type="submit" class="btn btn-danger btn-sm font-weight-bold fs-6 custom-btn-space">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">
                <div class="alert alert-danger-custom my-5 w-50 mx-auto">
                    <span>There are no plans yet! <a href="{{ route('plans.create') }}" class="fw-bold text-danger">Add Plans From Here</a></span>
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- End Table with stripped rows -->

<!-- Pagination -->
<div class="my-4 pagination-custom d-flex justify-content-center">
    {{ $plans->links() }}
</div>

@endsection

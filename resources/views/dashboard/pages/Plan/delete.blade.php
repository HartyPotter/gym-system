@extends('dashboard.layouts.master') 
@section('title', 'Deleted plan')
@section('main-content')

@include('dashboard.pages.User.indexmessages.messages') 

<!-- Table with stripped rows -->
<div class="table-responsive">
    <table class="table table-striped w-100 m-auto">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Membership</th>
                <th scope="col">Plan</th>
                <th scope="col">Price</th>
                <th scope="col" style="white-space: nowrap;">Duration</th>
                <th scope="col" style="white-space: nowrap;">Features</th>
                <th scope="col" style="white-space: nowrap;">Created At</th>
                <th scope="col" style="white-space: nowrap;">Updated At</th>
                <th scope="col" style="white-space: nowrap;">Deleted At</th>
                
                @if(auth()->user()->user_type == "admin")
                <th scope="col">Action</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @forelse ($Plans as $Plan)
            <tr>
                <td class="font-weight-bold">{{ $loop->iteration }}</td>
                <td>{{ $plan->membership }}</td>
                <td>{{ $Plan->plan }}</td>
                <td>{{ $Plan->price }}</td>
                <td>{{ $Plan->duration }}</td>
                <td>{{ $plan->features }}</td>
                <td>{{ $Plan->created_at->format('Y-m-d H:i') }}</td> 
                <td>{{ $Plan->updated_at ? $Plan->updated_at->format('Y-m-d H:i') : 'N/A' }}</td>
                <td>{{ $Plan->deleted_at ? $Plan->deleted_at->format('Y-m-d H:i') : 'N/A' }}</td>
                @if(auth()->user()->user_type == "admin")
                <td class="text-center">
                    <div class="d-flex justify-content-between">
                        <form action="{{ route('plans.restore', $Plan->id) }}" method="GET">
                            <button type="submit" class="btn btn-sm btn-success font-weight-bold fs-6 mx-1">Restore</button>
                        </form>

                        <form action="{{ route('plans.forceDelete', $Plan->id) }}" method="POST">
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
                <td colspan="{{ auth()->user()->user_type == 'admin' ? 9 : 8 }}" class="text-center">
                    <div class="alert alert-danger my-5 w-50 mx-auto">
                        <span>There are no plans yet!</span>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center my-4">
    <div class="me-6">
        {{ $Plans->links() }}
    </div>
</div>

<!-- End Table with stripped rows -->
@endsection

@extends('dashboard.layouts.master') 
@section('title' ,__('index-dash.Deleted user'))
@section('main-content')

@include('dashboard.pages.User.indexmessages.messages') 

<!-- Table with stripped rows -->
<div class="table-responsive">
    <table class="table table-striped w-100 m-auto">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">fullname</th>
                <th scope="col">username</th>
                <th scope="col" style="white-space: nowrap;">email</th>
                <th scope="col" style="white-space: nowrap;">user_type</th>
                <th scope="col" style="white-space: nowrap;">phone</th>
                <th scope="col" style="white-space: nowrap;">create_at</th>
                <th scope="col" style="white-space: nowrap;">update_at</th>
                
                @if(auth()->user()->user_type == "admin")
                <th scope="col">Action</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @forelse ($Users as $User)
            <tr>
                <td class="font-weight-bold">{{ $loop->iteration }}</td>
                <td>{{ $User->fullname }}</td>
                <td>{{ $User->username }}</td>
                <td>{{ $User->email }}</td>
                <td>{{ $User->user_type }}</td>
                <td>{{ $User->phone ?? 'N/A' }}</td>
                <td>{{ $User->created_at->format('Y-m-d H:i') }}</td> 
                <td>{{ $User->updated_at ? $User->updated_at->format('Y-m-d H:i') : 'N/A' }}</td>
                <td>{{ $User->deleted_at ? $User->deleted_at->format('Y-m-d H:i') : 'N/A' }}</td>
                @if(auth()->user()->user_type == "admin")
                <td class="text-center">
                    <div class="d-flex justify-content-between">
                        <form action="{{ route('categories.restore', $user->id) }}" method="GET">
                            <button type="submit" class="btn btn-sm btn-success font-weight-bold fs-6 mx-1">Restore</button>
                        </form>

                        <form action="{{ route('categories.forceDelete', $user->id) }}" method="POST">
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
                        <span>There are no categories yet!</span>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center my-4">
    <div class="me-6">
        {{ $Users->links() }}
    </div>
</div>

<!-- End Table with stripped rows -->
@endsection

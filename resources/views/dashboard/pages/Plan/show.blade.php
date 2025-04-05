@extends('dashboard.layouts.master')

@section('title','show')

@section('main-content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card card-custom border-light shadow-lg" style="min-height: 600px;"> <!-- زيادة الطول -->
                <div class="card-header text-center">
                    <h2 class="mb-0 display-4">{{ $plan->plan ?? 'No Plan Name' }}</h2>
                </div>
                <div class="card-body py-5"> <!-- زيادة padding عمودي -->
                    <div class="text-center">
                    <table class="table table-borderless" style="height: 400px;"> 

                            <tbody>
                                <tr>
                                    <td class="text-dark fw-bold"><b>Membership:</b></td>
                                    <td class="fs-5">{{ $plan->membership ?? 'No Plan Membership' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-dark fw-bold"><b>Plan Name:</b></td>
                                    <td class="fs-5">{{ $plan->plan ?? 'No Plan Name' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-dark fw-bold"><b>Price:</b></td>
                                    <td class="fs-5">{{ $plan->price ?? 'No Price' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-dark fw-bold"><b>Duration:</b></td>
                                    <td class="fs-5">{{ $plan->duration ?? 'No Duration' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-dark fw-bold"><b>Features:</b></td>
                                    <td class="fs-5">{{ $plan->features ?? 'No Features' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-dark fw-bold"><b>Created By:</b></td>
                                    <td class="fs-5">{{ $plan->create_user->name ?? 'No User' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-dark fw-bold"><b>Updated By:</b></td>
                                    <td class="fs-5">{{ $plan->update_user->name ?? 'No User' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <a class="btn btn-md px-4 font-weight-bold fs-5 btn-custom2" href="{{ route('plans.edit', $plan->id) }}">
                            <i class="fa-solid fa-edit"></i> Edit
                        </a>

                        <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-custom3" type="submit">
                                <i class="fa-solid fa-trash-alt"></i> Delete
                            </button>
                        </form>

                        <a class="btn btn-primary btn-custom3" href="{{ route('plans.index') }}">
                            <i class="fa-solid fa-arrow-left"></i> Return to Plans 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

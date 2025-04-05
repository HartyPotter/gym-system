@extends('dashboard.layouts.master')

@section('title', 'Show Blog')

@section('main-content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card card-custom border-light shadow-lg" style="min-height: 600px;">
                <div class="card-header text-center">
                    <h2 class="mb-0 display-4">{{ $blog->title ?? 'No Blog Title' }}</h2>
                </div>
                <div class="card-body py-5">
                    <div class="text-center">
                        <table class="table table-borderless" style="height: 400px;">
                            <tbody>
                                <tr>
                                    <td class="text-dark fw-bold"><b>Title:</b></td>
                                    <td class="fs-5">{{ $blog->title ?? 'No Title' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-dark fw-bold"><b>Description:</b></td>
                                    <td class="fs-5">{{ $blog->description ?? 'No Description' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-dark fw-bold"><b>Image:</b></td>
                                    <td class="fs-5">
                                        @if($blog->image)
                                            {{-- عرض الصورة إذا كانت موجودة --}}
                                            <img src="{{ asset('storage/profiles/' . $blog->image) }}" alt="Blog Image" style="width: 200px; height: auto;">
                                        @else
                                            {{-- نص بديل إذا لم تكن الصورة موجودة --}}
                                            No Image Available
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-dark fw-bold"><b>Publish Date:</b></td>
                                    <td class="fs-5">{{ $blog->publish_date ?? 'No Publish Date' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-dark fw-bold"><b>Category:</b></td>
                                    <td class="fs-5">{{ $blog->category ?? 'No Category' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-dark fw-bold"><b>Status:</b></td>
                                    <td class="fs-5">{{ ucfirst($blog->status) ?? 'No Status' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        {{-- زر التعديل --}}
                        <a class="btn btn-md px-4 font-weight-bold fs-5 btn-custom2" href="{{ route('blogs.edit', $blog->id) }}">
                            <i class="fa-solid fa-edit"></i> Edit
                        </a>

                        {{-- فورم الحذف --}}
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-custom3" type="submit">
                                <i class="fa-solid fa-trash-alt"></i> Delete
                            </button>
                        </form>

                       
                        <a class="btn btn-primary btn-custom3" href="{{ route('blogs.index') }}">
                            <i class="fa-solid fa-arrow-left"></i> Return to Blogs 
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

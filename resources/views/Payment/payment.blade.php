@extends('website.layouts.master')

@section('title', 'PayMENT')

@section('main-content')

<iframe
    width="100%"
    height="800"
    src="https://accept.paymob.com/api/acceptance/iframes/893463?payment_token={{ $token }}">
</iframe>
@endsection
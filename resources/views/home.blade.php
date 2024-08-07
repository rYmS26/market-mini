@extends('master')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between jumbotron" style="min-height: 400px;">
        <div class="left-content">
            <h1>Welcome to My Website</h1>
            <p>This is the landing page of the website. Explore and enjoy our services.</p>
            @if(Auth::check())
                <p>You are logged in as <b>{{ Auth::user()->name }}</b> with the role of <b>{{ Auth::user()->role }}</b>.</p>
            @else
                <p><a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Login</a></p>
            @endif
        </div>
        <div class="right-content">
            <img src="https://via.placeholder.com/400" alt="Placeholder Image" class="img-fluid">
        </div>
    </div>

    <!-- Section for Product, Features, and Pricing -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 50vh; padding-top: 20px; padding-bottom: 20px;">
    <div class="text-center">
        <h3>Lorem Ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lacinia odio vitae vestibulum.</p>
    </div>
</div>

    <!-- Section to include the product cards -->
    @include('card')

</div>
@endsection

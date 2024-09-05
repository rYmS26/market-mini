@extends('master')

@section('title', 'Home')

@section('content')

<header>
<div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-caption">
                    @if(Auth::check())
                    <h1 class="page-title" style="color: #F7F7F8;">Welcome, {{ Auth::user()->name }}</h1>
                    <div style="text-align: center;">
                    <button class="styled-button">
                        <a href="{{ route('products.index') }}" class="button-link">Buy Now</a>
                        </button>
                    </div>
                    @else
                    <div style="text-align: center;">
                    <button class="styled-button">
                        <a href="{{ route('login') }}" class="button-link">Login</a>
                        </button>
                    </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.page-header-->
    <!-- news -->
    <div class="card-section">
        <div class="container">
        <div class="card-block transparent-bg mb30">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <!-- section-title -->
            <div class="section-title mb-0">
                <h2>All about Hike. We share our knowledge on blog</h2>
                <p>Our approach is very simple: we define your problem and give the best solution. </p>
            </div>
            <!-- /.section-title -->
        </div>
    </div>
    
            </div>
            </div>
    <!-- Section for Product, Features, and Pricing -->
    <section class="about-section">
    <div class="container">
        <div class="row align-items-center">
            <!-- Text Section -->
            <div class="col-lg-6 col-md-12">
    <div class="image-container">
        <img src="{{ asset('storage/photos/men-shopping.png') }}" alt="Background Image" class="bg-image img-fluid rounded no-shadow" style="width: 325px;">
        <img src="{{ asset('storage/photos/men-shopping.png') }}" alt="Main Image" class="main-image img-fluid rounded no-shadow">
    </div>
</div>
            <!-- Image Section -->
           <div class="col-lg-6 col-md-12 mb-4">
                <h2 style="color: #179BAE;">What is Market Mini?</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit deleniti, placeat eum nostrum a quibusdam harum quod nesciunt magni explicabo culpa ipsa earum quas quae, reprehenderit, in est repudiandae consequuntur.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem blanditiis fuga quo ullam sint dolore rem natus animi beatae deserunt. Repudiandae iusto accusamus quo blanditiis magni vitae quae ipsam officia!</p>
            </div>
        </div>
    </div>
</section>
    <!-- Section to include the top 6 product cards -->
    <div class="container">
    <div class="row">
    <div class="col-md-12">
            <h2 class="top-seller-title">Top Seller</h2> <!-- Added title here -->
        </div>
        <div class="col-md-2">
            <h2 style="font-size: 36px; font-weight: bold; margin-top: 20px; color: #179BAE;">TOP</h2>
            <p style="font-size: 24px; font-weight: bold; color: black;">PRODUCT</p>
        </div>
        <div class="col-md-10">
    <div class="scrollable-card-section">
        <div class="row">
            @foreach($topProducts->take(6) as $product)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ $product->photo_url }}" class="card-img-top product-img" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text"><strong>${{ $product->price }}</strong></p>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
    
    <!-- Center the "tes" button -->
    <div class="d-flex justify-content-center">
    <button class="btn mb-4" style="background-color: #179BAE;">
        <a href="{{ route('products.index') }}" style="color: white; text-decoration: none; margin-bottom: 20px;">View More</a>
    </button>
    </div>
    <section class="home-testimonial">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center testimonial-pos">
            <div class="col-md-12 pt-4 d-flex justify-content-center">
                <h3 style="color: #179BAE;">Testimonials Customer</h3>
            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <h2>Explore the Customer experience</h2>
            </div>
        </div>
        <section class="home-testimonial-bottom">
            <div class="container testimonial-inner">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4 style-3">
                        <div class="tour-item ">
                            <div class="tour-desc bg-white">
                                <div class="tour-text color-grey-3 text-center">&ldquo;Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tenetur facere non rem nihil at quam deserunt neque sunt eveniet quaerat soluta placeat dolorem amet obcaecati, ipsum debitis ipsa excepturi? Nostrum..&rdquo;</div>
                                <div class="d-flex justify-content-center pt-2 pb-2"><img class="tm-people" src="{{asset('storage/photos/man-shopping.png')}}" alt=""></div>
                                <div class="link-name d-flex justify-content-center">Ryan Brooklin</div>
                                <div class="link-position d-flex justify-content-center">Customer</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 style-3">
                        <div class="tour-item ">
                            <div class="tour-desc bg-white">
                                <div class="tour-text color-grey-3 text-center">&ldquo;Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium corporis facere esse atque, harum dolor maiores illum ipsam? Veniam quas sapiente possimus labore velit iste ipsum optio voluptates non fuga?.&rdquo;</div>
                                <div class="d-flex justify-content-center pt-2 pb-2"><img class="tm-people" src="{{asset('storage/photos/women-shopping.png')}}" alt=""></div>
                                <div class="link-name d-flex justify-content-center">Jenny Blackpink</div>
                                <div class="link-position d-flex justify-content-center">Customer</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 style-3">
                        <div class="tour-item ">
                            <div class="tour-desc bg-white">
                                <div class="tour-text color-grey-3 text-center">&ldquo;Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem quas ipsam omnis asperiores error voluptatum veritatis nam odit eveniet sapiente dolor debitis quam reprehenderit quos sed, assumenda eius nemo ratione..&rdquo;</div>
                                <div class="d-flex justify-content-center pt-2 pb-2"><img class="tm-people" src="{{asset('storage/photos/men-shopping.png')}}" alt=""></div>
                                <div class="link-name d-flex justify-content-center">John Terry</div>
                                <div class="link-position d-flex justify-content-center">Customer</div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
</section>
   
</div>
<style>
    body { -webkit-font-smoothing: antialiased; text-rendering: optimizeLegibility; font-family: 'Overpass', sans-serif; letter-spacing: 0px; font-size: 17px; color: #8d8f90; font-weight: 400; line-height: 32px; background-color: #edefef; }
h1, h2, h3, h4, h5, h6 { color: #25292a; margin: 0px 0px 10px 0px; font-family: 'Overpass', sans-serif; font-weight: 700; letter-spacing: -1px; line-height: 1; }
h1 { font-size: 34px; }
h2 { font-size: 28px; line-height: 38px; }
h3 { font-size: 22px; line-height: 32px; }
h4 { font-size: 20px; }
h5 { font-size: 17px; }
h6 { font-size: 12px; }
p { margin: 0 0 20px; line-height: 1.7; }
p:last-child { margin: 0px; }
ul, ol { }
a { text-decoration: none; color: #8d8f90; -webkit-transition: all 0.3s; -moz-transition: all 0.3s; transition: all 0.3s; }
a:focus, a:hover { text-decoration: none; color: #f85759; }
.page-header { 
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{asset('storage/photos/mart-japan.png')}}) no-repeat; 
    position: relative; 
    background-size: cover; 
}
.page-caption { padding-top: 170px; padding-bottom: 174px; }
.page-title { font-size: 46px; line-height: 1; color: #fff; font-weight: 600; text-align: center; }

.card-section { position: relative; bottom: 60px; }
.card-block { padding: 80px; }
.section-title { margin-bottom: 60px; }

.top-seller-title {
    font-size: 28px; /* Match this with your h2 styling */
    font-weight: bold;
    color: #179BAE;
    margin-bottom: 20px;
    text-align: center; /* Center the text */
    width: 100%; /* Ensure it takes full width */
    margin-top: 20px;
}

.scrollable-card-section {
    overflow-x: auto;
    white-space: nowrap;
    padding: 20px 0;
    scrollbar-width: none;
}

.scrollable-card-section .card {
    display: inline-block;
    vertical-align: top;
    margin-right: 20px; /* Adjust spacing between cards */
}
.top-seller-title {
    font-size: 28px; /* Match this with your h2 styling */
    font-weight: bold;
    color: #179BAE;
    margin-bottom: 20px;
    text-align: center; /* Center the text */
    width: 100%; /* Ensure it takes full width */
    margin-top: 20px;
}

.scrollable-card-section {
    overflow-x: auto;
    white-space: nowrap;
    padding: 20px 0;
    scrollbar-width: none;
}

.scrollable-card-section .card {
    display: inline-block;
    vertical-align: top;
    margin-right: 20px; /* Adjust spacing between cards */
}
.home-testimonial {
    padding: 50px 0;
    background-color: #f9f9f9;
}

.home-testimonial h3 {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
}

.home-testimonial h2 {
    font-size: 24px;
    font-weight: 300;
    margin-bottom: 40px;
    color: #555;
}

.home-testimonial-bottom {
    padding: 30px 0;
}

.testimonial-inner {
    max-width: 1200px;
    margin: 0 auto;
}

.tour-item {
    margin-bottom: 30px;
    transition: transform 0.3s ease;
}

.tour-item:hover {
    transform: translateY(-10px);
}

.tour-desc {
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

.tour-text {
    font-size: 16px;
    line-height: 1.6;
    color: #777;
    margin-bottom: 15px;
}

.tm-people {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
}

.link-name {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

.link-position {
    font-size: 14px;
    color: #999;
}

@media (max-width: 768px) {
    .home-testimonial h3 {
        font-size: 24px;
    }

    .home-testimonial h2 {
        font-size: 20px;
    }

    .tour-item {
        margin-bottom: 20px;
    }

    .tour-text {
        font-size: 14px;
    }
}

.about-section {
    padding: 50px 0;
    background-color: #f5f5f5;
}

.about-section h2 {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
}

.about-section p {
    font-size: 17px;
    line-height: 1.7;
    color: #666;
}

.about-section img {
    width: 100%;
    height: auto;
    object-fit: cover;
}

@media (max-width: 768px) {
    .about-section h2 {
        font-size: 26px;
    }

    .about-section p {
        font-size: 15px;
    }
}

    .card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
        transform: scale(0.95); /* Shrink the card slightly on hover */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Enhance shadow on hover */
    }

    .product-img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .card-block.transparent-bg {
    background-color: rgba(255, 255, 255, 0.5%); /* Makes the background transparent */
    backdrop-filter: blur(10px);
    border-radius: 10px;
}

.card-block.transparent-bg .section-title h2,
.card-block.transparent-bg .section-title p {
    color: black; /* Sets the text color to black */
}

.styled-button {
    --c: #179BAE; /* Button color */
    box-shadow: 0 0 0 .1em inset var(--c);
    --_g: linear-gradient(var(--c) 0 0) no-repeat;
    background: 
        var(--_g) calc(var(--_p,0%) - 100%) 0%,
        var(--_g) calc(200% - var(--_p,0%)) 0%,
        var(--_g) calc(var(--_p,0%) - 100%) 100%,
        var(--_g) calc(200% - var(--_p,0%)) 100%;
    background-size: 50.5% calc(var(--_p,0%)/2 + .5%);
    outline-offset: .1em;
    transition: background-size .4s, background-position 0s .4s;
    font-family: system-ui, sans-serif;
    font-size: 1.4rem; /* Smaller font size */
    cursor: pointer;
    padding: .3em .8em; /* Further reduced padding */
    font-weight: bold;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center; /* Centers text horizontally */
    text-align: center; /* Centers text horizontally */
    margin: 0 auto; /* Centers the button within its container */
    border-radius: 12px; /* Slightly reduced border-radius for a more compact look */
}

.styled-button:hover {
    --_p: 100%;
    transition: background-position .4s, background-size 0s;
}

.styled-button:active {
    box-shadow: 0 0 9e9q inset #0009;
    background-color: var(--c);
    color: #fff; /* Change text color to white when active */
}

.button-link {
    color: black; /* Text color */
    text-decoration: none; /* Removes underline from the link */
    display: block;
    width: 100%; /* Ensures link covers button */
    height: 100%; /* Ensures link covers button */
    line-height: 1.2; /* Adjust line-height to vertically center text */
    font-size: 1rem; /* Adjust font size to fit the button */
    transition: color 0.3s; /* Smooth transition for text color */
}

.styled-button:hover .button-link {
    color: #fff; /* Change text color to white on hover */
}

.styled-button:active .button-link {
    color: #fff; /* Ensure text color is white when active */
}

.btn {
    border-radius: 10px;
}

.image-container {
        position: relative;
    }
    .bg-image {
        position: absolute;
        top: 30px;
        left: 176px;
        z-index: 1;
        width: 100%;
        height: auto; /* Atur ini sesuai kebutuhan */
        filter: grayscale(100%) brightness(0%) contrast(25%);
    }
    .main-image {
        position: relative;
        z-index: 2;
        width: 100%;
        height: auto; /* Atur ini sesuai kebutuhan */
    }

    .card-block.transparent-bg {
    background-color: rgba(255, 255, 255, 0.5%); /* Makes the background transparent */
    backdrop-filter: blur(10px);
    border-radius: 10px;
}

.card-block.transparent-bg .section-title h2,
.card-block.transparent-bg .section-title p {
    color: black; /* Sets the text color to black */
}

.styled-button {
    --c: #179BAE; /* Button color */
    box-shadow: 0 0 0 .1em inset var(--c);
    --_g: linear-gradient(var(--c) 0 0) no-repeat;
    background: 
        var(--_g) calc(var(--_p,0%) - 100%) 0%,
        var(--_g) calc(200% - var(--_p,0%)) 0%,
        var(--_g) calc(var(--_p,0%) - 100%) 100%,
        var(--_g) calc(200% - var(--_p,0%)) 100%;
    background-size: 50.5% calc(var(--_p,0%)/2 + .5%);
    outline-offset: .1em;
    transition: background-size .4s, background-position 0s .4s;
    font-family: system-ui, sans-serif;
    font-size: 1.4rem; /* Smaller font size */
    cursor: pointer;
    padding: .3em .8em; /* Further reduced padding */
    font-weight: bold;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center; /* Centers text horizontally */
    text-align: center; /* Centers text horizontally */
    margin: 0 auto; /* Centers the button within its container */
    border-radius: 12px; /* Slightly reduced border-radius for a more compact look */
}

.styled-button:hover {
    --_p: 100%;
    transition: background-position .4s, background-size 0s;
}

.styled-button:active {
    box-shadow: 0 0 9e9q inset #0009;
    background-color: var(--c);
    color: #fff; /* Change text color to white when active */
}

.button-link {
    color: black; /* Text color */
    text-decoration: none; /* Removes underline from the link */
    display: block;
    width: 100%; /* Ensures link covers button */
    height: 100%; /* Ensures link covers button */
    line-height: 1.2; /* Adjust line-height to vertically center text */
    font-size: 1rem; /* Adjust font size to fit the button */
    transition: color 0.3s; /* Smooth transition for text color */
}

.styled-button:hover .button-link {
    color: #fff; /* Change text color to white on hover */
}

.styled-button:active .button-link {
    color: #fff; /* Ensure text color is white when active */
}

.btn {
    border-radius: 10px;
}

.image-container {
        position: relative;
    }
    .bg-image {
        position: absolute;
        top: 30px;
        left: 176px;
        z-index: 1;
        width: 100%;
        height: auto; /* Atur ini sesuai kebutuhan */
        filter: grayscale(100%) brightness(0%) contrast(25%);
    }
    .main-image {
        position: relative;
        z-index: 2;
        width: 100%;
        height: auto; /* Atur ini sesuai kebutuhan */
    }
</style>
@endsection
@extends('layouts.master')
@section('content')

<!-- Header -->
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      {{ config('app.name', 'EduAT') }}
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="#about">{{ __('About Us') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#contact_us">{{ __('Contact Us') }}</a>
        </li>
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ms-auto">
        <!-- Authentication Links -->
        @guest
        @if (Route::has('login'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
          </a>

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<div class="hero-header py-5">
  <div class="container">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-md-6">
        <h1>
          Secured Quality Education for your Ward!
        </h1>
        <p class="py-3">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iure,
          eveniet accusamus. Voluptatibus asperiores ut molestiae! Hic esse
          nulla excepturi accusantium autem impedit eveniet magni aut!
        </p>
        <button type="button" class="hero-button">Contact Us</button>
      </div>
      <div class="col-6 hero-image d-flex align-items-center">
        <img src="image" class="image" alt="" />
      </div>
    </div>
  </div>
</div>

<!-- Features -->

<!-- Testimonial -->
<div class="bg-light p-3">
  <div class="text-center pt-3">
    <h3>What People Say</h3>
  </div>
<div id="testimonial" class="carousel slide bg-blend" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#testimonial" data-bs-slide-to="0" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#testimonial" data-bs-slide-to="1" class="active" aria-current="true" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#testimonial" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    @forelse ([
    [
    'name' => 'Carl Emmy',
    'testimonial' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam non voluptatum sequi doloribus, fugiat minus ab aut veniam iste debitis, mollitia nostrum optio ipsa praesentium repellat deserunt corrupti atque molestiae.',
    'img' => 'blog_sets/team.jpg'
    ],
    [
    'name' => 'Emmanuel Adesina',
    'testimonial' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam non voluptatum sequi doloribus, fugiat minus ab aut veniam iste debitis, mollitia nostrum optio ipsa praesentium repellat deserunt corrupti atque molestiae.',
    'img' => 'blog_sets/team.jpg'
    ],
    [
    'name' => 'Carl Emmy',
    'testimonial' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam non voluptatum sequi doloribus, fugiat minus ab aut veniam iste debitis, mollitia nostrum optio ipsa praesentium repellat deserunt corrupti atque molestiae.',
    'img' => 'blog_sets/team.jpg'
    ]
    ] as $testimonial)
    <div class="carousel-item @if($loop->index == 0) active @endif" data-bs-interval="10000">
      <div class="d-flex justify-content-center p-5">
        <div class="slider">
          <p class="txt">{{$testimonial['testimonial']}}</p>
          <h4 class="name">{{$testimonial['name']}}</h4>
        </div>
      </div>
    </div>
    @empty
    <div class="text-center-p-5">No Testimonials</div>
    @endforelse
  </div>
</div>
</div>

<!-- Contact Us -->

<!-- Footer -->
<footer class="text-start md-text-center text-white p-3 p-md-5">
  <div class="row">
    <div class="col-md-6 mx-auto mt-3">
      <h6 class="mb-4 font-weight-bold">Name of the School</h6>
      <p>
        Working to bring together significamnt changes in outline-based learning doing intensive research for course
        curriculum preparation,students engagements, and looking foward to flexible education Working to bring together significamnt changes in outline-based learning doing intensive research for course
        curriculum preparation,students engagements, and looking foward to flexible education Working to bring together significamnt changes in outline-based learning doing intensive research for course
        curriculum preparation,students engagements, and looking foward to flexible education
      </p>
    </div>

    <div class="col-6 col-md-3 mx-auto mt-3 listed">
      <h6 class="mb-4 font-weight-bold res">Resources</h6>
      <ul>
        <li class="contact">
          <p><a>Instructor Registration</a></p>
        </li>
        <li class="contact">
          <p> <a>Student Registration</a> </p>
        </li>
        <li class="contact">
          <p> <a>Course</a> </p>
        </li>
        <li class="contact">
          <p> <a>Terms & Condition</a> </p>
        </li>
      </ul>
    </div>
    ​
    <div class="col-6 col-md-3 mx-auto mt-3">
      <h6 class="mb-4 font-weight-bold">Address</h6>
      <div class="address">
        <i class="fa fa-map-marker"></i>
        <p class="contact">
          2750 Quadra Street Victoria Road,New York,Canada
        </p>
      </div>
      <div class="address">
        <i class="fa fa-phone mr-3"></i>
        <p class="contact">+ 01 234 567 88</p>
      </div>
      <div class="address">
        <i class="fa fa-envelope mr-3"></i>
        <p class="contact">hello@eacademy.com</p>
      </div>
      <div class="d-flex gap-3 pt-2">
        <a><i class="fab fa-facebook-f"></i></a>
        <a><i class="fab fa-twitter"></i></a>
        <a><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </div>
</footer>
<!-- Footer -->

<style>
  /* footer */
  .text-white .fab {
    color: white;
    background: #b57fb86c;
    border-radius: 5px;
    padding: 10px !important;
  }

  .text-white .fab:hover {
    background-color: rgba(255, 0, 0, 0.856) !important;
  }

  .btn:hover {
    border: none !important;
    outline: none !important;
  }

  .listed ul {
    padding-left: 0.75rem;
  }

  .listed ul li {
    list-style-type: square;
    color: rgb(255, 38, 0);
  }

  .listed ul li p a {
    text-decoration: none;
    color: white;
  }

  .listed ul li p {
    color: white;
  }

  .listed ul li p:hover {
    color: red;
  }

  .contact:hover {
    position: relative;
    animation: mymove 4s ease !important;
    animation-direction: alternate;
    cursor: pointer;
    color: red;
  }

  @keyframes mymove {
    0% {
      left: 5px;
    }

    100% {
      left: 0px;
    }
  }

  .address {
    display: flex;
  }

  .contact {
    margin-left: 10px;
  }

  /* Hero */
  .hero-header {
    background: rgb(244, 219, 170);
    background: linear-gradient(175deg, white 60.5%, #131827 39.5%);
  }

  .hero-button {
    padding: 10px 25px !important;
    border: none;
    color: white;
    background: red;
    text-align: center;
    font-weight: 600;
  }

  /* Testimonials */

.slider {
  background-color: whitesmoke;
  border: 5px solid white;
  border-radius: 15px;
  padding: 20px;
  margin-bottom: 50px;
  width: 90vw;
}

.slider .name {
  width: max-content;
  background-color: #3190E7;
  margin-bottom: -50px;
  border-radius: 50px;
  padding: 10px 10%;
}

#testimonial .carousel-indicators [data-bs-target] {
  height: 20px !important;
  width: 40px !important;
  background-color: #13182740;
}

@media (min-width: 870px) {
  #hero_carousel.carousel .carousel-item {
    height: 80vh;
  }

  #hero_carousel .carousel-item img {
    min-height: 80vh;
  }

  .slider {
    width: 30vw !important;
  }
}

</style>
@endsection
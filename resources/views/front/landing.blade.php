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
          <a class="nav-link" href="#about_us">{{ __('About Us') }}</a>
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
      <div class="col-md-6 hero-image d-flex align-items-center">
        <img src="{{asset('images/solved-the-problem.png') }}" class="w-100" alt="Solved the Problem Illustration by Manypixels Gallery on IconScout" />
      </div>
    </div>
  </div>
</div>

<!-- Features -->
<div class="p-3 pt-5 text-white">
  <div class="text-center pt-3">
    <h3 class='section-title'>Why Choose us?</h3>
  </div>
  <div class="container">
    <div class="row text-dark py-5">
      @foreach ([
      [
      'title' => 'Academic Strength',
      'note' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
      'icon' => 'fa-book'
      ],
      [
      'title' => 'Creativity',
      'note' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
      'icon' => 'fa-lightbulb'
      ],
      [
      'title' => 'Deligency',
      'note' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
      'icon' => 'fa-user'
      ]
      ] as $feature)
      <div class="col-md-4 p-3">
        <div class="card card-body text-center d-flex flex-column justify-content-center align-items-center p-md-4 rounded-0 gap-2">
          <i class="fa {{$feature['icon']}} large-fa d-flex justify-content-center align-items-center"></i>
          <h5>{{$feature['title']}}</h5>
          <p>{{$feature['note']}}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<!-- Testimonial -->
<div class="bg-light p-3 pt-5">
  <div class="text-center">
    <h3 class='section-title'>What People Say</h3>
  </div>
  <div id="testimonial" class="carousel slide bg-blend" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#testimonial" data-bs-slide-to="0" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#testimonial" data-bs-slide-to="1" class="active" aria-current="true" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#testimonial" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      @foreach ([
      [
      'name' => 'Carl Emmy',
      'testimonial' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam non voluptatum sequi doloribus, fugiat minus ab aut veniam iste debitis, mollitia nostrum optio ipsa praesentium repellat deserunt corrupti atque molestiae.',
      'img' => 'testimonial/team.jpg'
      ],
      [
      'name' => 'Emmanuel Adesina',
      'testimonial' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam non voluptatum sequi doloribus, fugiat minus ab aut veniam iste debitis, mollitia nostrum optio ipsa praesentium repellat deserunt corrupti atque molestiae.',
      'img' => 'testimonial/team.jpg'
      ],
      [
      'name' => 'Carl Emmy',
      'testimonial' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam non voluptatum sequi doloribus, fugiat minus ab aut veniam iste debitis, mollitia nostrum optio ipsa praesentium repellat deserunt corrupti atque molestiae.',
      'img' => 'testimonial/team.jpg'
      ]
      ] as $testimonial)
      <div class="carousel-item @if($loop->index == 0) active @endif" data-bs-interval="10000">
        <div class="d-flex justify-content-center p-3 p-md-5 pb-5">
          <div class="slider">
            <p class="txt">{{$testimonial['testimonial']}}</p>
            <h4 class="name">{{$testimonial['name']}}</h4>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  <div id="about_us"></div>
</div>

<!-- About Us -->
<div class="p-3 pt-5 text-white">
  <div class="text-center pt-3">
    <h3 class='section-title'>About Us</h3>
  </div>
  <div class="container">
    <div class="row text-dark py-5 d-flex justify-content-center align-items-center">
      <div class="col-md-6">
        <img src="{{asset('images/book-lovers.png') }}" class="w-100" alt="Book Lovers Illustration by Manypixels Gallery on IconScout" />
      </div>
      <div class="col-md-6">
        <div class="card card-body rounded-0">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat necessitatibus perspiciatis velit vero iure molestias odio autem, tempora unde ullam provident natus quos consequuntur ipsa pariatur deleniti vel, quo veritatis!
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium nesciunt tempora animi aut debitis fugiat impedit libero deleniti distinctio soluta, ducimus totam, iste repudiandae id eum possimus ut odio enim!
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ad consequatur itaque nihil. Voluptate pariatur harum adipisci, cupiditate quod voluptatem quia amet exercitationem quos debitis! Voluptatum amet error praesentium saepe doloremque.
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iusto, aliquam ipsam esse temporibus deleniti harum recusandae quas reiciendis modi tempora quo expedita, itaque enim commodi quam saepe aut cumque illum!
          </p>
        </div>
      </div>
    </div>
  </div>
  <div id="contact_us"></div>
</div>

<!-- Contact Us -->
<div class="bg-light p-3 pt-5">
  <div class="container">
  <div class="text-center pt-3">
    <h3 class='section-title'>Contact Us</h3>
    <h2 class="py-5">
      07014293952 &nbsp; || &nbsp; platinumemirate@gmail.com
    </h2>
  </div>
  </div>
</div>

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
  /* Large Icon */
  .large-fa {
    margin-bottom: 10px;
    border-radius: 50%;
    padding: 1rem;
    border: 1px solid black;
    width: 100px;
    height: 100px;
    font-size: 40px;
  }

  /* footer */
  .text-white .fab {
    color: white;
    background: var(--secondary-color);
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
    color: var(--secondary-color);
  }

  .social a {
    color: white;
    /* text-decoration: none; */
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
    background: linear-gradient(175deg, white 60.5%, var(--front-body-color) 39.5%);
  }

  .hero-button {
    padding: 10px 25px !important;
    border: none;
    color: white;
    background: var(--secondary-color);
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
    background-color: var(--secondary-color);
    margin-bottom: -50px;
    border-radius: 50px;
    padding: 10px 10%;
    color: white;
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
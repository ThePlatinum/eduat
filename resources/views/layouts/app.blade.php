<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name', 'EduAT') }}</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Styles -->
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
      font-weight: lighter;
    }

    :root {
      /* ===== Sizes ===== */
      --sidebar-width: 18vw;
      --sidebar-width-mobile: 5vw;
      --border-radius: 5px;

      /* ===== Colors ===== */
      --body-color: #E4E9F7;
      --sidebar-color: #FFF;
      --primary-color: #695CFE;
      --primary-color-light: #F6F5FF;
      --toggle-color: #DDD;
      --text-color: #707070;

      /* ====== Transition ====== */
      --tran-03: all 0.2s ease;
      --tran-03: all 0.3s ease;
    }

    p {
      font-size: 0.8rem;
    }

    body {
      height: 100vh !important;
      background-color: var(--body-color);
      transition: var(--tran-03);
    }

    /* ===== Sidebar ===== */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: var(--sidebar-width);
      padding: 1vh 1vw;
      background: var(--sidebar-color);
      transition: var(--tran-03);
      z-index: 100;
    }

    .sidebar.close {
      width: var(--sidebar-width-mobile);
    }

    .sidebar li {
      padding: 1vh 0px;
      list-style: none;
      display: flex;
      align-items: center;
      margin-top: 10px;
    }

    .sidebar header .image,
    .sidebar .icon {
      margin-right: 1vw;
      border-radius: 6px;
    }

    .sidebar .icon {
      border-radius: 6px;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
    }

    .sidebar .text,
    .sidebar .icon {
      color: var(--text-color);
      transition: var(--tran-03);
    }

    .sidebar .text {
      font-size: 17px;
      font-weight: 500;
      white-space: nowrap;
      opacity: 1;
    }

    .sidebar.close .text {
      opacity: 0;
    }

    .sidebar header {
      position: relative;
    }

    .sidebar header .image-text {
      display: flex;
      align-items: center;
    }

    .sidebar header .logo-text {
      display: flex;
      flex-direction: column;
    }

    header .image-text .name {
      margin-top: 2px;
      font-size: 18px;
      font-weight: 600;
    }

    .sidebar header .image {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .sidebar header .image img {
      width: 40px;
      border-radius: 6px;
    }

    .sidebar header .toggle {
      position: absolute;
      top: 50%;
      right: -25px;
      transform: translateY(-50%) rotate(180deg);
      height: 25px;
      width: 25px;
      background-color: var(--primary-color);
      color: var(--sidebar-color);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      cursor: pointer;
      transition: var(--tran-03);
    }

    .sidebar.close .toggle {
      transform: translateY(-50%) rotate(0deg);
    }

    .sidebar .menu {
      margin-top: 40px;
    }

    .sidebar ul {
      padding-left: 0rem;
    }

    .sidebar li a {
      list-style: none;
      background-color: transparent;
      display: flex;
      align-items: center;
      padding: 0.5vw;
      width: 100%;
      border-radius: var(--border-radius);
      text-decoration: none;
      transition: var(--tran-03);
    }

    .sidebar li a:hover {
      background-color: var(--primary-color);
    }

    .sidebar li a:hover .icon,
    .sidebar li a:hover .text {
      color: var(--sidebar-color);
    }

    .sidebar .menu-bar {
      height: calc(100% - 55px);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      overflow-y: scroll;
    }

    .menu-bar::-webkit-scrollbar {
      display: none;
    }

    .content {
      position: absolute;
      top: 0;
      top: 0;
      left: var(--sidebar-width);
      height: 100%;
      width: calc(100% - var(--sidebar-width));
      background-color: var(--body-color);
      transition: var(--tran-03);
    }

    .sidebar.close~.content {
      left: var(--sidebar-width-mobile);
      height: 100%;
      width: calc(100% - var(--sidebar-width-mobile));
    }

    .authcard {
      /* background: rgb(58, 73, 180); */
      background: linear-gradient(45deg, rgba(00, 00, 00, 0) 75%, rgba(58, 73, 180, 1) 80%);
    }
  </style>
</head>

<body>

  <nav class="sidebar" id="sidebar">
    <header>
      <div class="image-text">
        <span class="image">
          <img src="logo.png" alt="">
        </span>

        <div class="text logo-text">
          <span class="name">EduAT</span>
        </div>
      </div>

      <span class='bx bx-chevron-right toggle' id="toggle"></span>
    </header>

    <hr />

    <div class="menu-bar">
      <div class="menu">

        <ul class="menu-links">
          <li class="nav-link">
            <a href="#">
              <i class='bx bx-home-alt icon'></i>
              <span class="text nav-text">Dashboard</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bx-bar-chart-alt-2 icon'></i>
              <span class="text nav-text">Revenue</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bx-bell icon'></i>
              <span class="text nav-text">Notifications</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bx-pie-chart-alt icon'></i>
              <span class="text nav-text">Analytics</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bx-heart icon'></i>
              <span class="text nav-text">Likes</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bx-wallet icon'></i>
              <span class="text nav-text">Wallets</span>
            </a>
          </li>

        </ul>
      </div>
      <div class="bottom-content">
        <hr />
        <li class="">
          <a href="#">
            <i class='bx bx-log-out icon'></i>
            <span class="text nav-text">Logout</span>
          </a>
        </li>

      </div>
    </div>
  </nav>

  <div class="content d-flex flex-column justify-content-between">
    <div>
      @yield('content')
    </div>
    <div class="p-3">
      <hr>
      <div class="d-flex d-flex justify-content-between justify-content-between credit">
        EduAT
        <!-- <img src="" alt=""> -->
        <div class="social">
          <p>copywrite Platinum @2021</p>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class=" h-100">
    
  </div> -->
  <script>
    let body = document.getElementById("sidebar");
    const toggle = document.getElementById("toggle");

    toggle.addEventListener("click", () => {
      sidebar.classList.toggle("close");
    })
  </script>
</body>

</html>
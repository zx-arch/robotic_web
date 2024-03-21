<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="{{route('home_dashboard')}}">IntanRobotic</a></h1>

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto {{isset($currentActive) && $currentActive == 'dashboard' ? 'active' : ''}}" href="{{isset($currentActive) && $currentActive == 'dashboard' ? '#hero' :  route('home_dashboard')}}">Home</a></li>
                <li><a class="nav-link scrollto" href="#about">About</a></li>
                <li><a class="nav-link scrollto" href="#courses">Courses</a></li>
                <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                <li><a class="getstarted scrollto {{isset($currentActive) && $currentActive == 'login' ? 'active' : ''}}" href="{{isset($currentActive) && $currentActive == 'dashboard' ? route('form.login') : '#hero'}}">Login</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

    </div>
</header>

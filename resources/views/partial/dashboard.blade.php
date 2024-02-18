<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intan Robotic</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href=''>IntanRobotic</a></div>
            <div class="menu">
                <ul>
                    <li><a href="{{route('home_dashboard')}}">Home</a></li>
                    <li><a href="#courses">Courses</a></li>
                    <li><a href="{{route('materials')}}">Materials</a></li>
                    <li><a href="#partners">Partners</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="{{route('form_login')}}" class="tbl-biru">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <!-- untuk home -->
        <section id="home">
            <img src="https://img.freepik.com/free-vector/open-automation-architecture-abstract-concept-illustration_335657-3802.jpg?w=740&t=st=1707973461~exp=1707974061~hmac=3eccc82f22f37885ac0b44e82e0e88eddd0afc88865682556e3a821538c3d2c9"
                style="height: 500px;" />
            <div class="kolom">
                <p class="deskripsi">Belajar Programming #dirumahaja</p>
                <h2>Tetap Sehat, Tetap Semangat</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt, nobis.</p>
                <p><a href="" class="tbl-pink">Pelajari Lebih Lanjut</a></p>
            </div>
        </section>
    </div>
    <script src="{{asset('assets/js/script.js')}}"></script>
</body>
</html>
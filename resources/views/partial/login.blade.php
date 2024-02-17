<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intan Robotic | Login</title>
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
                    <li><a href="#tutors">Tutors</a></li>
                    <li><a href="#partners">Partners</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="{{route('form_login')}}" class="tbl-biru">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="wrapper">
        <section id="home">
            <img src="https://img.freepik.com/free-vector/open-automation-architecture-abstract-concept-illustration_335657-3802.jpg?w=740&t=st=1707973461~exp=1707974061~hmac=3eccc82f22f37885ac0b44e82e0e88eddd0afc88865682556e3a821538c3d2c9" style="height: 600px;"/>
            <div class="kolom">
                <div class="form-container">
                    <div class="login-form">
                        <h3>Login</h3>
                        <form action="#" method="post">
                            <input type="email" name="email" placeholder="Email" required>
                            <input type="password" name="password" placeholder="Password" required>
                            <button type="submit" class="btn btn-primary" style="width: 85px;">Login</button>
                            <a href="" class="btn btn-warning">Register</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="{{asset('assets/js/script.js')}}"></script>
</body>
</html>
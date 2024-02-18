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
                <ul class="accordion">
                    <li>
                        <input type="checkbox" name="accordion" id="first">
                        <label for="first">Block Programming</label>
                        <div class="content">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna
                                aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                aliquip ex ea commodo consequat. Duis
                                aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                pariatur. Excepteur sint
                                occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
                                laborum.
                            </p>
                        </div>
                    </li>
                    <li>
                        <input type="checkbox" name="accordion" id="second">
                        <label for="second">Python Programming</label>
                        <div class="content">
                            <p>Begginer</p>
                            <p>Intermediate</p>
                            <p>Advanced</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    <script>
        // Mengambil semua elemen accordion
        var accordions = document.querySelectorAll('.accordion input[type="checkbox"]');

        // Menambahkan event listener untuk setiap accordion
        accordions.forEach(function (accordion) {
            accordion.addEventListener('change', function () {
                // Mendapatkan konten terkait
                var content = this.parentNode.querySelector('.content');

                // Jika checkbox dicentang
                if (this.checked) {
                    // Menambahkan kelas "expanded" untuk menampilkan konten
                    content.classList.add('expanded');
                    content.style.display = 'block';
                    content.style.marginTop = '-10px';
                    var contentHeight = (content.scrollHeight - 75) + 'px';
                    content.style.height = contentHeight;
                } else {
                    // Menghapus kelas "expanded" untuk menyembunyikan konten
                    content.classList.remove('expanded');
                    content.style.display = 'none';
                    console.log('Accordion ditutup');
                }
            });
        });
    </script>
</body>

</html>
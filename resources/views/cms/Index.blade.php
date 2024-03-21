<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Intan Robotic</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
</head>

<body>

    @include('cms.partials.navbar')

    @yield('content')
    
    <main id="main">

        @include('cms.partials.clients')
        @include('cms.partials.about')
        @include('cms.partials.courses')
        @include('cms.partials.contact')
        @include('cms.partials.footer')

    </main>
    

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Cek apakah ada session 'valid'
            if ("{{ session()->has('valid') }}") {
                // Dapatkan elemen col-xl-4 pertama
                var firstCol = document.getElementById('courses');
                
                // Arahkan pengguna ke posisi elemen pertama tersebut
                if (firstCol) {
                    firstCol.scrollIntoView({ behavior: 'smooth' });
                }
            }

            if ("{{ session()->has('error_submit_chat') }}") {
                // Dapatkan elemen col-xl-4 pertama
                var firstCol = document.getElementById('contact');
                
                // Arahkan pengguna ke posisi elemen pertama tersebut
                if (firstCol) {
                    firstCol.scrollIntoView({ behavior: 'smooth' });
                }
            }

            
            if ("{{ session()->has('success_submit_chat') }}") {
                // Dapatkan elemen col-xl-4 pertama
                var firstCol = document.getElementById('contact');
                
                // Arahkan pengguna ke posisi elemen pertama tersebut
                if (firstCol) {
                    firstCol.scrollIntoView({ behavior: 'smooth' });
                }
            }

            if ("{{ session()->has('error_access') }}") {
                // Dapatkan elemen col-xl-4 pertama
                var firstCol = document.getElementById('courses');
                
                // Arahkan pengguna ke posisi elemen pertama tersebut
                if (firstCol) {
                    firstCol.scrollIntoView({ behavior: 'smooth' });
                }
            }

            // Dapatkan elemen-elemen yang diperlukan
            var levelSelect = document.getElementById('levelSelect');
            var translationSelect = document.getElementById('translationSelect');
            var courseForm = document.getElementById('courseForm');

            // Tambahkan event listener untuk setiap perubahan pada input
            levelSelect.addEventListener('change', checkAllInputsSelected);
            translationSelect.addEventListener('change', checkAllInputsSelected);

            // Fungsi untuk memeriksa apakah semua input telah dipilih
            function checkAllInputsSelected() {
                // Periksa apakah kedua input telah dipilih
                if (levelSelect.value !== '' && translationSelect.value !== '') {
                    // Jika ya, kirim formulir secara otomatis
                    courseForm.submit();
                }
            }
        });
    </script>

    @php
        session()->forget('valid');
        session()->forget('getBook');
        session()->forget('error_access');
        session()->forget('request');
        session()->forget('error_submit_chat');
        session()->forget('success_submit_chat');
    @endphp
    
    <!-- Vendor JS Files -->
    <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
    <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>
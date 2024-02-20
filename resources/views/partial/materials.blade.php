<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intan Robotic</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .card {
            width: 85%;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            margin-bottom: 1rem;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            padding: 0.75rem 1.25rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        /* Styling untuk select option */
        .form-control {
            display: block;
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .mt-1 { margin-top: 0.25rem; }
        .mt-2 { margin-top: 0.5rem; }
        .mt-3 { margin-top: 1rem; }
        .mt-4 { margin-top: 1.5rem; }
        .mt-5 { margin-top: 3rem; }

        /* Styling untuk margin bawah */
        .mb-1 { margin-bottom: 0.25rem; }
        .mb-2 { margin-bottom: 0.5rem; }
        .mb-3 { margin-bottom: 1rem; }
        .mb-4 { margin-bottom: 1.5rem; }
        .mb-5 { margin-bottom: 3rem; }
    </style>
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
                <div class="card" style="margin-left: 30px;">
                    <div class="card-header">Select your Book</div>
                    <div class="card-body">
                        <!-- Select untuk versi -->
                        <div class="form-group">
                            <select id="version" class="form-control">
                                <option value="" selected disabled>Version</option>
                                @foreach ($versionBook as $version)
                                    <option value="{{$version->language_id}}">{{$version->language_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Select untuk kategori buku -->
                        <div class="form-group mt-4">
                            <select id="category1" class="form-control">
                                <!-- Opsi-opsi kategori -->
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <select id="category2" class="form-control">
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <select id="category3" class="form-control">
                                <!-- Opsi-opsi kategori -->
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <select id="category4" class="form-control">
                                <!-- Opsi-opsi kategori -->
                            </select>
                        </div>
                    </div>
                </div>

                <ul class="accordion">
                    <li style="height: 35px;">
                        <input type="checkbox" name="accordion">
                        <i class="fa-solid fa-file-pdf" style="margin-right: 5px;"></i>
                        <a href="" style="vertical-align:middle;">Testing.pdf</a>
                    </li>
                </ul>
            </div>
        </section>
    </div>

    <script>
        var accordions = document.querySelectorAll('.accordion input[type="checkbox"]');
        var getCountCategory = @json($maxCategory)-1;
        
        //console.log(@json($maxCategory));
        var hierarchyCategories = @json($hierarchyCategories);
            // Konversi koleksi menjadi array
        hierarchyCategories = Object.values(hierarchyCategories);

        document.getElementById('version').addEventListener('change', function () {
            var selectedVersion = this.value;
            //console.log(selectedVersion);

            // Filter kategori buku sesuai dengan versi yang dipilih
            var categories = hierarchyCategories.filter(function(category) {
                return category.language_id == selectedVersion && category.parent_id == null;
            });

            // Kosongkan opsi kategori buku yang sudah ada sebelumnya
            document.getElementById('category1').innerHTML = '';
            document.getElementById('category2').innerHTML = '';
            document.getElementById('category3').innerHTML = '';
            document.getElementById('category4').innerHTML = '';
            // Membuat elemen option
            var option = document.createElement('option');
            option.value = '';
            option.text = 'Type of Book';
            option.disabled = true;
            option.selected = true;

            // Menemukan elemen select dengan id 'category1'
            var select = document.getElementById('category1');

            // Menambahkan elemen option ke dalam elemen select
            select.appendChild(option);

            // Isi opsi kategori buku
            categories.forEach(function(category) {
                var option = document.createElement('option');
                option.value = category.id; // Sesuaikan dengan nilai yang ingin ditampilkan
                option.textContent = category.name; // Sesuaikan dengan nilai yang ingin ditampilkan
                document.getElementById('category1').appendChild(option);
            });            
        });

        for (let i = 1; i <= getCountCategory; i++) {
            document.getElementById('category' + i).addEventListener('change', function() {
                var selectedVersion = this.value;

                // Filter kategori buku sesuai dengan versi yang dipilih
                var categories = hierarchyCategories.filter(function(category) {
                    return category.parent_id == selectedVersion;
                });

                // Kosongkan opsi kategori buku yang sudah ada sebelumnya
                for (let j = i + 1; j <= getCountCategory + 1; j++) {
                    document.getElementById('category' + j).innerHTML = '';
                }
                // Membuat elemen option
                var option = document.createElement('option');
                option.value = '';
                option.text = 'Category ' + i;
                option.disabled = true;
                option.selected = true;

                // Menambahkan elemen option ke dalam elemen select
                var select = document.getElementById('category' + (i + 1));
                select.appendChild(option);

                // Isi opsi kategori buku
                categories.forEach(function(category) {
                    var option = document.createElement('option');
                    option.value = category.id; // Sesuaikan dengan nilai yang ingin ditampilkan
                    option.textContent = category.name; // Sesuaikan dengan nilai yang ingin ditampilkan
                    select.appendChild(option);
                });   
            });
        }


        // document.getElementById('category2').addEventListener('change', function() {
        //     var selectedVersion = this.value;
        //     //console.log(selectedVersion);

        //     // Filter kategori buku sesuai dengan versi yang dipilih
        //     var categories = hierarchyCategories.filter(function(category) {
        //         return category.parent_id == selectedVersion;
        //     });

        //     // Kosongkan opsi kategori buku yang sudah ada sebelumnya
        //     document.getElementById('category3').innerHTML = '';
        //     document.getElementById('category4').innerHTML = '';
        //     // Membuat elemen option
        //     var option = document.createElement('option');
        //     option.value = '';
        //     option.text = 'Category 2';
        //     option.disabled = true;
        //     option.selected = true;

        //     // Menemukan elemen select dengan id 'category1'
        //     var select = document.getElementById('category3');

        //     // Menambahkan elemen option ke dalam elemen select
        //     select.appendChild(option);

        //     // Isi opsi kategori buku
        //     categories.forEach(function(category) {
        //         var option = document.createElement('option');
        //         option.value = category.id; // Sesuaikan dengan nilai yang ingin ditampilkan
        //         option.textContent = category.name; // Sesuaikan dengan nilai yang ingin ditampilkan
        //         document.getElementById('category3').appendChild(option);
        //     });   
        // });

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
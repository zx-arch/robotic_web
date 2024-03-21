<section id="courses" class="courses section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Courses</h2>
                    {{-- @if (session()->has('valid'))
                        <img src="{{asset('assets/content_pembelajaran/struktur_pengajaran.png')}}" class="img-fluid mb-4" style="width: 400px;" alt="">
                        <p>
                            Struktur kurikulum pada tiap materi dibagi menjadi 3 kategori yaitu basic, hands-on dan advanced. 
                            Kategori ini didasarkan pada tingkat kesulitan materi dari dasar hingga mahir. Pada tingkat jenjang SD s.d SMP
                            lebih berfokus pada materi 'Block Programming' dan jenjang SMA/SMK berfokus pada materi 'Python dan AI Programming'.
                        </p>
                    @endif --}}
        </div>
        @if (session()->has('error_access'))
            <div class="card">
                <form id="courseForm" action="{{ route('courses.submit') }}" method="post">
                    @csrf
                    <div class="card-header">
                        <div class="row w-75">
                            <div class="col-md-4 mb-2">
                                <select id="levelSelect" name="level" class="form-control" required>
                                    <option value="" disabled selected>Pilih Level ..</option>
                                    <option value="3">Begginer</option>
                                    <option value="4">Intermediate</option>
                                    <option value="5">Advanced</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select id="translationSelect" name="terjemahan" class="form-control" required>
                                    <option value="" disabled selected>Pilih Terjemahan ..</option>
                                    <option value="7">English</option>
                                    <option value="67">Indonesian</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>

                <div id="w0" class="gridview table-responsive" style="overflow-x: auto;">
                    <table class="table text-nowrap table-striped table-bordered mb-0">
                        <tr class="for_pc_tr w-100">
                            <td class="text-center align-middle th-number">No</td>
                            <td class="text-center align-middle font-weight-bold td-name">Nama Materi</td>
                            <td class="text-center align-middle font-weight-bold td-link">Jenis File</td>
                            <td class="text-center align-middle font-weight-bold td-name">Terjemahan</td>
                            <td class="text-center align-middle font-weight-bold td-link">Tutorial</td>
                            <td class="text-center align-middle font-weight-bold td-link">Downloads</td>
                        </tr>
                    </table>
                </div>

            </div>
        @endif

        @if (session()->has('valid'))
            <div class="row content">

                <div class="card mt-3">
                    <form id="courseForm" action="{{ route('courses.submit') }}" method="post">
                        @csrf
                        <div class="card-header">
                            <div class="row w-75">
                                <div class="col-md-4 mb-2">
                                    <select id="levelSelect" name="level" class="form-control" required>
                                        <option value="" disabled selected>Pilih Level ..</option>
                                        <option value="3" {{session()->has('request') && session('request')['level'] == 3 ? 'selected' : ''}}>Begginer</option>
                                        <option value="4" {{session()->has('request') && session('request')['level'] == 4 ? 'selected' : ''}}>Intermediate</option>
                                        <option value="5" {{session()->has('request') && session('request')['level'] == 5 ? 'selected' : ''}}>Advanced</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select id="translationSelect" name="terjemahan" class="form-control" required>
                                        <option value="" disabled selected>Pilih Terjemahan ..</option>
                                        @foreach (session('getLanguage') as $language)
                                            <option value="{{$language->language_id}}" {{session()->has('request') && session('request')['terjemahan'] == $language->language_id ? 'selected' : ''}}>{{$language->language_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div id="w0" class="gridview table-responsive" style="overflow-x: auto;">
                        
                        @if (session()->has('getBook'))
                            <table class="table text-nowrap table-striped table-bordered mb-0">
                                
                                <tr class="for_pc_tr w-100">
                                    <td class="text-center align-middle th-number">No</td>
                                    <td class="text-center align-middle font-weight-bold td-name">Nama Materi</td>
                                    <td class="text-center align-middle font-weight-bold td-name">Terjemahan</td>
                                    <td class="text-center align-middle font-weight-bold td-link">Tutorial</td>
                                    <td class="text-center align-middle font-weight-bold td-link">Downloads</td>
                                </tr>

                                @foreach (json_decode(session('getBook')) as $book)
                                    <tr class="for_pc_tr w-100">
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$book->book_title}}</td>
                                        <td>{{\App\Models\Translations::where('id',$book->language_id)->first()->language_name}}</td>
                                        <td>youtube</td>
                                        <td><a href="{{ asset('book/English/'.$book->file) }}">{{$book->file}}</a></td>
                                    </tr>
                                @endforeach

                            </table>
                        @endif

                    </div>
                </div>
            </div>

        @else
            <div class="row">
                <div class="col-xl-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100" onclick="window.location.href=`{{route('courses', ['jenis_materi' => 'block_programming'])}}`">

                    <div class="icon-box">
                        <div class="icon"><img src="{{asset('assets/content_pembelajaran/icon_block_programming.png')}}" class="img-fluid" style="height: 350px;" alt=""></div>
                        <h4><a href="">Block Programming</a></h4>
                        <p>Mempelajari teknik pemrograman dasar berbasis block menggunakan panduan dari buku Artec Robo Education</p>
                    </div>

                </div>

                <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200" onclick="window.location.href=`{{route('courses', ['jenis_materi' => 'ai_programming'])}}`">

                    <div class="icon-box">
                        <div class="icon"><img src="{{asset('assets/content_pembelajaran/icon_ai_programming.png')}}" class="img-fluid" style="height: 350px;" alt=""></div>
                        <h4><a href="">AI Programming</a></h4>
                        <p>Merancang sebuah program untuk memberi kecerdasan buatan yang diterapkan pada robot supaya mampu melakukan pengambilan keputusan</p>
                    </div>
                            
                </div>

                <div class="col-xl-4 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300" onclick="window.location.href=`{{route('courses', ['jenis_materi' => 'python_programming'])}}`">

                    <div class="icon-box">
                        <div class="icon"><img src="{{asset('assets/content_pembelajaran/icon_python_programming.png')}}" class="img-fluid" style="height: 350px;" alt=""></div>
                        <h4><a href="">Python Edition</a></h4>
                        <p>Mampu merancang sebuah program yang menggunakan python untuk mengatur berbagai pergerakan mobil robot</p>
                    </div>

                </div>

            </div>
        @endif                

    </div>
</section>


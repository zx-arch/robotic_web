@extends('cms_login.index_admin')
<!-- Memuat jQuery dari CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Memuat jQuery UI dari CDN -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- Memuat CSS untuk jQuery UI (dibutuhkan untuk styling datepicker) -->

@section('content')
<div class="container-fluid">

    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fas fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Semua User</span>
                            <span class="info-box-number">{{\App\Models\Users::all()->count()}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="fas fa-check"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total User Aktif</span>
                            <span class="info-box-number">{{\App\Models\Users::where('status', 'active')->get()->count()}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="fas fa-times"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total User Belum Aktif</span>
                            <span class="info-box-number">{{\App\Models\Users::where('status', 'inactive')->get()->count() ?? 0}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-danger">
                        <span class="info-box-icon"><i class="fas fa-times"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total User Dihapus</span>
                            <span class="info-box-number">{{\App\Models\Users::where('status', 'deleted')->get()->count()}}</span>
                        </div>
                    </div>
                </div>
            </div>
                        
            <div class="card mt-3">

                <div class="card-header">
                    <a href="{{route('daftar_pengguna.add')}}" class="btn btn-success">Add User</a>
                </div>

                <div class="card-body p-0">
                    <div id="w0" class="gridview table-responsive">
                        <table class="table text-nowrap table-striped table-bordered mb-0">
                            <colgroup>
                                <col style="width: 5%">
                                <col>
                                <col>
                                <col>
                                <col>
                                <col>
                                <col style="width: 140px">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>
                                        <a href="/dashmitra/web/user/index?UserSearch%5Bid%5D=&amp;UserSearch%5Busername%5D=&amp;UserSearch%5Bemail%5D=&amp;UserSearch%5Bstatus%5D=&amp;UserSearch%5Bcreated_at%5D=17-03-2024&amp;UserSearch%5Blogged_at%5D=&amp;sort=id" data-sort="id">Id</a>
                                    </th>
                                    <th>
                                        <a href="/dashmitra/web/user/index?UserSearch%5Bid%5D=&amp;UserSearch%5Busername%5D=&amp;UserSearch%5Bemail%5D=&amp;UserSearch%5Bstatus%5D=&amp;UserSearch%5Bcreated_at%5D=17-03-2024&amp;UserSearch%5Blogged_at%5D=&amp;sort=username" data-sort="username">Username</a>
                                    </th>
                                    <th>
                                        <a href="/dashmitra/web/user/index?UserSearch%5Bid%5D=&amp;UserSearch%5Busername%5D=&amp;UserSearch%5Bemail%5D=&amp;UserSearch%5Bstatus%5D=&amp;UserSearch%5Bcreated_at%5D=17-03-2024&amp;UserSearch%5Blogged_at%5D=&amp;sort=email" data-sort="email">E-mail</a>
                                    </th>
                                    <th>
                                        <a href="/dashmitra/web/user/index?UserSearch%5Bid%5D=&amp;UserSearch%5Busername%5D=&amp;UserSearch%5Bemail%5D=&amp;UserSearch%5Bstatus%5D=&amp;UserSearch%5Bcreated_at%5D=17-03-2024&amp;UserSearch%5Blogged_at%5D=&amp;sort=status" data-sort="status">Status</a>
                                    </th>
                                    <th>
                                        <a class="asc" href="/dashmitra/web/user/index?UserSearch%5Bid%5D=&amp;UserSearch%5Busername%5D=&amp;UserSearch%5Bemail%5D=&amp;UserSearch%5Bstatus%5D=&amp;UserSearch%5Bcreated_at%5D=17-03-2024&amp;UserSearch%5Blogged_at%5D=&amp;sort=-created_at" data-sort="-created_at">Created at</a>
                                    </th>
                                    <th>
                                        <a href="/dashmitra/web/user/index?UserSearch%5Bid%5D=&amp;UserSearch%5Busername%5D=&amp;UserSearch%5Bemail%5D=&amp;UserSearch%5Bstatus%5D=&amp;UserSearch%5Bcreated_at%5D=17-03-2024&amp;UserSearch%5Blogged_at%5D=&amp;sort=logged_at" data-sort="logged_at">Last login</a>
                                    </th>
                                    <th class="action-column">&nbsp;</th>
                                </tr>
                                <tr id="w0-filters" class="filters">
                                    <td><input type="text" class="form-control" name="UserSearch[id]" value=""></td>
                                    <td><input type="text" class="form-control" name="UserSearch[username]" value=""></td>
                                    <td><input type="text" class="form-control" name="UserSearch[email]" value=""></td>
                                    <td>
                                        <select id="usersearch-status" class="form-control" name="UserSearch[status]">
                                            <option value="" disabled selected></option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Not Active</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div id="usersearch-created_at-kvdate" class="input-group date">
                                            <input type="date" id="usersearch-created_at" class="form-control" name="UserSearch[created_at]" max="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </td>
                                    <td>
                                        <div id="usersearch-logged_at-kvdate" class="input-group date">
                                            <input type="date" id="usersearch-logged_at" class="form-control" name="UserSearch[logged_at]" max="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr data-key="33542">
                                        <td>{{$loop->index += 1;}}</td>
                                        <td>{{$user->username}}</td>
                                        <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                                        <td>{{$user->status}}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y, h:i:s A') }}</td>
                                        <td>{!! $user->logged_at ? $user->logged_at : '<span class="not-set">(not set)</span>' !!}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="#" title="View" aria-label="View" data-pjax="0"><i class="fa-fw fas fa-eye" aria-hidden></i></a>
                                            <a class="btn btn-warning btn-sm" href="#" title="Update" aria-label="Update" data-pjax="0"><i class="fa-fw fas fa-edit" aria-hidden></i></a>
                                            <a class="btn btn-danger btn-sm" id="buttonDelete" href="{{ route('daftar_pengguna.delete', $user->id) }}" title="Delete" aria-label="Delete" data-pjax="0" onclick="confirmDelete(event)"><i class="fa-fw fas fa-trash" aria-hidden></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <p>No records found!</p>
                                @endforelse
                            </tbody>
                        </table>
                        <nav id="w1"></nav>
                    </div>
                </div>

                @if ($users->lastPage() > 1)
                    <nav aria-label="Page navigation example">
                        <ul class="pagination mt-2">
                            {{-- Tombol Sebelumnya --}}
                            @if ($users->currentPage() > 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @endif
                                        {{-- Tampilkan 4 halaman sebelumnya jika halaman saat ini tidak terlalu dekat dengan halaman pertama --}}
                            @if ($users->currentPage() > 6)
                                @for ($i = $users->currentPage() - 3; $i < $users->currentPage(); $i++)
                                    @if ($i == 1)
                                        <li class="page-item">
                                            <a class="page-link" href="/admin/daftar_pengguna">{{ $i }}</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endfor
                            @else
                                @for ($i = 1; $i < $users->currentPage(); $i++)
                                    @if ($i == 1)
                                        <li class="page-item">
                                            <a class="page-link" href="/admin/daftar_pengguna">{{ $i }}</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endfor
                            @endif
                                        {{-- Halaman saat ini --}}
                            <li class="page-item active">
                                <span class="page-link">{{ $users->currentPage() }}</span>
                            </li>
                                        {{-- Tampilkan 4 halaman setelahnya jika halaman saat ini tidak terlalu dekat dengan halaman terakhir --}}
                            @if ($users->currentPage() < $users->lastPage() - 5)
                                @for ($i = $users->currentPage() + 1; $i <= $users->currentPage() + 3; $i++)
                                    @if ($i == 1)
                                        <li class="page-item">
                                            <a class="page-link" href="/admin/daftar_pengguna">{{ $i }}</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endfor
                            @else
                                @for ($i = $users->currentPage() + 1; $i <= $users->lastPage(); $i++)
                                    @if ($i == 1)
                                        <li class="page-item">
                                            <a class="page-link" href="/admin/daftar_pengguna">{{ $i }}</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endfor
                            @endif
                                        {{-- Tombol Selanjutnya --}}
                            @if ($users->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                @endif

                <div>
                    Showing <b>{{ $users->firstItem() }}</b> 
                    to <b>{{ $users->lastItem() }}</b>
                    of <b>{{ $users->total() }}</b> items.
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Inisialisasi datepicker
        $('#usersearch-created_at').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            endDate: new Date() // Batasi tanggal maksimum menjadi hari ini
        });

        // Menampilkan tanggal di input teks saat tanggal dipilih
        $('#usersearch-created_at').on('changeDate', function (e) {
            var selectedDate = e.format('dd-mm-yyyy');
            $('#usersearch-created_at').val(selectedDate);
        });

        document.getElementById('buttonDelete').addEventListener('click', function(e) {
            e.preventDefault();
            // Tampilkan SweetAlert konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
        text: 'Gambar akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
            }).then((result) => {
                // Jika konfirmasi diterima, submit form
                if (result.isConfirmed) {
                    document.getElementById('deleteAll').submit();
                }
            });
        });
    });
</script>

<script>
    function confirmDelete(event) {
        // Menghentikan tindakan default pengguna saat mengklik tautan
        event.preventDefault();

            // Menampilkan konfirmasi menggunakan SweetAlert
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            // Jika pengguna menekan "Ya, hapus", maka lanjutkan dengan mengarahkan ke tautan delete
            if (result.isConfirmed) {
                window.location.href = event.target.href;
            }
        });
    }
</script>

<script>
    function showNotification(message, type) {
        Swal.fire({
            title: 'Notification',
            text: message,
            icon: type,
            timer: 3000,
            showConfirmButton: false
        });
    }

    let successMessage = '{{ session('success') }}';
    if (successMessage) {
        showNotification(successMessage, 'success');
    }
</script>
@endsection
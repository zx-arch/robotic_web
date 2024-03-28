@extends('cms.Index')

<style>
    .clients .row {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    .clients img {
        display: block;
        margin: 0 auto;
        max-width: 100%;
        height: 70px;
    }
</style>

@section('content')

    <section id="hero" class="d-flex align-items-center" style="background-color: #37517e">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-2 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">

                    <div class="card">
                        <div class="card-body" id="login-form"> <!-- Add an id to identify the form -->

                            <form action="{{route('submit_form.login')}}" method="POST" id="formLogin">
                                @csrf

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Username atau Email</label>
                                    <input id="username_or_email" type="text" class="form-control" name="username_or_email" value="{{ old('username_or_email') }}" required autofocus>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    @error('password')
                                        <span role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                                <button type="button" id="buttonRegister" class="btn btn-success">Register</button>
                            </form>

                            <div id="formRegis" style="display: none;">
                                <form action="{{route('register.submit')}}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Username</label>
                                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                    </div>

                                    <div class="mb-3">
                                        <label for="role" class="form-label">Role</label>
                                        <select name="role" id="role" class="form-control" required>
                                            <option value="" selected disabled>Select Role ..</option>
                                            <option value="pengurus">Pengurus</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                        @error('password')
                                            <span role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" name="register" class="btn btn-primary">Register</button>
                                
                                </form>
                            </div>

                            @if (session()->has('success_register'))
                                <span role="alert">
                                    <strong class="text-success">{{ session('success_register') }}</strong>
                                </span>
                            @endif

                            @if (session()->has('error_register'))
                                <span role="alert">
                                    <strong class="text-warning">{{ session('error_register') }}</strong>
                                </span>
                            @endif
                            
                            @error('message')
                                <span role="alert">
                                    <strong class="text-warning">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    
                </div>

                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in">
                    <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('buttonRegister').addEventListener('click', function () {
            document.getElementById('formRegis').style.display = 'block';
            document.getElementById('formLogin').style.display = 'none';
        });
    });
</script>
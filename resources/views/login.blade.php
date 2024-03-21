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
                        <div class="card-body">
                            <form action="#" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                                <button type="submit" name="register" class="btn btn-success ms-1">Register</button>
                            </form>
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
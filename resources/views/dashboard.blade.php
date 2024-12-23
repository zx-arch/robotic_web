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
        
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" style="min-height: 170px;" data-aos="fade-up" data-aos-delay="200">
                    <h1>Robot Coding and AI Programming School</h1>
                    <h2>Menjelajahi dunia Robot dan Teknologi AI serta menerapkannya pada tantangan dunia nyata</h2>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="#about" class="btn-get-started scrollto">Get Started</a>
                        <a href="https://youtu.be/R6sLqTSXKZc" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                    </div>
                </div>

                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section>

@endsection
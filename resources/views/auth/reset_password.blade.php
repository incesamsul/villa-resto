<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Villa&Resto</title>
    <!-- Bootstrap CDN-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="/favicon.png" />
    <link rel="icon" type="image/png" href="https://example.com/favicon.png" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
    <!-- OwlCarousel CDN for image slider-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />
    <!-- Font awesome CDN for icons-->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>

<body>
    <section class="login-block">
        <div class="container-fluid login-wrapper ">
            <div class="row login-row">
                <div class="col-md-4 login-sec ">
                    <h2>Villa & Resto</h2>
                    <p class="text-secondary mb-5"><small>Silahkan mereset password anda</small></p>
                    @if (session('success'))
                        <p class="m-0 mt-3 p-0 text-success">{{ session('success') }}</p>
                    @endif
                    @if (session('error'))
                        <p class="m-0 mt-3 p-0 text-danger">{{ session('error') }}</p>
                    @endif
                    <form method="POST" action="{{ route('post-reset-password', $kodeReset) }}">
                        @csrf
                        <div class="form-group text-secondary">
                            <i class="fa fa-user" style="font-size: 12px"></i>
                            <label for="wa" class="text-uppercase "><strong>wa</strong></label>
                            <input name="wa" type="text" class="form-control border-0"
                                placeholder="Masukkan wa anda">

                        </div>
                        <div class="form-group text-secondary">
                            <i class="fa fa-key" style="font-size: 12px"></i>
                            <label for="password" class="text-uppercase"><strong>Password</strong></label>
                            <input name="password" type="password" class="form-control border-0"
                                placeholder="Masukkan password anda">
                        </div>
                        <div class="form-group text-secondary">
                            <i class="fa fa-key" style="font-size: 12px"></i>
                            <label for="konfirmasi_password" class="text-uppercase"><strong>Konfirmasi
                                    Password</strong></label>
                            <input name="konfirmasi_password" type="password" class="form-control border-0"
                                placeholder="konfirmasi password anda">
                        </div>
                        <a href="{{ URL::to('/login') }}" class="forgot"><u> Kembali ke halaman Login?</u></a>
                        <button type="submit" class="btn-block login-button">Reset</button>
                    </form>
                    <div class="copy-text">Copyright © 2022 ♦ .</div>
                </div>
                <div class="col-md-8 banner-sec d-flex flex-column text-center">
                    <img src="{{ asset('img/login_img/login.png') }}" alt="" width="400">
                    <p class="text-secondary"><strong>Villa & Resto</strong></p>
                    <small class="px-5 text-secondary">Selamat datang di aplikasi pemantauan villa dan resto! Kami
                        senang Anda sudah bergabung bersama kami. Silakan login untuk melanjutkan.</small>
                </div>
            </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script>
        $(document).ready(function() {

            // $('.owl-carousel').owlCarousel({
            //     loop: true
            //     , autoplay: true
            //     , autoplayTimeout: 5000
            //     , autoplayHoverPause: true
            //     , items: 1
            //     , animateOut: 'fadeOut'
            //     , animateIn: 'fadeOut',
            // });

            // function getPageWidth(){
            //     let lebarHalaman = $(window).width();
            //     if(lebarHalaman <= 1100){
            //         $('.banner-sec').remove();
            //     }
            // };

            // $(window).resize(getPageWidth);

        });
    </script>
</body>

</html>

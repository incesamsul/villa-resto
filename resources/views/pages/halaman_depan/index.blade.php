<!DOCTYPE html>
<html lang="en">

<head>
    <title>Villa & resto</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('template/eventalk-master/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/eventalk-master/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('template/eventalk-master/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/eventalk-master/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/eventalk-master/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('template/eventalk-master/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('template/eventalk-master/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template/eventalk-master/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('template/eventalk-master/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('template/eventalk-master/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('template/eventalk-master/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('template/eventalk-master/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html">Villa<span>Resto.</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Villa</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Resto</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Contact</a></li>
                    <li class="nav-item cta mr-md-2"><a href="{{ URL::to('/login') }}" class="nav-link">Login</a></li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <div class="hero-wrap js-fullheight" style="background-image: url('img/login_img/bg1.png');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
                data-scrollax-parent="true">
                <div class="col-xl-10 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                    <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"> cari
                        <br><span>Penginapan ?</span>
                    </h1>
                    <p class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Villa and resto
                    </p>
                    <div id="timer">
                        <small class="text-sm">Kami menyediakan villa dan resto untuk pengunjung ayo berkunjung sekarang
                            juga.</small>
                    </div>
                    <!-- <div id="timer" class="d-flex mb-3">
      <div class="time" id="days"></div>
      <div class="time pl-4" id="hours"></div>
      <div class="time pl-4" id="minutes"></div>
      <div class="time pl-4" id="seconds"></div>
      </div> -->
                </div>
            </div>
        </div>
    </div>





    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Villa</span>
                    <h2><span>Kamar</span> Tersedia</h2>
                </div>
            </div>
            <div class="row">
                @if (count($kamar) < 1)
                    <div class="col-sm-12">
                        <div class="card p-5 d-flex align-items-center">
                            <img src="{{ asset('img/svg/ilustration/contact.svg') }}" alt="food" width="300">
                            <p class="mt-4">Untuk saat ini tidak ada kamar kosong</p>
                        </div>
                    </div>
                @endif
                @foreach ($kamar as $row)
                    <div class="col-lg-3">
                        <a href="{{ URL::to('/admin/check_in/' . $row->id_kamar) }}">
                            <div class="card mt-4 border-0 my-card pt-5 pb-3 text-center">
                                <i class="text-dark fa-regular fa-building  room-icon"></i>
                                <h5 class="text-dark mt-4">{{ $row->nama_kamar }}</h5>
                                <p class="text-secondary">Rp. {{ number_format($row->harga_kamar) }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>




    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Villa@resto</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, voluptates.</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Useful Links</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">villa</a></li>
                            <li><a href="#" class="py-2 d-block">resto</a></li>
                            <li><a href="#" class="py-2 d-block"></a></li>
                            <li><a href="#" class="py-2 d-block"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Privacy</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Career</a></li>
                            <li><a href="#" class="py-2 d-block">About Us</a></li>
                            <li><a href="#" class="py-2 d-block">Contact Us</a></li>
                            <li><a href="#" class="py-2 d-block">Services</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">Jl tamalate 1 no
                                        10</span></li>
                                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2
                                            392 3929
                                            210</span></a></li>
                                <li><a href="#"><span class="icon icon-envelope"></span><span
                                            class="text">info@mail.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | made with <i class="icon-heart color-danger"
                            aria-hidden="true"></i> by Sam
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>


    <script src="{{ asset('template/eventalk-master/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template/eventalk-master/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('template/eventalk-master/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/eventalk-master/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/eventalk-master/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('template/eventalk-master/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('template/eventalk-master/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('template/eventalk-master/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template/eventalk-master/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('template/eventalk-master/js/aos.js') }}"></script>
    <script src="{{ asset('template/eventalk-master/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('template/eventalk-master/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('template/eventalk-master/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('template/eventalk-master/js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('template/eventalk-master/js/google-map.js') }}"></script>
    <script src="{{ asset('template/eventalk-master/js/main.js') }}"></script>
    <script src="https://kit.fontawesome.com/3423f55a30.js" crossorigin="anonymous"></script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <meta name="theme-color" content="#2196f3">
    <meta name="author" content="DexignZone" />
    <meta name="keywords" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="Jobie - Job Portal Mobile App Template ( Bootstrap 5 + PWA )" />
    <meta property="og:title" content="Jobie - Job Portal Mobile App Template ( Bootstrap 5 + PWA )" />
    <meta property="og:description" content="Jobie - Job Portal Mobile App Template ( Bootstrap 5 + PWA )" />
    <meta property="og:image" content="https://jobie.dexignzone.com/mobile-app/xhtml/social-image.png" />
    <meta name="format-detection" content="telephone=no">

    <!-- Favicons Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="https://jobie.dexignzone.com/mobile-app/xhtml/assets/images/favicon.png" />

    <!-- Title -->
    <title>JMART - Aplikasi Order Online</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://jobie.dexignzone.com/mobile-app/xhtml/assets/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="https://jobie.dexignzone.com/mobile-app/xhtml/assets/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Animte -->
    <link rel="stylesheet" href="https://jobie.dexignzone.com/mobile-app/xhtml/assets/vendor/wow/css/libs/animate.css">

</head>

<body>
    <div class="page-wraper">
        <!-- Page Content -->
        <div class="page-content page page-onboading">
            <!-- Onboading Start -->
            <div class="started-swiper-box">
                <div class="swiper-container get-started">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="slide-info">
                                <div class="dz-media">
                                    <img src="https://jobie.dexignzone.com/mobile-app/xhtml/assets/images/svg/business.svg" alt="" />
                                </div>
                                <div class="slide-content">
                                    <h1 class="dz-title">Selamat Datang</h1>
                                    <p>Temukan belanja mudah, menyenangkan. Ayo mulai sekarang!</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide-info">
                                <div class="dz-media">
                                    <img src="https://jobie.dexignzone.com/mobile-app/xhtml/assets/images/svg/pie-chart.svg" alt="" />
                                </div>
                                <div class="slide-content">
                                    <h1 class="dz-title">Temukan Produk Terbaik</h1>
                                    <p>Jelajahi katalog kami dan temukan produk favorit dari merek terkenal.</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="slide-info">
                                <div class="dz-media">
                                    <img src="https://jobie.dexignzone.com/mobile-app/xhtml/assets/images/svg/interview.svg" alt="" />
                                </div>
                                <div class="slide-content">
                                    <h1 class="dz-title">Mudah dan Aman</h1>
                                    <p>Nikmati pembayaran aman, pelacakan pesanan, dan pengiriman cepat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-btn">
                    <div class="swiper-pagination-started pagination-dots style-1"></div>
                </div>
            </div>
            <!-- Onboading End-->
        </div>
        <!-- Page Content End-->

        <!-- Footer -->
        <footer class="footer fixed border-0">
            <div class="container">
                <a href="<?= base_url('home/login') ?>" class="btn btn-primary light btn-rounded text-primary d-block">Get started</a>
            </div>
        </footer>
        <!-- Footer End-->
        <!-- Theme Color Settings -->
        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom">
            <div class="offcanvas-body small">
                <ul class="theme-color-settings">
                    <li>
                        <input class="filled-in" id="primary_color_8" name="theme_color" type="radio" value="color-primary" />
                        <label for="primary_color_8"></label>
                        <span>Default</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_2" name="theme_color" type="radio" value="color-green" />
                        <label for="primary_color_2"></label>
                        <span>Green</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_3" name="theme_color" type="radio" value="color-blue" />
                        <label for="primary_color_3"></label>
                        <span>Blue</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_4" name="theme_color" type="radio" value="color-pink" />
                        <label for="primary_color_4"></label>
                        <span>Pink</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_5" name="theme_color" type="radio" value="color-yellow" />
                        <label for="primary_color_5"></label>
                        <span>Yellow</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_6" name="theme_color" type="radio" value="color-orange" />
                        <label for="primary_color_6"></label>
                        <span>Orange</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_7" name="theme_color" type="radio" value="color-purple" />
                        <label for="primary_color_7"></label>
                        <span>Purple</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_1" name="theme_color" type="radio" value="color-red" />
                        <label for="primary_color_1"></label>
                        <span>Red</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_9" name="theme_color" type="radio" value="color-lightblue" />
                        <label for="primary_color_9"></label>
                        <span>Lightblue</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_10" name="theme_color" type="radio" value="color-teal" />
                        <label for="primary_color_10"></label>
                        <span>Teal</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_11" name="theme_color" type="radio" value="color-lime" />
                        <label for="primary_color_11"></label>
                        <span>Lime</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_12" name="theme_color" type="radio" value="color-deeporange" />
                        <label for="primary_color_12"></label>
                        <span>Deeporange</span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Theme Color Settings End -->

    </div>
    <!--**********************************
    Scripts
***********************************-->
    <script src="https://jobie.dexignzone.com/mobile-app/xhtml/assets/js/jquery.js"></script>
    <script src="https://jobie.dexignzone.com/mobile-app/xhtml/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://jobie.dexignzone.com/mobile-app/xhtml/assets/js/settings.js"></script>
    <script src="https://jobie.dexignzone.com/mobile-app/xhtml/assets/js/custom.js"></script>
    <script src="https://jobie.dexignzone.com/mobile-app/xhtml/assets/js/dz.carousel.js"></script><!-- Swiper -->
    <script src="https://jobie.dexignzone.com/mobile-app/xhtml/assets/vendor/swiper/swiper-bundle.min.js"></script><!-- Swiper -->
    <script src="https://jobie.dexignzone.com/mobile-app/xhtml/assets/vendor/wow/dist/wow.min.js"></script>
    <script>
        new WOW().init();

        var wow = new WOW({
            boxClass: 'wow', // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset: 50, // distance to the element when triggering the animation (default is 0)
            mobile: false // trigger animations on mobile devices (true is default)
        });
        wow.init();
    </script>
</body>

</html>
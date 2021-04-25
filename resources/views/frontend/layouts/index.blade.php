<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>D Dreams Creation Pvt. Ltd</title>
    <meta content="D Dreams Creation Pvt. Ltd" name="Photography and Videography at Biratchowk" />
    <meta content="Sandeep Shrestha" name="author" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/logo/favicon.png">

    <!--========== BOX ICONS ==========-->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!--  Magnific Popup css file  -->
    <link rel="stylesheet" href="{{asset('assets/Magnific-Popup/dist/magnific-popup.css')}}">

    <!--========== CSS ==========-->
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/52d4f81de8.js" crossorigin="anonymous"></script>

</head>
<body>

<!--========== SCROLL TOP ==========-->
<a href="#" class="scrolltop" id="scroll-top">
    <i class='bx bx-chevron-up scrolltop__icon'></i>
</a>

<!--========== HEADER ==========-->
<header class="l-header" id="header">
    <nav class="nav bd-container">
        <a href="#" class="nav__logo"><span><img src="assets/logo/favicon.png" alt="" style="height: 20px;width: auto;margin-right: 8px;"></span>Dreams Creation</a>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item"><a href="#home" class="nav__link active-link">Home</a></li>
                <li class="nav__item"><a href="#about" class="nav__link">About</a></li>
                <li class="nav__item"><a href="#our_works" class="nav__link">Our Work</a></li>
                <li class="nav__item"><a href="#" class="nav__link">Team</a></li>
                <li class="nav__item"><a href="#services" class="nav__link">Services</a></li>
                <!-- <li class="nav__item"><a href="#menu" class="nav__link">Menu</a></li> -->
                <li class="nav__item"><a href="#contact" class="nav__link">Contact us</a></li>

                <li><i class='bx bx-moon change-theme' id="theme-button"></i></li>
            </ul>
        </div>

        <div class="nav__toggle" id="nav-toggle">
            <i class='bx bx-menu'></i>
        </div>
    </nav>
</header>

<main class="l-main">
    @yield('content')
</main>

<!--========== FOOTER ==========-->
<footer class="footer section bd-container">
    <div class="footer__container bd-grid">
        <div class="footer__content">
            <a href="#" class="footer__logo">D Dreams Creation</a>
            <span class="footer__description">Photography & Videography</span>
            <div>
                <a href="#" class="footer__social"><i class='bx bxl-facebook'></i></a>
                <a href="#" class="footer__social"><i class='bx bxl-instagram'></i></a>
                <a href="#" class="footer__social"><i class='bx bxl-twitter'></i></a>
            </div>
        </div>

        <div class="footer__content">
            <h3 class="footer__title">Services</h3>
            <ul>
                <li><a href="#" class="footer__link">Delivery</a></li>
                <li><a href="#" class="footer__link">Pricing</a></li>
                <li><a href="#" class="footer__link">Fast food</a></li>
                <li><a href="#" class="footer__link">Reserve your spot</a></li>
            </ul>
        </div>

        <div class="footer__content">
            <h3 class="footer__title">Information</h3>
            <ul>
                <li><a href="#" class="footer__link">Event</a></li>
                <li><a href="#" class="footer__link">Contact us</a></li>
                <li><a href="#" class="footer__link">Privacy policy</a></li>
                <li><a href="#" class="footer__link">Terms of services</a></li>
            </ul>
        </div>

        <div class="footer__content">
            <h3 class="footer__title">Adress</h3>
            <ul>
                <li>Lima - Peru</li>
                <li>Jr Union #999</li>
                <li>999 - 888 - 777</li>
                <li>tastyfood@email.com</li>
            </ul>
        </div>
    </div>

    <p class="footer__copy">&#169; 2020 D Dreams Creation. All right reserved</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<!--  isotope js library  -->
<script src="{{asset('assets/isotope/isotope.min.js')}}"></script>

<!--  Magnific popup script file  -->
<script src="{{asset('assets/Magnific-Popup/dist/jquery.magnific-popup.min.js')}}"></script>

<!--========== SCROLL REVEAL ==========-->
<script src="https://unpkg.com/scrollreveal"></script>

<!--========== MAIN JS ==========-->
<script src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>



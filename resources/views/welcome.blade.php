<!DOCTYPE html>
<html lang='en'>
<head>
	<meta class="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Kurir Tilang</title>
	<!-- Don't forget to add your metadata here -->
	<link rel='stylesheet' href='{{ asset('landing/css/style.min.css')}}' />
</head>
<body>
	<!-- Hero(extended) navbar -->
	<div class="navbar navbar--extended">
		<nav class="nav__mobile"></nav>
		<div class="container">
			<div class="navbar__inner">
                {{-- <a href="index.html" class="navbar__logo">Kurir Tilang</a> --}}
                <img src="{{ asset('uploads/logo.jpg')}}" class="navbar__logo"
           {{-- alt="AdminLTE Logo" --}}
           {{-- class="brand-image img-circle elevation-3" --}}
           style="width: 235px;"           >
				<nav class="navbar__menu">
					<ul>
                        @if (Route::has('login'))
                        @auth
						<li><a href="{{ route('CreateOrder') }}">Make Order</a></li>
						<li><a href="{{ route('logout') }}">Logout</a></li>
                        @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">Reigister</a></li>
                        @endif
                        @endauth
                        @endif
					</ul>
				</nav>
				<div class="navbar__menu-mob"><a href="" id='toggle'><svg role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" class=""></path></svg></a></div>
			</div>
		</div>
	</div>
	<!-- Hero unit -->
	<div class="hero">
		<div class="hero__overlay hero__overlay--gradient"></div>
		<div class="hero__mask"></div>
		<div class="hero__inner">
			<div class="container">
				<div class="hero__content">
					<div class="hero__content__inner" id='navConverter'>
						<h1 class="hero__title" style="font-size: 3.074rem;">Ketilang ? Udah Kurir-in Aja !!</h1>
						<p class="hero__title" style="font-size: 1.374rem;">Solusi Buat Kamu Yang Lagi Mager Pas Ngurus Tilang.</p>
						
						<!-- <a href="#" class="button button__accent">Download Evie</a>
						<a href="#" class="button hero__button">Learn more</a> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="hero__sub">
		<span id="scrollToNext" class="scroll">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" class='hero__sub__down' fill="currentColor" width="512px" height="512px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path d="M256,298.3L256,298.3L256,298.3l174.2-167.2c4.3-4.2,11.4-4.1,15.8,0.2l30.6,29.9c4.4,4.3,4.5,11.3,0.2,15.5L264.1,380.9c-2.2,2.2-5.2,3.2-8.1,3c-3,0.1-5.9-0.9-8.1-3L35.2,176.7c-4.3-4.2-4.2-11.2,0.2-15.5L66,131.3c4.4-4.3,11.5-4.4,15.8-0.2L256,298.3z"/></svg>
		</span>
	</div>
	<!-- Steps -->
	<div class="steps landing__section">
		<div class="container">
			<h2>Feature</h2>
			<p>Kurir Tilang Pasti memberikan kemudahan Buat Kamu</p>
		</div>
		<div class="container">
			<div class="steps__inner">
				<div class="step">
					<div class="step__media">
						<img src="{{ asset('landing/images/undraw_Designer_by46.svg')}}" class="step__image">
					</div>
					<h4>Join With Us</h4>
					<p class="step__text">Daftar langsung ke website kami.</p>
				</div>
				<div class="step">
					<div class="step__media">
						<img src="{{ asset('landing/images/undraw_uploading_go67.svg')}}" class="step__image">
					</div>
					<h4>Place Order</h4>
					<p class="step__text">Buat detial order kamu sesuai petunjuk.</p>
				</div>
				<div class="step">
					<div class="step__media">
						<img src="{{ asset('landing/images/undraw_make_it_rain_iwk4.svg')}}" class="step__image">
					</div>
					<h4>Payment</h4>
					<p class="step__text">Lakukan Pembayaran.</p>
				</div>
				<div class="step">
					<div class="step__media">
						<img src="{{ asset('landing/images/undraw_chore_list_iof3.svg')}}" class="step__image">
					</div>
					<h4>Done !!</h4>
					<p class="step__text">Sans, tunggu order kamu selesai :D</p>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Footer -->
	<div class="footer footer--dark">
		<div class="container">
			<div class="footer__inner">
				<a href="index.html" class="footer__textLogo">Hello There :D</a>
				<div class="footer__data">
					<div class="footer__data__item">
						<div class="footer__row">
							Created by <a href="#" target="_blank" class="footer__link">Kurir Tilang</a>
						</div>
						<div class="footer__row">
						Code/design by <a href="#" target="_blank" class="footer__link">Esa Dewa & Aldian Akbar</a>
						</div>
					</div>
					<div class="footer__data__item">
						<div class="footer__row">Created for <a href="#" target="_blank" class="footer__link">PPSI Mercubuana</a>
						</div>
					</div>
					<div class="footer__data__item">
					<div class="footer__row">
						<a href="#" target="_blank" class="footer__link">GitHub</a>
					</div>
					<div class="footer__row">
						<a href="#" target="_blank" class="footer__link">Twitter</a>
					</div>
					<div class="footer__row">
						<a href="#" target="_blank" class="footer__link">Facebook</a>
					</div>
					<div class="footer__row">
						<a href="./additional.html" class="footer__link">MIT license</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<script src='{{ asset('landing/js/app.min.js')}}'></script>
</body>
</html>
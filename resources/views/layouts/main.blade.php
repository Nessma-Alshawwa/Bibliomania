<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Biblomonia Library</title>

    <link href="//fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">

    <!-- Template CSS -->
    @include('includes.AppStyle')
  </head>
  <body>
<!-- header -->
<header class="w3l-header">
	<div class="container">
	<!--/nav-->
	<nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-sm-3 px-0">
			<a class="navbar-brand" href="{{URL('/home')}}">
				<span class="fa fa-newspaper-o"></span> Biblomonia</a>

			<button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
				data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<!-- <span class="navbar-toggler-icon"></span> -->
				<span class="fa icon-expand fa-bars"></span>
				<span class="fa icon-close fa-times"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<nav class="mx-auto">
					<div class="search-bar">
						<form class="search" method="get" action="{{URL('/search')}}">
							<input type="search" class="search__input" name="search" placeholder="Discover news, articles and more"
								onload="equalWidth()" required>
							<span class="fa fa-search search__icon"></span>
						</form>
					</div>
				</nav>
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="{{ URL('/books')}}">Books</a>
					</li>
          
					<li class="nav-item dropdown @@pages__active">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Authors </span>
						</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach ($authors as $author)
              <a class="dropdown-item @@b__active" href="{{URL('/book/author/'.$author->id)}}">
                {{ $author->name }}</a>
              @endforeach
              </div>  
					</li>
          <li class="nav-item dropdown @@pages__active">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Publishers </span>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach ($publishers as $publisher)
							<a class="dropdown-item @@b__active" href="{{ URL('/book/publisher/'.$publisher->id) }}">
                {{ $publisher->name }}</a>
              @endforeach
						</div>
					</li>
          <li class="nav-item dropdown @@pages__active">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Categories </span>
						</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach ($categories as $category)
                <a class="dropdown-item @@b__active" href="{{ URL('/book/category/'.$category->id) }}">
                {{ $category->category }}</a>
              @endforeach
            </div>
					</li>
          <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                      <li class="nav-item active">
                        <a class="nav-link" href="{{ URL('/admin/book')}}">Admin Panel</a>
                      </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
				</ul>
			</div>
			<!-- toggle switch for light and dark theme -->
			<div class="mobile-position">
				<nav class="navigation">
					<div class="theme-switch-wrapper">
						<label class="theme-switch" for="checkbox">
							<input type="checkbox" id="checkbox">
							<div class="mode-container">
								<i class="gg-sun"></i>
								<i class="gg-moon"></i>
							</div>
						</label>
					</div>
				</nav>
			</div>
			<!-- //toggle switch for light and dark theme -->
		</div>
	</nav>
	<!--//nav-->
</header>
<!-- //header -->

        @yield('MainContent')


<!-- footer-28 block -->
<section class="app-footer">
    <footer class="footer-28 py-5">
      <div class="footer-bg-layer">
        <div class="container py-lg-3">
          <div class="row footer-top-28">
            <div class="col-lg-4 footer-list-28 copy-right mb-lg-0 mb-sm-5 mt-sm-0 mt-4">
              <a class="navbar-brand mb-3" href="index.html">
                <span class="fa fa-newspaper-o"></span> Biblomonia</a>
              <p class="copy-footer-28"> © 2021. All Rights Reserved. </p>
              <h5 class="mt-2">Done by <a href="/">Nessma Alshawwa</a></h5>
            </div>
            <div class="col-lg-8 row">
              <div class="col-sm-4 col-6 footer-list-28">
                <h6 class="footer-title-28">Useful links</h6>
                <ul>
                  <li><a href="#categories">food blogs</a></li>
                  <li><a href="#advertise">Advertise with us</a></li>
                  <li><a href="#authors">Our Authors</a></li>
                  <li><a href="contact.html">Get in touch</a></li>
                </ul>
              </div>
              <div class="col-sm-4 col-6 footer-list-28">
                <h6 class="footer-title-28">Categories</h6>
                <ul>
                  <li><a href="beauty.html">Beauty</a></li>
                  <li><a href="fashion.html">Fashion and Style</a></li>
                  <li><a href="#food"> Food and Wellness</a></li>
                  <li><a href="#lifestyle">Lifestyle</a></li>
                </ul>
              </div>
              <div class="col-sm-4 col-6 footer-list-28 mt-sm-0 mt-4">
                <h6 class="footer-title-28">Social Media</h6>
                <ul class="social-icons">
                  <li class="facebook">
                    <a href="#facebook"><span class="fa fa-facebook"></span> Facebook</a></li>
                  <li class="twitter"> <a href="#twitter"><span class="fa fa-twitter"></span> Twitter</a></li>
                  <li class="linkedin"> <a href="#linkedin"><span class="fa fa-linkedin"></span> Linkedin</a></li>
                  <li class="dribbble"><a href="#dribbble"><span class="fa fa-dribbble"></span> Dribbble</a></li>
                </ul>

              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </footer>

    <!-- move top -->
    <button onclick="topFunction()" id="movetop" title="Go to top">
      <span class="fa fa-angle-up"></span>
    </button>
  @include('includes.AppJS')
  </body>

</html>

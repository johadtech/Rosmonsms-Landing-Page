<!--start header-->
<header id="topnav" class="defaultscroll sticky" style="background-color:#0a0a33;color:#fff;">
	<div class="container">
		<!-- Logo container-->
		<a class="logo mt--4" href="{{ url('/') }}">
			{{--<img src="{{ asset('images/general/' . gs()->logo) }}" class="logo-light-mode" height="24" alt="">
			<img src="{{ asset('images/general/' . gs()->logo) }}" height="24" class="logo-dark-mode" alt="">--}}
			<img src="{{ asset('storage/general/'.gs()->logo) }}" class="logo-light-mode" height="24" alt="">
			<img src="{{ asset('storage/general/'.gs()->logo) }}" height="24" class="logo-dark-mode" alt="">
		</a>

		<!-- End Logo container-->
		<div class="menu-extras">
			<div class="menu-item">
				<!-- Mobile menu toggle-->
				<a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
					<div class="lines">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</a>
				<!-- End mobile menu toggle-->
			</div>
		</div>

		<!--Login button Start-->
		<ul class="buy-button list-inline mt--4 d-none mb-0">
			<li class="list-inline-item mb-0">
				<a href="javascript:void(0)" class="btn btn-sm btn-soft-myprimary text-uppercase"><i class="uil uil-bookmark"></i> Book a demo</a>
			</li>

			<li class="list-inline-item ps-1 mb-0 d-none">
				<a href="" target="_blank" class="btn btn-icon btn-pills btn-primary"><i data-feather="shopping-cart" class="fea icon-sm"></i></a>
			</li>
		</ul>
		<!--Login button End-->

		<div id="navigation">
			<!-- Navigation Menu-->
			<ul class="navigation-menu nav-right text-center">
				<li><a href="{{ url('/') }}" class="sub-menu-item">Home</a></li>

				<li><a href="{{route('about')}}" class="sub-menu-item">About us</a></li>

				<li><a href="" class="sub-menu-item">Pricing</a></li>

				<li class="has-submenu parent-parent-menu-item">
					<a href="javascript:void(0)">Pages</a><span class="menu-arrow"></span>
					<ul class="submenu">
						<li><a href="{{route('privacypolicy')}}" class="sub-menu-item">Privacy Policy </a></li>

						<li><a href="{{route('termcondition')}}" class="sub-menu-item">Terms of Services </a></li>

					</ul>
				</li>

				<li><a href="{{route('contact')}}" class="sub-menu-item">Contact Us</a></li>
			</ul>
			<!--end navigation menu-->
		</div>
		<!--end navigation-->
	</div>
	<!--end container-->
</header>
<!--end header-->

<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
	<div class="navbar-wrapper">
		<div class="m-header">
			<a href="" class="b-brand text-primary">
				<!-- ========   Change your logo from here   ============ -->
				<img src="{{ asset('storage/general/'.gs()->logo) }}" class="img-fluid logo-lg" alt="logo">
				<span class="badge bg-light-success rounded-pill ms-2 theme-version">v1.0</span>
			</a>
		</div>
		<div class="navbar-content">
			
			<ul class="pc-navbar">
			    <li class="pc-item pc-caption">
			        <label>Dashboard Navigations</label>
			    </li>
			
			    <li class="pc-item">
			        <a href="{{ route('admin.dashboard') }}" class="pc-link">
			            <span class="pc-micon">
			                <svg class="pc-icon">
			                    <use xlink:href="#custom-status-up"></use>
			                </svg>
			            </span>
			            <span class="pc-mtext">Dashboard</span>
			        </a>
			    </li>
			
			    <li class="pc-item pc-hasmenu">
			        <a href="#!" class="pc-link">
			            <span class="pc-micon">
			                <svg class="pc-icon">
			                    <use xlink:href="#custom-user-square"></use>
			                </svg>
			            </span>
			            <span class="pc-mtext">Users</span>
			            <span class="pc-arrow">
			                <i data-feather="chevron-right"></i>
			            </span>
			        </a>
			        <ul class="pc-submenu">
			            <li class="pc-item">
			                <a href="{{ route('admin.users.index') }}" class="pc-link">List Users</a>
			            </li>
			        </ul>
			    </li>
			
				<li class="pc-item pc-hasmenu">
			        <a href="#!" class="pc-link">
			            <span class="pc-micon">
			                <svg class="pc-icon">
			                    <use xlink:href="#custom-layer"></use>
			                </svg>
			            </span>
			            <span class="pc-mtext">Booking</span>
			            <span class="pc-arrow">
			                <i data-feather="chevron-right"></i>
			            </span>
			        </a>
			        <ul class="pc-submenu">
			            <li class="pc-item">
			                <a href="{{ route('admin.bookings.index') }}" class="pc-link">List Bookings</a>
			            </li>
			        </ul>
			    </li>
			
			    <li class="pc-item pc-hasmenu">
			        <a href="#!" class="pc-link">
			            <span class="pc-micon">
			                <svg class="pc-icon">
			                    <use xlink:href="#custom-notification-status"></use>
			                </svg>
			            </span>
			            <span class="pc-mtext">Posts</span>
			            <span class="pc-arrow">
			                <i data-feather="chevron-right"></i>
			            </span>
			        </a>
			        <ul class="pc-submenu">
			            <li class="pc-item">
			                <a href="{{ route('admin.posts.index') }}" class="pc-link">List Posts</a>
			            </li>
			            <li class="pc-item">
			                <a href="{{ route('admin.posts.create') }}" class="pc-link">Create Post</a>
			            </li>
			        </ul>
			    </li>
			
			    <li class="pc-item pc-hasmenu">
			        <a href="#!" class="pc-link">
			            <span class="pc-micon">
			                <svg class="pc-icon">
			                    <use xlink:href="#custom-mouse-circle"></use>
			                </svg>
			            </span>
			            <span class="pc-mtext">Categories</span>
			            <span class="pc-arrow">
			                <i data-feather="chevron-right"></i>
			            </span>
			        </a>
			        <ul class="pc-submenu">
			            <li class="pc-item">
			                <a href="{{ route('admin.categories.index') }}" class="pc-link">List Categories</a>
			            </li>
			            <li class="pc-item">
			                <a href="{{ route('admin.categories.create') }}" class="pc-link">Create Category</a>
			            </li>
			        </ul>
			    </li>
			
			    <li class="pc-item pc-hasmenu">
			        <a href="#!" class="pc-link">
			            <span class="pc-micon">
			                <svg class="pc-icon">
			                    <use xlink:href="#custom-24-support"></use>
			                </svg>
			            </span>
			            <span class="pc-mtext">Support</span>
			            <span class="pc-arrow">
			                <i data-feather="chevron-right"></i>
			            </span>
			        </a>
			        <ul class="pc-submenu">
			            <li class="pc-item">
			                <a href="#" class="pc-link">List Users</a>
			            </li>
			        </ul>
			    </li>
			
				<li class="pc-item pc-hasmenu">
			        <a href="#!" class="pc-link">
			            <span class="pc-micon">
			                <svg class="pc-icon">
			                    <use xlink:href="#custom-story"></use>
			                </svg>
			            </span>
			            <span class="pc-mtext">Partners</span>
			            <span class="pc-arrow">
			                <i data-feather="chevron-right"></i>
			            </span>
			        </a>
			        <ul class="pc-submenu">
			            <li class="pc-item">
			                <a href="{{ route('admin.partners.index') }}" class="pc-link">List Partners</a>
			            </li>
			            <li class="pc-item">
			                <a href="{{ route('admin.partners.create') }}" class="pc-link">Create Partner</a>
			            </li>
			        </ul>
			    </li>
			
			    <li class="pc-item pc-hasmenu">
			        <a href="#!" class="pc-link">
			            <span class="pc-micon">
			                <svg class="pc-icon">
			                    <use xlink:href="#custom-crop"></use>
			                </svg>
			            </span>
			            <span class="pc-mtext">Testimonies</span>
			            <span class="pc-arrow">
			                <i data-feather="chevron-right"></i>
			            </span>
			        </a>
			        <ul class="pc-submenu">
			            <li class="pc-item">
			                <a href="{{ route('admin.testimonies.index') }}" class="pc-link">List Testimonies</a>
			            </li>
			            <li class="pc-item">
			                <a href="{{ route('admin.testimonies.create') }}" class="pc-link">Create Testimony</a>
			            </li>
			        </ul>
			    </li>
			
			    <li class="pc-item pc-hasmenu">
			        <a href="#!" class="pc-link">
			            <span class="pc-micon">
			                <svg class="pc-icon">
			                    <use xlink:href="#custom-level"></use>
			                </svg>
			            </span>
			            <span class="pc-mtext">Custom Scripts</span>
			            <span class="pc-arrow">
			                <i data-feather="chevron-right"></i>
			            </span>
			        </a>
			        <ul class="pc-submenu">
			            <li class="pc-item">
			                <a href="{{ route('admin.scripts.index') }}" class="pc-link">Footer & Header Script</a>
			            </li>
			        </ul>
			    </li>
			
			    <li class="pc-item pc-hasmenu">
			        <a href="#!" class="pc-link">
			            <span class="pc-micon">
			                <svg class="pc-icon">
			                    <use xlink:href="#custom-element-plus"></use>
			                </svg>
			            </span>
			            <span class="pc-mtext">Settings</span>
			            <span class="pc-arrow">
			                <i data-feather="chevron-right"></i>
			            </span>
			        </a>
			        <ul class="pc-submenu">
			            <li class="pc-item">
			                <a href="{{ route('admin.settings.edit') }}" class="pc-link">Edit Settings</a>
			            </li>
			        </ul>
			    </li>
			
			    <li class="pc-item pc-caption">
			        <label>System Information</label>
			    </li>
			
			    <li class="pc-item">
			        <a href="{{ route('admin.system.about') }}" class="pc-link">
			            <span class="pc-micon">
			                <svg class="pc-icon">
			                    <use xlink:href="#custom-status-up"></use>
			                </svg>
			            </span>
			            <span class="pc-mtext">Version Control</span>
			        </a>
			    </li>
			
			</ul>
			
		</div>
	</div>
</nav>
<!-- [ Sidebar Menu ] end -->
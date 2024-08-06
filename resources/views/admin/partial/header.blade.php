<!-- [ Header Topbar ] start -->
<header class="pc-header">
	<div class="header-wrapper">
		<!-- [Mobile Media Block] start -->
		<div class="me-auto pc-mob-drp">
			<ul class="list-unstyled">
				<!-- ======= Menu collapse Icon ===== -->
				<li class="pc-h-item pc-sidebar-collapse"><a href="#" class="pc-head-link ms-0" id="sidebar-hide"><i class="ti ti-menu-2"></i></a></li>
				<li class="pc-h-item pc-sidebar-popup"><a href="#" class="pc-head-link ms-0" id="mobile-collapse"><i class="ti ti-menu-2"></i></a></li>
			</ul>
		</div>
		<!-- [Mobile Media Block end] -->
		<div class="ms-auto">
			<ul class="list-unstyled">
				<li class="dropdown pc-h-item">
					<a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
						<svg class="pc-icon">
							<use xlink:href="#custom-sun-1"></use>
						</svg>
					</a>
					<div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
						<a href="#!" class="dropdown-item" onclick="layout_change('dark')">
							<svg class="pc-icon">
								<use xlink:href="#custom-moon"></use>
							</svg>
							<span>Dark</span>
						</a>
						<a href="#!" class="dropdown-item" onclick="layout_change('light')">
							<svg class="pc-icon">
								<use xlink:href="#custom-sun-1"></use>
							</svg>
							<span>Light</span>
						</a>
						<a href="#!" class="dropdown-item d-none" onclick="layout_change_default()">
							<svg class="pc-icon">
								<use xlink:href="#custom-setting-2"></use>
							</svg>
							<span>Default</span>
						</a>
					</div>
				</li>
				
				@if($notificationCount > 0)
				<li class="dropdown pc-h-item">
					<a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
						<svg class="pc-icon">
							<use xlink:href="#custom-notification"></use>
						</svg>
						<span class="badge bg-success pc-h-badge">{{ __($notificationCount) }}</span>
					</a>
					<div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
						<div class="dropdown-header d-flex align-items-center justify-content-between">
							<h5 class="m-0">Notifications</h5>
							<a href="#" class="btn btn-link btn-sm" onclick="event.preventDefault(); document.getElementById('markall').submit();">
								Mark all read
							</a>
							<form action="{{ route('admin.notifications.mark') }}" method="POST" id="markall" style="display:none;">
								@csrf
							</form>
						</div>
						<div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
							@foreach ($groupedNotifications as $date => $notificationsGroup)
							<p class="text-span">
								{{ $date }}
							</p>
							@foreach ($notificationsGroup as $notification)
							<div class="card mb-2">
								<div class="card-body">
									<div class="d-flex">
										<div class="flex-shrink-0">
											<svg class="pc-icon text-primary">
												<use xlink:href="#custom-sms"></use>
											</svg>
										</div>
										<div class="flex-grow-1 ms-3">
											<span class="float-end text-sm small text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span>
											<h5 class="text-body mb-2 small">{{ __($notification->subject) }}</h5>
											<p class="mb-0 small">
												{{ __($notification->content) }}
											</p>
										</div>
									</div>
								</div>
							</div>
							@endforeach
							@endforeach
						</div>
						<div class="text-center py-2">
							<a href="#" class="link-danger" onclick="event.preventDefault(); document.getElementById('clearall').submit();">Clear all Notifications</a>
							<form action="{{ route('admin.notifications.clear') }}" method="POST" id="clearall" class="" style="display:none;">
								@csrf
								@method('DELETE')
							</form>
						</div>
					</div>
				</li>
				@endif
				<li class="dropdown pc-h-item header-user-profile"><a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
					<img src="{{ asset('storage/user/avatar-2.jpg') }}" alt="user-image" class="user-avtar">
				</a>
					<div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
						<div class="dropdown-header d-flex align-items-center justify-content-between">
							<h5 class="m-0">Profile</h5>
						</div>
						<div class="dropdown-body">
							<div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
								<div class="d-flex mb-1">
									<div class="flex-shrink-0">
										<img src="{{ asset('storage/user/avatar-2.jpg') }}" alt="user-image" class="user-avtar wid-35">
									</div>
									<div class="flex-grow-1 ms-3">
										<h6 class="mb-1">{{ auth()->user()->fullname() }}</h6>
										<span>
											<a href="Javascript:void(0)" class="">{{ auth()->user()->email }}</a>
										</span>
									</div>
								</div>
								<hr class="border-secondary border-opacity-50">


								<a href="{{ route('admin.users.edit', ['id' => auth()->user()->id]) }}" class="dropdown-item">
									<span>
										<svg class="pc-icon text-muted me-2">
											<use xlink:href="#custom-setting-outline"></use>
										</svg>
										<span>Settings</span>
									</span>
								</a>
								<a href="#" class="dropdown-item d-none">
									<span>
										<svg class="pc-icon text-muted me-2">
											<use xlink:href="#custom-share-bold"></use>
										</svg>
										<span>Share</span>
									</span>
								</a>
								<a href="{{ route('admin.users.pass') }}" class="dropdown-item">
									<span>
										<svg class="pc-icon text-muted me-2">
											<use xlink:href="#custom-lock-outline"></use>
										</svg>
										<span>Change Password</span>
									</span>
								</a>

								<hr class="border-secondary border-opacity-50">
								<div class="d-grid mb-3">
									<!-- Logout Button -->
									<button type="button" class="btn btn-primary" onclick="document.getElementById('logout-form').submit();">
										<svg class="pc-icon me-2">
											<use xlink:href="#custom-logout-1-outline"></use>
										</svg>
										Logout
									</button>
									<!-- Hidden Logout Form -->
									<form action="{{route('admin.logout')}}" method="post" id="logout-form" style="display:none;">
									@csrf
									</form>
								</div>

							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</header>
<!-- [ Header ] end -->
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar menu-light ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				
				<div class="">
				</div>

				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
						<label>Navigation</label>
					</li>
					@if (App\Helpers\RoleHelper::isSuperAdmin())
						<li class="nav-item">
						<a href="/super-admin/dashboard" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>
					@else
						<li class="nav-item">
							<a href="/dashboard" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
						</li>
					@endif
					
					@if(App\Helpers\RoleHelper::isSuperAdmin())
						<li class="nav-item">
							<a href="/region" class="nav-link "><span class="pcoded-micon"><i class="feather icon-map-pin"></i></span><span class="pcoded-mtext">Region & District</span></a>
						</li>
						<li class="nav-item">
							<a href="/super-admin/users" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">User</span></a>
						</li>
						<li class="nav-item">
							<a href="/super-admin/user-logs" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">User Logs</span></a>
						</li>
					@endif
					
					<li class="nav-item">
						<a href="/personal-info" class="nav-link "><span class="pcoded-micon"><i class="feather icon-edit-1"></i></span><span class="pcoded-mtext">Registration Forms</span></a>
					</li>
					<li class="nav-item">
						<a href="/officers" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user-check"></i></span><span class="pcoded-mtext">Officers</span></a>
					</li>
					<li class="nav-item">
						<a href="/report" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Report</span></a>
					</li>
					<li class="nav-item">
						<a href="/periodic-report" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Periodic Report</span></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->
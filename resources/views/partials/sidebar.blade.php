<aside class="main-sidebar elevation-4 sidebar-light-primary">
<a href="/dashboard" class="brand-link bg-primary">
	<img src="{{ asset('assets/images/system/qc_health_logo.png') }}" alt="App LOGO" class="brand-image img-circle elevation-3" style="opacity: .8">
	<span class="brand-text font-weight-light">Health Services</span>
</a>

<!-- Sidebar -->
<div class="sidebar os-host os-host-resize-disabled os-host-transition os-theme-dark os-host-overflow os-host-overflow-y os-host-scrollbar-horizontal-hidden"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 1212px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
		<div class="image">
			<img src="{{ asset('assets/images/system/qc_health_logo.png') }}" alt="Admin Image"  class="img-circle elevation-2">
		</div>
		<div class="info">
			<a href="#" class="d-block">Administrator</a>
		</div>
	</div>


	<!-- Sidebar Menu -->
	<nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
		<!-- Add icons to the links using the .nav-icon class
			with font-awesome or any other icon font library -->
		<li class="nav-item">
			<a href="/dashboard" class="nav-link">
				<i class="nav-icon fas fa-tachometer-alt"></i>
				<p>
					Dashboard
				</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="#" class="nav-link active">
				<i class="nav-icon fas fa-users"></i>
				<p>
					Applications
					<i class="right fas fa-angle-left"></i>
				</p>
			</a>
			<ul class="nav nav-treeview">
				<li class="nav-item">
					<a href="/applications/all" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>All</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="/applications/for-review" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>For Review</p>
					</a>
				</li>
				<li class="nav-item">
				<a href="/applications/payment-created" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Payment Created</p>
				</a>
				</li>
				<li class="nav-item">
				<a href="/applications/payment-validation" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Payment Validation</p>
				</a>
				</li>
				<li class="nav-item">
				<a href="/applications/validated" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Validated</p>
				</a>
				</li>
				<li class="nav-item">
				<a href="/applications/rejected" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>Rejected</p>
				</a>
				</li>
				<li class="nav-item">
				<a href="/applications/completed" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>
					Completed
					</p>
				</a>
				</li>
				<li class="nav-item">
				<a href="/applications/released" class="nav-link">
					<i class="far fa-circle nav-icon"></i>
					<p>
					Released
					</p>
				</a>
				</li>
			</ul>
		</li>

		<li class="nav-item">
			<a href="/applications/head-approval" class="nav-link">
				<i class="nav-icon fas fa-user-tie"></i>
				<p>
				Head Approval
				</p>
			</a>
		</li>
		<li class="nav-item">
			<a href="/applications/generate_report" class="nav-link">
				<i class="nav-icon fas fa-file-excel"></i>
				<p>
				Generate Report
				</p>
			</a>
		</li>

		<li class="nav-item">
			<a href="/applications/customer-complaints" class="nav-link">
				<i class="nav-icon fas fa-user-injured"></i>
				<p>
				Customer Complaints
				</p>
			</a>
		</li>
		
		<li class="nav-item">
		{{-- <a href="/execute/logout" class="nav-link"> --}}
			<a href="/" class="nav-link">
			<i class="nav-icon fas fa-sign-out-alt"></i>
			<p>
			Log Out
			</p>
		</a>
		</li>
	</ul>
	</nav>
	<!-- /.sidebar-menu -->
</div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-auto-hidden os-scrollbar-unusable"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 89.2568%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>
<!-- /.sidebar -->
</aside>
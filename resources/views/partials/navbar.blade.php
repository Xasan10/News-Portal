
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
          <span class="align-middle">AdminKit</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item ">
						<a class="sidebar-link" href="{{ route('showDashboard') }}">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('profile',auth()->user()->id) }}">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
            </a>
					</li>

				

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('showUsers') }}">
              <i class="align-middle" data-feather="book"></i> <span class="align-middle">Users</span>
            </a>
					</li>

					<li class="sidebar-header">
						Contents 
					</li>


					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('post') }}">
              <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">News</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('category.view') }}">
              <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Category</span>
            </a>
					</li>


				

			
				</ul>

			
			</div>
		</nav>


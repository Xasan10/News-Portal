<nav class="navbar navbar-expand navbar-light navbar-bg" >
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
					
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link  d-none d-sm-inline-block" href="#" >
                <img  src="{{ $user->img ? asset('storage/' . $user->img) : 'https://placehold.co/128x128.png?text=User' }}" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark">{{ $user->name }}</span>
              </a>
							
						</li>
					</ul>
				</div>
			</nav>
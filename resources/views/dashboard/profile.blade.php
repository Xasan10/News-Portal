@extends('dashboard.dashboard')

@section('content')




	<div class="wrapper">
		

		<div class="main">
			

			<main class="content">
				<div class="container-fluid p-0">

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Profile</h1>
						<a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html">
      Get more page examples
  </a>
					</div>
					<div class="row">
						<div class="col-md-4 col-xl-3">
							<div class="card mb-3">
								<div class="card-header">
									<h5 class="card-title mb-0">Profile Details</h5>
								</div>
								<div class="card-body text-center">
				

						     <img 
                  src="{{ $user->img ? asset('storage/' . $user->img) : 'https://placehold.co/128x128.png?text=User' }}" 
                  alt="{{ $user->name }}" 
                  class="img-fluid rounded-circle mb-2" 
                  width="128" height="128" 
                  id="img-id"
                  style="cursor:pointer;"
                />
											
							

								</div>
								<hr class="my-0" />
								<div class="card-body">
									<h5 class="h6 card-title" style="color: rgba(77, 117, 209, 1);" >Name:</h5>
									<h5 class="mb-1" >{{ $user->name }}</h5>
									<h5 class="h6 card-title" style="color:#4D75D1;">Email:</h5>
                                    <h5 class="mb-1">{{ $user->email }}</h5>

								</div>
								<hr class="my-0" />
								<div class="card-body">
									<h5 class="h6 card-title" style="color: rgba(77, 117, 209, 1);">Bio:</h5>
									<p>{{ $user->bio }}</p>
								</div>
								<hr class="my-0" />
								
							</div>
						</div>

					</div>

				</div>
			</main>


    <ul id="profile-menu" style="display:none; position:absolute; background:white; border:1px solid #ccc; padding:10px; list-style:none;">
      <li><a href="{{ route('profile.edit', ) }}">Edit Profile</a></li>
      <li><a href="#">Logout</a></li>
    </ul>


		
		</div>
	</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>









<script>
  const avatar = document.getElementById("img-id");
  const menu = document.getElementById("profile-menu");

  avatar.addEventListener("contextmenu", function(event) {
    event.preventDefault(); 

    menu.style.display = "block";
    menu.style.left = event.pageX + "px";
    menu.style.top = event.pageY + "px";
  });


  document.addEventListener("click", function(event) {
    if (!menu.contains(event.target) && event.target !== avatar) {
      menu.style.display = "none";
    }
  });
</script>




@endsection
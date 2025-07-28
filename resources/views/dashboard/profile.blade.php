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
									<form action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data" method="post">

									@csrf

											<img src="{{ 'storage/' . $user->img == null ? 'https://placehold.co/640x480.png?text=News+Article':'storage/' . $user->img == null}}" alt="Christina Mason" class="img-fluid rounded-circle mb-2" width="128" height="128" />
											<input type="file" name="img" accept="image/*"  >
											<button type="submit">submit</button>

									</form>
									<h5 class="card-title mb-0"></h5>
									<div class="text-muted mb-2">Lead Developer</div>

									<div>
										<a class="btn btn-primary btn-sm" href="#">Follow</a>
										<a class="btn btn-primary btn-sm" href="#"><span data-feather="message-square"></span> Message</a>
									</div>
								</div>
								<hr class="my-0" />
								<div class="card-body">
									<h5 class="h6 card-title">Email:</h5>
                                    <h5 class="h6 card-title"></h5>

								</div>
								<hr class="my-0" />
								<div class="card-body">
									<h5 class="h6 card-title">About</h5>
									<ul class="list-unstyled mb-0">
										<li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#">San Francisco, SA</a></li>

										<li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Works at <a href="#">GitHub</a></li>
										<li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> From <a href="#">Boston</a></li>
									</ul>
								</div>
								<hr class="my-0" />
								<div class="card-body">
									<h5 class="h6 card-title">Elsewhere</h5>
									<ul class="list-unstyled mb-0">
										<li class="mb-1"><a href="#">staciehall.co</a></li>
										<li class="mb-1"><a href="#">Twitter</a></li>
										<li class="mb-1"><a href="#">Facebook</a></li>
										<li class="mb-1"><a href="#">Instagram</a></li>
										<li class="mb-1"><a href="#">LinkedIn</a></li>
									</ul>
								</div>
							</div>
						</div>

						<div class="col-md-8 col-xl-9">
							<div class="card">
								<div class="card-header">

									<h5 class="card-title mb-0">Articles</h5>
								</div>
								<div class="card-body h-100">

								<div id="article-list">
									
                                @foreach ($articles as $article )

                                
										<div class="col-12 col-md-6">
									<div class="card">
										<img class="card-img-top" src="{{ asset('storage/' . $article->thumbnail) }}" alt="Unsplash">
										<div class="card-header">
											<h5 class="card-title mb-0">Card with image and button</h5>
										</div>
										<div class="card-body">
											<p class="card-text">{{ $article->title }}</p>
											<a href="{{ route('show.details', $article->id) }}" class="btn btn-primary">Go somewhere</a>
										</div>
									</div>
								</div>
                                
                                @endforeach
								</div>
                                

								

									<hr />
									<div class="d-grid">
										<button id="load-more-btn" data-offset="{{ count($articles) }}" class="btn btn-primary">Load more</button>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>


<script>

document.getElementById('load-more-btn').addEventListener('click', function () {
    const btn = this;
    let offset = parseInt(btn.dataset.offset);

    fetch(`/load-more-articles?offset=${offset}&user_id={{ $user->id }}`)
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                btn.textContent = "No more articles";
                btn.disabled = true;
                return;
            }

            const list = document.getElementById('article-list');

            data.forEach(article => {
                const div = document.createElement('div');
                div.className = 'col-12 col-md-6';
                div.innerHTML = `
                    <div class="card">
                        <img class="card-img-top" src="/storage/${article.thumbnail}" alt="Article Image">
                        <div class="card-header">
                            <h5 class="card-title mb-0">${article.title}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">${article.title}</p>
                            <a href="/articles/${article.id}" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                `;
                list.appendChild(div);
            });

            btn.dataset.offset = offset + data.length;
        });
});

</script>







@endsection
@extends('dashboard.dashboard')


@section('content')



<div class="main">
		
			<main class="content">

			    @if ($article->thumbnail)
					<div class="mb-2">
						<p>Current Image:</p>
						<img src="{{ asset('storage/' . $article->thumbnail) }}" alt="Current Thumbnail" width="150">
					</div>
   				@endif


				<form action="{{ route('post.update',$article->id) }} " method="post" enctype="multipart/form-data"   >

                @csrf
				    @method('PUT')
                <div class="container-fluid p-0">

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Forms</h1>
						<a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html">
      Get more form examples
  </a>
					</div>
					<div class="row">
						<div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Input</h5>
								</div>
								<div class="card-body">
									<input type="text" class="form-control" placeholder="Input" name="title" value="{{ $article->title }}" required>
								</div>
							</div>

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Textarea</h5>
								</div>
								<div class="card-body">
									<textarea class="form-control" rows="2" placeholder="Textarea" name="body"  required>{{ $article->body }}</textarea>
								</div>
                                
							</div>

						
						</div>

						<div class="col-12 col-lg-6">
							

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Selects</h5>
								</div>
								<div class="card-body">
									<select class="form-select mb-3" name="category_id">
                                    <option selected  required>Open this select menu</option>
                                    @foreach ($categories as $category )
                                    <option value="{{ $category->id }}">
															   {{ $article->category_id == $category->id ? 'selected' : '' }}>
            							{{ $category->name }}

									</option>
				
                                    @endforeach
        
                                    </select>

								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Upload Image</h5>
								</div>
								<div class="card-body">

                                
							       <input type="file" name="thumbnail" accept="image/*" >

								</div>
							</div>

							
						</div>

                   
					</div>

				</div>

                <button class="btn btn-primary" type="submit">Update Article</button>

                </form>





			</main>
		</div>




@endsection

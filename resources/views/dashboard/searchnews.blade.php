@extends('dashboard.dashboard')


@section('content')


		<div class="main">
		
			<main class="content">
				<form action="{{ route('post.store') }} " method="post" enctype="multipart/form-data"   >

                @csrf

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
									<input type="text" class="form-control" placeholder="Input" name="title" required>
								</div>
							</div>

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Textarea</h5>
								</div>
								<div class="card-body">
									<textarea class="form-control" rows="2" placeholder="Textarea" name="body" required></textarea>
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
          <option value="{{ $category->id }}">{{ $category->name }}</option>
        
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

                <button class="btn btn-primary" type="submit">Cretae New Article</button>

            

                </form>

             <div class="card-header" style=" justify-content:space-between; align-items: center;" >
                <h5 class="card-title mb-0">Articles</h5>
                  <div class="col-xl-2 col-lg-2 col-md-4">
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <i class="fas fa-search special-tag"></i>
                                    <div class="search-box">
                                        <form  method="GET" action="{{ route('search.news') }}">

                                            <input type="text" placeholder="Search" name="search"  id="searchInput">
                                                <button type="submit">Search</button>
                                            
                                        </form>
                                       
                                    </div>

                                    
                                </div>
                            </div>
            </div>     

			  <table class="table table-hover my-0" id="myTable">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Title</th>
                        <th>Category</th>
                        @if (auth()->user()->hasAnyRole('admin|editor'))
                            <th>Author</th>
                        @endif
                        <th class="d-none d-xl-table-cell">Created or Updated date</th>
                
                    </tr>
                </thead>
                <tbody>
                 
					<form id="deleteForm" method="POST" style="display: none;">
    					@csrf
    					@method('DELETE')
					   @foreach ($articles as $article)
                        <tr data-id="{{ $article->article_id }}">
							<td>{{ $article->article_id }}</td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->category_name }}</td>
                            @if (auth()->user()->hasAnyRole('admin|editor'))
                               <td>{{ $article->author}}</td>
                            @endif

                            <td class="d-none d-xl-table-cell">{{ \Carbon\Carbon::parse($article->updated_at)->format('Y-m-d') }}</td>
						
	
                       
                        </tr>
							

                    @endforeach



					</form>

                </tbody>
            </table>
				




			</main>
		
		</div>
<ul id="contextMenu" 
    style="display:none; position:absolute; z-index:1000; background:#fff; border:1px solid #ccc; list-style:none; padding:0; margin:0; width:150px;">
    <li style="padding:8px; cursor:pointer;">
        <a id="editLink" href="#">✏️ Edit</a>
    </li>
    <li style="padding:8px; cursor:pointer;">
        <form action="" id="delete-id" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" style="background:none;border:none;padding:0;color:red;cursor:pointer;">
                🗑 Delete
            </button>
        </form>
    </li>
</ul>


<script>

const deleteForm = document.getElementById('delete-id')


document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('myTable');
    const menu = document.getElementById('contextMenu');
    const editLink = document.getElementById('editLink');

    table.addEventListener('contextmenu', function (e) {
        e.preventDefault();

        if (e.target.tagName === 'TD') {
            const row = e.target.closest('tr');
            const id = row.dataset.id;

            // update the edit link dynamically
            editLink.href = `/post/update-view/${id}`;
            deleteForm.action = `/post/${id}`;

            // position the menu
            menu.style.top = e.pageY + 'px';
            menu.style.left = e.pageX + 'px';
            menu.style.display = 'block';
        }
    });

    // hide menu on click anywhere else
    document.addEventListener('click', function () {
        menu.style.display = 'none';
    });
});










</script>










@endsection
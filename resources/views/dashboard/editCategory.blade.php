@extends('dashboard.dashboard')

@section('content')

<div class="container">

<div class="container" style="margin-top:25px;">
    <h3>Edit Category</h3>
    <form method="POST" action="{{ route('categories.update', $category->id) }}" id="editCategoryForm">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input 
                type="text" 
                class="form-control" 
                id="name" 
                name="name" 
                value="{{ $category->name }}" 
                required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('category.view') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$('#editCategoryForm').on('submit', function(e){

    e.preventDefault()

    let name = $('#name').val()

    $.ajax({

        url:`/api/categories/{{ $category->id }}`,
        type:'PUT',
        data:{

            name:name,
            token:'{{ csrf_token() }}'


        },

        success: function(response){

              window.location.href = '/dashboard/categories';
        },
         error: function(xhr) {
            alert('Error updating category');
            console.log(xhr.responseText);
        }



    })


})




</script>


@endsection
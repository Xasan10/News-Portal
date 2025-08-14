@extends('dashboard.dashboard')


@section('content')


    
<div class="container">

<div class="d-flex justify-content-between align-items-center mb-3 " style="margin-top:25px;">
    <h3>Categories</h3>
    <button type="button" id="showAddCategory" class="btn btn-primary">+ Add Category</button>
</div>

<div id="addCategoryForm" style="display:none;">
    <input type="text" id="newCategoryName" placeholder="Category name">
    <button type="button" id="saveCategory">Save</button>
</div>

	  <table class="table table-hover my-0" id="myTable">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                    </tr>
                </thead>
                <tbody>

                        
                    @foreach ($categories as $category)
                    
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{$category->name }} </td>
                    </tr>

                    @endforeach
                    

                </tbody>
            </table>
				
    <ul id="contextMenu" style="display:none; position:absolute; background:#fff; border:1px solid #ccc; padding:5px; list-style:none;">
        <button type="button" id="delete-id">delete</button>
        <a href="#" id="edit-id">edit</a>
</ul>



</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>





$(document).on("contextmenu", "#myTable tbody tr", function(e) {
    e.preventDefault();

    
    const edit = document.getElementById('edit-id');

    selectedId = $(this).find("td:first").text(); 

    $("#contextMenu")
        .css({ top: e.pageY + "px", left: e.pageX + "px" })
        .show();

    edit.href = `/dashboard/categories/${selectedId}`

    

});

$(document).on("click", function() {
    $("#contextMenu").hide();
});

$("#delete-id").on("click", function() {
    if (confirm("Are you sure you want to delete this category?")) {
        $.ajax({
            url: `/api/categories/${selectedId}`,
            type: "DELETE",
            success: function(response) {
                alert("Deleted successfully");

          
                $(`#myTable tbody tr`).filter(function() {
                    return $(this).find("td:first").text() == selectedId;
                }).remove();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert("Error deleting category");
            }
        });
    }
    $("#contextMenu").hide();
});





$('#showAddCategory').click(function() {
    $('#addCategoryForm').toggle();
});

$('#saveCategory').click(function(e) {
    e.preventDefault();
    let name = $('#newCategoryName').val().trim();

    if (name === '') {
        alert('Please enter a category name.');
        return;
    }

    $.ajax({
        url: "{{ route('categories.store') }}",
        type: "POST",
        data: {
            name: name,
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            console.log("Category saved:", response);

          
            $('#myTable tbody').append(`
                <tr>
                    <td>${response.data.id}</td>
                    <td>${response.data.name}</td>
                </tr>
            `);

          
            $('#newCategoryName').val('');
            $('#addCategoryForm').hide();
        },
        error: function(xhr) {
            console.error(xhr.responseText);
            alert('Error saving category.');
        }
    });
});


</script>





@endsection


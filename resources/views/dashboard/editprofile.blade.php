@extends('dashboard.dashboard')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4 rounded">
        <h2 class="mb-4">Edit Profile</h2>

        <form action="{{ route('users.update',$user->id) }}" method="post" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
    
            <div class="mb-3">
                <label for="profile-pic" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="profile-pic" name="img">
            </div>

          <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="name" value="{{ $user->name }}">
            </div>

       
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>

      
           

            <div class="mb-3">
                <label for="bio" class="form-label">Bio</label>
                <textarea class="form-control" id="bio" name="bio" rows="4">{{ $user->bio ?? 'This is my bio...' }}
</textarea>
            </div>

      
            <!-- Buttons -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection

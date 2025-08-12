@extends('dashboard.dashboard')


@section('content')

<div class="container">
    <h2>Edit Profile</h2>

    <div class="mb-3">
        <label>Profile Picture</label><br>
        <img id="profile-pic" 
             src="{{ $user->profile_picture ? asset('storage/' . $user->img) : asset('images/default-avatar.png') }}" 
             alt="Profile Picture" width="150" style="cursor: pointer; border-radius: 50%;"><br>
        <input type="file" id="file-input" style="display: none;">
    </div>

    <div id="message" class="mt-2"></div>
</div>

<script>
document.getElementById('profile-pic').addEventListener('click', () => {
    document.getElementById('file-input').click();
});

document.getElementById('file-input').addEventListener('change', function () {
    let file = this.files[0];
    if (!file) return;

    let formData = new FormData();
    formData.append('profile_picture', file);

    fetch("{{ route('profile.upload.picture') }}", {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        let messageEl = document.getElementById('message');
        if (data.success) {
            document.getElementById('profile-pic').src = data.newImageUrl;
            messageEl.innerHTML = '<span class="text-success">Profile picture updated!</span>';
        } else {
            messageEl.innerHTML = '<span class="text-danger">Upload failed.</span>';
        }
    })
    .catch(() => {
        document.getElementById('message').innerHTML = '<span class="text-danger">Error uploading.</span>';
    });
});
</script>



@endsection


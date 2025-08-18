@extends('dashboard.dashboard')

@section('content')
<div class="row">


    <div class=" d-flex" style="margin-top:25px;">
        <div class="card flex-fill" >
             <div class="card-header" style="display:flex; justify-content:space-between; align-items: center;" >
                <h5 class="card-title mb-0">Users</h5>
                  <div class="col-xl-2 col-lg-2 col-md-4">
                                <div class="header-right-btn f-right d-none d-lg-block">
                                    <i class="fas fa-search special-tag"></i>
                                    <div class="search-box">
                                        <form  method="GET" action="{{ route('search.users') }}">

                                            <input type="text" placeholder="Search" name="search"  id="searchInput">
                                                <button type="submit">Search</button>
                                            
                                        </form>
                                       
                                    </div>

                                    
                                </div>
                            </div>
            </div>
            <table class="table table-hover my-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="d-none d-xl-table-cell">Join Date</th>
                        <th>Role</th>
                        <th class="d-none d-md-table-cell">Assignee</th>
                        <th class="d-none d-md-table-cell">Restrict-User</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td class="d-none d-xl-table-cell">{{ \Carbon\Carbon::parse($u->created_at)->format('Y-m-d') }}</td>
                            <td><span class="badge bg-success">{{ $u->roles->first()->name ?? 'No role' }}</span></td>
                            <td>
                                <form class="role-form" data-user-id="{{ $u->id }}">
                                    @csrf
                                    <select name="role">
                                        @foreach ($roles as $role )
                                            <option value="{{ $role->name }}" {{ $u->hasRole($role->name) ? 'selected' : '' }}>{{  $role->name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                                 <td>  
                               <form action="{{ route('users.toggleBlock', $u->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $u->is_blocked ? 'btn-success' : 'btn-danger' }}">
                                        {{ $u->is_blocked ? 'Unblock' : 'Block' }}
                                    </button>
                                </form>

                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    document.querySelectorAll('.role-form select').forEach(select => {
        select.addEventListener('change', function () {
            const form = this.closest('form');
            const userId = form.dataset.userId;
            const role = this.value;
            const token = document.querySelector('meta[name="csrf-token"]').content;

            fetch(`api/users/${userId}/role`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                },
                body: JSON.stringify({ role: role })
            })
         
          
           ;

        });
    });
</script>




@endsection

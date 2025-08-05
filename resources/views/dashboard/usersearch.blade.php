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
                        <th class="d-none d-md-table-cell">	Restrict-User</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td class="d-none d-xl-table-cell">{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</td>
                            <td><span class="badge bg-success">{{ $user->roles->first()->name ?? 'No role' }}</span></td>
                            <td>
                                <form class="role-form" data-user-id="{{ $user->id }}">
                                    @csrf
                                    <select name="role">
                                        <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                                        <option value="editor" {{ $user->hasRole('editor') ? 'selected' : '' }}>Editor</option>
                                        <option value="author" {{ $user->hasRole('author') ? 'selected' : '' }}>Author</option>
                                        <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>User</option>
                                    </select>
                                </form>
                            </td>
                                         <td>  
                               <form action="{{ route('users.toggleBlock', $user->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $user->is_blocked ? 'btn-success' : 'btn-danger' }}">
                                        {{ $user->is_blocked ? 'Unblock' : 'Block' }}
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



@endsection



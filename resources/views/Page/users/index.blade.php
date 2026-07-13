@extends('layouts.master')

@section('title')
Users
@endsection

@section('APP')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">
                    <i class="fas fa-users text-primary"></i>
                    Users Management
                </h3>
            </div>

            <div class="col-sm-6 text-end">
                <a href="{{ route('Users.create') }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i>
                    Add User
                </a>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-users"></i>
                    Users List
                </h5>
            </div>

            <div class="card-body p-0">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th width="70">#</th>
                            <th width="90">Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th width="120">Role</th>
                            <th>Created At</th>
                            <th width="220" class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($users as $user)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D6EFD&color=fff"
                                    class="rounded-circle border"
                                    width="50"
                                    height="50">
                            </td>

                            <td>
                                <strong>{{ $user->name }}</strong>
                            </td>

                            <td>{{ $user->email }}</td>

                            <td>
                                @if($user->role == 'admin')
                                    <span class="badge bg-danger">
                                        <i class="fas fa-user-shield"></i>
                                        Admin
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        <i class="fas fa-user"></i>
                                        User
                                    </span>
                                @endif
                            </td>

                            <td>{{ $user->created_at->format('Y-m-d') }}</td>

                            <td class="text-center">

                                <a href="{{ route('Users.show',$user->id) }}"
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('Users.edit',$user->id) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('Users.destroy',$user->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this user?')">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-users fa-3x text-secondary mb-3"></i>
                                <h5>No Users Found</h5>
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="card-footer">
                {{ $users->links() }}
            </div>

        </div>

    </div>
</div>

@endsection
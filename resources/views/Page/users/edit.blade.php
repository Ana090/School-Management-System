@extends('layouts.master')

@section('title')
Edit User
@endsection

@section('APP')

<div class="container-fluid">

    <div class="card shadow-sm mt-3">

        <div class="card-header bg-warning text-dark">
            <h5>Edit User</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('Users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ $user->name }}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ $user->email }}" required>
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <button class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('Users.index') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@endsection
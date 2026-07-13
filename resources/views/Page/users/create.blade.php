@extends('layouts.master')

@section('title')
Add User
@endsection

@section('APP')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">
                    <i class="fas fa-user-plus text-primary"></i>
                    Add New User
                </h3>
            </div>

            <div class="col-sm-6 text-end">
                <a href="{{ route('Users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm border-0">

                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-user-plus"></i>
                            User Information
                        </h5>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('Users.store') }}" method="POST">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>

                                <input type="text"
                                       name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}"
                                       required>

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>

                                <input type="email"
                                       name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       required>

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">Password</label>

                                <input type="password"
                                       name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       required>

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>

                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control"
                                       required>
                            </div>

                            <!-- Role -->
                            <div class="mb-4">
                                <label class="form-label">Role</label>

                                <select name="role"
                                        class="form-select @error('role') is-invalid @enderror">

                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>

                                </select>

                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="text-end">

                                <button type="reset" class="btn btn-secondary">
                                    <i class="fas fa-undo"></i>
                                    Reset
                                </button>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    Save User
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection
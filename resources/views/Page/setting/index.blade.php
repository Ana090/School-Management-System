 @extends('layouts.master')
  @section('title')
     Settings
 @endsection
 @section('APP')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="row g-0">

                    <!-- Logo Section -->
                    <div class="col-md-4 bg-light d-flex flex-column justify-content-center align-items-center p-3 border-end">
                        {{-- <img  src="{{ asset('asset/img/AdminLTELogo.png') }}"
                             class="img-fluid rounded mb-5"
                             alt="School Logo"> --}}

                                                         <h5 class="card-title mb-3">⚙️ School Settings</h5>

                                 <img  src="{{ asset('storage/' . $settings->img) }}" class="img-fluid img-thumbnail mt-4 mb-2"
                                     style="width: 150px; z-index: 1">
 

                        <h6 class="text-muted">Current Logo</h6>
                    </div>

                    <!-- Form Section -->
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title mb-3">⚙️</h5>
                            <form action="{{ Route('setting.store') }}" method="POST" enctype="multipart/form-data">
 @csrf
                                <!-- School Name -->
                                <div class="mb-2">
                                    <label class="form-label">School Name</label>
                                    <input type="text" value="{{ $settings->school_name }}" class="form-control form-control-sm" name="school_name" required>
                                </div>

                                <!-- Email -->
                                <div class="mb-2">
                                    <label class="form-label">Email</label>
                                    <input type="email" value="{{ $settings->email }}" class="form-control form-control-sm" name="email" required>
                                </div>

                                <!-- Phone -->
                                <div class="mb-2">
                                    <label class="form-label">Phone</label>
                                    <input type="text" value="{{ $settings->phone }}"  class="form-control form-control-sm" name="phone" required>
                                </div>

                                <!-- Address -->
                                <div class="mb-2">
                                    <label class="form-label">Address</label>
                                    <textarea  class="form-control form-control-sm" required rows="2" name="address">{{ $settings->address }}</textarea>
                                 </div>

                                <!-- Upload Logo -->
                                <div class="mb-2">
                                    <label class="form-label">Change Logo</label>
                                    <input type="file" class="form-control form-control-sm" name="img">
                                </div>

                                <!-- Academic Year -->
                                <div class="mb-2">
                                    <label class="form-label">Academic Year</label>
                                    <input type="date"  value="{{ $settings->academic_year }}" class="form-control form-control-sm" name="academic_year">
                                </div>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        💾 Save
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
 
 
 @endsection
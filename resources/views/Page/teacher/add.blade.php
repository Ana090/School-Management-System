 @extends('layouts.master')
 @section('title')
     Add Teacher
 @endsection
 @section('APP')
     <div class="app-content-header">

         @if (session('success'))
             <script>
                 toastr.success("{{ session('success') }}");
             </script>
         @endif

         @if (session('error'))
             <script>
                 toastr.error("{{ session('error') }}");
             </script>
         @endif
         <!--begin::Container-->
         @if ($errors->any())
             <div class="alert alert-danger">
                 <ul>
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                 </ul>
             </div>

             <script>
                 document.addEventListener("DOMContentLoaded", function() {
                     var myModal = new bootstrap.Modal(document.getElementById('addClassModal'));
                     myModal.show();
                 });
             </script>
         @endif
         <!--end::Container-->
     </div>
     <div class="card card-info card-outline mb-4">
         <!--begin::Header-->
         <div class="card-header">
             <div class="card-title">Form Add Teacher </div>
         </div>
         <!--end::Header-->
         <!--begin::Form-->
         <form class="needs-validation" action="{{ Route('teacher.store') }}" method="POST" enctype="multipart/form-data">
             @csrf
             <!--begin::Body-->
             <div class="card-body">
                 <!--begin::Row-->
                 <div class="row g-3">
                     <!--begin::Col-->
                     <div class="col-md-6">
                         <label for="validationCustom01" class="form-label">Full name</label>
                         <input type="text" class="form-control" id="validationCustom01" required name="Name"
                             value="{{ old('Name') }}" />
                         <div class="valid-feedback">Looks good!</div>
                     </div>
                     <!--end::Col-->
                     <!--begin::Col-->
                     <div class="col-md-6">
                         <label for="validationCustom02" class="form-label">E-mail</label>
                         <input type="email" class="form-control" id="validationCustom02" required name="Email"
                             value="{{ old('Email') }}" />
                         <div class="valid-feedback">Looks good!</div>
                     </div>
                     <!--end::Col-->
                     <!--begin::Col-->
                     <div class="col-md-6">
                         <label for="validationPhone" class="form-label">Phone</label>
                         <div class="input-group has-validation">
                             <span class="input-group-text" id="inputGroupPrepend">+249</span>
                             <input type="number" class="form-control" id="validationPhone"
                                 aria-describedby="inputGroupPrepend" required name="Phone" value="{{ old('Phone') }}" />

                             <div class="invalid-feedback">Please Enter a Phone.</div>
                         </div>
                     </div>
                     <!--end::Col-->
                     <!--begin::Col-->
                     <div class="col-md-6">
                         <label for="validationAddress" class="form-label">Address</label>
                         <input type="text" class="form-control" id="validationAddress" required name="Address"
                             value="{{ old('Address') }}" />
                         <div class="invalid-feedback">Please Enter Address.</div>
                     </div>
                     <!--end::Col-->
                     <!--begin::Col-->

                     <div class="col-md-6">
                         <label for="validationCustom0" class="form-label">Specialization</label>
                         <select class="form-select" id="validationCustom0" required name="Suplation">
                             <option selected disabled value="">Choose...</option>
                             <option value="Maht">Maht</option>
                             <option value="English">English</option>
                             <option value="chemistry">chemistry</option>
                             <option value="physics">physics</option>

                         </select>
                         <div class="invalid-feedback">Please select a Specialization .</div>
                     </div>

                     <div class="col-md-6">
                         <label for="validationCustom04" class="form-label">status</label>
                         <select class="form-select" id="validationCustom04" required name="status">
                             <option selected disabled value="">Choose...</option>
                             <option value="1" style="color: green">Active</option>
                             <option value="2" style="color: rgb(243, 43, 8)">None Active</option>

                         </select>
                         <div class="invalid-feedback">Please select a valid state.</div>
                     </div>
                     <!--end::Col-->
                     <!--begin::Col-->
                     <div class="col-md-6">
                         <label for="validationCustom05" class="form-label">img</label>
                         <input type="file" class="form-control" id="validationCustom05" accept="image/*" name="img"
                             required value="{{ old('img') }}" />
                         <div class="invalid-feedback">Please Choose img.</div>
                     </div>
                     <!--end::Col-->
                     <!--begin::Col-->

                     <!--end::Col-->
                 </div>
                 <!--end::Row-->
             </div>
             <!--end::Body-->
             <!--begin::Footer-->
             <div class="card-footer">
                 <button class="btn btn-info" type="submit">Submit form</button>
             </div>
             <!--end::Footer-->
         </form>
         <!--end::Form-->
         <!--begin::JavaScript-->
         <script>
             // Example starter JavaScript for disabling form submissions if there are invalid fields
             (() => {
                 'use strict';

                 // Fetch all the forms we want to apply custom Bootstrap validation styles to
                 const forms = document.querySelectorAll('.needs-validation');

                 // Loop over them and prevent submission
                 Array.from(forms).forEach((form) => {
                     form.addEventListener(
                         'submit',
                         (event) => {
                             if (!form.checkValidity()) {
                                 event.preventDefault();
                                 event.stopPropagation();
                             }

                             form.classList.add('was-validated');
                         },
                         false,
                     );
                 });
             })();
         </script>
         <!--end::JavaScript-->
     </div>
 @endsection

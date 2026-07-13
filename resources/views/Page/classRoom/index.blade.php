 @extends('layouts.master')
 @section('title')
     Classess
 @endsection
 @section('APP')
     <div class="app-content-header">
         <!--begin::Container-->
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
         <!--end::Container-->
     </div>
     @can('admin')

     <a class="btn btn-primary btn-bg" data-bs-toggle="modal" data-bs-target="#addClassModal">
         Add Class
     </a>
     @endcan
     <br>
     <br>
     {{--  --}}
     <div class="row">
         @foreach ($ClassRooms as $ClassRoom)
             <!-- Card -->
             <div class="col-md-3 col-sm-6 mb-4">
                 <div class="class-card">

                     <!-- Header -->
                     <div class="card-header-custom">
                         <div>
                             <span> {{ $ClassRoom->Name }}</span><br>
                             <small> {{ $ClassRoom->code }}</small>
                         </div>

                         <!-- Actions -->
                                  @can('admin')

                         <div class="card-actions">
                             <button type="button" class="delete-btn" data-toggle="modal"
                                 data-target="#edit{{ $ClassRoom->id }}" title="Delet">
                                 <i class="bi bi-pencil-square"></i>
                             </button>


                             <!-- Button trigger modal -->
                             <button type="button" class="delete-btn" data-toggle="modal"
                                 data-target="#delete{{ $ClassRoom->id }}" title="Delet">
                                 <i class="bi bi-trash"></i>
                             </button>
                         </div>
                         @endcan
                     </div>

                     <!-- Body -->
                     <div class="card-body-custom">

                         <!-- Teacher -->
                         <div class="teacher">
                             <div class="avatar">
                                 {{-- <img src="{{ asset('asset/img/3.jpg') }}" alt="User Avatar" class="avatar" /> --}}
                                 <img src="{{ asset('storage/' . $ClassRoom->Teacher->img) }}" alt="User Avatar"
                                     class="avatar" />
                             </div>
                             <div>
                                 <span class="label">Prof</span>
                                 <div><strong> D/ {{ $ClassRoom->Teacher->Name }} </strong></div>
                                 <small>{{ $ClassRoom->Teacher->Email }}</small>

                             </div>
                         </div>

                         <hr>

                         <!-- Info -->
                         <div class="info">
                             <div>
                                 <span class="label">Level:one</span>
                                 <div>
                                     {{ $ClassRoom->created_at->format('Y-m') }}

                                 </div>
                             </div>
                             <div>
                                 <span class="label"> Student Account:</span>
                                 <div> {{ $studnet }}  Form {{ $ClassRoom->Nu_of_St }}</div>
                             </div>
                         </div>

                         <!-- Progress -->
                         <div class="progress mt-2">
                             <div class="progress-bar" style="width: {{ $studnet }}%"></div>
                         </div>

                         <!-- Status -->
                         <a href="{{ Route('classRoom.show' ,$ClassRoom->id ) }}">
                         <div class="status success">View Student</div>
</a>
                     </div>
                 </div>
             </div>
             {{-- delete --}}

             <div class="modal fade" id="delete{{ $ClassRoom->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                 Delete
                             </h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>
                         <div class="modal-body">
                             <form action="{{ route('classRoom.destroy', 'test') }}" method="post">
                                 {{ method_field('Delete') }}
                                 @csrf
                                 Are you sure? Delete <span style="color: blue"></span>
                                 <input id="id" type="hidden" name="id" class="form-control"
                                     value="{{ $ClassRoom->id }}">
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                     <button type="submit" class="btn btn-danger">submit</button>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
             {{-- end --}}

             {{-- edit --}}
             <div class="modal fade" id="edit{{ $ClassRoom->id }}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                 Edite
                             </h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>
                         <div class="modal-body">
                             <form action="{{ Route('classRoom.update', 'test') }}" method="POST">
                                 @csrf
                                 @method('PATCH')
                                 <!-- اسم الفصل -->
                                 <div class="mb-3">
                                     <label class="form-label"> ClassRoom Name</label>
                                     <input type="text" name="Name" class="form-control" placeholder="First Semester"
                                         value="{{ $ClassRoom->Name }}" required>
                                 </div>
                                 <input type="hidden" value="{{ $ClassRoom->id }}" name="id">
                                 <!-- الكود -->
                                 <div class="mb-3">
                                     <label class="form-label">ClassRoom Code</label>
                                     <input type="text" name="code" class="form-control"
                                         value="{{ $ClassRoom->code }}" readonly>
                                 </div>

                                 <!-- المعلم -->
                                 <div class="mb-3">
                                     <label class="form-label">Teacher</label>
                                     <select class="form-select" name="teacher_id" id="validationCustom0" required>
                                         <option selected disabled value="">{{ $ClassRoom->Teacher->Name }}</option>
                                         @foreach ($Teachers as $Teacher)
                                             <option value="{{ $Teacher->id }}">{{ $Teacher->Name }}</option>
                                         @endforeach
                                     </select>
                                 </div>

                                 <!-- عدد الطلاب -->
                                 <div class="mb-3">
                                     <label class="form-label"> Number of Student </label>
                                     <input type="number" name="Nu_of_St" value="{{ $ClassRoom->Nu_of_St }}"
                                         class="form-control" placeholder=" : 30">
                                 </div>

                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                                 إلغاء
                             </button>
                             <button type="submit" class="btn btn-primary">
                                 حفظ
                             </button>
                         </div>
                         </form>

                     </div>
                 </div>
             </div>
         @endforeach

     </div>
     {{--  --}}



     <!-- Modal add -->
     <div class="modal fade" id="addClassModal" tabindex="-1">
         <div class="modal-dialog">
             <div class="modal-content">

                 <!-- Header -->
                 <div class="modal-header bg-primary text-white">
                     <h5 class="modal-title"> Add Classes </h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 </div>

                 <!-- Body -->
                 <div class="modal-body">
                     <form action="{{ Route('classRoom.store') }}" method="POST">
                         @csrf
                         <!-- اسم الفصل -->
                         <div class="mb-3">
                             <label class="form-label"> ClassRoom Name</label>
                             <input type="text" name="Name" class="form-control" placeholder="First Semester"
                                 required>
                         </div>

                         <!-- الكود -->
                         <div class="mb-3">
                             <label class="form-label">ClassRoom Code</label>
                             <input type="text" name="code" class="form-control" value="CL{{ rand(1000, 9999) }}"
                                 readonly>
                         </div>

                         <!-- المعلم -->
                         <div class="mb-3">
                             <label class="form-label">Teacher</label>
                             <select class="form-select" name="teacher_id" id="validationCustom0" required>
                                 <option selected disabled value="">Choose...</option>
                                 @foreach ($Teachers as $Teacher)
                                     <option value="{{ $Teacher->id }}">{{ $Teacher->Name }}</option>
                                 @endforeach
                             </select>
                         </div>

                         <!-- عدد الطلاب -->
                         <div class="mb-3">
                             <label class="form-label"> Number of Student </label>
                             <input type="number" name="Nu_of_St" class="form-control" placeholder=" : 30">
                         </div>

                 </div>

                 <!-- Footer -->
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                         إلغاء
                     </button>
                     <button type="submit" class="btn btn-primary">
                         حفظ
                     </button>
                 </div>
                 </form>

             </div>
         </div>
     </div>
     {{-- end model --}}
 @endsection

 @extends('layouts.master')
 @section('title')
     Show {{ $teacher->Name }}
 @endsection
 @section('APP')
     <section class="h-100 gradient-custom-2">
         <div class="container py-5 h-100">
             <div class="row d-flex justify-content-center">
                 <div class="col col-lg-9 col-xl-8">
                     <div class="card">
                         <div class="rounded-top text-white d-flex flex-row" style="background-color: #3a52d6; height:200px;">

                             <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">


                                 <img src="{{ asset('storage/' . $teacher->img) }}" class="img-fluid img-thumbnail mt-4 mb-2"
                                     style="width: 150px; z-index: 1">
                                 <button type="button" data-mdb-button-init data-mdb-ripple-init
                                     class="btn btn-outline-info text-body" data-mdb-ripple-color="dark"
                                     style="z-index: 1;">
                                     Edit profile
                                 </button>

                             </div>

                             <div class="ms-3" style="margin-top: 130px;">

                                 <h5>
                                     @if ($teacher->status == 1)
                                         <span class="dot active"></span>
                                     @else
                                         <span class="dot inactive"></span>
                                     @endif{{ $teacher->Name }}
                                 </h5>
                                 <p>{{ $teacher->Email }}</p>
                             </div>
                         </div>
                         <div class="p-4 text-black bg-body-tertiary">
                             <div class="d-flex justify-content-end text-center py-1 text-body">
                                 <div>
                                     <p class="mb-1 h5">{{ $teacher->Suplation }}</p>
                                     <p class="small text-muted mb-0">Specialization</p>
                                 </div>
                                 <div class="px-3">
                                     <p class="mb-1 h5">
                                         {{ $teacher->created_at->format('Y-m') }}
                                     </p>
                                     <p class="small text-muted mb-0">Year Ac</p>
                                 </div>
                                 <div>
                                     <p class="mb-1 h5">22</p>
                                     <p class="small text-muted mb-0">Age</p>
                                 </div>
                             </div>
                         </div>
                         <div class="card-body p-4 text-black">
                             <div class="mb-5  text-body">
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
                                 <p class="lead fw-normal mb-1">About</p>

                                 <form action="{{ Route('teacher.update', 1) }}" method="post">
                                     @csrf
                                     {{ method_field('patch') }}
                                     <input type="hidden" name="id" value="{{ $teacher->id }}">
                                     <div class="form-row">
                                         <div class="col">
                                             <input type="text" class="form-control" placeholder=""
                                                 value="{{ $teacher->Name }}" name="Name">
                                         </div>
                                         <div class="col">
                                             <input type="email" class="form-control" name="Email"
                                                 value="{{ $teacher->Email }}">
                                         </div>
                                         <div class="col">
                                             <input type="text" class="form-control" name="Phone"
                                                 value="{{ $teacher->Phone }}">
                                         </div>
                                         <div class="col">
                                             <input type="text" class="form-control" name="Address"
                                                 value="{{ $teacher->Address }}">
                                         </div>
                                     </div>
                                     <br>
                                     <div class="form-row">
                                         <div class="col">
                                             <select class="form-control" id="validationCustom0" required name="Suplation">
                                                 <option selected disabled value="">{{ $teacher->Suplation }}...
                                                 </option>
                                                 <option value="Maht">Maht</option>
                                                 <option value="English">English</option>
                                                 <option value="chemistry">chemistry</option>
                                                 <option value="physics">physics</option>

                                             </select>

                                         </div>
                                         <div class="col">
                                             <select class="form-control" name="status" id="">
                                                 <option style="color: rgb(0, 255, 0)" value="1">Active</option>
                                                 <option style="color: red" value="2">No Active</option>
                                             </select>
                                         </div>
                                         <div class="col">
                                             <input style="color: #052afa" type="submit" value=" Edit profile"
                                                 class="btn btn-info text-body">



                                         </div>

                                     </div>
                                 </form>
                             </div>
                             <div class="d-flex justify-content-between align-items-center mb-4 text-body">
                                 <p class="lead fw-normal mb-0">Recent photos</p>
                                 <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p>
                             </div>

                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
 @endsection

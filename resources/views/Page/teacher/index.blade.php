 @extends('layouts.master')
 @section('title')
     Teacher List
 @endsection
 @section('APP')
     <br>
     {{-- --------------------------------- --}}
     <a href="{{ Route('teacher.create') }}" class="btn btn-primary btn-sm">
         Add Teacher
     </a>
     <br> <br>




     <div class="row">
         @foreach ($Teachers as $Teacher)
             <div class="col-12 col-sm-6 col-md-3">
                 <div class="info-box"> <a href="{{ Route('teacher.show', $Teacher->id) }}">

                         <span class="info-box-icon text-bg-primary shadow-sm">
                             <img src="{{ asset('storage/' . $Teacher->img) }}" alt="User Avatar"
                                 class="rounded-BOX img-size-40 me-0" />
                         </span>
                     </a>
                     @if ($Teacher->status == 1)
                         <span class="dot active"></span>
                     @else
                         <span class="dot inactive"></span>
                     @endif
                     <div class="info-box-content">
                         {{ $Teacher->Name }}
                         <span class="info-box-text"> </span>
                         <span class="info-box-number">
                             English Teach
                             <small>28Y</small>
                         </span>
                     </div>
                     <!-- /.info-box-content -->
                 </div>
                 <!-- /.info-box -->
             </div>
         @endforeach
     </div>


     <!-- /.col -->
     {{-- --------------------------------- --}}
     <div class="card mb-4">
         <div class="card-header border-0">
             <h3 class="card-title">Teacher</h3>
             <div class="card-tools">

                 <button onclick="downloadTable()"class="btn btn-tool btn-sm">
                     <i class="bi bi-download"></i>
                 </button>
                 <a href="#" class="btn btn-tool btn-sm">
                     <i class="bi bi-list"></i>
                 </a>

             </div>
         </div>
         <div class="card-body table-responsive p-0">

             <table class="table table-striped align-middle">
                 <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th>Name</th>
                         <th>E-mail</th>
                         <th>Phone</th>
                         <th>Address</th>
                         <th>Status</th>
                         <th>Splatction</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($Teachers as $Teacher)
                         <tr>
                             <td>{{ $Teacher->id }}</td>
                             <td>
                                 <img src="{{ asset('storage/' . $Teacher->img) }}" class="rounded-circle img-size-32 me-2">
                                 {{ $Teacher->Name }}
                             </td>
                             <td>{{ $Teacher->Email }}</td>


                             <td>

                                 {{ $Teacher->Phone }}
                             </td>
                             <td>{{ $Teacher->Address }}</td>
                             <td>
                                 @if ($Teacher->status == 1)
                                     <p style="color: green ; "> Active</p>
                                 @else
                                     <p style="color: rgb(250, 53, 4) ; "> No Active</p>
                                 @endif

                             </td>
                             <td>
                                 {{ $Teacher->Suplation }}
                             </td>
                             <td>
                                 <a href="{{ Route('teacher.show', $Teacher->id) }}"
                                     class="btn btn-primary btn-sm">View</a>

                                 <!-- Button trigger modal -->
                                 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                     data-target="#delete{{ $Teacher->id }}" title="Delet">Delet
                                     <i class="fa fa-trash"></i></button>


                             </td>
                         </tr>

                         <!-- delete_modal_Grade -->
                         <div class="modal fade" id="delete{{ $Teacher->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                             id="exampleModalLabel">
                                             Delete
                                         </h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <div class="modal-body">
                                         <form action="{{ route('teacher.destroy', 'test') }}" method="post">
                                             {{ method_field('Delete') }}
                                             @csrf
                                             Are you sure? Delete <span style="color: blue">{{ $Teacher->Name }}</span>
                                             <input id="id" type="hidden" name="id" class="form-control"
                                                 value="{{ $Teacher->id }}">
                                             <div class="modal-footer">
                                                 <button type="button" class="btn btn-secondary"
                                                     data-dismiss="modal">Close</button>
                                                 <button type="submit" class="btn btn-danger">submit</button>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">

         <div class="modal-dialog" role="document">
             <div style="text-align: center" class="modal-content">

                 <div style="background-color: rgb(231, 95, 95)" class="modal-header">
                     <h5 class="modal-title">تأكيد الحذف</h5>

                     <button type="button" class="close" data-dismiss="modal">
                         <span>&times;</span>
                     </button>
                 </div>
                 <h4 id="userName"></h4>
                 <div class="modal-footer">

                     <form id="deleteForm" method="POST">
                         @csrf
                         @method('DELETE')
                         <button type="submit" class="btn btn-danger">
                             حذف
                         </button>
                     </form>

                     <button type="button" class="btn btn-secondary" data-dismiss="modal">
                         إغلاق
                     </button>

                 </div>

             </div>
         </div>
     </div>
 @endsection

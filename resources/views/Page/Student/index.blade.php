 @extends('layouts.master')
 @section('title')
     Students
 @endsection
 @section('APP')
     <div class="app-content-header">
         <!--begin::Container-->
         <div class="container-fluid">
             <!--begin::Row-->
             <div class="row">
                 <div class="col-sm-6">
                 </div>

             </div>
             <!--end::Row-->
         </div>
         <!--end::Container-->
     </div>

     <div class="card mb-4">
        
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
         <div class="card-header border-0">
             <h3 class="card-title">Student List</h3>
             <div class="card-tools">
                 <a href="#" class="btn btn-tool btn-sm">
                     <i class="bi bi-download"></i>
                 </a>
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
                         <th>name</th>
                         <th>Class</th>
                         <th>E-mail</th>
                         <th>Phone</th>
                         <th>ID Number</th>
                         <th>Date</th>
                         <th>Address</th>
                         <th>Processe</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($Students as $Student)
                         <tr>
                             <td>{{ $Student->id }}</td>
                             <td>


                                 <img src="{{ asset('storage/' . $Student->img) }}"alt="User Avatar"
                                     class="rounded-circle img-size-32 me-2" />
                                 {{ $Student->Name }}
                             </td>
                             <td> {{ $Student->ClassRooms->Name }}</td>
                             <td>
                                 {{ $Student->Email }}
                             </td>

                             <td>

                                 {{ $Student->Phone }}
                             </td>
                             <td>
                                 {{ $Student->ID_number }}
                             </td>
                             <td>
                                 {{ $Student->created_at->format('Y-m') }}

                             </td>
                             <td>
                                 {{ $Student->Address }}
                             </td>
                             {{-- <td>
                                 <a href="{{ Route('Student.edit' ,$Student->id ) }}" class="btn btn-primary btn-sm">show</a> --}}
                                 
                                 {{-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                     data-target="#delete{{ $Student->id }}" title="Delet">Delet
                                     <i class="fa fa-trash"></i></button> --}}
                             {{-- </td> --}}
       <td class="text-center">
    <div class="dropdown position-static">
        <button class="btn btn-success btn-sm dropdown-toggle"
                data-bs-toggle="dropdown">
             options
        </button>

        <ul class="dropdown-menu dropdown-menu-end shadow">

            <li>
                <a class="dropdown-item d-flex align-items-center gap-2"
                 href="{{ Route('Student.edit' ,$Student->id ) }}">
                    <ion-icon style="color: rgb(245, 121, 20)" name="create-outline"></ion-icon>
                    edit
                </a>
            </li>

            <li>
                <a class="dropdown-item d-flex align-items-center gap-2" href="#">
                    <ion-icon style="color: blue" name="eye-outline"></ion-icon>
                    view
                </a>
            </li>
 <li>
                <a class="dropdown-item d-flex align-items-center gap-2" 
                href='{{ Route('Invoice.show' ,$Student->id ) }}'>
                   <ion-icon  style="color:green" name="cash-outline"></ion-icon>
                    invoice
                </a>
            </li>
 
            <li>
                <a class="dropdown-item text-danger d-flex align-items-center gap-2"  
                data-toggle="modal"
                                     data-target="#delete{{ $Student->id }}">
                    <ion-icon name="trash-outline"></ion-icon>
                    delete
                </a>
            </li>

        </ul>
    </div>  
</td>
                             </tr>
                          <!-- delete_modal_Grade -->
                         <div class="modal fade" id="delete{{ $Student->id }}" tabindex="-1" role="dialog"
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
                                         <form action="{{ route('Student.destroy', 'test') }}" method="post">
                                             {{ method_field('Delete') }}
                                             @csrf
                                             Are you sure? Delete <span style="color: blue">{{ $Student->Name }}</span>
                                             <input id="id" type="hidden" name="id" class="form-control"
                                                 value="{{ $Student->id }}">
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
     @if(session('print_id'))
<script>
    window.open("{{ url('/invoice/print') }}/{{ session('print_id') }}", "_blank");
</script>
@endif
 @endsection


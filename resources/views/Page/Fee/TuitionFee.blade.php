 @extends('layouts.master')
  @section('title')
     TuitionFee
 @endsection
 @section('APP')
      <div class="app-content-header">
          <!--begin::Container-->
        
          <!--end::Container-->
        </div>
        <div class="container mt-4">

    <!-- 🔍 الفلاتر -->
    <div class="d-flex justify-content-between mb-3 gap-2">
        <input type="text" id="searchInput" class="form-control" placeholder="ابحث عن الرسوم...">

        <select id="classFilter" class="form-select w-auto">
            <option value="all">كل الفصول</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->Name }}</option>
            @endforeach
        </select>

        {{-- <a href="{{ route(' TuitionFee.create') }}" class="btn btn-primary">
            + إضافة رسوم
        </a> --}}
          <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFeeModal">
         Add Tuition Fee
     </a>

    </div>

    <!-- 📊 الجدول -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle" id="feesTable">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>اسم الرسوم</th>
                    <th>المبلغ</th>
                    <th>الفصل</th>
                    <th>السنة</th>
                    <th>التحكم</th>
                </tr>
            </thead>
            <tbody>
                @foreach($TuitionFee as $fee)
                <tr class="fee-row"
                    data-name="{{ strtolower($fee->name) }}"
                    data-class="{{ $fee->class_id }}">
                    
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fee->name }}</td>
                    <td>{{ number_format($fee->amount, 2) }}</td>
                    <td>{{ $fee->classRoom->Name ?? '-' }}</td>
                    <td>{{ $fee->academic_year }}</td>

                    <td>
                        {{-- <a href="{{ route('TuitionFee.edit', $fee->id) }}" class="btn btn-sm btn-warning">تعديل</a> --}}

                        {{-- <form action="{{ route('TuitionFee.destroy', 0) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                           <input type="hidden" name="id" value="{{ $fee->id }}">
                            <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد؟')">
                                حذف
                            </button>
                        </form> --}}
                            <a href="{{ Route('Student.edit' ,$fee->id ) }}" class="btn btn-primary btn-sm">show</a>
                                 {{-- <a class="btn btn-danger btn-sm">Delet</a> --}}
                                 <!-- Button trigger modal -->
                                 <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                     data-target="#delete{{ $fee->id }}" title="Delet">Delet
                                     <i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                 
<!-- delete_modal_Grade -->
                         <div class="modal fade" id="delete{{ $fee->id }}" tabindex="-1" role="dialog"
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
                                         <form action="{{ route('TuitionFee.destroy', 'test') }}" method="post">
                                             {{ method_field('Delete') }}
                                             @csrf
                                             Are you sure? Delete <span style="color: blue">{{ $fee->name }}</span>
                                             <input id="id" type="hidden" name="id" class="form-control"
                                                 value="{{ $fee->id }}">
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

<!-- Modal add Tuition Fee -->
<div class="modal fade" id="addFeeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Add Tuition Fee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <form action="{{ route('TuitionFee.store') }}" method="POST">
                    @csrf

                    <!-- Fee Name -->
                    <div class="mb-3">
                        <label class="form-label">Fee Name</label>
                        <input type="text" name="name" class="form-control"
                               placeholder="e.g. First Semester Fee" required>
                    </div>

                    <!-- Amount -->
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" name="amount" class="form-control"
                               placeholder="500" min="0" required>
                    </div>

                    <!-- Class -->
                    <div class="mb-3">
                        <label class="form-label">Class</label>
                        <select class="form-select" name="class_id" required>
                            <option selected disabled value="">Choose Class</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->Name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Academic Year -->
                    <div class="mb-3">
                        <label class="form-label">Academic Year</label>
                        <input type="text" name="academic_year" class="form-control"
                               value="{{ date('Y') }}" required>
                    </div>

            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-success">
                    Save
                </button>
            </div>
                </form>

        </div>
    </div>
</div>
<!-- End Modal -->
 @endsection
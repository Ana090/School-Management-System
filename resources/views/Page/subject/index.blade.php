 @extends('layouts.master')
  @section('title')
     Subject
 @endsection
 @section('APP')
      <div class="app-content-header">
          <!--begin::Container-->
         
          <!--end::Container-->
        </div>
  
    <!-- 🔍 الفلاتر -->
    <div class="d-flex justify-content-between mb-3 gap-2">
         <a class="btn btn-primary btn-bg" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
         Add Subject
     </a>
        <input type="text" id="searchInput" class="form-control" placeholder="ابحث عن المادة...">

        <select id="classFilter" class="form-select w-auto">
            <option value="all">كل الفصول</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}">{{ $class->Name }}</option>
            @endforeach
        </select>

      
    </div>

    <!-- 📊 الجدول -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle" id="subjectsTable">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>اسم المادة</th>
                    <th>الكود</th>
                    <th>الفصل</th>
                    <th>المعلم</th>
                    <th>التحكم</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr class="subject-row"
                    data-name="{{ strtolower($subject->Name) }}"
                    data-class="{{ $subject->class_id }}">
                    
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $subject->Name }}</td>
                    <td>{{ $subject->code }}</td>
                    <td>{{ $subject->classRoom->Name ?? '-' }}</td>
                    <td>{{ $subject->teacher->Name ?? '-' }}</td>

                    <td>
                        <a href="#" class="btn btn-sm btn-info">عرض</a>
                        <a href="#" class="btn btn-sm btn-warning">تعديل</a>
                        {{-- <form action="#" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">حذف</button>
                        </form> --}}
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                     data-target="#delete{{ $subject->id }}" title="Delet">Delet
                                     <i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <div class="modal fade" id="delete{{ $subject->id }}" tabindex="-1" role="dialog"
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
                                         <form action="{{ route('subject.destroy', 'test') }}" method="post">
                                             {{ method_field('Delete') }}
                                             @csrf
                                             Are you sure? Delete <span style="color: blue">{{ $subject->Name }}</span>
                                             <input id="id" type="hidden" name="id" class="form-control"
                                                 value="{{ $subject->id }}">
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
             <!-- Modal add -->
     <div class="modal fade" id="addSubjectModal" tabindex="-1">
         <div class="modal-dialog">
             <div class="modal-content">

                 <!-- Header -->
                 <div class="modal-header bg-primary text-white">
                     <h5 class="modal-title"> Add Subjects </h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                 </div>

                 <!-- Body -->
                 <div class="modal-body">
                     <form action="{{ Route('subject.store') }}" method="POST">
                         @csrf
                         <!-- اسم الفصل -->
                         <div class="mb-3">
                             <label class="form-label"> Subject Name</label>
                             <input type="text" name="Name" class="form-control" placeholder="First Semester"
                                 required>
                         </div>

                         <!-- الكود -->
                         <div class="mb-3">
                             <label class="form-label">Subject Code</label>
                             <input type="text" name="code" class="form-control" value="SUB{{ rand(1000, 9999) }}"
                                 readonly>
                         </div>
                       <div class="mb-3">
                             <label class="form-label"> Classes</label>
                             <select class="form-select" name="Classes" id="validationCustom0" required>
                                 <option selected disabled value="">Choose...</option>
                                 @foreach ($classes as $Classe)
                                     <option value="{{ $Classe->id }}">{{ $Classe->Name }}</option>
                                 @endforeach
                             </select>
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

    @section('js')

    @endsection
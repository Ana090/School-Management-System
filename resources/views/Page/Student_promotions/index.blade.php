@extends('layouts.master')

@section('title')
سجل تصعيد الطلاب
@endsection

@section('APP')

<div class="app-content-header">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">
                    <i class="fas fa-history text-primary"></i>
                    سجل تصعيد الطلاب
                </h3>
            </div>
        </div>

    </div>
</div>

<div class="app-content">
<div class="container-fluid">

{{-- رسائل --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- أدوات التحكم --}}
<div class="card mb-3">
<div class="card-body">

<form method="GET"
      action="{{ route('Student_promotions.index') }}">

    <div class="row g-2">

        {{-- اسم الطالب --}}
        <div class="col-md-2">
            <input type="text"
                   name="student_name"
                   class="form-control"
                   placeholder="اسم الطالب"
                   value="{{ request('student_name') }}">
        </div>

        {{-- الفصل القديم --}}
        <div class="col-md-2">
            <select name="from_class_id" class="form-select">
                <option value="">الفصل القديم</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}"
                        {{ request('from_class_id') == $class->id ? 'selected' : '' }}>
                        {{ $class->Name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- الفصل الجديد --}}
        <div class="col-md-2">
            <select name="to_class_id" class="form-select">
                <option value="">الفصل الجديد</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}"
                        {{ request('to_class_id') == $class->id ? 'selected' : '' }}>
                        {{ $class->Name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- السنة --}}
        <div class="col-md-2">
            <input type="text"
                   name="academic_year"
                   class="form-control"
                   placeholder="2025-2026"
                   value="{{ request('academic_year') }}">
        </div>

        {{-- التاريخ --}}
        <div class="col-md-2">
            <input type="date"
                   name="date"
                   class="form-control"
                   value="{{ request('date') }}">
        </div>

        {{-- زر البحث --}}
        <div class="col-md-2">
            <button class="btn btn-primary w-100">
                بحث
            </button>
        </div>

    </div>

</form>

</div>
</div>

{{-- أزرار إضافية --}}
<div class="mb-3">

    <a href="{{ route('Student_promotions.index') }}"
       class="btn btn-secondary">

        إعادة تعيين
    </a>

 

</div>

{{-- الجدول --}}
<div class="card">
<div class="card-body table-responsive">

<table id="promotionsTable"
       class="table table-bordered table-hover text-center align-middle">

    <thead class="table-primary">

        <tr>
            <th>#</th>
            <th>اسم الطالب</th>
            <th>الفصل القديم</th>
            <th>الفصل الجديد</th>
            <th>السنة الدراسية</th>
            <th>التاريخ</th>
        </tr>

    </thead>

    <tbody>

        @forelse($promotions as $promotion)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $promotion->student->Name ?? '' }}</td>

                <td>
                    <span class="badge bg-danger">
                        {{ $promotion->fromClass->Name ?? '' }}
                    </span>
                </td>

                <td>
                    <span class="badge bg-success">
                        {{ $promotion->toClass->Name ?? '' }}
                    </span>
                </td>

                <td>
                    <span class="badge bg-info">
                        {{ $promotion->created_at->format('Y-m-d') }}
                    </span>
                </td>

                <td>
                    {{ $promotion->created_at->format('Y-m-d') }}
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="6">
                    لا توجد بيانات
                </td>
            </tr>

        @endforelse

    </tbody>

</table>

</div>
</div>

{{-- Pagination (إذا لم تستخدم DataTables server) --}}
<div class="mt-3">
    {{ $promotions->links() }}
</div>

</div>
</div>

@endsection

{{-- DataTables --}}
@section('js')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    $('#promotionsTable').DataTable({
        pageLength: 10,
        ordering: true,
        searching: true,
        language: {
            search: "بحث:",
            lengthMenu: "عرض _MENU_",
            info: "عرض _START_ إلى _END_ من _TOTAL_",
            paginate: {
                previous: "السابق",
                next: "التالي"
            }
        }
    });

});
</script>

@endsection
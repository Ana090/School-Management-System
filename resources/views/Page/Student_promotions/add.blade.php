@extends('layouts.master')

@section('title')
ترقية الطلاب
@endsection

@section('APP')

<div class="app-content-header">
    <div class="container-fluid">
        <h3>
            <i class="fas fa-level-up-alt text-primary"></i>
            نظام ترقية الطلاب
        </h3>
    </div>
</div>

<div class="app-content">
<div class="container-fluid">

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form method="POST"
      action="{{ route('Student_promotions.store') }}">

@csrf

{{-- الفصل الحالي --}}
<div class="card mb-3">
<div class="card-body">

    <label>الفصل الحالي</label>

    <select name="from_class_id"
            id="from_class_id"
            class="form-select"
            required>

        <option value="">-- اختر الفصل --</option>

        @foreach($Classes as $Class)
            <option value="{{ $Class->id }}">
                {{ $Class->Name }}
            </option>
        @endforeach

    </select>

</div>
</div>

{{-- الفصل الجديد --}}
<div class="card mb-3">
<div class="card-body">

    <label>الفصل الجديد</label>

    <select name="to_class_id"
            class="form-select"
            required>

        <option value="">-- اختر الفصل --</option>

        @foreach($Classes as $Class)
            <option value="{{ $Class->id }}">
                {{ $Class->Name }}
            </option>
        @endforeach

    </select>

</div>
</div>

{{-- أدوات التحكم --}}
<div class="mb-2">

    <button type="button"
            class="btn btn-primary btn-sm"
            id="check_all">

        تحديد الكل

    </button>

    <button type="button"
            class="btn btn-secondary btn-sm"
            id="uncheck_all">

        إلغاء التحديد

    </button>

</div>

{{-- جدول الطلاب --}}
<div class="card">
<div class="card-body table-responsive">

<table class="table table-bordered text-center">

<thead class="table-primary">

<tr>
    <th>
        <input type="checkbox" id="main_check">
    </th>
    <th>#</th>
    <th>اسم الطالب</th>
    <th>الرقم</th>
</tr>

</thead>

<tbody id="students_table">

{{-- Ajax --}}

</tbody>

</table>

</div>
</div>

{{-- زر التنفيذ --}}
<div class="text-center mt-3">

    <button class="btn btn-success px-5">

        تنفيذ الترقية

    </button>

</div>

</form>

</div>
</div>

@endsection

@section('js')

<script>

    // جلب الطلاب عند تغيير الفصل
    $('#from_class_id').on('change', function () {

        let id = $(this).val();

        if (!id) return;

        $.ajax({
            url: "/students-by-class/" + id,
            type: "GET",
            success: function (data) {
                $('#students_table').html(data);
            }
        });

    });

    // تحديد الكل
    $('#check_all').on('click', function () {
        $('.student_checkbox').prop('checked', true);
    });

    // إلغاء التحديد
    $('#uncheck_all').on('click', function () {
        $('.student_checkbox').prop('checked', false);
    });

    // checkbox الرئيسي
    $('#main_check').on('change', function () {
        $('.student_checkbox').prop('checked', this.checked);
    });

</script>

@endsection
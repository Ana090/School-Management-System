@extends('layouts.master')

@section('title')
تقارير حسابات الطلاب
@endsection

@section('APP')

<div class="container-fluid mt-4">

    <!-- عنوان -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">تقارير حسابات الطلاب</h4>
        </div>

        <div class="card-body">

            <!-- فورم البحث -->
            <form method="GET" action="{{ route('student.accounts.report') }}">

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label class="form-label">الطالب</label>
                        <select name="student_id" class="form-select">
                            <option value="">كل الطلاب</option>

                            @foreach($students as $student)
                                <option value="{{ $student->id }}"
                                    {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                   <div class="col-md-3 mb-3">
    <label class="form-label">الفصل الدراسي</label>
    <select name="classroom_id" class="form-select">
        <option value="">كل الفصول</option>

        @foreach($classrooms as $class)
            <option value="{{ $class->id }}"
                {{ request('classroom_id') == $class->id ? 'selected' : '' }}>
                {{ $class->Name }}
            </option>
        @endforeach
    </select>
</div>

<div class="col-md-2 mb-3">
    <label class="form-label">الحالة</label>
    <select name="status" class="form-select">

        <option value="">الكل</option>

        <option value="paid"
            {{ request('status') == 'paid' ? 'selected' : '' }}>
            مدفوع
        </option>
            <option value="paid_partial"
                {{ request('status') == 'paid_partial' ? 'selected' : '' }}>
                مدفوع جزئي
                </option>

        <option value="unpaid"
            {{ request('status') == 'unpaid' ? 'selected' : '' }}>
            غير مدفوع
        </option>

    </select>
</div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label">من تاريخ</label>
                        <input type="date" name="from_date"
                               value="{{ request('from_date') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">إلى تاريخ</label>
                        <input type="date" name="to_date"
                               value="{{ request('to_date') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-3 mb-3 d-flex align-items-end gap-2">
                        <button class="btn btn-primary w-100">بحث</button>

                        <a href="{{ route('student.accounts.report') }}"
                           class="btn btn-secondary w-100">إعادة</a>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <!-- الإحصائيات -->
    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card shadow border-0 bg-success text-white">
                <div class="card-body">
                    <h5>إجمالي المطلوب</h5>
                    <h3>{{ number_format($totalDebit, 2) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0 bg-primary text-white">
                <div class="card-body">
                    <h5>إجمالي المستلم</h5>
                    <h3>{{ number_format($totalCredit, 2) }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0 bg-danger text-white">
                <div class="card-body">
                    <h5>الرصيد المتبقي</h5>
                    <h3>{{ number_format($balance, 2) }}</h3>
                </div>
            </div>
        </div>

    </div>

    <!-- الجدول -->
    <div class="card shadow">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span>كشف حساب الطلاب</span>

            <button onclick="window.print()" class="btn btn-light btn-sm">
                طباعة
            </button>
        </div>

        <div class="card-body table-responsive">

            <!-- 🔥 حقل البحث داخل الجدول -->
            <div class="mb-3">
                <input type="text"
                       id="tableSearch"
                       class="form-control"
                       placeholder="بحث باسم الطالب / النوع / الحالة / الوصف">
            </div>

            <table class="table table-bordered table-hover text-center align-middle" id="accountsTable">

                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>التاريخ</th>
                        <th>الطالب</th>
                        <th>النوع</th>
                        <th>المطلوب</th>
                        <th>المستلم</th>
                        <th>الحالة</th>
                        <th>الوصف</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($accounts as $account)

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $account->date }}</td>

                            <td>{{ $account->student->Name ?? '-' }}</td>

                            <td>
                                <span class="badge bg-primary">
                                    {{ $account->type }}
                                </span>
                            </td>

                            <td class="text-danger fw-bold">
                                {{ number_format($account->debit, 2) }}
                            </td>

                            <td class="text-success fw-bold">
                                {{ number_format($account->credit, 2) }}
                            </td>

                            <td>
                                @if($account->debit == $account->credit)
                                    <span class="badge bg-success">مدفوع</span>
                                @elseif( $account->credit > 0)
                                    <span class="badge bg-warning text-dark "> مدفوع جزئي </span>
                                @else
                                    <span class="badge bg-danger ">غير مدفوع</span>
                                @endif
                            </td>

                            <td>{{ $account->description }}</td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                لا توجد بيانات
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

<!-- 🔥 سكربت البحث داخل الجدول -->
<script>
document.getElementById('tableSearch').addEventListener('keyup', function () {

    let value = this.value.toLowerCase();

    let rows = document.querySelectorAll('#accountsTable tbody tr');

    rows.forEach(row => {

        let text = row.innerText.toLowerCase();

        row.style.display = text.includes(value) ? '' : 'none';

    });

});
</script>

@endsection
@extends('layouts.master')

@section('title')
    empty
@endsection

@section('APP')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"></h3>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            إضافة فاتورة
        </div>

        <div class="card-body">
            <form action="{{ route('Invoice.store') }}" method="POST" onsubmit="return validateForm()">
                @csrf

                <div class="row">

                    <!-- اسم الطالب -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ $student->Name }}" readonly>
                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                    </div>

                    <!-- المبلغ المطلوب -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">المبلغ المطلوب</label>
                        <input type="number" step="0.01" id="amount" name="amount"
                               value="{{ $amount }}" readonly class="form-control">
                    </div>

                    <!-- الفصل -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">الفصل</label>
                        <input type="text" readonly value="{{ $student->ClassRooms->Name }}" class="form-control">
                        <input type="hidden" name="ClassRooms_id" value="{{ $student->ClassRooms->id }}">
                    </div>

                    <!-- النوع -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">النوع</label>
                        <input type="text" name="description" readonly value="{{ $type }}" class="form-control">
                    </div>

                    <!-- المبلغ الكلي -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">المبلغ الكلي للفاتورة</label>
                        <input type="number" step="0.01"
                        name="debit" readonly value="{{ $debit }}" class="form-control">
                    </div>

                    <!-- الدفع -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">دفع</label>
                        <input type="number"
                               step="0.01"
                               name="Amount_paid"
                               id="paid"
                               min="0"
                               max="{{ $amount }}"
                               class="form-control">

                        <small class="text-danger d-none" id="error-msg">
                            المبلغ يجب أن يكون بين 0 و {{ $amount }}
                        </small>
                    </div>

                    <!-- المتبقي -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">المتبقي</label>
                        <input type="text" id="remaining" class="form-control" readonly>
                    </div>

                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">حفظ</button>
                    <button type="reset" class="btn btn-secondary">إلغاء</button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- سكربت الحساب والتحقق -->
<script>
    const paidInput = document.getElementById('paid');
    const remainingInput = document.getElementById('remaining');
    const errorMsg = document.getElementById('error-msg');
    const totalAmount = parseFloat("{{ $amount }}") || 0;

    // حساب المتبقي
    paidInput.addEventListener('input', function () {
        let paid = parseFloat(this.value) || 0;

        if (paid < 0 || paid > totalAmount) {
            errorMsg.classList.remove('d-none');
            remainingInput.value = '';
            return;
        } else {
            errorMsg.classList.add('d-none');
        }

        let remaining = totalAmount - paid;
        remainingInput.value = remaining.toFixed(2);
    });

    // منع الإرسال لو في خطأ
    function validateForm() {
        let paid = parseFloat(paidInput.value) || 0;

        if (paid < 0 || paid > totalAmount) {
            alert("قيمة الدفع غير صحيحة");
            return false;
        }
        return true;
    }
</script>

@endsection
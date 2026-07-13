@extends('layouts.master')

@section('title')
    إضافة طالب
@endsection

@section('APP')
    <div class="app-content-header mb-2">
        @if (session('success'))
            <script>toastr.success("{{ session('success') }}");</script>
        @endif
        @if (session('error'))
            <script>toastr.error("{{ session('error') }}");</script>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger py-1 px-2 mb-2" style="font-size: 0.85rem;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="card card-info card-outline shadow-sm">
        <div class="card-header py-2 bg-light">
            <h3 class="card-title text-primary fw-bold mb-0" style="font-size: 1rem;">
                <i class="fas fa-user-plus me-1"></i> إضافة طالب جديد
            </h3>
        </div>

        <form class="needs-validation" action="{{ Route('Student.store') }}" method="post" novalidate enctype="multipart/form-data">
            @csrf
            <div class="card-body py-3">
                {{-- استخدام row-cols لتوزيع الحقول بشكل مدمج --}}
                <div class="row g-2">
                    
                    {{-- الاسم الكامل --}}
                    <div class="col-md-4">
                        <label for="Name" class="form-label small fw-bold mb-1">الاسم الكامل</label>
                        <input type="text" name="Name" class="form-control form-control-sm" id="Name" required value="{{ old('Name') }}" />
                    </div>

                    {{-- البريد الإلكتروني --}}
                    <div class="col-md-4">
                        <label for="Email" class="form-label small fw-bold mb-1">البريد الإلكتروني</label>
                        <input type="email" name="Email" class="form-control form-control-sm" id="Email" required value="{{ old('Email') }}" />
                    </div>

                    {{-- رقم الهاتف --}}
                    <div class="col-md-4">
                        <label for="Phone" class="form-label small fw-bold mb-1">رقم الهاتف</label>
                        <div class="input-group input-group-sm has-validation">
                            <span class="input-group-text">+249</span>
                            <input type="number" name="Phone" class="form-control form-control-sm" id="Phone" required value="{{ old('Phone') }}" />
                        </div>
                    </div>

                    {{-- تاريخ الميلاد --}}
                    <div class="col-md-3">
                        <label for="Date_of_Birth" class="form-label small fw-bold mb-1">تاريخ الميلاد</label>
                        <input type="date" name="Date_of_Birth" class="form-control form-control-sm" id="Date_of_Birth" required value="{{ old('Date_of_Birth') }}" />
                    </div>

                    {{-- الرقم الوطني --}}
                    <div class="col-md-3">
                        <label for="ID_number" class="form-label small fw-bold mb-1">الرقم الوطني</label>
                        <input type="text" name="ID_number" maxlength="11" pattern="[0-9]{11}" class="form-control form-control-sm" id="ID_number" required value="{{ old('ID_number') }}">
                    </div>

                    {{-- العنوان --}}
                    <div class="col-md-6">
                        <label for="Address" class="form-label small fw-bold mb-1">العنوان</label>
                        <input type="text" name="Address" class="form-control form-control-sm" id="Address" required value="{{ old('Address') }}" />
                    </div>

                    {{-- الفصل الدراسي --}}
                    <div class="col-md-4">
                        <label for="ClassesRoom" class="form-label small fw-bold mb-1">الفصل الدراسي</label>
                        <select name="ClassesRoom" id="ClassesRoom" class="form-select form-select-sm" required>
                            <option value="" selected disabled>اختر...</option>
                            @foreach ($ClassesRooms as $ClassesRoom)
                                <option value="{{ $ClassesRoom->id }}" {{ old('ClassesRoom') == $ClassesRoom->id ? 'selected' : '' }}>
                                    {{ $ClassesRoom->Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- المبلغ المطلوب --}}
                    <div class="col-md-4">
                        <label for="amount_id" class="form-label small fw-bold mb-1">المبلغ المطلوب</label>
                        <select name="amount_id" id="amount_id" class="form-select form-select-sm" required>
                            {{-- <option value="" selected disabled>اختر الفصل...</option> --}}
                        </select>
                    </div>

                    {{-- المبلغ المدفوع --}}
                  

                     <div class="col-md-4">
                        <label for="Amount_paid" class="form-label small fw-bold mb-1">المبلغ المدفوع</label>
                        <div class="input-group input-group-sm">
                            <input type="number" name="Amount_paid" id="Amount_paid" class="form-control form-control-sm" required value="{{ old('Amount_paid') }}" min="0" />
                            <span class="input-group-text">SDG</span>
                            <div class="invalid-feedback" id="Amount_paid_feedback">الرجاء إدخال مبلغ مدفوع صحيح.</div>
                        </div>
                    </div>

                    {{-- صورة الطالب --}}
                    <div class="col-md-12">
                        <label for="img" class="form-label small fw-bold mb-1">صورة الطالب</label>
                        <input type="file" name="img" class="form-control form-control-sm" id="img" accept="image/*" required />
                    </div>
                </div>
            </div>

            <div class="card-footer py-2 bg-light text-end">
                <button type="reset" class="btn btn-sm btn-secondary px-3 me-1">إلغاء</button>
                <button type="submit" class="btn btn-sm btn-primary px-4">
                    <i class="fas fa-save me-1"></i> حفظ البيانات
                </button>
            </div>
        </form>
    </div>
@endsection
 @section('js')
<script>
    $(document).ready(function () {
        let requiredAmount = 0;

        // التحقق من صحة النموذج عند الإرسال
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach((form) => {
                form.addEventListener('submit', (event) => {
                    if (!form.checkValidity() || !validateAmountPaid()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();

        // AJAX لجلب المبالغ عند تغيير الفصل
        var getAmountUrl = "{{ URL::to('get_amount_id') }}";
        $("select[name='ClassesRoom']").on('change', function () {
            var ClassRoomId = $(this).val();
            var $amountSelect = $("select[name='amount_id']");
            if (ClassRoomId) {
                $amountSelect.empty().append('<option value="" selected disabled>جاري التحميل...</option>');
                $.ajax({
                    url: getAmountUrl + "/" + ClassRoomId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $amountSelect.empty().append('<option value="" selected disabled>اختر المبلغ</option>');
                        $.each(data, function (key, value) {
                            $amountSelect.append('<option value="' + key + '">' + value + '</option>');
                        });
                        requiredAmount = 0;
                        $('#Amount_paid').val('').removeClass('is-invalid is-valid');
                    },
                    error: function () {
                        $amountSelect.empty().append('<option value="" selected disabled>خطأ في  !</option>');
                    }
                });
            }
        });

        // تحديث المبلغ المطلوب عند الاختيار
        $("select[name='amount_id']").on('change', function () {
            requiredAmount = parseFloat($(this).find('option:selected').text()) || 0;
            validateAmountPaid();
        });

        // التحقق الفوري عند الكتابة
        $('#Amount_paid').on('input', function () {
            validateAmountPaid();
        });

        function validateAmountPaid() {
            const amountPaidInput = $('#Amount_paid');
            const amountPaid = parseFloat(amountPaidInput.val());
            const feedbackElement = $('#Amount_paid_feedback');

            amountPaidInput.removeClass('is-invalid is-valid');

            if (isNaN(amountPaid) || amountPaid < 0) {
                amountPaidInput.addClass('is-invalid');
                feedbackElement.text('المبلغ المدفوع يجب أن يكون رقماً موجباً.');
                return false;
            }

            if (requiredAmount > 0 && amountPaid > requiredAmount) {
                amountPaidInput.addClass('is-invalid');
                feedbackElement.text('المبلغ المدفوع لا يمكن أن يتجاوز ' + requiredAmount + ' SDG.');
                return false;
            }

            amountPaidInput.addClass('is-valid');
            return true;
        }
    });
</script>
@endsection
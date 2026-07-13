@extends('layouts.master')

@section('title')
    الفواتير
@endsection

@section('APP')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">الفواتير</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">الرئيسية</a></li>
                    <li class="breadcrumb-item active">الفواتير</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- بداية المحتوى -->
<div class="container-fluid mt-4">

    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">قائمة الفواتير</h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>رقم الفاتورة</th>
                        <th>Sutdent Name</th>
                        <th>type</th>
                        <th>Class Room</th>
                        <th>تاريخ الفاتورة</th>
                        <th>المبلغ الكلي</th>
                        <th>المبلغ المدفوع</th>
                        <th>المتبقي</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($invoices as $invoice)

                        @php
                            if ($invoice->Amount_paid == $invoice->amount) {
                                $status = 'مدفوعة';
                                $class = 'success';
                            } elseif ($invoice->Amount_paid > 0 && $invoice->Amount_paid < $invoice->amount) {
                                $status = 'مدفوعة جزئياً';
                                $class = 'warning';
                            } else {
                                $status = 'غير مدفوعة';
                                $class = 'danger';
                            }
                        @endphp

                        <tr>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->invoice_number }}</td>
                            <td>{{ $invoice->student->Name }}</td>
                            <td>{{ $invoice->description }}</td>
                             <td>{{ $invoice->ClassRoom->Name }}</td>
                            <td>{{ $invoice->invoice_date }}</td>
                            <td>{{ number_format($invoice->amount, 2) }}</td>
                            <td>{{ number_format($invoice->Amount_paid, 2) }}</td>
                             <td>
                                {{number_format($invoice->amount - $invoice->Amount_paid, 2) }}
                             </td>
                            <td>
                                <span class="badge bg-{{ $class }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('invoice.print', $invoice->id) }}" class="btn btn-sm btn-primary">طباعة</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>
<!-- نهاية المحتوى -->

@endsection
@extends('layouts.master')

@section('title')
    Dashbord
@endsection

 @php
use App\Models\Students\student;
use App\Models\Invoice\Invoice;

$studentsCount = student::count();

$paidInvoices = Invoice::whereColumn('Amount_paid', 'amount')->count();

$partialInvoices = Invoice::where('Amount_paid', '>', 0)
                          ->whereColumn('Amount_paid', '<', 'amount')
                          ->count();

$unpaidInvoices = Invoice::where('Amount_paid', 0)->count();

$totalInvoices = Invoice::count();

$paidPercentage = $totalInvoices > 0
    ? round(($paidInvoices / $totalInvoices) * 100)
    : 0;
@endphp

@section('APP')

<br>

<div class="row">

    <!-- عدد الطلاب -->
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-primary">
            <div class="inner">
                <h3>{{ $studentsCount }}</h3>
                <p>عدد الطلاب</p>
            </div>

            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25z"/>
            </svg>

            <a href="#" class="small-box-footer">
                More info <i class="bi bi-link-45deg"></i>
            </a>
        </div>
    </div>

    <!-- الفواتير المدفوعة -->
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-success">
            <div class="inner">
                <h3>{{ $paidPercentage }}<sup class="fs-5">%</sup></h3>
                <p>الفواتير المدفوعة</p>
            </div>

            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                <path d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75z"/>
            </svg>

            <a href="#" class="small-box-footer">
                More info <i class="bi bi-link-45deg"></i>
            </a>
        </div>
    </div>

    <!-- المدفوعة جزئياً -->
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-warning">
            <div class="inner">
                <h3>{{ $partialInvoices }}</h3>
                <p>الفواتير المدفوعة جزئياً</p>
            </div>

            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0z"/>
            </svg>

            <a href="#" class="small-box-footer">
                More info <i class="bi bi-link-45deg"></i>
            </a>
        </div>
    </div>

    <!-- غير المدفوعة -->
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-danger">
            <div class="inner">
                <h3>{{ $unpaidInvoices }}</h3>
                <p>الفواتير غير المدفوعة</p>
            </div>

            <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                <path d="M2.25 13.5a8.25 8.25 0 018.25-8.25"/>
            </svg>

            <a href="#" class="small-box-footer">
                More info <i class="bi bi-link-45deg"></i>
            </a>
        </div>
    </div>

</div>

@endsection
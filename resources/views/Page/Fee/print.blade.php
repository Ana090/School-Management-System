@extends('layouts.master')

@section('title')
    فاتورة رقم {{ $invoice->invoice_number }}
@endsection

@section('APP')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">

<style>

    @page {
        size: A4;
        margin: 10mm;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    

    /* ── SCREEN WRAPPER ── */
    .page-wrap {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 30px 16px 50px;
    }

    .actions-bar {
        display: flex;
        gap: 10px;
        margin-bottom: 18px;
        width: 100%;
        max-width: 860px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 20px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-family: 'Tajawal', sans-serif;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: opacity .2s;
    }
    .btn:hover { opacity: .85; }
    .btn-print { background: #2563a8; color: #fff; }
    .btn-back  { background: #fff; color: #444; border: 1px solid #ccc; }

    /* ── INVOICE PAPER ── */
    .invoice {
        width: 100%;
        max-width: 860px;
        background: #fff;
        border: 1px solid #bbb;
        box-shadow: 0 4px 24px rgba(0,0,0,.18);
    }

    /* ════ HEADER ════ */
    .inv-header {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        align-items: stretch;
        border-bottom: 3px double #555;
        min-height: 110px;
    }

    .hd-right {
        border-left: 1px solid #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 18px 24px;
    }
    .hd-title {
        font-size: 26px;
        font-weight: 800;
        color: #111;
        border: 2px solid #333;
        padding: 8px 28px;
        letter-spacing: 2px;
    }

    .hd-center {
        text-align: center;
        padding: 16px 30px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 2px;
    }
    .hd-center .co-name {
        font-size: 17px;
        font-weight: 800;
        color: #111;
        margin-bottom: 4px;
    }
    .hd-center p {
        font-size: 12px;
        color: #444;
        line-height: 1.7;
    }

    .hd-left {
        border-right: 1px solid #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 18px 24px;
    }
    .logo-box {
        width: 130px;
        height: 70px;
        border: 1.5px solid #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        color: #999;
    }
    .logo-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    /* ════ META ════ */
    .inv-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        border-bottom: 1px solid #ccc;
    }

    .meta-block { padding: 16px 22px; }
    .meta-block:first-child { border-left: 1px solid #ccc; }

    .meta-block-title {
        font-size: 13px;
        font-weight: 700;
        color: #111;
        margin-bottom: 10px;
        padding-bottom: 6px;
        border-bottom: 1px solid #e0e0e0;
    }

    .meta-pair {
        display: flex;
        justify-content: space-between;
        padding: 3.5px 0;
        font-size: 12.5px;
        color: #333;
        gap: 10px;
    }
    .meta-pair .lbl { color: #666; font-weight: 500; }
    .meta-pair .val { font-weight: 600; color: #111; }

    .client-box {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 10px 14px;
        margin-top: 6px;
        background: #fafafa;
        font-size: 12.5px;
        line-height: 2;
        color: #333;
    }

    /* ════ TABLE ════ */
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    table thead tr th {
        background: #efefef;
        border: 1px solid #bbb;
        padding: 9px 12px;
        text-align: center;
        font-weight: 700;
        color: #222;
        font-size: 12.5px;
    }

    table tbody tr td {
        border: 1px solid #ccc;
        padding: 9px 12px;
        text-align: center;
        color: #333;
        vertical-align: middle;
    }

    /* ════ BOTTOM: NOTES + TOTALS ════ */
    .bottom-area {
        display: grid;
        grid-template-columns: 1fr auto;
        border-top: 1px solid #ccc;
    }

    .notes-block {
        padding: 16px 22px;
        border-left: 1px solid #ccc;
    }
    .notes-label {
        font-size: 11.5px;
        color: #888;
        margin-bottom: 8px;
        font-weight: 600;
        text-align: left;
    }
    .notes-area {
        border: 1px solid #ddd;
        border-radius: 3px;
        min-height: 56px;
        padding: 8px 12px;
        background: #fafafa;
        font-size: 12px;
        color: #555;
    }

    .totals-block {
        padding: 14px 22px;
        min-width: 300px;
    }
    .tot-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5.5px 0;
        font-size: 13px;
        border-bottom: 1px solid #eee;
        gap: 30px;
    }
    .tot-row:last-child { border-bottom: none; }
    .tot-row .t-lbl { color: #555; font-weight: 600; }
    .tot-row .t-val { font-weight: 600; color: #222; }
    .tot-row.total-final {
        margin-top: 6px;
        padding-top: 8px;
        border-top: 2px solid #333;
        border-bottom: none;
    }
    .tot-row.total-final .t-lbl,
    .tot-row.total-final .t-val { font-weight: 800; font-size: 14px; color: #111; }

    /* ════ SIGNATURES ════ */
    .sig-section {
        border-top: 1px solid #ccc;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        text-align: center;
    }

    .sig-cell {
        padding: 18px 20px;
        border-left: 1px solid #ccc;
    }
    .sig-cell:last-child { border-left: none; }

    .sig-title {
        font-size: 12px;
        font-weight: 700;
        color: #333;
        margin-bottom: 12px;
    }
    .sig-line-area {
        height: 54px;
        border: 1px dashed #bbb;
        background: #fafafa;
        margin-bottom: 8px;
        position: relative;
    }
    .sig-line-area span {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        color: #ccc;
    }
    .sig-name-line {
        width: 70%;
        height: 1px;
        background: #666;
        margin: 0 auto 5px;
    }
    .sig-name-text { font-size: 11.5px; color: #555; font-weight: 500; }

    /* ════ FOOTER ════ */
    .inv-footer {
        border-top: 1px solid #ccc;
        background: #f7f7f7;
        padding: 9px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 11px;
        color: #888;
    }

    /* ════ PRINT ════ */
    @media print {
        body       { background: #fff !important; }
        .page-wrap { padding: 0 !important; background: none !important; }
        .actions-bar { display: none !important; }
        .invoice   { box-shadow: none !important; max-width: 100% !important; }
        .sig-line-area, .notes-area { background: #fff !important; }
        thead { display: table-header-group; }
        tr    { page-break-inside: avoid; }
        .sig-section, .bottom-area { page-break-inside: avoid; }
        .inv-footer { position: fixed; bottom: 0; left: 0; right: 0; }
    }
</style>

<div class="page-wrap">

    {{-- Action Bar --}}
    <div class="actions-bar">
        <button class="btn btn-print" onclick="window.print()">🖨️ طباعة الفاتورة</button>
        <a href="{{ route('Student.index') }}" class="btn btn-back">← رجوع</a>
    </div>

    <div class="invoice">

        {{-- ══════════ HEADER ══════════ --}}
        <div class="inv-header">

            <div class="hd-right">
                <div class="hd-title">فاتورة</div>
            </div>

            <div class="hd-center">
                <div class="co-name">{{ $setting->school_name ?? 'مدرسة المثال' }}</div>
                @if(!empty($setting->tax_number))
                    <p>الرقم الضريبي: {{ $setting->tax_number }}</p>
                @endif
                <p>{{ $setting->address ?? 'الخرطوم — السودان' }}</p>
                <p>{{ $setting->phone ?? '+249 912 345 678' }}</p>
                @if(!empty($setting->email))
                    <p>{{ $setting->email }}</p>
                @endif
            </div>

            <div class="hd-left">
                <div class="logo-box">
                         <img src="{{ asset('storage/' . $setting->img) }}" alt="logo">
      
                     
                </div>
            </div>

        </div>

        {{-- ══════════ META ══════════ --}}
        <div class="inv-meta">

            <div class="meta-block">
                <div class="meta-block-title">بيانات الفاتورة</div>
                <div class="meta-pair">
                    <span class="lbl">رقم الفاتورة</span>
                    <span class="val">#{{ $invoice->invoice_number }}</span>
                </div>
                <div class="meta-pair">
                    <span class="lbl">تاريخ الإصدار</span>
                    <span class="val">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d / m / Y') }}</span>
                </div>
                <div class="meta-pair">
                    <span class="lbl">الفصل الدراسي</span>
                    <span class="val">{{ $invoice->semester->name ?? '—' }}</span>
                </div>
                <div class="meta-pair">
                    <span class="lbl">الحالة</span>
                    <span class="val">
                        @if($invoice->amount - $invoice->Amount_paid <= 0)
                            مسدد بالكامل
                        @elseif($invoice->Amount_paid > 0)
                            مدفوع جزئياً
                        @else
                            غير مدفوع
                        @endif
                    </span>
                </div>
            </div>

            <div class="meta-block">
                <div class="meta-block-title">فاتورة إلى:</div>
                <div class="client-box">
                    <strong>{{ $invoice->student->Name ?? '—' }}</strong><br>
                    الصف: {{ $invoice->classRoom->Name ?? '—' }}<br>
                    @if(!empty($invoice->student->student_number))
                        رقم الطالب: {{ $invoice->student->student_number }}<br>
                    @endif
                    @if(!empty($invoice->student->phone))
                        الهاتف: {{ $invoice->student->phone }}
                    @endif
                </div>
            </div>

        </div>

        {{-- ══════════ TABLE ══════════ --}}
        <table>
            <thead>
                <tr>
                    <th style="width:44px">#</th>
                    <th>الوصف / البيان</th>
                    <th style="width:130px">الإجمالي الأصلي</th>
                    <th style="width:115px">المدفوع</th>
                    <th style="width:115px">المتبقي</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td style="text-align:right; padding-right:18px;">
                        رسوم دراسية — {{ $invoice->classRoom->Name ?? '' }}
                    </td>
                    <td>{{ number_format($invoice->amount, 2) }}</td>
                    <td style="color:#1a7a4e; font-weight:700;">
                        {{ number_format($invoice->Amount_paid, 2) }}
                    </td>
                    <td style="color:{{ ($invoice->amount - $invoice->Amount_paid) > 0 ? '#b83535' : '#1a7a4e' }}; font-weight:700;">
                        {{ number_format(max(0, $invoice->amount - $invoice->Amount_paid), 2) }}
                    </td>
                </tr>
                {{-- صف فارغ للمساحة --}}
                <tr>
                    <td colspan="5" style="height:28px; border:1px solid #ccc;"></td>
                </tr>
            </tbody>
        </table>

        {{-- ══════════ NOTES + TOTALS ══════════ --}}
        <div class="bottom-area">

            <div class="notes-block">
                <div class="notes-label">ملاحظات الفاتورة</div>
                <div class="notes-area">{{ $invoice->notes ?? '' }}</div>
            </div>

            <div class="totals-block">
                <div class="tot-row">
                    <span class="t-lbl">الإجمالي</span>
                    <span class="t-val">{{ number_format($invoice->amount, 2) }}</span>
                </div>
                <div class="tot-row">
                    <span class="t-lbl">مدفوع</span>
                    <span class="t-val" style="color:#1a7a4e;">
                        {{ number_format($invoice->Amount_paid, 2) }}
                    </span>
                </div>
                <div class="tot-row total-final">
                    <span class="t-lbl">الرصيد المستحق</span>
                    <span class="t-val" style="color:{{ ($invoice->amount - $invoice->Amount_paid) > 0 ? '#b83535' : '#1a7a4e' }};">
                        {{ number_format(max(0, $invoice->amount - $invoice->Amount_paid), 2) }}
                    </span>
                </div>
            </div>

        </div>

        {{-- ══════════ SIGNATURES ══════════ --}}
        <div class="sig-section">

            <div class="sig-cell">
                <div class="sig-title">المحاسب</div>
                <div class="sig-line-area"><span>التوقيع</span></div>
                <div class="sig-name-line"></div>
                <div class="sig-name-text">اسم المحاسب</div>
            </div>

            <div class="sig-cell">
                <div class="sig-title">مدير المدرسة</div>
                <div class="sig-line-area"><span>التوقيع</span></div>
                <div class="sig-name-line"></div>
                <div class="sig-name-text">{{ $setting->principal_name ?? 'اسم المدير' }}</div>
            </div>

            <div class="sig-cell">
                <div class="sig-title">ولي الأمر / الطالب</div>
                <div class="sig-line-area"><span>التوقيع</span></div>
                <div class="sig-name-line"></div>
                <div class="sig-name-text">{{ $invoice->student->Name ?? 'اسم ولي الأمر' }}</div>
            </div>

        </div>

        {{-- ══════════ FOOTER ══════════ --}}
        <div class="inv-footer">
            <span>هذه فاتورة رسمية معتمدة من إدارة المدرسة</span>
            <span>تاريخ الطباعة: {{ now()->format('d/m/Y — H:i') }}</span>
        </div>

    </div>

</div>

<script>
    window.onload = function () {
        window.print();
    }
</script>

@endsection

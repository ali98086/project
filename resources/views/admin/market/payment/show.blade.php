@extends('admin.layouts.master')


@section('title','نمایش پرداخت')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#">پرداخت ها</a></li>
        <li class="breadcrumb-item active" aria-current="page"> نمایش پرداخت </li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    نمایش پرداخت 
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.payment.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="card">

                <section class="card-header ">

                    <h6 class="mb-0">مشخصات پرداخت</h6>

                </section>
                <section class="card-body">


                    <p class="mb-2 date">کد تراکنش : {{$payment->paymentable->transaction_id ?? '_'}}</p>
                    <p class="mb-2">پرداخت کننده : {{$payment->user->full_name}}</p>
                    <p class="mb-2 date">مبلغ : {{number_format($payment->paymentable->amount_price)}} تومان</p>
                    <p class="mb-2">بانک : {{$payment->paymentable->gateway ?? '_'}}</p>
                    <p class="mb-2">وضعیت پرداخت : @if($payment->status == 0) پرداخت نشده @elseif($payment->status == 1) پرداخت شده @elseif($payment->status == 2) باطل شده @else برگشت داده شده @endif</p>
                    <p class="mb-2">نوع پرداخت : @if($payment->type == 0) آنلاین @elseif($payment->type == 1) آفلاین @else در محل @endif</p>
                    <p class="mb-2 date">تاریخ پرداخت : @if($payment->type == 0) {{jdate($payment->paymentable->created_at)->format('H:i:s d-m-Y')}} @else {{jdate($payment->paymentable->pay_date)->format('H:i:s d-m-Y')}}  @endif</p>

                    @if($payment->type == 2)

                    <p class="mb-2">گیرنده هزینه : {{$payment->paymentable->receiver_name}}</p>

                    @endif

                </section>

            </section>

        </section>
    </section>
</section>

@endsection


@section('script')

<script>
    var arabicNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $('.date').text(function(i, v) {
        var chars = v.split('');
        for (var i = 0; i < chars.length; i++) {
            if (/\d/.test(chars[i])) {
                chars[i] = arabicNumbers[chars[i]];
            }
        }
        return chars.join('');
    })
</script>

@endsection
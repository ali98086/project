@extends('admin.layouts.master')


@section('title','پرداخت های در محل')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#">پرداخت ها</a></li>
        <li class="breadcrumb-item active" aria-current="page"> پرداخت های در محل</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    پرداخت های در محل
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="#" class="btn btn-primary btn-sm disabled" aria-disabled="true">ایجاد پرداخت جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover ">
                    <thead>

                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">پرداخت کننده</th>
                            <th class="text-center width-16-rem">وضعیت پرداخت</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cashPayments as $key=>$cashPayment)
                        <tr>
                            <th class="text-center">{{++$key}}</th>
                            <td class="text-center">{{$cashPayment->user->full_name}}</td>
                            <td class="text-center">@if($cashPayment->status == 0) پرداخت نشده @elseif($cashPayment->status == 1) پرداخت شده @elseif($cashPayment->status == 2) باطل شده @else برگشت داده شده @endif</td>
                            <td class="text-center w-25">

                                <a href="{{route('admin.market.payment.show', $cashPayment->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> مشاهده</a>
                                <a href="{{route('admin.market.payment.canceled', $cashPayment->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-window-close"></i> باطل کردن</a>
                                <a href="{{route('admin.market.payment.returned', $cashPayment->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> برگرداندن</a>

                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>

@endsection
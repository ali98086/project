@extends('admin.layouts.master')


@section('title','تمام سفارشات')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#">سفارشات</a></li>
        <li class="breadcrumb-item active" aria-current="page"> تمام سفارشات</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                تمام سفارشات
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="#" class="btn btn-primary btn-sm disabled" aria-disabled="true">ایجاد سفارش جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                        <th class="text-center width-16-rem">کد سفارش</th>
                            <th class="text-center width-16-rem"> مبلغ سفارش (بدون تخفیف)</th>
                            <th class="text-center width-16-rem"> میزان تخفیف سفارش</th>
                            <th class="text-center width-16-rem">مجموع تخفیف محصولات</th>
                            <th class="text-center width-16-rem">مبلغ نهایی</th>
                            <th class="text-center width-16-rem">وضعیت پرداخت</th>
                            <th class="text-center width-16-rem">شیوه پرداخت</th>
                            <th class="text-center width-16-rem">بانک</th>
                            <th class="text-center width-16-rem">وضعیت ارسال</th>
                            <th class="text-center width-16-rem">شیوه ارسال</th>
                            <th class="text-center width-16-rem">وضعیت سفارش</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody class="h-150px">

                    @foreach($orders as $order)
                        <tr>

                            <td class="text-center">{{$order->id}}</td>

                            <td class="text-center">{{number_format($order->order_final_amount)}} تومان</td>

                            <td class="text-center">{{number_format($order->order_discount_amount)}} تومان</td>

                            <td class="text-center">{{number_format($order->order_total_products_discount_amount)}} تومان</td>

                            <td class="text-center">{{number_format($order->order_final_amount - $order->order_discount_amount)}} تومان</td>

                            <td class="text-center">@if($order->payment_status == 0) پرداخت نشده  @elseif($order->payment_status == 1) پرداخت شده  @elseif($order->payment_status == 2) باطل شده  @else برگشت داده شده @endif</td>

                            <td class="text-center">@if($order->payment_type == 0) آنلاین  @elseif($order->payment_type == 1) آفلاین  @else در محل @endif</td>

                            <td class="text-center">{{$order->payment->paymentable->gateway ?? '_'}}</td>

                            <td class="text-center">@if($order->delivery_status == 0) ارسال نشده  @elseif($order->delivery_status == 1) در حال ارسال  @elseif($order->delivery_status == 2) ارسال شده  @else تحویل شده @endif</td>

                            <td class="text-center">{{$order->delivery->name}}</td>

                            <td class="text-center">@if($order->order_status == 0) در انتظار تایید  @elseif ($order->order_status == 1)  تایید نشده @elseif ($order->order_status == 2) تایید شده @elseif ($order->order_status == 3) باطل شده @elseif($order->order_status == 4) مرجوع شده @else بررسی نشده @endif</td>

                            <td>
                                <section class="dropdown text-center">
                                     <a href="#" class="btn btn-success btn-sm dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-wrench" aria-hidden="true"></i>
                                        عملیات
                                    </a> 

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="{{route('admin.market.order.seeFactor', $order->id)}}"><i class="fa fa-images" aria-hidden="true"></i> مشاهده فاکتور</a></li>
                                        <li><a class="dropdown-item" href="{{route('admin.market.order.changeStatusSend', $order->id)}}"><i class="fa fa-list-ul" aria-hidden="true"></i> تغییر وضعیت ارسال</a></li>
                                        <li><a class="dropdown-item" href="{{route('admin.market.order.changeStatusOrder', $order->id)}}"><i class="fa fa-edit" aria-hidden="true"></i> تغییر وضعیت سفارش</a></li>
                                        <li><a class="dropdown-item" href="{{route('admin.market.order.invalidOrder', $order->id)}}"><i class="fa fa-window-close" aria-hidden="true"></i> باطل کردن سفارش</a></li>
                                    </ul>

                                </section>                              

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
@extends('customer.layouts.master-two-col')


@section('title')

تاریخچه سفارشات

@endsection


@section('content')

<section>
    <section id="main-body-two-col" class="container-xxl body-container">
        <section class="row">

            @include('customer.layouts.partials.profile-sidebar')


            <section class="content-wrapper bg-white p-3 rounded-2 mb-3 w-50">

                <!-- start vontent header -->
                <section class="content-header">
                    <section class="d-flex justify-content-between align-items-center">
                        <h2 class="content-header-title">
                            <span>تاریخچه سفارشات</span>
                        </h2>
                        <section class="content-header-link">
                            <!--<a href="#">مشاهده همه</a>-->
                        </section>
                    </section>
                </section>
                <!-- end vontent header -->


                <section class="d-flex justify-content-center my-4">
                    <a class="btn btn-outline-primary btn-sm mx-1" href="{{route('customer.profileOrder.index')}}">همه</a>
                    <a class="btn btn-info btn-sm mx-1" href="{{route('customer.profileOrder.index' , 'type=0')}}">منتظر تایید</a>
                    <a class="btn btn-warning btn-sm mx-1" href="{{route('customer.profileOrder.index' , 'type=1')}}">تایید نشده</a>
                    <a class="btn btn-success btn-sm mx-1" href="{{route('customer.profileOrder.index' , 'type=2')}}">تایید شده</a>
                    <a class="btn btn-dark btn-sm mx-1" href="{{route('customer.profileOrder.index' , 'type=3')}}">لغو شده</a>
                    <a class="btn btn-danger btn-sm mx-1" href="{{route('customer.profileOrder.index' , 'type=4')}}">مرجوعی</a>
                    <a class="btn btn-outline-danger btn-sm mx-1" href="{{route('customer.profileOrder.index' , 'type=5')}}">بررسی نشده</a>

                </section>



                <section class="order-wrapper">

                    @forelse($orders as $order)

                    <section class="order-item">
                        <section class="d-flex justify-content-between">
                            <section>
                                <section class="order-item-date date"><i class="fa fa-calendar-alt"></i> {{Morilog\Jalali\Jalalian::forge($order->created_at)->format('H:i:s Y-m-d')}}</section>
                                <section class="order-item-id code"><i class="fa fa-id-card-alt"></i>کد سفارش : {{$order->id}}</section>
                                <section class="order-item-status"><i class="fa fa-clock"></i> {{$order->paymentStatus()}}</section>
                                <section class="order-item-products">

                                    @foreach($order->orderItems as $orderItem)

                                    <a><img src="{{asset($orderItem->product->image)}}" width="50px" height="50px" alt=""></a>

                                    @forelse($orderItem->product->images as $image)

                                    <a><img src="{{asset($image->image)}}" width="50px" height="50px" alt=""></a>

                                    @empty

                                    @endforelse

                                    @endforeach



                                </section>
                            </section>
                            <section class="order-item-link"><a href="#">پرداخت سفارش</a></section>
                        </section>
                    </section>

                    @empty

                    <section>
                        <p>سفارشی یافت نشد.</p>
                    </section>

                    @endforelse

                </section>


            </section>
        </section>
    </section>
</section>
<!-- end body -->


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

    $('.code').text(function(i, v) {
        var chars = v.split('');
        for (var i = 0; i < chars.length; i++) {
            if (/\d/.test(chars[i])) {
                chars[i] = arabicNumbers[chars[i]];
            }
        }
        return chars.join('');
    })
    $('.price').text(function(i, v) {
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
@extends('customer.layouts.master-two-col')

@section('title')

انتخاب نوع پرداخت

@endsection



@section('content')


<section class="mb-4">
    <section class="container-xxl">
        <section class="row">
            <section class="col">

                @if(session('copan-null'))

                <p class="alert alert-danger">{{session('copan-null')}}</p>

                @elseif(session('success'))

                <p class="alert alert-success">{{session('success')}}</p>

                @endif

                @if($errors->any())

                <ul>

                    @foreach($errors->all() as $error)

                    <p class="alert alert-danger">{{$error}}</p>

                    @endforeach

                </ul>

                @endif
                <!-- start vontent header -->
                <section class="content-header">
                    <section class="d-flex justify-content-between align-items-center">
                        <h2 class="content-header-title">
                            <span>انتخاب نوع پرداخت </span>
                        </h2>
                        <section class="content-header-link">
                            <!--<a href="#">مشاهده همه</a>-->
                        </section>
                    </section>
                </section>

                <section class="row mt-4">
                    <section class="col-md-9">
                        <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                            <!-- start vontent header -->
                            <section class="content-header mb-3">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        کد تخفیف
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>

                            <section class="payment-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                <secrion>
                                    کد تخفیف خود را در این بخش وارد کنید.
                                </secrion>
                            </section>

                            <section class="row">
                                <section class="col-md-5">
                                    <form action="{{route('customer.salesProcess.payment.copanDiscount')}}" method="post">
                                        @csrf
                                        <section class="input-group input-group-sm">
                                            <input type="text" name="code" class="form-control" placeholder="کد تخفیف را وارد کنید">
                                            <button class="btn btn-primary" type="submit">اعمال کد</button>
                                    </form>
                                </section>
                            </section>

                        </section>
                    </section>


                    <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                        <!-- start vontent header -->
                        <section class="content-header mb-3">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title content-header-title-small">
                                    انتخاب نوع پرداخت
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>
                        <section class="payment-select">

                            <section class="payment-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                <secrion>
                                    برای پیشگیری از انتقال ویروس کرونا پیشنهاد می کنیم روش پرداخت اینترنتی رو پرداخت کنید.
                                </secrion>
                            </section>

                            <form action="{{route('customer.salesProcess.payment.paymentSubmit')}}" id="payment-submit" method="post">
                                @csrf
                                <input type="radio" name="payment_type" value="0" id="d1" />
                                <label for="d1" class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                    <section class="mb-2">
                                        <i class="fa fa-credit-card mx-1"></i>
                                        پرداخت آنلاین
                                    </section>
                                    <section class="mb-2">
                                        <i class="fa fa-calendar-alt mx-1"></i>
                                        درگاه پرداخت زرین پال
                                    </section>
                                </label>

                                <section class="mb-2"></section>

                                <input type="radio" name="payment_type" value="1" id="d2" />
                                <label for="d2" class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                    <section class="mb-2">
                                        <i class="fa fa-id-card-alt mx-1"></i>
                                        پرداخت آفلاین
                                    </section>
                                    <section class="mb-2">
                                        <i class="fa fa-calendar-alt mx-1"></i>
                                        حداکثر در 2 روز کاری بررسی می شود
                                    </section>
                                </label>

                                <section class="mb-2"></section>

                                <input type="radio" name="payment_type" value="2" id="d3" />
                                <label for="d3" class="col-12 col-md-4 payment-wrapper mb-2 pt-2">
                                    <section class="mb-2">
                                        <i class="fa fa-money-check mx-1"></i>
                                        پرداخت در محل
                                    </section>
                                    <section class="mb-2">
                                        <i class="fa fa-calendar-alt mx-1"></i>
                                        پرداخت به پیک هنگام دریافت کالا
                                    </section>
                                </label>
                            </form>

                        </section>
                    </section>

                </section>

                @php
                $totalProductsPrice = 0;
                $totalProductsDiscount = 0;
                @endphp

                @foreach($cartItems as $cartItem)

                @php

                $totalProductsPrice += $cartItem->cartItemsProductPrice() * $cartItem->number;
                $totalProductsDiscount += $cartItem->discountProducts();

                @endphp

                @endforeach

                <section class="col-md-3">
                    <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                        <section class="d-flex justify-content-between align-items-center border-bottom">
                            <p class="text-muted price">قیمت کالاها ({{$cartItems->count()}})</p>
                            <p class="text-muted price" id="totalProductPrice">{{number_format($totalProductsPrice)}} تومان</p>
                        </section>

                        @if($order->commonDiscount != null)

                        <section class="d-flex justify-content-between align-items-center mt-3">
                            <p class="text-muted">میزان تخفیف عمومی</p>
                            <p class="text-danger fw-bolder price" id="totalProductDiscount">{{number_format($order->commonDiscount->percentage)}} درصد</p>
                        </section>
                        <section class="d-flex justify-content-between align-items-center my-2">
                            <p class="text-muted">میزان حداکثر تخفیف عمومی</p>
                            <p class="text-danger fw-bolder price" id="totalProductDiscount">{{number_format($order->commonDiscount->discount_ceiling)}} تومان</p>
                        </section>
                        <section class="d-flex justify-content-between align-items-center my-2">
                            <p class="text-muted">حداقل موجودی سبد خرید</p>
                            <p class="text-danger fw-bolder price" id="totalProductDiscount">{{number_format($order->commonDiscount->minimal_order_amount)}} تومان</p>
                        </section>

                        @endif

                        <section class="border-bottom mb-3"></section>
                        <section class="d-flex justify-content-between align-items-center">
                            <p class="text-muted">جمع سبد خرید</p>
                            <p class="fw-bolder price" id="totalProductsFinalPrice">{{number_format($order->order_final_amount)}} تومان</p>
                        </section>

                        <p class="my-3">
                            <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این سفارش صورت میگیرد.
                        </p>



                        <section class="d-flex justify-content-center">
                            <button class="btn btn-danger text-white d-block w-100" onclick="document.getElementById('payment-submit').submit();">تکمیل فرآیند خرید</button>
                        </section>

                    </section>
                </section>
            </section>
        </section>
    </section>

</section>
</section>
<!-- end cart -->


@endsection


@section('script')


<script>
    var arabicNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $('.price').text(function(i, v) {
        var chars = v.split('');
        for (var i = 0; i < chars.length; i++) {
            if (/\d/.test(chars[i])) {
                chars[i] = arabicNumbers[chars[i]];
            }
        }
        return chars.join('');
    })

    $('.address').text(function(i, v) {
        var chars = v.split('');
        for (var i = 0; i < chars.length; i++) {
            if (/\d/.test(chars[i])) {
                chars[i] = arabicNumbers[chars[i]];
            }
        }
        return chars.join('');
    })
</script>


<script>

    $(document).ready(function() {

        $showReceiver = false;

        $('#d1').click(function() {

            $showReceiver = false;
            document.getElementById('cash').remove();

        });


        $('#d2').click(function() {

            $showReceiver = false;
            document.getElementById('cash').remove();

        });


        $('#d3').click(function() {


            var sectionReceiver = document.createElement("section");
            sectionReceiver.id = 'cash';

            if ($showReceiver == false) {

                sectionReceiver.innerHTML = `<input class="form-control" id="payment-receiver" type="text" name="receiver_name" form="payment-submit" placeholder="نام و نام خانوادگی گیرنده">`;

                document.getElementsByClassName('content-wrapper')[1].append(sectionReceiver);

                $showReceiver = true;

            } else {

                $showReceiver = false;
                document.getElementById('cash').remove();

            }

        });
    });
</script>


@endsection
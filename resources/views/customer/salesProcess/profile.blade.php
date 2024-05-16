@extends('customer.layouts.master-two-col')

@section('title')

تکمیل اطلاعات حساب کاربری


@endsection

@section('content')

    <!-- start cart -->
    <section class="mb-4">
        <section class="container-xxl" >
            <section class="row">
                <section class="col">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>تکمیل اطلاعات حساب کاربری</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>

                    <section class="row mt-4">
                        <section class="col-md-9">
                            <form id="profile" action="{{ route('customer.salesProcess.profile.completeProfile') }}" method="post" class="content-wrapper bg-white p-3 rounded-2 mb-4">
                                @csrf

                                <section class="payment-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                    <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                    <section>
                                        اطلاعات حساب کاربری خود را (فقط یک بار، برای همیشه) وارد کنید. از این پس کالاها برای شخصی با این مشخصات ارسال می شود.
                                    </section>
                                </section>

                                <section class="row pb-3">

                                    @if(empty($user->first_name))
                                    <section class="col-12 col-md-6 my-2">
                                        <div class="form-group mb-3">
                                            <label for="first_name">نام</label>
                                            <input type="text" class="form-control form-control-sm" name="first_name" id="first_name" value="{{ old('first_name') }}">
                                        </div>
                                        @error('first_name')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            
                                            {{ $message }}
                                            
                                        </span>
                                        @enderror
                                    </section>
                                    @endif


                                    @if(empty($user->last_name))
                                    <section class="col-12 col-md-6 my-2">
                                        <div class="form-group mb-3">
                                            <label for="last_name">نام خانوادگی</label>
                                            <input type="text" class="form-control form-control-sm" name="last_name" id="last_name" value="{{ old('last_name') }}">
                                        </div>
                                        @error('last_name')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            
                                            {{ $message }}
                                            
                                        </span>
                                        @enderror
                                    </section>
                                    @endif


                                    @if(empty($user->mobile))
                                    <section class="col-12 col-md-6 my-2">
                                        <div class="form-group mb-3">
                                            <label for="mobile">موبایل</label>
                                            <input type="text" class="form-control form-control-sm" name="mobile" id="mobile" value="{{ old('mobile') }}">
                                        </div>
                                        @error('mobile')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                            
                                            {{ $message }}
                                            
                                        </span>
                                        @enderror
                                    </section>
                                    @endif


                                    @if(empty($user->national_code))
                                    <section class="col-12 col-md-6 my-2">
                                        <div class="form-group mb-3">
                                            <label for="national_code">کد ملی</label>
                                            <input type="text" class="form-control form-control-sm" name="national_code" id="national_code" value="{{ old('national_code') }}">
                                        </div>
                                        @error('national_code')
                                        <span class="alert_required bg-danger text-white p-1 rounded" role="alert">

                                                {{ $message }}

                                        </span>
                                        @enderror
                                    </section>
                                    @endif

                                    @if(empty($user->email))
                                        <section class="col-12 col-md-6 my-2">
                                            <div class="form-group mb-3">
                                                <label for="email">ایمیل (اختیاری)</label>
                                                <input type="text" class="form-control form-control-sm" name="email" id="email" value="{{ old('email') }}">
                                            </div>
                                            @error('email')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                
                                                {{ $message }}
                                                
                                            </span>
                                            @enderror
                                        </section>
                                    @endif



                                </section>
                            </form>

                        </section>
                        <section class="col-md-3">
                            <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
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

                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted price">قیمت کالاها ({{ $cartItems->count() }})</p>
                                    <p class="text-muted price"><span  id="total_product_price">{{ number_format($totalProductsPrice) }}</span> تومان</p>
                                </section>

                                @if($totalProductsDiscount != 0)
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">تخفیف کالاها</p>
                                        <p class="text-danger fw-bolder price"><span id="total_discount">{{ number_format($totalProductsDiscount) }}</span> تومان</p>
                                    </section>
                                @endif
                                <section class="border-bottom mb-3"></section>
                                <section class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted">جمع سبد خرید</p>
                                    <p class="fw-bolder price"><span id="total_price">{{ number_format($totalProductsPrice - $totalProductsDiscount) }}</span> تومان</p>
                                </section>

                                <p class="my-3">
                                    <i class="fa fa-info-circle me-1"></i>کاربر گرامی  خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این سفارش صورت میگیرد.
                                </p>


                                <section class="">
                                    <button type="button" onclick="document.getElementById('profile').submit();" class="btn btn-danger d-block w-100">تکمیل فرآیند خرید</button>
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

</script>       

@endsection
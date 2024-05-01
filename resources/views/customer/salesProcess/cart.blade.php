@extends('customer.layouts.master-two-col')


@section('title')

سبد خرید شما

@endsection



@section('content')

<section class="mb-4">
            <section class="container-xxl" >
                <section class="row">
                    <section class="col">
                        <!-- start vontent header -->
                        <section class="content-header">
                            <section class="d-flex justify-content-between align-items-center">
                                <h2 class="content-header-title">
                                    <span>سبد خرید شما</span>
                                </h2>
                                <section class="content-header-link">
                                    <!--<a href="#">مشاهده همه</a>-->
                                </section>
                            </section>
                        </section>

                        <section class="row mt-4">
                            <section class="col-md-9 mb-3">
                                <section class="content-wrapper bg-white p-3 rounded-2">
                                <form action="" id="cart_items" method="post">
                                    @csrf
                                    
                                @php 
                                
                                $totalProductsPrice = 0 ;
                                $totalProductsDiscount = 0 ;
                                
                                @endphp    
                                

                                @foreach($cartItems as $cartItem)

                                @php

                                $totalProductsPrice += $cartItem->cartItemsProductFinalPrice();
                                $totalProductsDiscount += $cartItem->discountProducts();

                                @endphp

                                    <section class="cart-item d-md-flex py-3">
                                        <section class="cart-img align-self-start flex-shrink-1"><img src="{{asset($cartItem->product->image)}}" alt=""></section>
                                        <section class="align-self-start w-100">

                                            <p class="fw-bold">{{$cartItem->product->name}}</p>
                                            
                                            @if(!empty($cartItem->color))

                                            <p><span style="background-color: {{$cartItem->color->color_code}};" class="cart-product-selected-color me-1"></span>

                                             <span> رنگ {{$cartItem->color->color_name}}</span>
                                            
                                            </p>

                                            @endif

                                            @if(!empty($cartItem->guarantiee))

                                            <p><i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i> <span>  گارانتی {{$cartItem->guarantiee->name}}</span></p>

                                            @endif

                                            <p><i class="fa fa-store-alt cart-product-selected-store me-1"></i> <span>کالا موجود در انبار </span></p>

                                            <section>
                                                <section class="cart-product-number d-inline-block ">
                                                    <button class="cart-number cart-number-down" type="button">-</button>
                                                    <input class="number" data-total-product-price="{{$cartItem->cartItemsProductPrice()}}" data-product-discount="{{$cartItem->cartItemsProductDiscount()}}" type="number" min="1" max="{{$cartItem->product->marketable_number}}" step="1" value="{{$cartItem->number}}" readonly="readonly">
                                                    <button class="cart-number cart-number-up" type="button">+</button>
                                                </section>
                                                <a class="text-decoration-none ms-4 cart-delete" href="#"><i class="fa fa-trash-alt"></i> حذف از سبد</a>
                                            </section>

                                        </section>

                                        <section class="align-self-end flex-shrink-1">

                                            <section class="text-nowrap fw-bold price">قیمت : {{number_format($cartItem->cartItemsProductPrice())}} تومان</section>
                                            
                                            @if(!empty($cartItem->product->activeAmazingSales()))

                                            <section class="text-nowrap text-danger fw-bold price">تخفیف : {{number_format($cartItem->cartItemsProductDiscount())}} تومان</section>

                                            @endif
                                        
                                        </section>
                                    </section>

                                @endforeach

                                </form>
                                </section>
                            </section>
                            <section class="col-md-3">
                                <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">قیمت کالاها ({{$cartItems->count()}})</p>
                                        <p class="text-muted price" id="totalProductPrice">{{number_format($totalProductsPrice)}} تومان</p>
                                    </section>

                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">تخفیف کالاها</p>
                                        <p class="text-danger fw-bolder price" id="totalProductDiscount">{{number_format($totalProductsDiscount)}} تومان</p>
                                    </section>
                                    <section class="border-bottom mb-3"></section>
                                    <section class="d-flex justify-content-between align-items-center">
                                        <p class="text-muted">جمع سبد خرید</p>
                                        <p class="fw-bolder price" id="totalProductsFinalPrice">{{number_format($totalProductsPrice - $totalProductsDiscount)}} تومان</p>
                                    </section>

                                    <p class="my-3">
                                        <i class="fa fa-info-circle me-1"></i>کاربر گرامی  خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این سفارش صورت میگیرد.
                                    </p>


                                    <section class="">
                                        <a href="address.html" class="btn btn-danger d-block">تکمیل فرآیند خرید</a>
                                    </section>

                                </section>
                            </section>
                        </section>
                    </section>
                </section>

            </section>
        </section>



        <section class="mb-4">
            <section class="container-xxl" >
                <section class="row">
                    <section class="col">
                        <section class="content-wrapper bg-white p-3 rounded-2">
                            <!-- start vontent header -->
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span>کالاهای مرتبط با سبد خرید شما</span>
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <!-- start vontent header -->
                            <section class="lazyload-wrapper" >
                                <section class="lazyload light-owl-nav owl-carousel owl-theme">


                                @foreach($relatedProducts as $relatedProduct)
                            <section class="item border">
                                <section class="lazyload-item-wrapper">
                                    <section class="product">
                                        <section class="product-add-to-cart"><a class="bg-light" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a></section>

                                        @guest

                                        <section class="product-add-to-favorite">
                                            <a class="bg-light add-to-favorite" data-url="{{route('customer.market.product.addToFavorite', $relatedProduct->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی ها">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </section>

                                        @endguest

                                        @auth

                                        @if($relatedProduct->users->contains(auth()->user()->id))

                                        <section class="product-add-to-favorite">
                                            <a class="bg-light add-to-favorite text-danger" data-url="{{route('customer.market.product.addToFavorite', $relatedProduct->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی ها">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </section>

                                        @else

                                        <section class="product-add-to-favorite">
                                            <a class="bg-light add-to-favorite" data-url="{{route('customer.market.product.addToFavorite', $relatedProduct->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی ها">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </section>

                                        @endif


                                        @endauth

                                        <a class="product-link" href="{{route('customer.market.product', $relatedProduct->id)}}">

                                            <section class="product-image">
                                                <img class="" src="{{asset($relatedProduct->image)}}" alt="">
                                            </section>
                                            <section class="product-colors"></section>
                                            <section class="product-name">
                                                <h3>{{$relatedProduct->name}}</h3>
                                            </section>
                                            <section class="product-price-wrapper d-flex align-items-center">

                                                <section class="product-price price">{{number_format($relatedProduct->price).' تومان'}} </section>

                                                <section class="product-discount">
                                                    <span class="product-old-price"></span>

                                                    @if(!empty($relatedProduct->activeAmazingSales()))

                                                    <span class="product-discount-amount price">{{$relatedProduct->activeAmazingSales()->percentage.'%'}}</span>

                                                    @endif

                                                </section>

                                            </section>
                                            <section class="product-colors">
                                                @foreach($relatedProduct->colors as $color)

                                                <section class="product-colors-item" style="background-color: {{$color->color_code}};"></section>

                                                @endforeach
                                            </section>
                                        </a>
                                    </section>
                                </section>
                            </section>
                            @endforeach

                                </section>
                            </section>
                        </section>
                    </section>
                </section>
            </section>
        </section>

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


<script>

    $(document).ready(function(){

        bill();

        $('.cart-number').click(function(){

            bill();

        })

    })


    function bill(){
// console.log('ok');
        var total_products_price = 0 ;
        var total_products_discount = 0 ;
        var total_products_finalPrice = 0 ;

        $('.number').each(function(){

            var productPrice = parseFloat($(this).data('total-product-price'));
            var productsDiscount = parseFloat($(this).data('product-discount'));
            var number = parseFloat($(this).val());

            
            total_products_price += productPrice * number;
            total_products_discount += productsDiscount * number;

        })
        
        total_products_finalPrice = total_products_price - total_products_discount;

        $('#totalProductPrice').html(toFarsiNumber(total_products_price));
        $('#totalProductDiscount').html(toFarsiNumber(total_products_discount));
        $('#totalProductsFinalPrice').html(toFarsiNumber(total_products_finalPrice));



        function toFarsiNumber(number)
        {
            const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            // add comma
            number = new Intl.NumberFormat().format(number);
            //convert to persian
            return number.toString().replace(/\d/g, x => farsiDigits[x]);
        }

    }

    

</script>

<script>
    $(document).ready(function() {


        $('.product-add-to-favorite a').click(function() {

            var url = $(this).attr('data-url');
            var element = $(this);

            $.ajax({

                url: url,
                success: function(result) {


                    if (result.status == 1) {

                        $(element).addClass("text-danger");
                        $(element).attr("data-bs-original-title", "حذف از علاقه مندی ها");
                        $(element).attr("aria-label", "حذف از علاقه مندی ها");


                    } else if (result.status == 2) {

                        $(element).removeClass('text-danger');
                        $(element).attr("data-bs-original-title", "افزودن به علاقه مندی ها");
                        $(element).attr("aria-label", "افزودن به علاقه مندی ها");

                    } else if (result.status == 3) {

                        $('.toast').parent().removeClass('d-none');
                        $('.toast').toast('show');

                    }

                }

            })

        })

    })
</script>


@endsection
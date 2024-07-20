@extends('customer.layouts.master-one-col')


@section('content')

<!-- start main one col -->

<!-- start slideshow -->
<section class="container-xxl my-4">

    @if(session('success'))

    <p class="alert alert-success">{{session('success')}}</p>

    @endif

    <section class="row">
        <section class="col-md-8 pe-md-1 ">
            <section id="slideshow" class="owl-carousel owl-theme">

                @foreach($slideShowBanners as $slideShowBanner)

                <section class="item">
                    <a class="w-100 d-block h-auto text-decoration-none" href="{{url($slideShowBanner->url)}}">
                        <img class="w-100 rounded-2 d-block h-auto" src="{{asset($slideShowBanner->image)}}" alt="{{$slideShowBanner->title}}">
                    </a>
                </section>

                @endforeach

            </section>
        </section>

        <section class="col-md-4 ps-md-1 mt-2 mt-md-0">
            @foreach($topSlideShowBanners as $topSlideShowBanner)

            <section class="mb-2">
                <a href="{{url($topSlideShowBanner->url)}}" class="d-block">
                    <img class="w-100 rounded-2" src="{{asset($topSlideShowBanner->image)}}" alt="{{$topSlideShowBanner->title}}">
                </a>
            </section>

            @endforeach
        </section>

    </section>
</section>
<!-- end slideshow -->



<!-- start product lazy load -->
<section class="mb-3">
    <section class="container-xxl">
        <section class="row">
            <section class="col">
                <section class="content-wrapper bg-white p-3 rounded-2">
                    <!-- start content header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>پربازدیدترین کالاها</span>
                            </h2>
                            <section class="content-header-link">
                                <a href="{{route('customer.products',['sort'=> 4])}}">مشاهده همه</a>
                            </section>
                        </section>
                    </section>
                    <!-- start content header -->
                    <section class="lazyload-wrapper">
                        <section class="lazyload light-owl-nav owl-carousel owl-theme">

                            @foreach($mostVisitedProducts as $mostVisitedProduct)

                            <section class="item border">
                                <section class="lazyload-item-wrapper">
                                    <section class="product">
                                        <section class="product-add-to-cart"><a class="bg-light" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a></section>

                                        @guest

                                        <section class="product-add-to-favorite">
                                            <a class="bg-light add-to-favorite" data-url="{{route('customer.market.product.addToFavorite', $mostVisitedProduct->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی ها">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </section>

                                        @endguest

                                        @auth

                                        @if($mostVisitedProduct->users->contains(auth()->user()->id))

                                        <section class="product-add-to-favorite">
                                            <a class="bg-light add-to-favorite text-danger" data-url="{{route('customer.market.product.addToFavorite', $mostVisitedProduct->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی ها">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </section>

                                        @else

                                        <section class="product-add-to-favorite">
                                            <a class="bg-light add-to-favorite" data-url="{{route('customer.market.product.addToFavorite', $mostVisitedProduct->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی ها">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </section>

                                        @endif


                                        @endauth

                                        <a class="product-link" href="{{route('customer.market.product', $mostVisitedProduct->id)}}">
                                            <section class="product-image">
                                                <img class="" src="{{asset($mostVisitedProduct->image)}}" alt="">
                                            </section>
                                            <section class="product-colors"></section>
                                            <section class="product-name">
                                                <h3>{{$mostVisitedProduct->name}}</h3>
                                            </section>
                                            <section class="product-price-wrapper d-flex align-items-center justify-content-between">

                                                <section class="product-price price">{{number_format($mostVisitedProduct->price).' تومان'}} </section>

                                                <section class="product-discount">
                                                    <span class="product-old-price"></span>

                                                    @if(!empty($mostVisitedProduct->activeAmazingSales()))

                                                    <span class="product-discount-amount price">{{$mostVisitedProduct->activeAmazingSales()->percentage.'%'}}</span>

                                                    @endif

                                                </section>

                                            </section>
                                            <section class="product-colors">

                                                @foreach($mostVisitedProduct->colors as $color)

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
<!-- end product lazy load -->



<!-- start ads section -->
<section class="mb-3">
    <section class="container-xxl">
        <!-- two column-->
        <section class="row py-4">
            @foreach($middleSlideShowBanners as $middleSlideShowBanner)
            <section class="col-12 col-md-6 mt-2 mt-md-0"><img class="d-block rounded-2 w-100" src="{{asset($middleSlideShowBanner->image)}}" alt="{{$middleSlideShowBanner->title}}"></section>
            @endforeach
        </section>

    </section>
</section>
<!-- end ads section -->


<!-- start product lazy load -->
<section class="mb-3">
    <section class="container-xxl">
        <section class="row">
            <section class="col">
                <section class="content-wrapper bg-white p-3 rounded-2">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>پیشنهاد آمازون به شما</span>
                            </h2>
                            <section class="content-header-link">
                                <a href="{{route('customer.products',['sort'=> 5])}}">مشاهده همه</a>
                            </section>
                        </section>
                    </section>
                    <!-- start vontent header -->
                    <section class="lazyload-wrapper">
                        <section class="lazyload light-owl-nav owl-carousel owl-theme">

                            @foreach($productOffers as $productOffer)
                            <section class="item border">
                                <section class="lazyload-item-wrapper">
                                    <section class="product">
                                        <section class="product-add-to-cart"><a class="bg-light" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a></section>

                                        @guest

                                        <section class="product-add-to-favorite">
                                            <a class="bg-light add-to-favorite" data-url="{{route('customer.market.product.addToFavorite', $productOffer->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی ها">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </section>

                                        @endguest

                                        @auth

                                        @if($productOffer->users->contains(auth()->user()->id))

                                        <section class="product-add-to-favorite">
                                            <a class="bg-light add-to-favorite text-danger" data-url="{{route('customer.market.product.addToFavorite', $productOffer->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی ها">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </section>

                                        @else

                                        <section class="product-add-to-favorite">
                                            <a class="bg-light add-to-favorite" data-url="{{route('customer.market.product.addToFavorite', $productOffer->id)}}" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به علاقه مندی ها">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </section>

                                        @endif


                                        @endauth

                                        <a class="product-link" href="{{route('customer.market.product', $productOffer->id)}}">

                                            <section class="product-image">
                                                <img class="" src="{{asset($productOffer->image)}}" alt="">
                                            </section>
                                            <section class="product-colors"></section>
                                            <section class="product-name">
                                                <h3>{{$productOffer->name}}</h3>
                                            </section>
                                            <section class="product-price-wrapper d-flex align-items-center justify-content-between">

                                                <section class="product-price price">{{number_format($productOffer->price).' تومان'}} </section>

                                                <section class="product-discount">
                                                    <span class="product-old-price"></span>

                                                    @if(!empty($productOffer->activeAmazingSales()))

                                                    <span class="product-discount-amount price">{{$productOffer->activeAmazingSales()->percentage.'%'}}</span>

                                                    @endif

                                                </section>

                                            </section>
                                            <section class="product-colors">
                                                @foreach($productOffer->colors as $color)

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
<!-- end product lazy load -->


@if(!empty($bottomBanner))
<!-- start ads section -->
<section class="mb-3">
    <section class="container-xxl">
        <!-- one column -->
        <section class="row py-4">
            <section class="col"><a href="">

                    <a href="{{url($bottomBanner->url)}}">

                        <img class="d-block rounded-2 w-100" src="{{asset($bottomBanner->image)}}" alt="{{$bottomBanner->title}}">

                    </a>

            </section>
        </section>

    </section>
</section>
<!-- end ads section -->
@endif



<!-- start brand part-->
<section class="brand-part mb-4 py-4">
    <section class="container-xxl">
        <section class="row">
            <section class="col">
                <!-- start vontent header -->
                <section class="content-header">
                    <section class="d-flex align-items-center">
                        <h2 class="content-header-title">
                            <span>برندهای ویژه</span>
                        </h2>
                    </section>
                </section>
                <!-- start vontent header -->
                <section class="brands-wrapper py-4">
                    <section class="brands dark-owl-nav owl-carousel owl-theme">

                        @foreach($brands as $brand)

                        <section class="item">
                            <section class="brand-item">
                                <a href="{{route('customer.products' , ['brands[]'=> $brand->id])}}"><img class="rounded-2" src="{{$brand->logo}}" alt="{{$brand->persian_name.$brand->orginal_name}}"></a>
                            </section>
                        </section>

                        @endforeach

                    </section>
                </section>
            </section>
        </section>
    </section>
</section>
<!-- end brand part-->


<section class="position-fixed p-4 flex-row-reverse d-none" style="z-index: 999999999; left: 0; top: 3rem; width: 26rem; max-width: 80%;">
    <div class="toast" data-delay="7000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">فروشگاه</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <strong class="ml-auto">
                برای افزودن کالا به لیست علاقه مندی ها باید ابتدا وارد حساب کاربری خود شوید.
                <br>
                <br>
                <a href="{{ route('auth.customer.login-register-form') }}" class="text-dark">
                    ثبت نام / ورود
                </a>
            </strong>
        </div>
    </div>
</section>



<!-- end main one col -->

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
    $(document).ready(function() {


        $('.product-add-to-favorite a').click(function() {
            // alert('clicked');
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
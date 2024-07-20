@extends('customer.layouts.master-two-col')

@section('title')

{{$product->name}}

@endsection


@section('head-tag')

<style>
    /***
 *  Simple Pure CSS Star Rating Widget Bootstrap 4 
 * 
 *  www.TheMastercut.co
 *  
 ***/

    @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

    /* Styling h1 and links
––––––––––––––––––––––––––––––––– */
    h1[alt="Simple"] {
        color: white;
    }

    .starrating>input {
        display: none;
    }

    /* Remove radio buttons */

    .starrating>label:before {
        content: "\f005";
        /* Star */
        margin: 2px;
        font-size: 2em;
        font-family: FontAwesome;
        display: inline-block;
    }

    .starrating>label {
        color: #222222;
        /* Start color when not clicked */
    }

    .starrating>input:checked~label {
        color: #ffca08;
    }

    /* Set yellow color when star checked */

    .starrating>input:hover~label {
        color: #ffca08;
    }

    /* Set yellow color when star hover */
</style>

@endsection


@section('content')


<!-- start cart -->
<section class="mb-4">
    <section class="container-xxl">
        <section class="row">
            <section class="col">
                <!-- start vontent header -->
                <section class="content-header">
                    <section class="d-flex justify-content-between align-items-center">
                        <h2 class="content-header-title">
                            <span>{{$product->name}}</span>
                        </h2>
                        <section class="content-header-link">
                            <!--<a href="#">مشاهده همه</a>-->
                        </section>
                    </section>
                </section>

                @php

                $productGalleyImages= $product->images()->get();
                $productImage= $product->image;
                $images= collect(); //create collection for add product image to galleryImages in this collation
                $images->push($productImage);

                foreach($productGalleyImages as $productGalleyImage){

                $images->push($productGalleyImage->image);

                }

                @endphp
                <section class="row mt-4">
                    <!-- start image gallery -->
                    <section class="col-md-4">
                        <section class="content-wrapper bg-white p-3 rounded-2 mb-4">
                            <section class="product-gallery">
                                <section class="product-gallery-selected-image mb-3">

                                    <img src="{{$product->image != null ? asset($product->image) : asset($productGalleyImages->first()->image)}}" alt="{{$product->image != null ? $product->image : '' }}">

                                </section>
                                <section class="product-gallery-thumbs">

                                    @foreach($images as $image)
                                    <img class="product-gallery-thumb" src="{{asset($image)}}" alt="" data-input="{{asset($image)}}">
                                    @endforeach

                                </section>
                            </section>
                        </section>
                    </section>
                    <!-- end image gallery -->

                    <!-- start product info -->
                    <section class="col-md-5">

                        <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                            <!-- start vontent header -->
                            <section class="content-header mb-3">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        {{$product->name}}
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-info">

                                <form action="{{route('customer.salesProcess.addToCart', $product->id)}}" method="post">
                                    @csrf

                                    @php $colors= $product->colors()->get(); @endphp

                                    @if($colors->count() != 0)

                                    <p><span>رنگ انتخاب شده : <span id="selected-color">{{$colors->first()->color_name}}</span> </span></p>

                                    <p>

                                        @foreach($product->colors as $key=>$productColor)


                                        <label for="{{'color-'.$productColor->id}}" style="cursor:pointer;background-color: {{$productColor->color_code}}" class="product-info-colors me-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$productColor->color_name}}"></label>
                                        <input type="radio" class="d-none" name="color" id="{{'color-'.$productColor->id}}" value="{{$productColor->id}}" data-color-name="{{$productColor->color_name}}" data-color-priceIncrease="{{$productColor->price_increase}}" @if($key==0) checked @endif />

                                        @endforeach

                                    </p>

                                    @endif

                                    @php $guarantiees= $product->guarantiees()->get(); @endphp

                                    @if($guarantiees->count() != 0)

                                    <p><i class="fa fa-shield-alt cart-product-selected-warranty me-1"></i>
                                        <span> گارانتی :

                                            <select name="guarantiee" id="guarantiee">
                                                @foreach($guarantiees as $key=>$guarantiee)

                                                <option value="{{$guarantiee->id}}" data-guarantiee-priceIncrease="{{$guarantiee->price_increase}}" @if($key==0) selected @endif>{{$guarantiee->name}}</option>

                                                @endforeach
                                            </select>
                                        </span>
                                    </p>

                                    @endif


                                    <p>
                                        @if($product->marketable_number > 0)
                                        <i class="fa fa-store-alt cart-product-selected-store me-1 text-success"></i> <span class="text-success">کالا موجود در انبار</span>
                                        @else
                                        <i class="fa fa-store-alt cart-product-selected-store me-1 text-danger"></i> <span class="text-danger">کالا ناموجود</span>
                                        @endif
                                    </p>



                                    <section class="mb-4 add-to-favorite">
                                        @guest

                                        <a class="btn btn-light btn-sm text-decoration-none" data-url="{{route('customer.market.product.addToFavorite', $product->id)}}"><i class="fa fa-heart"></i> افزودن به علاقه مندی ها</a>

                                        @endguest

                                        @auth

                                        @if($product->users->contains(auth()->user()->id))

                                        <a class="btn btn-light btn-sm text-decoration-none" data-url="{{route('customer.market.product.addToFavorite', $product->id)}}"><i class="fa fa-heart text-danger"></i> حذف از علاقه مندی ها</a>

                                        @else

                                        <a class="btn btn-light btn-sm text-decoration-none" data-url="{{route('customer.market.product.addToFavorite', $product->id)}}"><i class="fa fa-heart text-danger"></i> افزودن به علاقه مندی ها</a>

                                        @endif


                                        @endauth
                                    </section>


                                    @auth

                                    @if($product->marketable_number > 0)

                                    <section>
                                        <section class="cart-product-number d-inline-block ">
                                            <button class="cart-number cart-number-down" type="button">-</button>
                                            <input class="" type="number" name="number" id="number" min="1" max="{{$product->marketable_number}}" step="1" value="1" readonly="readonly">
                                            <button class="cart-number cart-number-up" type="button">+</button>
                                        </section>
                                    </section>

                                    @endif

                                    @endauth

                                    <p class="mb-3 mt-5">
                                        <i class="fa fa-info-circle me-1"></i>کاربر گرامی خرید شما هنوز نهایی نشده است. برای ثبت سفارش و تکمیل خرید باید ابتدا آدرس خود را انتخاب کنید و سپس نحوه ارسال را انتخاب کنید. نحوه ارسال انتخابی شما محاسبه و به این مبلغ اضافه شده خواهد شد. و در نهایت پرداخت این سفارش صورت میگیرد. پس از ثبت سفارش کالا بر اساس نحوه ارسال که شما انتخاب کرده اید کالا برای شما در مدت زمان مذکور ارسال می گردد.
                                    </p>

                            </section>
                        </section>

                    </section>
                    <!-- end product info -->

                    <section class="col-md-3">
                        <section class="content-wrapper bg-white p-3 rounded-2 cart-total-price">
                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">قیمت کالا</p>
                                <p class="text-muted price" id="product_orginal_price" data-orginal-price="{{$product->price}}">{{number_format($product->price)}} <span class="small">تومان</span></p>
                            </section>

                            @php

                            $amazingSale= $product->activeAmazingSales();

                            @endphp

                            @if($amazingSale != null)

                            <section class="d-flex justify-content-between align-items-center">
                                <p class="text-muted">تخفیف کالا</p>
                                <p class="text-danger fw-bolder price" id="product_discount_price" data-product-discount-price="{{$product->price * $amazingSale->percentage / 100}}">{{number_format($product->price * $amazingSale->percentage / 100)}} <span class="small">تومان</span></p>
                            </section>

                            @endif

                            <section class="border-bottom mb-3"></section>

                            <section class="d-flex justify-content-between align-items-center">

                                <p class="text-muted">قیمت نهایی کالا</p>
                                <p class="fw-bolder" id="final_price" data-orginal-price="{{$product->price}}"></p>

                            </section>


                            <section class="">

                                @if($product->marketable_number > 0)
                                <button id="next-level" type="submit" class="btn btn-danger my-2 d-block w-100">افزودن به سبد خرید</button>
                                <a href="{{route('customer.salesProcess.cart')}}" class="btn btn-primary d-block w-100">مشاهده سبد خرید</a>
                                @else
                                <p id="next-level" class="btn btn-secondary d-block disabled">محصول ناموجود می باشد</p>
                                @endif

                            </section>
                            </form>
                        </section>
                    </section>
                </section>
            </section>
        </section>

    </section>
</section>
<!-- end cart -->


<!-- start product lazy load -->
<section class="mb-4">
    <section class="container-xxl">
        <section class="row">
            <section class="col">
                <section class="content-wrapper bg-white p-3 rounded-2">
                    <!-- start vontent header -->
                    <section class="content-header">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>کالاهای مرتبط</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <!-- start vontent header -->
                    <section class="lazyload-wrapper">
                        <section class="lazyload light-owl-nav owl-carousel owl-theme">

                            @forelse($relatedProducts as $relatedProduct)

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
                                            <section class="product-price-wrapper d-flex align-items-center justify-content-between">

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

                            @empty

                            
                            @endforelse

                        </section>

                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end product lazy load -->

    <!-- start description, features and comments -->
    <section class="mb-4">
        <section class="container-xxl">
            <section class="row">
                <section class="col">
                    <section class="content-wrapper bg-white p-3 rounded-2">
                        <!-- start content header -->
                        <section id="introduction-features-comments" class="introduction-features-comments">
                            <section class="content-header">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title">
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#introduction">معرفی</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#features">ویژگی ها</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#comments">دیدگاه ها</a></span>
                                        <span class="me-2"><a class="text-decoration-none text-dark" href="#rates">امتیازات</a></span>
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                        </section>
                        <!-- start content header -->

                        <section class="py-4">

                            <!-- start vontent header -->
                            <section id="introduction" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        معرفی
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-introduction mb-4">

                                {!! $product->description !!}

                            </section>

                            <!-- start vontent header -->
                            <section id="features" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        ویژگی ها
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-features mb-4 table-responsive">
                                <table class="table table-bordered border-white">

                                    @foreach($product->values as $value)
                                    <tr>
                                        <td>{{$value->attribute->name}}</td>
                                        <td>{{json_decode($value->value)->value}} {{$value->attribute->unit}}</td>
                                    </tr>
                                    @endforeach

                                    @foreach($product->metas as $meta)
                                    <tr>
                                        <td>{{$meta->meta_key}}</td>
                                        <td>{{$meta->meta_value}}</td>
                                    </tr>
                                    @endforeach

                                </table>
                            </section>

                            <!-- start vontent header -->
                            <section id="comments" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        دیدگاه ها
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>
                            <section class="product-comments mb-4">

                                <section class="comment-add-wrapper">
                                    <button class="comment-add-button" type="button" data-bs-toggle="modal" data-bs-target="#add-comment"><i class="fa fa-plus"></i> افزودن دیدگاه</button>

                                    @guest

                                    <section class="modal fade" id="add-comment" tabindex="-1" aria-labelledby="add-comment-label" aria-hidden="true">
                                        <section class="modal-dialog">
                                            <section class="modal-content">
                                                <section class="modal-header">
                                                    <h5 class="modal-title" id="add-comment-label"><i class="fa fa-plus"></i> افزودن دیدگاه</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </section>
                                                <section class="modal-body">

                                                    <p>شما عضو سایت نیستید. جهت افزودن دیدگاه نیاز به عضویت و ورود به سایت دارید.</p>
                                                    <p>جهت ثبت نام یا ورود به سایت روی <a href="{{route('auth.customer.login-register-form')}}">اینجا</a> کلیک کنید.</p>

                                                </section>
                                            </section>
                                        </section>
                                    </section>


                                    @endguest

                                    @auth
                                    <!-- start add comment Modal -->
                                    <section class="modal fade" id="add-comment" tabindex="-1" aria-labelledby="add-comment-label" aria-hidden="true">
                                        <section class="modal-dialog">
                                            <section class="modal-content">
                                                <section class="modal-header">
                                                    <h5 class="modal-title" id="add-comment-label"><i class="fa fa-plus"></i> افزودن دیدگاه</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </section>
                                                <section class="modal-body">

                                                    <form class="row" action="{{route('customer.market.product.addComment' , $product->id)}}" method="post">
                                                        @csrf

                                                        <section class="col-12 mb-2">
                                                            <label for="comment" class="form-label mb-1">دیدگاه شما</label>
                                                            <textarea class="form-control form-control-sm" id="comment" name="body" placeholder="دیدگاه شما ..." rows="4"></textarea>
                                                        </section>
                                                        @error('body')
                                                        <span class="text-white bg-danger rounded">
                                                            {{$message}}
                                                        </span>
                                                        @enderror

                                                </section>
                                                <section class="modal-footer py-1">
                                                    <button type="submit" class="btn btn-sm btn-primary">ثبت دیدگاه</button>
                                                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                                </section>
                                                </form>
                                            </section>
                                        </section>
                                    </section>
                                    @endauth
                                </section>

                                @php

                                $activeProductComments = $product->activeProductComments();

                                @endphp

                                @foreach($activeProductComments as $activeProductComment)

                                <section class="product-comment">
                                    <section class="product-comment-header d-flex justify-content-start">
                                        <section class="product-comment-title mx-3">

                                            @if(empty($activeProductComment->user->first_name) && empty($activeProductComment->user->last_name))

                                            ناشناس

                                            @else

                                            {{$activeProductComment->user->first_name.' '.$activeProductComment->user->last_name}}

                                            @endif

                                        </section>

                                        <section class="product-comment-date date">{{jdate($activeProductComment->created_at)->format('s:i:H Y/m/d')}}</section>

                                    </section>
                                    <section class="product-comment-body ms-3">
                                        {{$activeProductComment->body}}
                                    </section>

                                    @if($activeProductComment->answers->count() > 0)

                                    @foreach($activeProductComment->answers()->get() as $answer)

                                    <section class="product-comment ms-5 border border-bottom-5 border-black">
                                        <section class="product-comment-header d-flex justify-content-start">

                                            <section class="product-comment-title mx-3">

                                                @if(empty($answer->user->first_name) && empty($answer->user->last_name))

                                                ناشناس

                                                @else

                                                {{$answer->user->first_name.' '.$answer->user->last_name}}

                                                @endif

                                            </section>

                                            <section class="product-comment-date">{{jdate($answer->created_at)->format('s:i:H Y/m/d')}}</section>

                                        </section>
                                        <section class="product-comment-body ms-3">
                                            {{$answer->body}}
                                        </section>
                                    </section>

                                    @endforeach

                                    @endif

                                </section>

                                @endforeach


                            </section>

                            <section id="rates" class="content-header mt-2 mb-4">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small mt-4">
                                        امتیازات
                                    </h2>
                                </section>

                            </section>
                        
                            @auth

                            @if(auth()->user()->isBuyProductUser($product))

                            <section>

                                <p>لطفا به این محصول امتیاز بدهید.</p>

                            </section>

                            <div class="container d-flex flex-column">
                                <form action="{{route('customer.market.product.addRate', $product->id)}}" method="post">
                                    @csrf
                                    <div class="starrating risingstar d-flex justify-content-end flex-row-reverse">
                                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title=" پنج امتیاز"></label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title=" چهار امتیاز"></label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title=" سه امتیاز"></label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title=" دو امتیاز"></label>
                                        <input type="radio" id="star1" name="rating" value="1" checked /><label for="star1" title="یک امتیاز"></label>
                                    </div>
                                    <div class="d-flex ms-5 my-3">

                                        <button class="btn btn-sm btn-info" type="submit">ثبت امتیاز</button>

                                    </div>
                                    </form>
                            @endif        

                            @endauth
                                    <div class="d-flex ms-3 price">

                                        <p type="submit">مجموع امتیاز محصول : {{$product->ratingsCount()}}</p>

                                    </div>
                                
                            </div>

                        </section>

                    </section>
                </section>
            </section>
        </section>
    </section>
    <!-- end description, features and comments -->


    <section class="position-fixed p-4 flex-row-reverse d-none" style="z-index: 909999999; left: 0; top: 3rem; width: 26rem; max-width: 80%;">
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



    <script>
        $(document).ready(function() {

            bill();

            $("input[name=color]").change(function() {

                bill();

            })

            $("select[name=guarantiee]").change(function() {

                bill();

            })

            $(".cart-number").click(function() {

                bill();

            })

        })


        function bill() {

            if ($('input[name=color]:checked').length != 0) {

                var checked_color_input = $('input[name=color]:checked');
                $('#selected-color').html(checked_color_input.attr('data-color-name'));

            }

            var selected_color_price = 0;
            var selected_guarantiee_price = 0;
            var number = 1;
            var product_discount_price = 0;
            var product_orginal_price = parseFloat($('#product_orginal_price').attr('data-orginal-price'));


            if ($('input[name=color]:checked').length != 0) {

                selected_color_price = parseFloat($('input[name=color]:checked').attr('data-color-priceIncrease'));

            }

            if ($('#guarantiee option:selected').length != 0) {

                selected_guarantiee_price = parseFloat($('#guarantiee option:selected').attr('data-guarantiee-priceIncrease'));

            }


            if ($('#number').val() > 0) {

                number = $('#number').val();

            }

            if ($('#product_discount_price').length != 0) {

                product_discount_price = parseFloat($('#product_discount_price').attr('data-product-discount-price'));

            }

            var productPrice = product_orginal_price + selected_color_price + selected_guarantiee_price;

            var finalPrice = number * (productPrice - product_discount_price);

            // $('#product_orginal_price').html(productPrice); 

            $('#final_price').html(toFarsiNumber(finalPrice) + '<span> تومان </span>');


        }


        function toFarsiNumber(number) {
            const farsiDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            // add comma 3 number 3 number
            number = new Intl.NumberFormat().format(number);
            //convert to persian
            return number.toString().replace(/\d/g, x => farsiDigits[x]);
        }
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



            $('.add-to-favorite a').click(function() {
                // alert('clicked');
                var url = $(this).attr('data-url');
                var element = $(this);

                $.ajax({

                    url: url,
                    success: function(result) {


                        if (result.status == 1) {

                            $(element).children().first().addClass("text-danger");
                            $(element).html("<i class= 'fa fa-heart text-danger'></i> حذف از علاقه مندی ها");
                            $(element).attr("data-bs-original-title", "حذف از علاقه مندی ها");
                            $(element).attr("aria-label", "حذف از علاقه مندی ها");


                        } else if (result.status == 2) {

                            $(element).children().first().removeClass('text-danger');
                            $(element).html("<i class= 'fa fa-heart'></i> افزودن به علاقه مندی ها");
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

    <script>
        //start product introduction, features and comment
        $(document).ready(function() {
            var s = $("#introduction-features-comments");
            var pos = s.position();
            $(window).scroll(function() {
                var windowpos = $(window).scrollTop();

                if (windowpos >= pos.top) {
                    s.addClass("stick");
                } else {
                    s.removeClass("stick");
                }
            });
        });
        //end product introduction, features and comment
    </script>


    @endsection
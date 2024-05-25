@extends('customer.layouts.master-two-col')


@section('title')

لیست علاقه مندی ها

@endsection


@section('content')

<!-- start body -->
<section class="">
    <section id="main-body-two-col" class="container-xxl body-container">

        @if(session('success'))

        <p class="alert alert-success">{{session('success')}}</p>

        @endif

        <section class="row">

            @include('customer.layouts.partials.profile-sidebar')

            <main id="main-body" class="main-body col-md-9">
                <section class="content-wrapper bg-white p-3 rounded-2 mb-2">

                    <!-- start vontent header -->
                    <section class="content-header mb-4">
                        <section class="d-flex justify-content-between align-items-center">
                            <h2 class="content-header-title">
                                <span>لیست علاقه مندی های من</span>
                            </h2>
                            <section class="content-header-link">
                                <!--<a href="#">مشاهده همه</a>-->
                            </section>
                        </section>
                    </section>
                    <!-- end vontent header -->

                    @forelse(auth()->user()->products as $product)

                    <section class="cart-item d-flex py-3">
                        <section class="cart-img align-self-start flex-shrink-1"><img src="{{asset($product->image)}}" alt=""></section>
                        <section class="align-self-start w-100">
                            <p class="fw-bold">{{$product->name}} {{$product->brand->persian_name}} {{$product->brand->orginal_name}}</p>
                            <section>
                                <a class="text-decoration-none cart-delete" href="{{route('customer.salesProcess.profile-favorites.remove-to-favorites', $product->id)}}"><i class="fa fa-trash-alt"></i> حذف از لیست علاقه ها</a>
                            </section>
                        </section>
                        <section class="align-self-end flex-shrink-1">
                                    <section class="text-nowrap fw-bold price">{{ number_format($product->price) }} تومان</section>
                                </section>
                    </section>

                    @empty

                    <section>
                        محصولی وجود ندارد.
                    </section>

                    @endforelse


                </section>
            </main>
        </section>
    </section>
</section>
<!-- end body -->


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
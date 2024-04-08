@extends('admin.layouts.master')


@section('title','ایجاد عکس جدید')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#">کالا ها</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ایجاد عکس جدید</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ایجاد عکس جدید
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.product.gallery.index', $product->id)}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.market.product.gallery.store', $product->id)}}" method="post" id="form" enctype="multipart/form-data">
                    @csrf
                    <section class="row">

                    <section class="col-12 col-md-6 my-2">

                            <div class="form-group">
                                <label for="image">عکس</label>
                                <input id="image" type="file" name="image" class="form-control form-control-sm" onchange="document.getElementById('imagesize').classList.add('d-block')">
                            </div>
                            @error('image')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror

                            <section id="imagesize" class="mt-2 d-none">
                            <p>انتخاب سایز تصویر : (دلخواه)</p>
                                <input type="radio" id="size1" name="size" value="small">
                                <label for="size1">120*160 - کوچک</label><br>
                                <input type="radio" id="size2" name="size" value="medium">
                                <label for="size2">240*320 - متوسط</label><br>
                                <input type="radio" id="size3" name="size" value="large">
                                <label for="size3">600*800 - بزرگ</label>
                            </section>

                        </section>

                        <section class="col-12 mt-3">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
            </section>
            </form>
        </section>

    </section>
</section>
</section>

@endsection


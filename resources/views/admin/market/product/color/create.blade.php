@extends('admin.layouts.master')


@section('title','ایجاد رنگ جدید')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#">کالا ها</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ایجاد رنگ جدید</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ایجاد رنگ جدید
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.product.color.index', $product->id)}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.market.product.color.store', $product->id)}}" method="post" id="form">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">نام رنگ</label>
                                <input type="text" name="color_name" class="form-control form-control-sm" value="{{old('color_name')}}">
                            </div>
                            @error('color_name')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for=""> قیمت (تومان)</label>
                                <input type="text" name="price_increase" class="form-control form-control-sm" value="{{old('price_increase')}}">
                            </div>
                            @error('price_increase')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
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


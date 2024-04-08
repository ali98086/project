@extends('admin.layouts.master')


@section('title','ایجاد مقدار فرم کالا')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#"> فرم کالا</a></li>
        <li class="breadcrumb-item"> <a href="#"> ویژگی های فرم کالا</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ایجاد مقدار فرم کالا</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ایجاد مقدار فرم کالا
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.property.value.index', $categoryAttribute->id)}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.market.property.value.store', $categoryAttribute->id)}}" method="post">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">مقدار</label>
                                <input type="text" name="value" class="form-control form-control-sm" value="{{old('value')}}">
                            </div>
                            @error('value')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">افزایش قیمت(تومان)</label>
                                <input type="text" name="price_increase" class="form-control form-control-sm" value="{{old('price_increase')}}">
                            </div>
                            @error('price_increase')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">محصول</label>
                                <select class="form-control form-control-sm" name="product_id">

                                    <option value="">محصول مورد نظر را انتخاب کنید</option>

                                    @foreach($categoryAttribute->category->products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('product_id')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">نوع</label>
                                <select class="form-control form-control-sm" name="type">

                                    <option value="0">تک انتخابی (ساده)</option>
                                    <option value="1">چند انتخابی</option>

                                </select>
                            </div>
                            @error('type')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 mt-2">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
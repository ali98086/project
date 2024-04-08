@extends('admin.layouts.master')


@section('title','ویرایش مقدار فرم کالا')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#"> فرم کالا</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ویرایش مقدار فرم کالا</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش مقدار فرم کالا
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.property.value.index', $categoryAttribute->id)}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.market.property.value.update' , ['categoryAttribute'=>$categoryAttribute->id , 'value'=>$value->id])}}" method="post">
                    @csrf
                    @method('put')
                    <section class="row">

                    <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">مقدار</label>
                                <input type="text" name="value" class="form-control form-control-sm" value="{{json_decode($value->value)->value}}">
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
                                <input type="text" name="price_increase" class="form-control form-control-sm" value="{{json_decode($value->value)->price_increase}}">
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

                                    @foreach($categoryAttribute->category->products as $product)
                                    <option value="{{$product->id}}" {{$value->product_id  == $product->id ? 'selected' : ''}}>{{$product->name}}</option>
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

                                    <option value="0" {{$value->type == 0 ? 'selected' : ''}}>تک انتخابی (ساده)</option>
                                    <option value="1" {{$value->type == 1 ? 'selected' : ''}}>چند انتخابی</option>

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
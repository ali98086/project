@extends('admin.layouts.master')


@section('title','اصلاح موجودی')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#"> انبار</a></li>
        <li class="breadcrumb-item active" aria-current="page"> اصلاح موجودی</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    اصلاح موجودی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.store.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.market.store.update', $product->id)}}" method="post">
                    @csrf
                    @method('put')
                    <section class="row flex-column">
                    
                    <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تعداد قابل فروش</label>
                                <input type="text" class="form-control form-control-sm" name="marketable_number" value="{{old('marketable_number', $product->marketable_number)}}">
                            </div>
                            @error('marketable_number')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تعداد رزرو شده</label>
                                <input type="text" class="form-control form-control-sm" name="frozen_number" value="{{old('marketable_number', $product->frozen_number)}}">
                            </div>
                            @error('frozen_number')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تعداد فروخته شده</label>
                                <input type="text" class="form-control form-control-sm" name="sold_number" value="{{old('sold_number', $product->sold_number)}}">
                            </div>
                            @error('sold_number')
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
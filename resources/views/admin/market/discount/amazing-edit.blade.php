@extends('admin.layouts.master')

@section('head-tag')

    <link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}" />

@endsection

@section('title','ویرایش فروش شگفت انگیز')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">  بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#">تخفیف ها</a></li>
        <li class="breadcrumb-item"> <a href="{{route('admin.market.discount.commonDiscount')}}">  فروش شگفت انگیز</a></li>
        <li class="breadcrumb-item active" aria-current="page">  ویرایش فروش شگفت انگیز</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                ویرایش فروش شگفت انگیز
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.discount.amazingSale')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.market.discount.amazingSale.update', $amazingSale->id)}}" method="post">
                    @csrf
                    @method('put')
                    <section class="row">

                    <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="product_id">کالا</label>
                                <select name="product_id" id="product_id" class="form-control form-control-sm">

                                    @foreach($products as $product)
                                        <option value="{{$product->id}}" {{$amazingSale->product->id == $product->id ? 'selected' : ''}}>{{$product->name}}</option>
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
                                <label for="">درصد تخفیف</label>
                                <input type="text" name="percentage" class="form-control form-control-sm" value="{{$amazingSale->percentage}}">
                            </div>
                            @error('percentage')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="">تاریخ شروع</label>
                                <input type="text" id="start_date" name="start_date" class="form-control form-control-sm d-none">
                                <input type="text" id="start_date_view" class="form-control form-control-sm" value="{{$amazingSale->start_date}}">
                            </div>
                            @error('start_date')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="">تاریخ پایان</label>
                                <input type="text" id="end_date" name="end_date" class="form-control form-control-sm d-none">
                                <input type="text" id="end_date_view" class="form-control form-control-sm" value="{{$amazingSale->end_date}}">
                            </div>
                            @error('end_date')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if($amazingSale->status ==0) {{'selected'}} @endif>غیر فعال</option>
                                    <option value="1" @if($amazingSale->status ==1) {{'selected'}} @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection

@section('script')

<script src="{{asset('admin-assets/jalalidatepicker/persian-date.min.js')}}"></script>
<script src="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#start_date_view').persianDatepicker({
            format: 'YYYY/MM/DD',
            altField: '#start_date'
        }),
        $('#end_date_view').persianDatepicker({
            format: 'YYYY/MM/DD',
            altField: '#end_date'
        })
    });
</script>


@endsection
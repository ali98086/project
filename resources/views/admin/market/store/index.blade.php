@extends('admin.layouts.master')


@section('title','انبار')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item active" aria-current="page"> انبار</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    انبار
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="#" class="btn btn-primary btn-sm disabled" aria-disabled="true">ایجاد انبار جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">نام کالا</th>
                            <th class="text-center width-16-rem">تصویر کالا</th>
                            <th class="text-center width-16-rem">تعداد قابل فروش</th>
                            <th class="text-center width-16-rem">تعداد رزرو شده</th>
                            <th class="text-center width-16-rem">تعداد فروخته شده</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($products as $key=>$product)
                        <tr>
                            <th class="text-center">{{++$key}}</th>
                            <td class="text-center">{{$product->name}}</td>
                            <td class="text-center"><img src="{{asset($product->image)}}" class="max-height-2rem" alt="تصویر ندارد"/></td>
                            <td class="text-center">{{$product->marketable_number}}</td>
                            <td class="text-center">{{$product->frozen_number}}</td>
                            <td class="text-center">{{$product->sold_number}}</td>
                            <td class="text-center w-25">

                                <a href="{{route('admin.market.store.create', $product->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> افزایش موجودی</a>
                                <a href="{{route('admin.market.store.edit', $product->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-trash-alt"></i> اصلاح موجودی</a>

                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>

@endsection
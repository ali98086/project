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
                <a href="" class="btn btn-primary btn-sm disabled" aria-disabled="true">ایجاد انبار جدید</a>
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
                            <th class="text-center width-16-rem">موجودی</th>
                            <th class="text-center width-16-rem">ورودی انبار</th>
                            <th class="text-center width-16-rem">خروجی انبار</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <th class="text-center">1</th>
                            <td class="text-center">LED سامسونگ</td>
                            <td class="text-center"><img src="{{asset('admin-assets/images/avatar-3.jpg')}}" class="max-height-2rem" /></td>
                            <td class="text-center">16</td>
                            <td class="text-center">38</td>
                            <td class="text-center">22</td>
                            <td class="text-center w-25">

                                <a href="{{route('admin.market.store.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> افزایش موجودی</a>
                                <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-trash-alt"></i> اصلاح موجودی</a>

                            </td>

                        </tr>
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>

@endsection
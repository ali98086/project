@extends('admin.layouts.master')


@section('title','نظرات')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item active" aria-current="page"> نظرات</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    نظرات
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="#" class="btn btn-primary btn-sm disabled" aria-disabled="true">ایجاد نظر جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">کد کاربر</th>
                            <th class="text-center width-16-rem">نویسنده نظر</th>
                            <th class="text-center width-16-rem">کد کالا</th>
                            <th class="text-center width-16-rem">کالا</th>
                            <th class="text-center width-16-rem">وضعیت</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-center">1</th>
                            <td class="text-center">4784562</td>
                            <td class="text-center">سهیل کاشانی</td>
                            <td class="text-center">6543219</td>
                            <td class="text-center">شارژر Type C</td>
                            <td class="text-center">در انتظار تایید</td>
                            <td class="text-center">

                                <a href="{{route('admin.market.comment.show')}}" class="btn btn-info btn-sm" type="submit"><i class="fa fa-eye"></i> نمایش</a>
                                <a href="#" class="btn btn-success btn-sm"><i class="fa fa-check"></i> تایید</a>

                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">2</th>
                            <td class="text-center">4722262</td>
                            <td class="text-center">ملیکا ترابی</td>
                            <td class="text-center">8526554</td>
                            <td class="text-center">شارژر معمولی</td>
                            <td class="text-center">تایید شده</td>
                            <td class="text-center">

                                <a href="#" class="btn btn-info btn-sm" type="submit"><i class="fa fa-eye"></i> نمایش</a>
                                <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-clock"></i> عدم تایید</a>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>

@endsection
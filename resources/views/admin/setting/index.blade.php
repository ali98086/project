@extends('admin.layouts.master')


@section('title','تنظیمات')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#"> تنظیمات</a></li>
        <li class="breadcrumb-item active" aria-current="page"> تنظیمات</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    تنظیمات
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="#" class="btn btn-primary btn-sm disabled">ایجاد تنظیم جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">نام سایت</th>
                            <th class="text-center width-16-rem">عنوان سایت</th>
                            <th class="text-center width-16-rem">کلمات کلیدی</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody class="h-150px">
                        <tr>
                            <th class="text-center">1</th>
                            <td class="text-center">فروشگاه</td>
                            <td class="text-center">فروشگاه</td>
                            <td class="text-center">سایت فروشگاهی،فروش انواع محصولات، محصولات ارزان</td>
                            <td class="text-center w-25">

                                <a class="btn btn-primary" href="#"><i class="fa fa-edit" aria-hidden="true"></i> ویرایش</a>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>
@endsection
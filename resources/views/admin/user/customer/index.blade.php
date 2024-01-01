@extends('admin.layouts.master')


@section('title','مشتریان')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش کاربران</a></li>
        <li class="breadcrumb-item active" aria-current="page"> مشتریان</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    مشتریان
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="#" class="btn btn-primary btn-sm disabled">ایجاد کاربر مشتری جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">نام</th>
                            <th class="text-center width-16-rem">نام خانوادگی</th>
                            <th class="text-center width-16-rem">ایمیل</th>
                            <th class="text-center width-16-rem">کد ملی</th>
                            <th class="text-center width-16-rem">شماره موبایل</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody class="h-150px">
                        <tr>
                            <th class="text-center">1</th>
                            <td class="text-center">علی</td>
                            <td class="text-center">یزدانی</td>
                            <td class="text-center">ali@yahoo.com</td>
                            <td class="text-center">0371598536</td>
                            <td class="text-center">09632587412</td>
                            <td>
                                <section class="text-center">

                                    <a class="btn btn-primary" href="#"><i class="fa fa-edit" aria-hidden="true"></i> ویرایش</a>
                                    <button class="btn btn-danger" type="submit"><i class="fa fa-trash-alt" aria-hidden="true"></i> حذف</button>
                                    
                                </section>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>
@endsection
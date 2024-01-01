@extends('admin.layouts.master')


@section('title','پرداخت های آفلاین')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item active" aria-current="page"> پرداخت های آفلاین</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    پرداخت های آفلاین
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="#" class="btn btn-primary btn-sm disabled" aria-disabled="true">ایجاد پرداخت جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">کد تراکنش</th>
                            <th class="text-center width-16-rem">بانک</th>
                            <th class="text-center width-16-rem">پرداخت کننده</th>
                            <th class="text-center width-16-rem">وضعیت پرداخت</th>
                            <th class="text-center width-16-rem">نوع پرداخت</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <th class="text-center">2</th>
                            <td class="text-center">4724562</td>
                            <td class="text-center">ملت</td>
                            <td class="text-center">کرم رضایی</td>
                            <td class="text-center">تایید شده</td>
                            <td class="text-center">آفلاین</td>

                            <td class="text-center w-25">

                                <a href="#" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> مشاهده</a>
                                <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-window-close"></i> باطل کردن</a>
                                <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> برگرداندن</a>

                            </td>

                        </tr>
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>

@endsection
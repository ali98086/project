@extends('admin.layouts.master')


@section('title','تیکت های بسته')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#"> تیکت ها</a></li>
        <li class="breadcrumb-item active" aria-current="page"> تیکت های بسته</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    تیکت های بسته
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="#" class="btn btn-primary btn-sm disabled">ایجاد تیکت جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">نویسنده تیکت</th>
                            <th class="text-center width-16-rem">عنوان تیکت</th>
                            <th class="text-center width-16-rem">دسته تیکت</th>
                            <th class="text-center width-16-rem">اولویت تیکت</th>
                            <th class="text-center width-16-rem">ارجاع شده از</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody class="h-150px">
                        <tr>
                            <th class="text-center">1</th>
                            <td class="text-center">مهران مدیری</td>
                            <td class="text-center">مشکل در پرداخت</td>
                            <td class="text-center">دسته فروش</td>
                            <td class="text-center">فوری</td>
                            <td class="text-center">-</td>
                            <td class="text-center w-25">

                                    <a class="btn btn-info" href="#"><i class="fa fa-eye" aria-hidden="true"></i> مشاهده</a>

                            </td>
                        </tr>
                        <tr>
                        <th class="text-center">2</th>
                            <td class="text-center">مهران مدیری</td>
                            <td class="text-center">مشکل در پرداخت</td>
                            <td class="text-center">دسته فروش</td>
                            <td class="text-center">فوری</td>
                            <td class="text-center">اکرم محمدی</td>
                            <td class="text-center w-25">

                                    <a class="btn btn-info" href="#"><i class="fa fa-eye" aria-hidden="true"></i> مشاهده</a>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>
@endsection
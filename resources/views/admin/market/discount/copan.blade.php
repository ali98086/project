@extends('admin.layouts.master')


@section('title','کوپن تخفیف')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item active" aria-current="page"> کوپن تخفیف</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    کوپن تخفیف
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.discount.copan.create')}}" class="btn btn-primary btn-sm">ایجاد کوپن تخفیف جدید</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">کد کوپن</th>
                            <th class="text-center width-16-rem">درصد تخفیف</th>
                            <th class="text-center width-16-rem">سقف تخفیف</th>
                            <th class="text-center width-16-rem">نوع کوپن</th>
                            <th class="text-center width-16-rem">تاریخ پایان</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-center">1</th>
                            <td class="text-center">hd84d8d	</td>
                            <td class="text-center">15%</td>
                            <td class="text-center">25,000 تومان</td>
                            <td class="text-center">عمومی</td>
                            <td class="text-center">24 اردیبهشت 94</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>
@endsection
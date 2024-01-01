@extends('admin.layouts.master')


@section('title','تخفیف عمومی')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item active" aria-current="page"> تخفیف عمومی</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    تخفیف عمومی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.discount.commonDiscount.create')}}" class="btn btn-primary btn-sm">ایجاد تخفیف عمومی</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">درصد تخفیف</th>
                            <th class="text-center width-16-rem">سقف تخفیف</th>
                            <th class="text-center width-16-rem">عنوان مناسبت</th>
                            <th class="text-center width-16-rem">تاریخ شروع</th>
                            <th class="text-center width-16-rem">تاریخ پایان</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-center">1</th>
                            <td class="text-center">15%	</td>
                            <td class="text-center">ندارد</td>
                            <td class="text-center">میلاد امام علی (ع)</td>
                            <td class="text-center">24 اردیبهشت 1402</td>
                            <td class="text-center">26 اردیبهشت 1402</td>
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
@extends('admin.layouts.master')


@section('title','سفارشات باطل شده')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item active" aria-current="page"> سفارشات باطل شده</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    سفارشات باطل شده
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="#" class="btn btn-primary btn-sm disabled" aria-disabled="true">ایجاد سفارش جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">کد سفارش</th>
                            <th class="text-center width-16-rem">مبلغ سفارش</th>
                            <th class="text-center width-16-rem">مبلغ تخفیف</th>
                            <th class="text-center width-16-rem">مبلغ نهایی</th>
                            <th class="text-center width-16-rem">وضعیت پرداخت</th>
                            <th class="text-center width-16-rem">شیوه پرداخت</th>
                            <th class="text-center width-16-rem">بانک</th>
                            <th class="text-center width-16-rem">وضعیت ارسال</th>
                            <th class="text-center width-16-rem">شیوه ارسال</th>
                            <th class="text-center width-16-rem">وضعیت سفارش</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody class="h-150px">

                        <tr>
                            <th class="text-center">1</th>
                            <td class="text-center">9953-4722262</td>
                            <td class="text-center">380,000 تومان</td>
                            <td class="text-center">30,000 تومان</td>
                            <td class="text-center">410,000 تومان</td>
                            <td class="text-center"><i class="fa fa-credit-card" aria-hidden="true"></i> پرداخت شده</td>
                            <td class="text-center">آنلاین</td>
                            <td class="text-center">ملت</td>
                            <td class="text-center"><i class="fa fa-clock" aria-hidden="true"></i> در حال ارسال</td>
                            <td class="text-center">پیک موتوری</td>
                            <td class="text-center"><i class="fa fa-clock" aria-hidden="true"></i> در حال ارسال</td>
                            <td>
                                <section class="dropdown text-center">
                                     <a href="#" class="btn btn-success btn-sm dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-wrench" aria-hidden="true"></i>
                                        عملیات
                                    </a> 

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-images" aria-hidden="true"></i> مشاهده فاکتور</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-list-ul" aria-hidden="true"></i> تغییر وضعیت ارسال</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-edit" aria-hidden="true"></i> تغییر وضعیت سفارش</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-window-close" aria-hidden="true"></i> باطل کردن سفارش</a></li>
                                    </ul>

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
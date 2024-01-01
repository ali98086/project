@extends('admin.layouts.master')


@section('title','کالا ها')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item active" aria-current="page"> کالا ها</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    کالا ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.product.create')}}" class="btn btn-primary btn-sm">ایجاد کالای جدید</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">نام کالا</th>
                            <th class="text-center width-16-rem">تصویر کالا</th>
                            <th class="text-center width-16-rem">قیمت</th>
                            <th class="text-center width-16-rem">وزن</th>
                            <th class="text-center width-16-rem">دسته</th>
                            <th class="text-center width-16-rem">فرم</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody class="h-150px">
                        <tr>
                            <th class="text-center">1</th>
                            <td class="text-center">LED سامسونگ	</td>
                            <td class="text-center"><img src="{{asset('admin-assets/images/avatar-2.jpg')}}" class="max-height-2rem"/></td>
                            <td class="text-center">12,000,000 تومان</td>
                            <td class="text-center">13 کیلوگرم</td>
                            <td class="text-center">کالای صوتی تصویری</td>
                            <td class="text-center">نمایشگر</td>

                        <td>
                                <section class="dropdown text-center h-35">
                                     <a href="#" class="btn btn-success btn-sm dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-wrench" aria-hidden="true"></i>
                                        عملیات
                                    </a> 

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-images" aria-hidden="true"></i> گالری</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-list-ul" aria-hidden="true"></i> فرم کالا</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-edit" aria-hidden="true"></i> ویرایش</a></li>
                                        <form action="" method="post">
                                        <li><button class="dropdown-item" type="submit"><i class="fa fa-window-close" aria-hidden="true"></i> حذف</button></li>
                                        </form>
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
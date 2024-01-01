@extends('admin.layouts.master')


@section('title','برندها')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item active" aria-current="page"> برندها</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    برندها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.brand.create')}}" class="btn btn-primary btn-sm">ایجاد برند جدید</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">نام برند</th>
                            <th class="text-center width-16-rem">لوگو</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-center">1</th>
                            <td class="text-center">سامسونگ	</td>
                            <td class="text-center"><img src="{{asset('admin-assets/images/avatar-2.jpg')}}" class="max-height-2rem"/></td>
                            <td class="text-center">
                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">2</th>
                            <td class="text-center">هواوی </td>
                            <td class="text-center"><img src="{{asset('admin-assets/images/avatar-2.jpg')}}" class="max-height-2rem"/></td>
                            <td class="text-center">
                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">3</th>
                            <td class="text-center">ال جی </td>
                            <td class="text-center"><img src="{{asset('admin-assets/images/avatar-2.jpg')}}" class="max-height-2rem"/></td>
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
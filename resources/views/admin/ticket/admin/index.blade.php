@extends('admin.layouts.master')


@section('title','ادمین تیکت')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"><a href=""> تیکت ها</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ادمین تیکت</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ادمین تیکت
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="#" class="btn btn-primary btn-sm disabled">ایجاد ادمین تیکت جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">نام ادمین</th>
                            <th class="text-center width-16-rem">ایمیل ادمین</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> مجوز دسترسی ادمین به تیکت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $key=>$admin)
                        <tr>
                            <th class="text-center">{{++$key}}</th>
                            <td class="text-center">{{$admin->full_name}}</td>
                            <td class="text-center">{{$admin->email}}</td>
                            <td class="text-center w-25">

                                <a href="{{route('admin.ticket.admin.set', $admin->id)}}" class="btn btn-sm btn-{{$admin->admin == null ? 'warning' : 'danger'}}">
                                    
                                    <i class="fa fa-{{$admin->admin == null ? 'check' : 'times'}}" aria-hidden="false"></i> 
                            
                                    {{$admin->admin == null ? 'اضافه کردن' : 'حذف'}}

                                </a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>
@endsection
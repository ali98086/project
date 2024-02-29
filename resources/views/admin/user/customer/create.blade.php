@extends('admin.layouts.master')


@section('title','ایجاد کاربر مشتری جدید')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#"> بخش کاربران</a></li>
        <li class="breadcrumb-item "><a href="#"> مشتریان</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ایجاد کاربر مشتری جدید</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ایجاد کاربر مشتری جدید
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.user.customer.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.user.customer.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">نام</label>
                                <input type="text" name="first_name" class="form-control form-control-sm" value="{{old('first_name')}}">
                            </div>
                            @error('first_name')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">نام خانوادگی</label>
                                <input type="text" name="last_name" class="form-control form-control-sm" value="{{old('last_name')}}">
                            </div>
                            @error('last_name')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">پست الکترونیکی</label>
                                <input type="text" name="email" class="form-control form-control-sm" value="{{old('email')}}">
                            </div>
                            @error('email')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">کد ملی</label>
                                <input type="text" name="national_code" class="form-control form-control-sm" value="{{old('national_code')}}">
                            </div>
                            @error('national_code')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">شماره موبایل</label>
                                <input type="text" name="mobile" class="form-control form-control-sm" value="{{old('mobile')}}">
                            </div>
                            @error('mobile')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">رمز عبور</label>
                                <input type="text" name="password" class="form-control form-control-sm">
                            </div>
                            @error('password')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تکرار رمز عبور</label>
                                <input type="text" name="password_confirmation" class="form-control form-control-sm">
                            </div>
                            @error('password_confirmation')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تصویر</label>
                                <input type="file" name="profile_photo_path" class="form-control form-control-sm">
                            </div>
                            @error('profile_photo_path')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">وضعیت فعالسازی</label>
                                <select name="activation" id="" class="form-control form-control-sm">
                                    <option value="0">غیر فعال</option>
                                    <option value="1">فعال</option>
                                </select>
                            </div>
                            @error('activation')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 mt-3 pb-2">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>

                        

                    </section>
            </section>
            </form>
        </section>

    </section>
</section>
</section>

@endsection

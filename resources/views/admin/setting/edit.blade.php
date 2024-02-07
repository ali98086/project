@extends('admin.layouts.master')


@section('title','ویرایش تنظیمات')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item" aria-current="page"> تنظیمات</li>
        <li class="breadcrumb-item active" aria-current="page"> ویرایش تنظیمات</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش تنظیمات
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.setting.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.setting.update', $setting->id)}}" id="form" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <section class="row">

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="">عنوان سایت</label>
                                <input type="text" name="title" class="form-control form-control-sm" value="{{$setting->title}}">
                            </div>
                            @error('title')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 my-2">
                            <div class="form-group">
                                <label for="">توضیحات سایت</label>
                                <textarea name="description" type="text" class="form-control form-control-sm" rows="4">{{$setting->description}}</textarea>
                            </div>
                            @error('description')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 my-2">
                            <div class="form-group">
                                <label for="">کلمات کلیدی سایت</label>
                                <input type="text" name="keywords" class="form-control form-control-sm" value="{{$setting->keywords}}">
                            </div>
                            @error('keywords')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="logo">لوگوی سایت</label>
                                <input id="logo" type="file" name="logo" class="form-control form-control-sm">
                                <section class="mt-2">
                                    <img src="{{asset($setting->logo)}}" width="150px" height="100px"/>
                                </section>
                            </div>
                            @error('logo')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="icon">آیکون سایت</label>
                                <input id="icon" type="file" name="icon" class="form-control form-control-sm">
                                <section class="mt-2">
                                    <img src="{{asset($setting->icon)}}" width="150px" height="100px"/>
                                </section>
                            </div>
                            @error('icon')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 mt-4">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection

@extends('admin.layouts.master')


@section('title','ایجاد فایل اطلاعیه ایمیلی')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">اطلاع رسانی</a></li>
        <li class="breadcrumb-item"> <a href="#">اطلاعیه ایمیلی</a></li>
        <li class="breadcrumb-item"> <a href="#">فایل اطلاعیه ایمیلی</a></li>
        <li class="breadcrumb-item active" aria-current="page">ایجاد فایل اطلاعیه ایمیلی</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                ایجاد فایل اطلاعیه ایمیلی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.notify.email-file.index', $email->id)}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.notify.email-file.store', $email->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="">فایل</label>
                                <input type="file" name="file" class="form-control form-control-sm">
                            </div>
                            @error('file')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">

                            <div class="form-group">
                                <label for="">وضعیت</label>
                                <select class="form-control form-control-sm" name="status">
                                    <option value="0" @if(old('status')==0) 'selected' @endif>غیر فعال</option>
                                    <option value="1" @if(old('status')==1) 'selected' @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="" class="mb-3">مکان ذخیره سازی فایل :</label>
                                <section class="d-flex">
                               ذخیره در Public <input type="radio" id="public" name="placeSave" class="ml-3" value="public">
                               ذخیره در Storage <input type="radio" id="storage" name="placeSave" value="storage">
                               </section>
                            </div>
                            @error('placeSave')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 my-2">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection

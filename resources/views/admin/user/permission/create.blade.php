@extends('admin.layouts.master')


@section('title','ایجاد دسترسی جدید')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#"> بخش کاربران</a></li>
        <li class="breadcrumb-item "><a href="#"> سطوح دسترسی</a></li>
        <li class="breadcrumb-item "><a href="#"> مدیریت دسترسی ها</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ایجاد دسترسی جدید</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ایجاد دسترسی جدید
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.user.role.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.user.permission.store')}}" method="post">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عنوان دسترسی</label>
                                <input type="text" class="form-control form-control-sm" name="name" value="{{old('name')}}">
                            </div>
                            @error('name')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">توضیح دسترسی</label>
                                <input type="text" class="form-control form-control-sm" name="description" value="{{old('description')}}">
                            </div>
                            @error('description')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 mt-3 border-bottom pb-3">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>

                        
                        </section>

                    </section>
            </section>
            </form>
        </section>

    </section>
</section>
</section>

@endsection

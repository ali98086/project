@extends('admin.layouts.master')


@section('title','ایجاد پست جدید')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش محتوا</a></li>
        <li class="breadcrumb-item"> <a href="#">پست ها</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ایجاد پست جدید</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ایجاد پست جدید
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.content.post.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="" method="">
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عنوان پست</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">انتخاب دسته</label>
                                <select class="form-control form-control-sm">
                                    
                                    <option>دسته را انتخاب کنید</option>
                                    <option>کالای الکترونیکی</option>

                                </select>
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تصویر</label>
                                <input type="file" class="form-control form-control-sm">
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تاریخ انتشار</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </section>
                        <section class="col-12">
                            <div class="form-group">
                                <label for="">متن پست</label>
                                <textarea id="body" type="text" class="form-control form-control-sm" rows="4"></textarea>
                            </div>
                        </section>
                        <section class="col-12">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection

@section('script')

<script src="{{asset('admin-assets/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('body');
</script>
@endsection
@extends('admin.layouts.master')


@section('title','ایجاد منوی جدید')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش محتوا</a></li>
        <li class="breadcrumb-item"> <a href="#">منو</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ایجاد منوی جدید</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ایجاد منوی جدید
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.content.menu.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="" method="">
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عنوان منو</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">منوی والد</label>
                                <input type="text" class="form-control form-control-sm"/>
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">آدرس URL</label>
                                <input type="text" class="form-control form-control-sm"/>
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تصویر</label>
                                <input type="file" class="form-control form-control-sm"/>
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
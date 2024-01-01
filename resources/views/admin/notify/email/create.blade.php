@extends('admin.layouts.master')


@section('title','ایجاد اطلاعیه ایمیلی')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#"> اطلاع رسانی</a></li>
        <li class="breadcrumb-item "><a href="#"> اطلاعیه ایمیلی</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ایجاد اطلاعیه ایمیلی</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ایجاد اطلاعیه ایمیلی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.notify.email.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="" method="post">
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عنوان ایمیل</label>
                                <input type="text" class="form-control form-control-sm">
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
                                <label for="">متن ایمیل</label>
                                <textarea class="form-control form-control-sm" id="body" rows="4"></textarea>
                            </div>
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

@section('script')

<script src="{{asset('admin-assets/ckeditor/ckeditor.js')}}"></script>

<script>

CKEDITOR.replace('body');

</script>

@endsection

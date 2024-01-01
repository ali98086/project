@extends('admin.layouts.master')


@section('title','ایجاد اطلاعیه پیامکی')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#"> اطلاع رسانی</a></li>
        <li class="breadcrumb-item "><a href="#"> اطلاعیه پیامکی</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ایجاد اطلاعیه پیامکی</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ایجاد اطلاعیه پیامکی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.notify.sms.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="" method="post">
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عنوان پیامک</label>
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
                                <label for="">متن پیامک</label>
                                <textarea class="form-control form-control-sm" rows="4"></textarea>
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



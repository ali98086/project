@extends('admin.layouts.master')


@section('title','نمایش نظر')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="{{route('admin.market.comment.index')}}">نظر ها</a></li>
        <li class="breadcrumb-item active" aria-current="page"> نمایش نظر ها</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    نمایش نظر ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.comment.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="card">

                <section class="card-header ">

                    <h6 class="mb-0">4784562 - سهیل کاشانی</h6>

                </section>
                <section class="card-body">

                    <h4>مشخصات کالا : شارژر Type C کد کالا: 6543219</h4>
                    <p class="mb-0">به نظر من شارژر خوبیه ولی قیمتش گرونه</p>

                </section>

            </section>

            <section>

                <form>
                    <section class="row">
                        <section class="col-12 mt-3">
                            <section class="form-group">
                                <label for="">پاسخ ادمین</label>
                                <textarea class="form-control form-control-sm" id="" rows="4"></textarea>
                                <button class="btn btn-primary btn-sm mt-3">ثبت</button>
                            </section>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
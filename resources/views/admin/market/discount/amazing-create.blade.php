@extends('admin.layouts.master')


@section('title','افزودن به فروش شگفت انگیز')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">  بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="{{route('admin.market.discount.commonDiscount')}}">  فروش شگفت انگیز</a></li>
        <li class="breadcrumb-item active" aria-current="page">  افزودن به فروش شگفت انگیز</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                افزودن به فروش شگفت انگیز
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.discount.amazingSale')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="" method="">
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">نام کالا</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">درصد تخفیف</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تاریخ شروع</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تاریخ پایان</label>
                                <input type="text" class="form-control form-control-sm">
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
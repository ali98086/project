@extends('admin.layouts.master')


@section('title','ایجاد نقش جدید')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#"> بخش کاربران</a></li>
        <li class="breadcrumb-item "><a href="#"> سطوح دسترسی</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ایجاد نقش جدید</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ایجاد نقش جدید
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.user.role.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="" method="post">
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عنوان نقش</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">توضیح نقش</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </section>

                        <section class="col-12 mt-3 border-bottom pb-3">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>

                        <section class="col-md-3 mt-3">
                            <section class="form-check">

                            <input type="checkbox" class="form-check-input" id="check1" checked/>
                            <label for="check1" class="form-check-label mr-3 font-size-14px">نمایش دسته جدید</label>

                        </section>
                        </section>

                        <section class="col-md-3 mt-3">
                            <section class="form-check">

                            <input type="checkbox" class="form-check-input" id="check2" checked/>
                            <label for="check2" class="form-check-label mr-3 font-size-14px">ایجاد دسته جدید</label>

                        </section>
                        </section>

                        <section class="col-md-3 mt-3">
                            <section class="form-check">

                            <input type="checkbox" class="form-check-input" id="check3" checked/>
                            <label for="check3" class="form-check-label mr-3 font-size-14px">ویرایش دسته جدید</label>

                        </section>
                        </section>

                        <section class="col-md-3 mt-3">
                            <section class="form-check">

                            <input type="checkbox" class="form-check-input" id="check4" checked/>
                            <label for="check4" class="form-check-label mr-3 font-size-14px">حذف دسته جدید</label>

                        </section>
                        </section>

                        <section class="col-md-3 mt-3">
                            <section class="form-check">

                            <input type="checkbox" class="form-check-input" id="check5" checked/>
                            <label for="check5" class="form-check-label mr-3 font-size-14px">نمایش کالا جدید</label>

                        </section>
                        </section>

                        <section class="col-md-3 mt-3">
                            <section class="form-check">

                            <input type="checkbox" class="form-check-input" id="check6" checked/>
                            <label for="check6" class="form-check-label mr-3 font-size-14px">ایجاد کالا جدید</label>

                        </section>
                        </section>

                        <section class="col-md-3 mt-3">
                            <section class="form-check">

                            <input type="checkbox" class="form-check-input" id="check7" checked/>
                            <label for="check7" class="form-check-label mr-3 font-size-14px">ویرایش کالا جدید</label>

                        </section>
                        </section>

                        <section class="col-md-3 mt-3">
                            <section class="form-check">

                            <input type="checkbox" class="form-check-input" id="check8" checked/>
                            <label for="check8" class="form-check-label mr-3 font-size-14px">حذف کالا جدید</label>

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

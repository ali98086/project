@extends('admin.layouts.master')


@section('title','ایجاد کالا')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#"> بخش فروش</a></li>
        <li class="breadcrumb-item "> کالا ها</li>
        <li class="breadcrumb-item active" aria-current="page"> ایجاد کالا</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ایجاد کالا
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.product.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="" method="post">
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">نام کالا</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">دسته کالا</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">فرم کالا</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تصویر</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">وزن</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">قیمت کالا</label>
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for=""> توضیحات</label>
                                <textarea id="body" class="form-control form-control-sm" rows="10"></textarea>
                            </div>
                        </section>

                        <section class="col-12 border-top border-bottom pt-3">

                            <section class="row">

                                <section class="col-6 col-md-3">

                                    <section class="form-group">
                                        <input type="text" class="form-control form-control-sm" placeholder="ویژگی ..." />
                                    </section>

                                </section>

                                <section class="col-6 col-md-3">

                                    <section class="form-group">
                                        <input type="text" class="form-control form-control-sm" placeholder="مقدار ..." />
                                    </section>

                                </section>

                            </section>

                            <section class="mb-3">

                            <button type="button" class="btn btn-success btn-sm">افزودن</button>

                            </section>

                        </section>

                        <section class="col-12 mt-3">
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
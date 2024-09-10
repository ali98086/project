@extends('admin.layouts.master')


@section('title','ویژگی های فرم کالا')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#">فرم کالا</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ویژگی های فرم کالا</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویژگی های فرم کالا
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <section>
                <a href="{{route('admin.market.property.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <a href="{{route('admin.market.property.value.create', $categoryAttribute->id)}}" class="btn btn-primary btn-sm" aria-disabled="true">ایجاد مقدار فرم کالا جدید</a>
                </section>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">نام محصول</th>
                            <th class="text-center width-16-rem">نام فرم</th>
                            <th class="text-center width-16-rem">مقدار</th>
                            <th class="text-center width-16-rem">میزان افزایش قیمت</th>
                            <th class="text-center width-16-rem">دسته والد</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($categoryAttribute->values as $key=>$value)
                        <tr>
                            <th class="text-center">{{++$key}}</th>
                            <td class="text-center">{{$value->product->name}}</td>
                            <td class="text-center">{{empty($value->categoryAttribute) ? '_' : $value->categoryAttribute->name}}</td>
                            <td class="text-center">{{json_decode($value->value)->value}}</td>
                            <td class="text-center">{{json_decode($value->value)->price_increase.' تومان'}}</td>
                            <td class="text-center">{{$categoryAttribute->category->name}}</td>
                            
                            <td class="text-center w-25">

                                <a href="{{route('admin.market.property.value.edit', ['categoryAttribute'=> $categoryAttribute->id, 'value'=> $value->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form action="{{route('admin.market.property.value.destroy', ['categoryAttribute'=> $categoryAttribute->id, 'value'=> $value->id])}}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash-alt"></i> حذف</button>
                                </form>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>

@endsection

@section('script')

@include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
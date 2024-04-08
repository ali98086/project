@extends('admin.layouts.master')


@section('title','کالا ها')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item active" aria-current="page"> کالا ها</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    کالا ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.product.create')}}" class="btn btn-primary btn-sm">ایجاد کالای جدید</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">نام کالا</th>
                            <th class="text-center width-16-rem">برند کالا</th>
                            <th class="text-center width-16-rem">تصویر کالا</th>
                            <th class="text-center width-16-rem">قیمت</th>
                            <th class="text-center width-16-rem">وزن</th>
                            <th class="text-center width-16-rem">دسته</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody class="h-150px">
                        @foreach($products as $key=>$product)
                        <tr>
                            <th class="text-center">{{$key += 1 }}</th>
                            <td class="text-center">{{$product->name}}</td>
                            <td class="text-center">{{$product->brand->persian_name.' '.$product->brand->orginal_name}}</td>
                            <td class="text-center"><img src="{{asset($product->image)}}" class="max-height-2rem" alt="تصویر ندارد"/></td>
                            <td class="text-center">{{number_format($product->price);}} تومان</td>
                            <td class="text-center">{{Str::of($product->weight)->startsWith('0') ? $product->weight : Str::of($product->weight)->before('.');}} کیلوگرم</td>
                            <td class="text-center">{{$product->productCategory->name}}</td>

                        <td>
                                <section class="dropdown text-center h-35">

                                    <div class="dropdown">
                                    <a href="#" class="btn btn-success btn-sm btn-block dorpdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-tools"></i> عملیات
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a href="{{route('admin.market.product.gallery.index', $product->id)}}" class="dropdown-item text-right"><i class="fa fa-images"></i> گالری</a>
                                        <a href="{{route('admin.market.product.color.index', $product->id)}}" class="dropdown-item text-right"><i class="fa fa-list-ul"></i> رنگ کالا</a>
                                        <a href="{{ route('admin.market.product.edit', $product->id) }}" class="dropdown-item text-right"><i class="fa fa-edit"></i> ویرایش</a>
                                        <form class="d-inline" action="{{ route('admin.market.product.destroy', $product->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-right delete"><i class="fa fa-window-close"></i> حذف</button>
                                        </form>
                                    </div>
                                </div>

                                </section>                              

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
@extends('admin.layouts.master')


@section('title','گالری')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#">کالا ها</a></li>
        <li class="breadcrumb-item active" aria-current="page"> گالری</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    گالری
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <section>
                <a href="{{route('admin.market.product.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <a href="{{route('admin.market.product.gallery.create' , $product->id)}}" class="btn btn-primary btn-sm">ایجاد عکس جدید</a>
                </section>
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
                            <th class="text-center width-16-rem">عکس</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product->images as $key=>$image)
                        <tr>
                            <th class="text-center">{{$key += 1 }}</th>
                            <td class="text-center">{{$product->name}}</td>
                            <td class="text-center"><img src="{{asset($image->image)}}" class="max-height-2rem" alt="تصویر ندارد"/></td>

                            <td class="text-center">
                                <form action="{{route('admin.market.product.gallery.destroy', ['product'=>$product->id, 'productGallery'=>$image->id])}}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
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
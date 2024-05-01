@extends('admin.layouts.master')

@section('head-tag')

<link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}" />

@endsection 

@section('title','ویرایش کالا')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#">کالا ها</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ویرایش کالا</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش کالا
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.product.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.market.product.update', $product->id)}}" id="form" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">نام کالا</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="{{old('name', $product->name)}}">
                            </div>
                            @error('name')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="category_id">دسته کالا</label>
                                <select name="category_id" id="category_id" class="form-control form-control-sm">

                                    @foreach($productCategories as $productCategory)
                                        <option value="{{$productCategory->id}}" {{$product->category_id == $productCategory->id ? 'selected' : ''}}>{{$productCategory->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('category_id')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="brand_id">برند کالا</label>
                                <select name="brand_id" id="brand_id" class="form-control form-control-sm">

                                    <option value="">برند کالا را انتخاب کنید</option>

                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" {{$product->brand_id == $brand->id ? 'selected' : ''}}>{{$brand->persian_name.' _ '.$brand->orginal_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            @error('brand_id')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="image">تصویر</label>

                                <section>

                                    <input id="image" type="file" name="image" class="form-control form-control-sm" onchange="document.getElementById('imagesize').classList.add('d-block'); document.getElementById('img').classList.add('d-none')">

                                    <img src="{{asset($product->image)}}" id="img" class="mt-2" width="150px" height="150px" alt="تصویر ندارد" />

                                </section>
                            </div>
                            @error('image')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror


                            <section id="imagesize" class="mt-2 {{$product->image != null ? 'd-none' : 'd-none'}}">
                                <p>انتخاب سایز تصویر : (دلخواه)</p>
                                <input type="radio" id="size1" name="size" value="small">
                                <label for="size1">120*160 - کوچک</label><br>
                                <input type="radio" id="size2" name="size" value="medium">
                                <label for="size2">240*320 - متوسط</label><br>
                                <input type="radio" id="size3" name="size" value="anotherMedium">
                                <label for="size3">350*350 - متوسط</label><br>
                                <input type="radio" id="size4" name="size" value="large">
                                <label for="size4">600*800 - بزرگ</label>
                            </section>
                            <hr>

                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">وزن (کیلوگرم)</label>
                                <input type="text" name="weight" class="form-control form-control-sm" value="{{old('weight', $product->weight)}}">
                            </div>
                            @error('weight')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">طول (سانتیمتر)</label>
                                <input type="text" name="length" class="form-control form-control-sm" value="{{old('length', Str::of($product->length)->before('.'))}}">
                            </div>
                            @error('length')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عرض (سانتیمتر)</label>
                                <input type="text" name="width" class="form-control form-control-sm" value="{{old('width', Str::of($product->width)->before('.'))}}">
                            </div>
                            @error('width')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">ارتفاع (سانتیمتر)</label>
                                <input type="text" name="height" class="form-control form-control-sm" value="{{old('height', Str::of($product->height)->before('.'))}}">
                            </div>
                            @error('height')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 mt-2">
                            <div class="form-group">
                                <label for="description">توضیحات</label>
                                <textarea id="description" type="text" name="description" class="form-control form-control-sm">{{old('description', $product->description)}}</textarea>
                            </div>
                            @error('description')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12">
                            <div class="form-group">
                                <label for=""> قیمت کالا (تومان)</label>
                                <input type="text" name="price" class="form-control form-control-sm" value="{{old('price', Str::of($product->price)->before('.'))}}">
                            </div>
                            @error('price')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="marketable">قابل فروش بودن کالا</label>
                                <select name="marketable" id="marketable" class="form-control form-control-sm">
                                    <option value="0" @if($product->marketable == 0) {{'selected'}} @endif>غیر فعال</option>
                                    <option value="1" @if($product->marketable == 1) {{'selected'}} @endif>فعال</option>
                                </select>
                            </div>
                            @error('marketable')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 mt-2">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if($product->status ==0) {{'selected'}} @endif>غیر فعال</option>
                                    <option value="1" @if($product->status ==1) {{'selected'}} @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 ">
                        <div class="form-group">
                            <label for="tags">تگ ها</label>
                            <input id="tags" name="tags" type="hidden" class="form-control form-control-sm" value="{{$product->tags}}">
                            <select class="select2 form-control form-control-sm" id="select_tags" multiple>
                            </select>
                        </div>
                        @error('tags')
                        <span class="text-white bg-danger rounded">
                            {{$message}}
                        </span>
                        @enderror
                    </section>
                    </section>

                    <section class="col-12 col-md-6 pr-0">
                        <div class="form-group">
                            <label for="">تاریخ انتشار</label>
                            <input type="text" id="published_at" name="published_at" class="form-control form-control-sm d-none">
                            <input type="text" id="published_at_view" class="form-control form-control-sm" value="{{$product->published_at}}">
                        </div>
                        @error('published_at')
                        <span class="text-white bg-danger rounded">
                            {{$message}}
                        </span>
                        @enderror
                    </section>


                    <section class="col-12 border-top border-bottom pt-3">
                        
                        @foreach($product->metas as $productMeta)
                        <section class="row">

                            <section class="col-6 col-md-3">

                                <section class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="meta_key[{{$productMeta->id}}]" placeholder="ویژگی ..." value="{{$productMeta->meta_key}}"/>
                                </section>
                                @error('meta_key.*')
                                <span class="text-white bg-danger rounded">
                                    {{$message}}
                                </span>
                                @enderror

                            </section>

                            <section class="col-6 col-md-3">

                                <section class="form-group">
                                    <input type="text" class="form-control form-control-sm" name="meta_value[]" placeholder="مقدار ..." value="{{$productMeta->meta_value}}"/>
                                </section>
                                @error('meta_value.*')
                                <span class="text-white bg-danger rounded">
                                    {{$message}}
                                </span>
                                @enderror

                            </section>

                        </section>
                        @endforeach

                    </section>


            </section>
            <section class="col-12 mt-4">
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

<script src="{{asset('admin-assets/jalalidatepicker/persian-date.min.js')}}"></script>
<script src="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
<script src="{{asset('admin-assets/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('description');
</script>

<script>
    $(document).ready(function() {
        $('#published_at_view').persianDatepicker({
            format: 'YYYY/MM/DD',
            altField: '#published_at'
        })
    });
</script>

<script>
    $(document).ready(function() {
        var tags_input = $('#tags');
        var select_tags = $('#select_tags');
        var default_tags = tags_input.val();
        var default_data = null;

        if (tags_input.val() !== null && tags_input.val().length > 0) {
            default_data = default_tags.split(',');
        }

        select_tags.select2({
            placeholder: 'لطفا تگ های خود را وارد نمایید',
            tags: true,
            data: default_data
        });
        select_tags.children('option').attr('selected', true).trigger('change');


        $('#form').submit(function(event) {
            if (select_tags.val() !== null && select_tags.val().length > 0) {
                var selectedSource = select_tags.val().join(',');
                tags_input.val(selectedSource)
            }
        })
    })
</script>

<script>
    $(function() {
        $('#btn-copy').on('click', function() {
            var ele = $(this).parent().prev().clone(true);
            $(this).before(ele);
        })
    })
</script>
@endsection
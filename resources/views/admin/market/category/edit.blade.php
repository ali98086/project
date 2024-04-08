@extends('admin.layouts.master')


@section('title','ویرایش دسته بندی')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#">دسته بندی</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ویرایش دسته بندی</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش دسته بندی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.category.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.market.category.update', $productcategory->id)}}" id="form" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <section class="row">

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="name">نام دسته</label>
                                <input id="name" type="text" name="name" class="form-control form-control-sm" value="{{old('name', $productcategory->name)}}">

                            </div>

                            @error('name')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 mt-2">
                            <div class="form-group">
                                <label for="">دسته والد</label>
                                <select name="parent_id" id="" class="form-control form-control-sm">

                                    <option value="" {{$productcategory->parent_id == null ? 'selected' : ''}}>منوی اصلی</option>

                                    @foreach($productCategories as $productCategory)
                                        <option value="{{$productCategory->id}}" @if($productCategory->id == $productcategory->parent_id) {{'selected'}} @endif>{{$productCategory->name}}</option>
                                    @endforeach

  
                                </select>
                            </div>
                            @error('parent_id')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 mt-2">
                            <div class="form-group">
                                <label for="description">توضیحات</label>
                                <textarea id="description" type="text" name="description" class="form-control form-control-sm">{{$productcategory->description}}</textarea>
                            </div>
                            @error('description')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="tags">تگ ها</label>
                                <input id="tags" name="tags" type="hidden" class="form-control form-control-sm" value="{{$productcategory->tags}}">
                                <select class="select2 form-control form-control-sm" id="select_tags" multiple>
                                </select>
                            </div>
                            @error('tags')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 mt-2">
                            <div class="form-group">
                                <label for="">نمایش در منو</label>
                                <select name="show_in_menu" id="" class="form-control form-control-sm">

                                    <option value="0"  @if($productcategory->show_in_menu == 0) {{'selected'}} @endif>غیر فعال</option>
                                    <option value="1"  @if($productcategory->show_in_menu == 1) {{'selected'}} @endif>فعال</option>

                                </select>
                            </div>
                            @error('show_in_menu')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if($productcategory->status == 0) {{'selected'}} @endif>غیر فعال</option>
                                    <option value="1" @if($productcategory->status == 1) {{'selected'}} @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="image">تصویر</label>
                                
                                
                                <section class="mt-2">

                                    <input id="image" type="file" name="image" class="form-control form-control-sm" onchange="document.getElementById('imagesize').classList.add('d-block')">

                                    <img src="{{asset($productcategory->image)}}" class="mt-2" width="150px" height="150px" alt="تصویر ندارد"/>

                                </section>
                            </div>
                            @error('image')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror

                                
                                <section id="imagesize" class="mt-2 {{$productcategory->image != null ? '' : 'd-none'}}">
                                <p>انتخاب سایز تصویر : (دلخواه)</p>
                                    <input type="radio" id="size1" name="size" value="small">
                                    <label for="size1">120*160 - کوچک</label><br>
                                    <input type="radio" id="size2" name="size" value="medium">
                                    <label for="size2">240*320 - متوسط</label><br>
                                    <input type="radio" id="size3" name="size" value="large">
                                    <label for="size3">600*800 - بزرگ</label>
                                </section>

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

<script src="{{asset('admin-assets/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('description');
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
@endsection
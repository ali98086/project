@extends('admin.layouts.master')


@section('title','ایجاد پرسش جدید')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش محتوا</a></li>
        <li class="breadcrumb-item"> <a href="#">سوالات متداول</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ایجاد پرسش جدید</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ایجاد پرسش جدید
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.content.faq.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.content.faq.store')}}" id="form" method="post">
                    
                    @csrf
                    <section class="row">

                        <section class="col-12">
                            <div class="form-group">
                                <label for="">پرسش</label>
                                <input type="text" name="question" class="form-control form-control-sm" value="{{old('question')}}">
                            </div>
                            @error('question')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="tags">تگ ها</label>
                                <input id="tags" name="tags" type="hidden" class="form-control form-control-sm" value="{{old('tags')}}">
                                <select class="select2 form-control form-control-sm" id="select_tags" multiple>

                                </select>
                            </div>

                            @error('tags')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">

                            <div class="form-group">
                                <label for="">وضعیت</label>
                                <select class="form-control form-control-sm" name="status">
                                    <option value="0" @if(old('status')==0) 'selected' @endif>غیر فعال</option>
                                    <option value="1" @if(old('status')==1) 'selected' @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 my-2">
                            <div class="form-group">
                                <label for="">پاسخ</label>
                                <textarea class="form-control form-control-sm" name="answer" id="body"></textarea>
                            </div>
                            @error('answer')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>
                        <section class="col-12 my-2">
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
    CKEDITOR.replace('body');
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
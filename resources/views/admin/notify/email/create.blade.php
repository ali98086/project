@extends('admin.layouts.master')

@section('head-tag')

<link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}" />

@endsection

@section('title','ایجاد اطلاعیه ایمیلی')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#"> اطلاع رسانی</a></li>
        <li class="breadcrumb-item "><a href="#"> اطلاعیه ایمیلی</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ایجاد اطلاعیه ایمیلی</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ایجاد اطلاعیه ایمیلی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.notify.email.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
            </section>

            <section>
            <form action="{{route('admin.notify.email.store')}}" method="post">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="">عنوان ایمیل</label>
                                <input type="text" name="subject" class="form-control form-control-sm" value="{{old('subject')}}">
                            </div>
                            @error('subject')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="">تاریخ انتشار</label>
                                <input type="text" id="published_at" name="published_at" class="form-control form-control-sm d-none">
                                <input type="text" id="published_at_view" class="form-control form-control-sm">
                            </div>
                            @error('published_at')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 my-2">
                            <div class="form-group">
                                <label for="">متن ایمیل</label>
                                <textarea class="form-control form-control-sm" name="body" rows="4">{{old('body')}}</textarea>
                            </div>
                            @error('body')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if(old('status')==0) {{'selected'}} @endif>غیر فعال</option>
                                    <option value="1" @if(old('status')==1) {{'selected'}} @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 mt-3 pb-2 my-2">
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

<script src="{{asset('admin-assets/jalalidatepicker/persian-date.min.js')}}"></script>
<script src="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
<script src="{{asset('admin-assets/ckeditor/ckeditor.js')}}"></script>

<script>

CKEDITOR.replace('body');

</script>

<script>
    $(document).ready(function() {
        $('#published_at_view').persianDatepicker({

            altField: '#published_at',
            altformat: 'LLLL',

            timePicker: {
                enabled: true,
                meridiem: {
                    enabled: true
                }
            }
        })
    });
</script>


@endsection
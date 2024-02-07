@extends('admin.layouts.master')

@section('head-tag')

<link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}" />

@endsection

@section('title','ویرایش اطلاعیه پیامکی')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#"> اطلاع رسانی</a></li>
        <li class="breadcrumb-item "><a href="#"> اطلاعیه پیامکی</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ویرایش اطلاعیه پیامکی</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش اطلاعیه پیامکی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.notify.sms.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.notify.sms.update', $sms->id)}}" id="form" method="post">
                    @csrf
                    @method('put')
                    <section class="row">

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="">عنوان اطلاعیه</label>
                                <input type="text" name="title" class="form-control form-control-sm" value="{{$sms->title}}">
                            </div>
                            @error('title')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="">تاریخ انتشار</label>
                                <input type="text" id="published_at" name="published_at" class="form-control form-control-sm d-none">
                                <input type="text" id="published_at_view" class="form-control form-control-sm" value="{{$sms->published_at}}">
                            </div>
                            @error('published_at')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 my-2">
                            <div class="form-group">
                                <label for="">متن پیامک</label>
                                <textarea id="body" name="body" type="text" class="form-control form-control-sm" rows="4">{{$sms->body}}</textarea>
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
                                    <option value="0" @if($sms->status == 0) {{'selected'}} @endif>غیر فعال</option>
                                    <option value="1" @if($sms->status == 1) {{'selected'}} @endif>فعال</option>
                                </select>
                            </div>
                            @error('status')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
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
@extends('admin.layouts.master')


@section('title','ویرایش اولویت')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item" aria-current="page"> تیکت ها</li>
        <li class="breadcrumb-item" aria-current="page"> اولویت</li>
        <li class="breadcrumb-item active" aria-current="page"> ویرایش اولویت</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش اولویت
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.ticket.priority.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.ticket.priority.update', $ticketPriority->id)}}" id="form" method="post" >
                    @csrf
                    @method('put')
                    <section class="row">

                    <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="">نام اولویت</label>
                                <input type="text" name="name" class="form-control form-control-sm" value="{{$ticketPriority->name}}">
                            </div>
                            @error('name')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if($ticketPriority->status==0) {{'selected'}} @endif>غیر فعال</option>
                                    <option value="1" @if($ticketPriority->status==1) {{'selected'}} @endif>فعال</option>
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

@extends('admin.layouts.master')


@section('title','ویرایش منو')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش محتوا</a></li>
        <li class="breadcrumb-item"> <a href="#">منو</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ویرایش منو</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش منو
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.content.menu.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.content.menu.update', $menu->id)}}" id="form" method="post">
                    @csrf
                    @method('put')
                    <section class="row">

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="">نام منو</label>
                                <input type="text" class="form-control form-control-sm" name="name" value="{{$menu->name}}">
                            </div>
                            @error('name')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="">منوی والد</label>
                                <select class="form-control form-control-sm" name="parent_id">

                                    <option value="" @if($menu->parent_id == null) {{'selected'}} @endif>
                                        {{'منوی اصلی'}}
                                    </option>
                                    @foreach($parent_menus as $Menu)
                                    <option value="{{$Menu->id}}" @if($Menu->id == $menu->parent_id) {{'selected'}} @endif>
                                        {{$Menu->name}}
                                    </option>
                                    @endforeach

                                </select>
                            </div>
                        </section>

                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="">لینک منو</label>
                                <input type="text" class="form-control form-control-sm" name="url" value="{{$menu->url}}" />
                            </div>
                            @error('url')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 my-2">

                            <div class="form-group">
                                <label for="">وضعیت</label>
                                <select class="form-control form-control-sm" name="status">
                                    <option value="0" @if($menu->status == 0) {{'selected'}} @endif>غیر فعال</option>
                                    <option value="1" @if($menu->status == 1) {{'selected'}} @endif>فعال</option>
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
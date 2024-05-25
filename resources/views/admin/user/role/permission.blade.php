@extends('admin.layouts.master')


@section('title','دسترسی ها')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش کاربران</a></li>
        <li class="breadcrumb-item"> <a href="#">سطوح دسترسی</a></li>
        <li class="breadcrumb-item"> <a href="#">مدیریت نقش ها</a></li>
        <li class="breadcrumb-item active" aria-current="page"> دسترسی ها</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                دسترسی ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.user.role.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>

            <form action="{{route('admin.user.role.update-permission', $role->id)}}" method="post">
                @csrf
                @method('put')

                <section class="border-bottom pb-3">
                <section class="col-6">
                   نقش :  {{$role->name}}
                </section>
                <section class="col-6">
                توضیح نقش :  {{$role->description}}
                </section>
                </section>
            @php

                $permissionsId= $role->permissions->pluck('id')->toArray();

            @endphp

            <p class="pt-3">سطوح دسترسی</p>
            <section class="d-flex flex-column">
            @foreach($permissions as $key=>$permission)
                        <section class="col-md-3 mt-2">
                            <section class="form-check">

                            <input type="checkbox" class="form-check-input" name="permissions[]" id="{{$permission->id}}" value="{{$permission->id}}" @if(in_array($permission->id , $permissionsId)) {{'checked'}} @endif/>
                            <label for="{{$permission->id}}" class="form-check-label mr-3 font-size-14px">{{$permission->name}}</label>

                        </section>
                        @error('permissions.'.$key)
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>
                        @endforeach
            </section>
            
            <section class="col-12 mt-4">
                <button class="btn btn-primary btn-sm">ثبت</button>
            </section>

            </form>
            </section>

        </section>
    </section>
</section>

@endsection

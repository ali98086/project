@extends('admin.layouts.master')


@section('title','نقش ها')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش کاربران</a></li>
        <li class="breadcrumb-item"> <a href="#">کاربران ادمین</a></li>
        <li class="breadcrumb-item active" aria-current="page"> نقش ها</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    نقش ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.user.admin.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>

                <form action="{{route('admin.user.admin.addRole' , $user->id)}}" method="post">
                    @csrf

                    @php

                    $rolesId= $user->roles->pluck('id')->toArray();

                    @endphp

                    <p class="pt-3">نقش ها</p>
                    <section class="col-md-3 d-flex">
                        @foreach($roles as $key=>$role)

                        <section class="form-check">

                            <input type="checkbox" class="form-check-input" name="roles[]" id="{{$role->id}}" value="{{$role->id}}" @if(in_Array($role->id , $rolesId)) checked @endif/>
                            <label for="{{$role->id}}" class="form-check-label mr-3 font-size-14px">{{$role->name}}</label>

                        </section>

                        @endforeach

                    </section>

                    <section class="my-3">
                    @error('roles'.$key)

                    <span class="text-white bg-danger rounded">
                        {{$message}}
                    </span>

                    @enderror
                    </section>

                    <section class="col-12">
                        <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
                    </section>

                </form>
            </section>

        </section>
    </section>
</section>

@endsection



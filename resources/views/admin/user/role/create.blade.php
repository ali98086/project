@extends('admin.layouts.master')


@section('title','ایجاد نقش جدید')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#"> بخش کاربران</a></li>
        <li class="breadcrumb-item "><a href="#"> سطوح دسترسی</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ایجاد نقش جدید</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ایجاد نقش جدید
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.user.role.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{route('admin.user.role.store')}}" method="post">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">عنوان نقش</label>
                                <input type="text" class="form-control form-control-sm" name="name" value="{{old('name')}}">
                            </div>
                            @error('name')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">توضیح نقش</label>
                                <input type="text" class="form-control form-control-sm" name="description" value="{{old('description')}}">
                            </div>
                            @error('description')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 mt-3 border-bottom pb-3">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>

                        @foreach($permissions as $key=>$permission)
                        <section class="col-md-3 mt-3">
                            <section class="form-check">

                            <input type="checkbox" class="form-check-input" name="permissions[]" id="{{$permission->id}}" value="{{$permission->id}}"/>
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

                    </section>
            </section>
            </form>
        </section>

    </section>
</section>
</section>

@endsection

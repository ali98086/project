@extends('admin.layouts.master')


@section('title','نقش ها')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش کاربران</a></li>
        <li class="breadcrumb-item active" aria-current="page"> سطوح دسترسی</li>
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
                <a href="{{route('admin.user.role.create')}}" class="btn btn-primary btn-sm" aria-disabled="true">ایجاد نقش جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">نام نقش</th>
                            <th class="text-center width-16-rem">توضیح نقش</th>
                            <th class="text-center width-16-rem">دسترسی ها</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($roles as $key=>$role)
                        <tr>
                            <th class="text-center">{{$key += 1}}</th>
                            <td class="text-center">{{$role->name}}</td>
                            <td class="text-center">{{$role->description}}</td>
                            <td class="text-center">

                                @if($role->permissions()->get()->toArray() == null)
                                
                                <span class="text-danger">بدون سطح دسترسی</span>

                                @else

                                @foreach($role->permissions as $permission)
                                {{$permission->name}}<br>
                                @endforeach

                                @endif
                            </td>
                            <td class="text-center w-25">

                                <a href="{{route('admin.user.role.permission', $role->id)}}" class="btn btn-success btn-sm"><i class="fa fa-user-graduate"></i> دسترسی ها</a>
                                <a href="{{route('admin.user.role.edit', $role->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i> حذف</a>

                            </td>

                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>

@endsection
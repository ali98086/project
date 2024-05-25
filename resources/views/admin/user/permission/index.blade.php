@extends('admin.layouts.master')


@section('title','دسترسی ها')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش کاربران</a></li>
        <li class="breadcrumb-item"> <a href="#">سطوح دسترسی</a></li>
        <li class="breadcrumb-item active" aria-current="page"> مدیریت دسترسی ها</li>
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
                <a href="{{route('admin.user.permission.create')}}" class="btn btn-primary btn-sm" aria-disabled="true">ایجاد دسترسی جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">نام دسترسی</th>
                            <th class="text-center width-16-rem">توضیح دسترسی</th>
                            <th class="text-center width-16-rem">نقش ها</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($permissions as $key=>$permission)
                        <tr>
                            <th class="text-center">{{$key += 1}}</th>
                            <td class="text-center">{{$permission->name}}</td>
                            <td class="text-center">{{$permission->description}}</td>
                            <td class="text-center">

                                @if($permission->roles()->get()->toArray() == null)
                                
                                <span class="text-danger">این دسترسی فاقد نقش ندارد.</span>

                                @else

                                @foreach($permission->roles as $role)

                                    {{$role->name}}<br>

                                @endforeach

                                @endif
                            </td>
                            <td class="text-center w-25">

                                <a href="{{route('admin.user.permission.edit', $permission->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form action="{{route('admin.user.permission.destroy' , $permission->id)}}" class="d-inline" method='post'>
                                    @csrf
                                    @method('delete')

                                    <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash-alt"></i> حذف</a>

                                </form>
                                

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


@section('script')

@include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
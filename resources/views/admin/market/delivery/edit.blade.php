@extends('admin.layouts.master')


@section('title','ویرایش روش ارسال')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#"> بخش فروش</a></li>
        <li class="breadcrumb-item "> <a href="#">روش های ارسال</a></li>
        <li class="breadcrumb-item active" aria-current="page"> ویرایش روش ارسال</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش روش ارسال
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.delivery.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.market.delivery.update', $delivery->id)}}" method="post">
                    @csrf
                    @method('put')
                    <section class="row">

                        <section class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">روش ارسال</label>
                                <input type="text" class="form-control form-control-sm" name="name" value="{{$delivery->name}}">
                            </div>
                            @error('name')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">هزینه ارسال</label>
                                <input type="text" class="form-control form-control-sm" name="amount" value="{{$delivery->amount}}">
                            </div>
                            @error('amount')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">زمان ارسال</label>
                                <input type="text" class="form-control form-control-sm" name="delivery_time" value="{{$delivery->delivery_time}}">
                            </div>
                            @error('delivery_time')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">واحد زمان ارسال</label>
                                <input type="text" class="form-control form-control-sm" name="delivery_time_unit" value="{{$delivery->delivery_time_unit}}">
                            </div>
                            @error('delivery_time_unit')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>



                        <section class="col-12">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
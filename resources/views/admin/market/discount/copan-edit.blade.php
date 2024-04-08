@extends('admin.layouts.master')

@section('head-tag')

    <link rel="stylesheet" href="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.css')}}" />

@endsection

@section('title','ویرایش کوپن تخفیف')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">  بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#">  تخفیف ها</a></li>
        <li class="breadcrumb-item"> <a href="#">  کوپن تخفیف</a></li>
        <li class="breadcrumb-item active" aria-current="page">  ویرایش کوپن تخفیف</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ویرایش کوپن تخفیف
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.discount.copanDiscount')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section>
                <form action="{{route('admin.market.discount.copanDiscount.update', $copan->id)}}" method="post">
                    @csrf
                    @method('put')
                    <section class="row">

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">کد تخفیف</label>
                                <input type="text" name="code" class="form-control form-control-sm" value="{{$copan->code}}">
                            </div>
                            @error('code')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6" id="copan">
                            <div class="form-group">
                                <label for="">نوع کوپن</label>
                                <select class="form-control form-control-sm" name="type">
                                <option value="0" onclick="document.querySelector('#user').classList.remove('d-block');" {{$copan->type == 0 ? 'selected' : ''}}>عمومی</option>
                                <option value="1" onclick="document.querySelector('#user').classList.add('d-block');" {{$copan->type == 1 ? 'selected' : ''}}>خصوصی</option>
                            </select>
                            </div>

                            @error('type')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6 d-none {{$copan->type == 1 ? 'd-block' : ''}}" id="user" >
                            <div class="form-group">
                                <label for="user_id">کاربر</label>
                                <select name="user_id" id="user_id" class="form-control form-control-sm">

                                    @if($copan->type == 0)

                                    @foreach($users as $user)
                                        <option value="{{$user->id ?? ''}}" @if($copan->user->id ?? '' == $user->id) selected @endif>{{$user->full_name}}</option>
                                    @endforeach

                                    @else

                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" @if($copan->user->id == $user->id) selected @endif>{{$user->full_name}}</option>
                                    @endforeach

                                    @endif

                                </select>
                            </div>
                            @error('user_id')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="amount_type">نوع تخفیف</label>
                                <select name="amount_type" id="amount_type" class="form-control form-control-sm">

                                        <option value="0" @if($copan->amount_type == 0) selected @endif>درصدی</option>
                                        <option value="1" @if($copan->amount_type == 1) selected @endif>عددی</option>

                                </select>
                            </div>
                            @error('amount_type')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">میزان تخفیف</label>
                                <input type="text" name="amount" class="form-control form-control-sm" value="{{$copan->amount}}">
                            </div>
                            @error('amount')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">سقف تخفیف</label>
                                <input type="text" name="discount_ceiling" class="form-control form-control-sm" value="{{$copan->discount_ceiling ?? '0'}}">
                            </div>
                            @error('discount_ceiling')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تاریخ شروع</label>
                                <input type="text" id="start_date" name="start_date" class="form-control form-control-sm d-none">
                                <input type="text" id="start_date_view" class="form-control form-control-sm" value="{{$copan->start_date}}">
                            </div>
                            @error('start_date')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>


                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تاریخ پایان</label>
                                <input type="text" id="end_date" name="end_date" class="form-control form-control-sm d-none">
                                <input type="text" id="end_date_view" class="form-control form-control-sm" value="{{$copan->end_date}}">
                            </div>
                            @error('end_date')
                            <span class="text-white bg-danger rounded">
                                {{$message}}
                            </span>
                            @enderror
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">

                                        <option value="0" @if($copan->status ==0) {{'selected'}} @endif>غیرفعال</option>
                                        <option value="1" @if($copan->status ==1) {{'selected'}} @endif>فعال</option>

                                </select>
                            </div>
                            @error('status')
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

@section('script')

<script src="{{asset('admin-assets/jalalidatepicker/persian-date.min.js')}}"></script>
<script src="{{asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#start_date_view').persianDatepicker({
            format: 'YYYY/MM/DD',
            altField: '#start_date'
        }),
        $('#end_date_view').persianDatepicker({
            format: 'YYYY/MM/DD',
            altField: '#end_date'
        })
    });
</script>


@endsection
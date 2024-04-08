@extends('admin.layouts.master')


@section('title','کوپن تخفیف')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#">پرداخت ها</a></li>
        <li class="breadcrumb-item active" aria-current="page"> کوپن تخفیف</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    کوپن تخفیف
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.discount.copanDiscount.create')}}" class="btn btn-primary btn-sm">ایجاد کوپن تخفیف جدید</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem px-0">#</th>
                            <th class="text-center width-16-rem px-0">کد تخفیف</th>
                            <th class="text-center width-16-rem px-0">میزان تخفیف</th>
                            <th class="text-center width-16-rem px-0">سقف تخفیف</th>
                            <th class="text-center width-16-rem px-0">نوع کوپن</th>
                            <th class="text-center width-16-rem px-0">تاریخ شروع</th>
                            <th class="text-center width-16-rem px-0">تاریخ پایان</th>
                            <th class="text-center width-16-rem px-0"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($copans as $key=>$copan)
                        <tr>
                            <th class="text-center px-0">{{++$key}}</th>
                            <td class="text-center px-0">{{$copan->code}}</td>
                            <td class="text-center px-0">@if($copan->amount_type == 0) {{$copan->amount.'%'}} @else {{number_format($copan->amount).' تومان'}} @endif</td>
                            <td class="text-center px-0">@if($copan->discount_ceiling == null) _ @else {{number_format($copan->discount_ceiling).' تومان'}} @endif</td>
                            <td class="text-center px-0">{{$copan->type == 0 ? 'عمومی' : 'خصوصی'}}</td>
                            <td class="text-center px-0 date">{{jdate($copan->start_date)->format('H:i:s Y-m-d')}}</td>
                            <td class="text-center px-0 date">{{jdate($copan->end_date)->format('H:i:s Y-m-d')}}</td>
                            <td class="text-center px-0">
                                <a href="{{route('admin.market.discount.copanDiscount.edit', $copan->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form action="{{route('admin.market.discount.copanDiscount.destroy', $copan->id)}}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
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

<script>
    var arabicNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $('.date').text(function(i, v) {
        var chars = v.split('');
        for (var i = 0; i < chars.length; i++) {
            if (/\d/.test(chars[i])) {
                chars[i] = arabicNumbers[chars[i]];
            }
        }
        return chars.join('');
    })
</script>

@include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
@extends('admin.layouts.master')


@section('title','تخفیف عمومی')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#">تخفیف ها</a></li>
        <li class="breadcrumb-item active" aria-current="page"> تخفیف عمومی</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    تخفیف عمومی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.discount.commonDiscount.create')}}" class="btn btn-primary btn-sm">ایجاد تخفیف عمومی</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">درصد تخفیف</th>
                            <th class="text-center width-16-rem">حداکثر تخفیف</th>
                            <th class="text-center width-16-rem">عنوان مناسبت</th>
                            <th class="text-center width-16-rem">تاریخ شروع</th>
                            <th class="text-center width-16-rem">تاریخ پایان</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commonDiscounts as $key=>$commonDiscount)
                        <tr>
                            <th class="text-center">{{++$key}}</th>
                            <td class="text-center">{{$commonDiscount->percentage}}%</td>
                            <td class="text-center">{{$commonDiscount->discount_ceiling}} تومان</td>
                            <td class="text-center">{{$commonDiscount->title}}</td>
                            <td class="text-center date">{{jdate($commonDiscount->start_date)->format('H:i:s Y-m-d')}}</td>
                            <td class="text-center date">{{jdate($commonDiscount->end_date)->format('H:i:s Y-m-d')}}</td>
                            <td class="text-center">
                                <a href="{{route('admin.market.discount.commonDiscount.edit', $commonDiscount->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form action="{{route('admin.market.discount.commonDiscount.destroy', $commonDiscount->id)}}" method="post" class="d-inline">
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
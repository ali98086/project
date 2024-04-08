@extends('admin.layouts.master')


@section('title','جزئیات سفارش')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#">سفارشات</a></li>
        <li class="breadcrumb-item"> <a href="#">فاکتور سفارش</a></li>
        <li class="breadcrumb-item active" aria-current="page"> جزئیات سفارش</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    جزئیات سفارش
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="#" class="btn btn-primary btn-sm disabled" aria-disabled="true">ایجاد سفارش جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover " id="printable">
                    <thead>
                        <tr>

                            <th>#</th>
                            <th class="text-center width-16-rem"> نام محصول</th>
                            <th class="text-center width-16-rem"> درصد فروش فوق العاده</th>
                            <th class="text-center width-16-rem"> مبلغ فروش فوق العاده</th>
                            <th class="text-center width-16-rem"> تعداد</th>
                            <th class="text-center width-16-rem"> مبلغ نهایی</th>
                            <th class="text-center width-16-rem"> جمع قیمت محصول</th>
                            <th class="text-center width-16-rem"> رنگ</th>
                            <th class="text-center width-16-rem"> گارانتی</th>
                            <th class="text-center width-16-rem"> ویژگی</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach($order->orderItems as $key => $item)
                        <tr class="border-bottom">
                    
                            <td class="text-center">{{ $key += 1 }}</td>
                            <td class="text-center">{{ $item->product->name ?? '_'}}</td>
                            <td class="text-center">{{ $item->amazingSale->percentage.'%' ?? '_'}}</td>
                            <td class="text-center">{{ number_format($item->amazing_sale_discount_amount).' تومان' ?? '_' }}</td>
                            <td class="text-center">{{ $item->number ?? '_'}}</td>
                            <td class="text-center">{{ number_format($item->final_product_price).' تومان' ?? '_'}}</td>
                            <td class="text-center">{{ number_format($item->final_total_price).' تومان' ?? '_'}}</td>
                            <td class="text-center">{{ $item->color->color_name ?? '_'}}</td>
                            <td class="text-center">{{ $item->guarantee->name ?? '_'}}</td>

                            @foreach($item->orderItemSelectedAttributes as $orderItemSelectedAttribute)

                                <td class="text-center">
                                    
                                    {{ $orderItemSelectedAttribute->categoryAttribute->name ?? '_' }}
                                     : 
                                    {{ json_decode($orderItemSelectedAttribute->categoryValue->value)->value ?? '_' }}
                                    {{ $orderItemSelectedAttribute->categoryAttribute->unit ?? '_' }}

                                </td>

                            @endforeach

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

<script>

var printBtn = document.getElementById('print');
printBtn.addEventListener('click', function(){
    printContent('printable');
})


function printContent(el){

    var restorePage = $('body').html();
    var printContent = $('#' + el).clone();
    $('body').empty().html(printContent);
    window.print();
    $('body').html(restorePage);
}


</script>




@endsection
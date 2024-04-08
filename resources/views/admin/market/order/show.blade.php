@extends('admin.layouts.master')


@section('title','فاکتور سفارش')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش فروش</a></li>
        <li class="breadcrumb-item"> <a href="#">سفارشات</a></li>
        <li class="breadcrumb-item active" aria-current="page"> فاکتور سفارش</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    فاکتور سفارش
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
                        </tr>
                    </thead>
                    <tbody>

                        <tr class="table-primary">
                            <th>{{ $order->id }}</th>
                            <td class="width-8-rem text-left">
                                <a href="" class="btn btn-dark btn-sm text-white" id="print">
                                    <i class="fa fa-print"></i>
                                    چاپ
                                </a>
                                <a href="{{ route('admin.market.order.details', $order->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-book"></i>
                                    جزئیات
                                </a>
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <th>نام مشتری</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->user->fullName ?? '-' }}
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <th>آدرس</th>
                            <td class="text-left font-weight-bolder date">
                                {{ $order->address->address ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th> استان ، شهر</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->address->city->province->name ?? '-' }} ، {{ $order->address->city->name ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>کد پستی</th>
                            <td class="text-left font-weight-bolder date">
                                {{ $order->address->postal_code ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>پلاک</th>
                            <td class="text-left font-weight-bolder date">
                                {{ $order->address->no ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>واحد</th>
                            <td class="text-left font-weight-bolder date">
                                {{ $order->address->unit ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>نام گیرنده</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->address->recipient_first_name ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>نام خانوادگی گیرنده</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->address->recipient_last_name ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>موبایل</th>
                            <td class="text-left font-weight-bolder date">
                                {{ $order->address->mobile ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>نوع پرداخت</th>
                            <td class="text-left font-weight-bolder">
                                @if($order->payment_type == 0) آنلاین @elseif ($order->payment_type == 1) آفلاین @else در محل @endif
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>وضعیت پرداخت</th>
                            <td class="text-left font-weight-bolder">
                                @if($order->payment_status == 0) پرداخت نشده @elseif ($order->payment_status == 1) پرداخت شده @elseif ($order->payment_status == 2) باطل شده @else برگشت داده شده @endif
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>مبلغ ارسال</th>
                            <td class="text-left font-weight-bolder date">
                                {{ number_format($order->delivery_amount ) ?? '-'}} تومان
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>وضعیت ارسال</th>
                            <td class="text-left font-weight-bolder">
                                @if($order->delivery_status == 0) ارسال نشده @elseif ($order->delivery_status == 1) درحال ارسال @elseif ($order->delivery_status == 2) ارسال شده @else تحویل شده @endif
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>تاریخ ارسال</th>
                            <td class="text-left font-weight-bolder date">
                                {{ jdate($order->delivery_time)->format('H:i:s Y-m-d') }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>مجموع مبلغ سفارش (بدون تخفیف)</th>
                            <td class="text-left font-weight-bolder date">
                                {{  number_format( $order->order_final_amount) ?? '-' }} تومان
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>مجموع تمامی مبلغ تخفیفات</th>
                            <td class="text-left font-weight-bolder date">
                                {{ number_format($order->order_discount_amount) ?? '-'}} تومان
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>مبلغ تخفیف همه محصولات</th>
                            <td class="text-left font-weight-bolder date">
                                {{ number_format($order->order_total_products_discount_amount) ?? '-' }} تومان
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>مبلغ نهایی</th>
                            <td class="text-left font-weight-bolder date">
                                {{ number_format($order->order_final_amount -  $order->order_discount_amount) }} تومان
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>بانک</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->payment->paymentable->gateway ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>کوپن استفاده شده</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->copan->code ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>تخفیف کد تخفیف</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->order_copan_discount_amount ?? '-' }}
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>تخفیف عمومی استفاده شده</th>
                            <td class="text-left font-weight-bolder">
                                {{ $order->commonDiscount->title ?? '-' }}
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <th>مبلغ تخفیف عمومی</th>
                            <td class="text-left font-weight-bolder date">
                                {{ number_format($order->order_common_discount_amount) ?? '-' }} تومان
                            </td>
                        </tr>
                        <tr class="border-bottom">
                            <th>وضعیت سفارش</th>
                            <td class="text-left font-weight-bolder">
                            @if($order->order_status == 0) در انتظار تایید  @elseif ($order->order_status == 1)  تایید نشده @elseif ($order->order_status == 2) تایید شده @elseif ($order->order_status == 3) باطل شده @elseif($order->order_status == 4) مرجوع شده @else بررسی نشده @endif
                            </td>
                        </tr>

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
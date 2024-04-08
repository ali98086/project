@extends('admin.layouts.master')


@section('title','روش های ارسال')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#"> بخش فروش</a></li>
        <li class="breadcrumb-item active" aria-current="page"> روش های ارسال</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    روش های ارسال
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.market.delivery.create')}}" class="btn btn-primary btn-sm">ایجاد روش ارسال جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">روش ارسال</th>
                            <th class="text-center width-16-rem">هزینه ارسال</th>
                            <th class="text-center width-16-rem">زمان ارسال</th>
                            <th class="text-center width-16-rem">وضعیت</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($delivery_methods as $key=>$delivery_method)
                        <tr>
                            <th class="text-center">{{++$key}}</th>
                            <td class="text-center">{{$delivery_method->name}}</td>
                            <td class="text-center">{{$delivery_method->amount}} تومان</td>
                            <td class="text-center width-16-rem">{{$delivery_method->delivery_time.' '.$delivery_method->delivery_time_unit}}</td>
                            <td class="text-center">

                                <input type="checkbox" id="{{$delivery_method->id}}" onchange="changeStatus('{{ $delivery_method->id }}')" data-url="{{route('admin.market.delivery.status', $delivery_method->id)}}" @if($delivery_method->status===1) {{'checked'}} @endif />

                            </td>
                            <td class="text-center">
                                <a href="{{route('admin.market.delivery.edit', $delivery_method->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form action="{{route('admin.market.delivery.destroy', $delivery_method->id)}}" method="post" class="d-inline">
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


<script type="text/javascript">
    function changeStatus(id) {

        var element = $('#' + id);
        var url = element.attr('data-url');
        var elementValue = !element.prop('checked');

        $.ajax({

            url: url,
            type: "GET",
            success: function(response) {
                if (response.status) {
                    if (response.checked) {
                        element.prop('checked', true);
                        successToast('روش ارسال با موفقیت فعال شد');
                    } else {

                        element.prop('checked', false);
                        successToast('روش ارسال با موفقیت غیر فعال شد');
                    }
                } else {

                    element.prop('checked', elementValue);
                    errorToast('امکان تغییر وضعیت روش ارسال وجود ندارد')

                }
            }

        })

        function successToast(message) {

            var successToastTag = '<div class="toast bg-success mb-0" data-delay="5000">\n' +
                '<div class="toast-body d-flex bg-success text-white rounded">\n' +
                '<strong class="ml-auto font-weight-normal">' + message + '</strong>\n' +
                '<button type="button" class="btn-close pl-0" data-dismiss="toast" aria-close="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>\n' +
                '</div>';

            $('#container-alerts').append(successToastTag);
            $('.toast').toast('show').delay(5500).queue(function() {
                $(this).remove();
            })

        }

        function errorToast(message) {

            var errorToastTag = '<div class="toast bg-danger mb-0" data-delay="5000" >\n' +
                '<div class="toast-body d-flex bg-danger text-white rounded">\n' +
                '<strong class="ml-auto font-weight-normal">' + message + '</strong>\n' +
                '<button type="button" class="btn-close pl-0" data-dismiss="toast"  aria-close="Close">\n' +
                '<span aria-hidden="true">&times;</span>\n' +
                '</button>\n' +
                '</div>\n' +
                '</div>';

            $('#container-alerts').append(errorToastTag);
            $('.toast').toast('show').delay(5500).queue(function() {
                $(this).remove();
            })

        }
    }
</script>

@include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])

@endsection
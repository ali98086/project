@extends('admin.layouts.master')


@section('title','مشتریان')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش کاربران</a></li>
        <li class="breadcrumb-item active" aria-current="page"> مشتریان</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    مشتریان
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.user.customer.create')}}" class="btn btn-primary btn-sm">ایجاد کاربر مشتری جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">نام</th>
                            <th class="text-center width-16-rem">نام خانوادگی</th>
                            <th class="text-center width-16-rem">پست الکترونیکی</th>
                            <th class="text-center width-16-rem">کد ملی</th>
                            <th class="text-center width-16-rem">شماره موبایل</th>
                            <th class="text-center width-16-rem">فعال سازی</th>
                            <th class="text-center width-16-rem">وضعیت</th>
                            <th class="text-center width-16-rem">نقش</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key=>$user)
                        <tr>
                            <th class="text-center">{{$key+=1}}</th>
                            <td class="text-center">{{$user->first_name}}</td>
                            <td class="text-center">{{$user->last_name}}</td>
                            <td class="text-center">{{$user->email}}</td>
                            <td class="text-center">{{$user->national_code}}</td>
                            <td class="text-center">{{$user->mobile}}</td>
                            <td class="text-center">
                                <input type="checkbox" id="{{$user->id}}" onchange="changeActivationStatus('{{ $user->id }}')" data-url="{{route('admin.user.customer.activation', $user->id)}}" @if($user->activation===1) {{'checked'}} @endif />
                            </td>
                            <td class="text-center">
                                <input type="checkbox" id="{{'status'.$user->id}}" onchange="changeStatus('{{ $user->id }}')" data-url="{{route('admin.user.customer.status', $user->id)}}" @if($user->status===1) {{'checked'}} @endif />
                            </td>
                            <td class="text-center">کاربر مشتری</td>
                            <td class="text-center w-25">

                                    <a class="btn btn-sm btn-warning" href="#"><i class="fa fa-edit" aria-hidden="true"></i> نقش</a>
                                    <a class="btn btn-sm btn-primary" href="{{route('admin.user.customer.edit', $user->id)}}"><i class="fa fa-edit" aria-hidden="true"></i> ویرایش</a>
                                    <form action="{{route('admin.user.customer.destroy', $user->id)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                    <button class="btn btn-sm btn-danger delete" type="submit"><i class="fa fa-trash-alt" aria-hidden="true"></i> حذف</button>     
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


<script type="text/javascript">
    function changeActivationStatus(id) {

        var element = $('#' + id);
        var url = element.attr('data-url');
        var elementValue = !element.prop('checked');

        $.ajax({

            url: url,
            type: "GET",
            success: function(response) {
                if (response.activation) {
                    if (response.checked) {
                        element.prop('checked', true);
                        successToast('کاربر مشتری با موفقیت فعال سازی شد');
                    } else {

                        element.prop('checked', false);
                        successToast('کاربر مشتری با موفقیت غیر فعال شد');
                    }
                } else {

                    element.prop('checked', elementValue);
                    errorToast('امکان تغییر وضعیت فعال سازی کاربر مشتری وجود ندارد')

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



    function changeStatus(id) {

var element = $('#status' + id);
var url = element.attr('data-url');
var elementValue = !element.prop('checked');

$.ajax({

    url: url,
    type: "GET",
    success: function(response) {
        if (response.status) {
            if (response.checked) {
                element.prop('checked', true);
                successToastMsg('وضعیت کاربر مشتری با موفقیت فعال شد');
            } else {

                element.prop('checked', false);
                successToastMsg('وضعیت کاربر مشتری با موفقیت غیر فعال شد');
            }
        } else {

            element.prop('checked', elementValue);
            errorToastMsg('امکان تغییر وضعیت کاربر مشتری وجود ندارد')

        }
    }

})

function successToastMsg(message) {

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

function errorToastMsg(message) {

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
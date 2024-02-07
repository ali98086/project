@extends('admin.layouts.master')


@section('title','اطلاعیه ایمیلی')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">اطلاع رسانی</a></li>
        <li class="breadcrumb-item active" aria-current="page"> اطلاعیه ایمیلی</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    اطلاعیه ایمیلی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.notify.email.create')}}" class="btn btn-primary btn-sm">ایجاد اطلاعیه ایمیلی</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">عنوان اطلاعیه</th>
                            <th class="text-center width-16-rem">متن اطلاعیه</th>
                            <th class="text-center width-16-rem">تاریخ ارسال</th>
                            <th class="text-center width-16-rem">وضعیت</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($emails as $key=>$email)
                        <tr>
                            <th class="text-center">{{++$key}}</th>
                            <td class="text-center">{{$email->subject}}</td>
                            <td class="text-center">{{$email->body}}</td>
                            <td class="text-center date">{{Morilog\Jalali\Jalalian::forge($email->published_at)->format('H:i:s Y-m-d')}}</td>
                            <td class="text-center">
                                <input type="checkbox" id="{{$email->id}}" onchange="changeStatus('{{ $email->id }}')" data-url="{{route('admin.notify.email.status', $email->id)}}" @if($email->status===1) {{'checked'}} @endif/>
                            </td>
                            <td class="text-center w-25">

                                <a href="{{route('admin.notify.email-file.index', $email->id)}}" class="btn btn-warning mr-1"><i class="fa fa-file"></i> فایل های ضمیمه شده</a>

                                <a href="{{route('admin.notify.email.edit', $email->id)}}" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i> ویرایش</a>

                                <form action="{{route('admin.notify.email.destroy', $email->id)}}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                <button class="btn btn-danger delete" type="submit"><i class="fa fa-trash-alt" aria-hidden="true"></i> حذف</button>
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
                        successToast('اطلاعیه ایمیلی با موفقیت فعال شد');
                    } else {

                        element.prop('checked', false);
                        successToast('اطلاعیه ایمیلی با موفقیت غیر فعال شد');
                    }
                } else {

                    element.prop('checked', elementValue);
                    errorToast('امکان تغییر وضعیت اطلاعیه ایمیلی وجود ندارد')

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
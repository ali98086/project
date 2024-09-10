@extends('admin.layouts.master')


@section('title','فایل های اطلاعیه ایمیلی')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">اطلاع رسانی</a></li>
        <li class="breadcrumb-item"> <a href="#">اطلاعیه ایمیلی</a></li>
        <li class="breadcrumb-item active" aria-current="page"> فایل اطلاعیه ایمیلی</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    فایل اطلاعیه ایمیلی
                </h5>
            </section>

            <section class="d-flex align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.notify.email.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <a href="{{route('admin.notify.email-file.create', $email->id)}}" class="btn btn-primary btn-sm mr-2">ایجاد فایل اطلاعیه ایمیلی</a>
                <div class="width-16-rem mr-auto">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">عنوان ایمیل</th>
                            <th class="text-center width-16-rem">نام فایل</th>
                            <th class="text-center width-16-rem">سایز فایل</th>
                            <th class="text-center width-16-rem">وضعیت</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($email->files as $key=>$file)
                        <tr>
                            <th class="text-center">{{++$key}}</th>
                            <td class="text-center">{{$email->subject}}</td>
                            <td class="text-center">{{Str::of($file->file_path)->afterLast('\\')}}</td>
                            <td class="text-center">{{$file->file_size}}</td>
                            <td class="text-center">
                                <input type="checkbox" id="{{$file->id}}" onchange="changeStatus('{{ $file->id }}')" data-url="{{route('admin.notify.email-file.status', $file->id)}}" @if($file->status===1) {{'checked'}} @endif/>
                            </td>
                            <td class="text-center w-25">

                                <a href="{{route('admin.notify.email-file.seeFile', $file)}}" class="btn btn-info btn-sm">
                                    مشاهده
                                </a>

                                <a href="{{route('admin.notify.email-file.download', $file)}}" class="btn btn-success btn-sm">
                                    دانلود
                                </a>

                                <a href="{{route('admin.notify.email-file.edit', $file->id)}}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit" aria-hidden="true"></i> ویرایش
                                </a>

                                <form action="{{route('admin.notify.email-file.destroy', $file->id)}}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt" aria-hidden="true"></i> حذف</button>
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
                        successToast('فایل اطلاعیه ایمیلی با موفقیت فعال شد');
                    } else {

                        element.prop('checked', false);
                        successToast('فایل اطلاعیه ایمیلی با موفقیت غیر فعال شد');
                    }
                } else {

                    element.prop('checked', elementValue);
                    errorToast('امکان تغییر وضعیت فایل اطلاعیه ایمیلی وجود ندارد')

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
@extends('admin.layouts.master')


@section('title','نظرات')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش محتوا</a></li>
        <li class="breadcrumb-item active" aria-current="page"> نظرات</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    نظرات
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="#" class="btn btn-primary btn-sm disabled" aria-disabled="true">ایجاد نظر جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">کد کاربر</th>
                            <th class="text-center width-16-rem">متن نظر</th>
                            <th class="text-center width-16-rem">نویسنده نظر</th>
                            <th class="text-center width-16-rem">کد پست</th>
                            <th class="text-center width-16-rem">پست</th>
                            <th class="text-center width-16-rem">پاسخ به</th>
                            <th class="text-center width-16-rem">وضعیت تایید</th>
                            <th class="text-center width-16-rem">وضعیت نظر</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $key=>$comment)
                        <tr>
                            <th class="text-center">{{$key + 1 }}</th>
                            <td class="text-center">{{$comment->author_id}}</td>
                            <td class="text-center">{{$comment->body}}</td>
                            <td class="text-center">{{$comment->user->full_name}}</td>
                            <td class="text-center">{{$comment->commentable_id}}</td>
                            <td class="text-center">{{$comment->commentable->title}}</td>
                            <td class="text-center">{{$comment->parent == null ? '' : Str::limit($comment->parent->body, 10)}}</td>
                            <td class="text-center">{{$comment->approved == 1 ? 'تایید شده' : 'تایید نشده' }}</td>
                            <td class="text-center">
                                <input type="checkbox" id="{{$comment->id}}" onchange="changeStatus('{{ $comment->id }}')" data-url="{{route('admin.content.comment.status', $comment->id)}}" @if($comment->status===1) {{'checked'}} @endif/>
                            </td>
                            <td class="text-center d-flex pr-0">

                                <a href="{{route('admin.content.comment.show', $comment->id)}}" class="btn btn-info btn-sm" type="submit"><i class="fa fa-eye"></i> نمایش</a>

                                @if($comment->approved == 1)
                                <a href="{{route('admin.content.comment.approved', $comment->id)}}" class="btn btn-warning btn-sm mr-1"><i class="fa fa-clock"></i> عدم تایید</a>
                                @else
                                <a href="{{route('admin.content.comment.approved', $comment->id)}}" class="btn btn-success btn-sm text-white mr-1"><i class="fa fa-check"></i> تایید</a>
                                @endif
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
                        successToast('نظر با موفقیت فعال شد');
                    } else {

                        element.prop('checked', false);
                        successToast('نظر با موفقیت غیر فعال شد');
                    }
                } else {

                    element.prop('checked', elementValue);
                    errorToast('امکان تغییر وضعیت نظر وجود ندارد')

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



@endsection
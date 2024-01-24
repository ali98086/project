@extends('admin.layouts.master')


@section('title','پست ها')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش محتوا</a></li>
        <li class="breadcrumb-item active" aria-current="page"> پست ها</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    پست ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.content.post.create')}}" class="btn btn-primary btn-sm">ایجاد پست جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">عنوان پست</th>
                            <th class="text-center width-16-rem">دسته</th>
                            <th class="text-center width-16-rem">تصویر</th>
                            <th class="text-center width-16-rem">وضعیت</th>
                            <th class="text-center width-16-rem">امکان درج نظر</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $key=>$post)
                        <tr>
                            <th class="text-center">{{$key+=1}}</th>
                            <td class="text-center">{{$post->title}}</td>
                            <td class="text-center">{{$post->postCategory->name}}</td>
                            <td class="text-center"><img src="{{asset($post->image)}}" class="max-height-2rem" /></td>
                            <td class="text-center">
                                <input type="checkbox" id="{{$post->id}}" onchange="changeStatus('{{ $post->id }}')" data-url="{{route('admin.content.post.status', $post->id)}}" @if($post->status===1) {{'checked'}} @endif/>
                            </td>
                            <td class="text-center">
                                <input type="checkbox" id="{{$post->id}}-commentable" onchange="changeCommentable('{{ $post->id }}')" data-url="{{route('admin.content.post.commentable', $post->id)}}" @if($post->commentable===1) {{'checked'}} @endif/>
                            </td>
                            <td class="text-center">
                                <a href="{{route('admin.content.post.edit', $post->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                
                                <form action="{{route('admin.content.post.destroy', $post->id)}}" method="post" class="d-inline">
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
                        successToast('پست با موفقیت فعال شد');
                    } else {

                        element.prop('checked', false);
                        successToast('پست با موفقیت غیر فعال شد');
                    }
                } else {

                    element.prop('checked', elementValue);
                    errorToast('امکان تغییر وضعیت پست وجود ندارد')

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

<script type="text/javascript">
    function changeCommentable(id) {

        var element = $('#' + id + '-commentable');
        var url = element.attr('data-url');
        var elementValue = !element.prop('checked');

        $.ajax({

            url: url,
            type: "GET",
            success: function(response) {
                if (response.commentable) {
                    if (response.checked) {
                        element.prop('checked', true);
                        successToast('امکان درج نظر پست با موفقیت فعال شد');
                    } else {

                        element.prop('checked', false);
                        successToast('امکان درج نظر پست با موفقیت غیر فعال شد');
                    }
                } else {

                    element.prop('checked', elementValue);
                    errorToast('امکان تغییر امکان درج نظر پست وجود ندارد')

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
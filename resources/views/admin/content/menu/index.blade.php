@extends('admin.layouts.master')


@section('title','منو')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش محتوا</a></li>
        <li class="breadcrumb-item active" aria-current="page">منو</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    منو
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.content.menu.create')}}" class="btn btn-primary btn-sm">ایجاد منوی جدید</a>
                <div class="width-16-rem" >
                <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">نام منو</th>
                            <th class="text-center width-16-rem">منوی والد</th>
                            <th class="text-center width-16-rem">لینک منو</th>
                            <th class="text-center width-16-rem">وضعیت</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($menus as $key=>$menu)
                        <tr>
                            <th class="text-center">{{++$key}}</th>
                            <td class="text-center">{{$menu->name}}</td>
                            <td class="text-center">{{$menu->parent_id ? $menu->parent->name : 'منوی اصلی'}}</td>
                            <td class="text-center">{{$menu->url}}</td>
                            <td class="text-center">
                                <input type="checkbox" id="{{$menu->id}}" onchange="changeStatus('{{ $menu->id }}')" data-url="{{route('admin.content.menu.status', $menu->id)}}" @if($menu->status===1) {{'checked'}} @endif/>
                            </td>
                            <td class="text-center">
                                <a href="{{route('admin.content.menu.edit', $menu->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                <form action="{{route('admin.content.menu.destroy',$menu->id)}}" class="d-inline" id="form" method="post">
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
                        successToast('منو با موفقیت فعال شد');
                    } else {

                        element.prop('checked', false);
                        successToast('منو با موفقیت غیر فعال شد');
                    }
                } else {

                    element.prop('checked', elementValue);
                    errorToast('امکان تغییر وضعیت منو وجود ندارد')

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
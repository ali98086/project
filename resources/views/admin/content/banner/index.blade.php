@extends('admin.layouts.master')


@section('title','بنر ها')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش محتوا</a></li>
        <li class="breadcrumb-item active" aria-current="page"> بنر ها</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    بنر ها
                </h5>
                @include('admin.alerts.alert-message.success')
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.content.banner.create')}}" class="btn btn-primary btn-sm">ایجاد بنر جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">عنوان</th>
                            <th class="text-center width-16-rem">آدرس</th>
                            <th class="text-center width-16-rem">تصویر</th>
                            <th class="text-center width-16-rem">وضعیت</th>
                            <th class="text-center width-16-rem">مکان</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $key=>$banner)
                        <tr>
                            <th class="text-center">{{++$key}}</th>
                            <td class="text-center">{{$banner->title}}</td>
                            <td class="text-center">{{$banner->url}}</td>
                            <td class="text-center"><img src="{{asset($banner->image)}}" alt="" width="50px" height="50px" /></td>
                            <td class="text-center">
                                <input type="checkbox" id="{{$banner->id}}" onchange="changeStatus('{{ $banner->id }}')" data-url="{{route('admin.content.banner.status', $banner->id)}}" @if($banner->status === 1) {{'checked'}} @endif />
                            </td>
                            <td class="text-center">@if($banner->position == 0) اسلایدشو (صفحه اصلی) @elseif($banner->position == 1) کنار اسلایدشو (صفحه اصلی)
                                
                            @elseif($banner->position == 2) دو بنر تبلیغی بین دو اسلایدر (صفحه اصلی)  @else بنر تبلیغی بزرگ پایین دو اسلایدر (صفحه اصلی)  @endif</td>

                            <td class="text-center">
                                <a href="{{route('admin.content.banner.edit', $banner->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>

                                <form action="{{route('admin.content.banner.destroy', $banner->id)}}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash-alt"></i> حذف</button>
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

    function changeStatus(id){

        var element= $('#' + id);
        var url= element.attr('data-url');
        var elementValue= !element.prop('checked');

        $.ajax({

            url: url,
            type: "GET",
            success: function(response){
                if(response.status){
                    if(response.checked){
                        element.prop('checked', true); 
                        successToast('وضعیت با موفقیت فعال شد');
                    }
                    else{

                        element.prop('checked', false);
                        successToast('وضعیت با موفقیت غیر فعال شد');
                    }
                }
                else{

                    element.prop('checked',elementValue);
                    errorToast('امکان تغییر وضعیت وجود ندارد')

                }
            }

        })

        function successToast(message){

            var successToastTag= '<div class="toast bg-success mb-0" data-delay="5000">\n'+
            '<div class="toast-body d-flex bg-success text-white rounded">\n'+
            '<strong class="ml-auto font-weight-normal">'+message+'</strong>\n'+
            '<button type="button" class="btn-close pl-0" data-dismiss="toast" aria-close="Close">\n'+
            '<span aria-hidden="true">&times;</span>\n'+
            '</button>\n'+
            '</div>\n'+
            '</div>';

            $('#container-alerts').append(successToastTag);
            $('.toast').toast('show').delay(5500).queue(function(){
                $(this).remove();
            })

        }

        function errorToast(message){

            var errorToastTag= '<div class="toast bg-danger mb-0" data-delay="5000" >\n'+
            '<div class="toast-body d-flex bg-danger text-white rounded">\n'+
            '<strong class="ml-auto font-weight-normal">'+message+'</strong>\n'+
            '<button type="button" class="btn-close pl-0" data-dismiss="toast"  aria-close="Close">\n'+
            '<span aria-hidden="true">&times;</span>\n'+
            '</button>\n'+
            '</div>\n'+
            '</div>';

            $('#container-alerts').append(errorToastTag);
            $('.toast').toast('show').delay(5500).queue(function(){
                $(this).remove();
            })

        }
    }


</script>

@include('admin.alerts.sweetalert.delete-confirm', ['className' => 'delete'])


@endsection
@extends('admin.layouts.master')


@section('title','تیکت ها')


@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item active" aria-current="page"> تیکت ها</li>
    </ol>
</nav>


<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    تیکت ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="#" class="btn btn-primary btn-sm disabled">ایجاد تیکت جدید</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center width-16-rem">#</th>
                            <th class="text-center width-16-rem">نویسنده تیکت</th>
                            <th class="text-center width-16-rem">عنوان تیکت</th>
                            <th class="text-center width-16-rem">دسته تیکت</th>
                            <th class="text-center width-16-rem">اولویت تیکت</th>
                            <th class="text-center width-16-rem">ارجاع شده از</th>
                            <th class="text-center width-16-rem">پاسخ به تیکت</th>
                            <th class="text-center width-16-rem"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $key=>$ticket)
                        <tr>
                            <th class="text-center">{{++$key}}</th>
                            <td class="text-center">{{$ticket->user->first_name.' '.$ticket->user->last_name}}</td>
                            <td class="text-center">{{$ticket->subject}}</td>
                            <td class="text-center">{{$ticket->category->name}}</td>
                            <td class="text-center">{{$ticket->priority->name}}</td>
                            <td class="text-center">{{$ticket->admin->user->first_name.' '.$ticket->admin->user->last_name}}</td>
                            <td class="text-center">{{$ticket->parent->subject ?? '_'}}</td>
                            <td class="text-center w-25">

                                <a class="btn btn-info" href="{{route('admin.ticket.show', $ticket->id)}}"><i class="fa fa-eye" aria-hidden="true"></i> مشاهده</a>
                                <a class="btn btn-warning" href="{{route('admin.ticket.change', $ticket->id)}}"><i class="fa fa-{{$ticket->status==1 ? 'check' : 'times'}}" aria-hidden="true"></i> 
                            
                                {{$ticket->status == 1 ? 'باز کردن' : 'بستن'}}

                                </a>

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

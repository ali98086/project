@extends('customer.layouts.master-two-col')


@section('title')

مدیریت تیکت ها

@endsection


@section('content')

<section>
    <section id="main-body-two-col" class="container-xxl body-container">
        <section class="row">

            @include('customer.layouts.partials.profile-sidebar')

            <section class="content-wrapper bg-white p-3 rounded-2 mb-3 w-50">

                <!-- start vontent header -->
                <section class="content-header">
                    <section class="d-flex justify-content-between align-items-center">
                        <h2 class="content-header-title">
                            <span>مدیریت تیکت ها</span>
                        </h2>
                        <section class="content-header-link mb-2">
                            <a href="{{route('customer.profile.ticket.createTicket')}}" class="btn btn-success btn-sm text-white">ارسال تیکت جدید</a>
                        </section>
                    </section>
                </section>
                <!-- end vontent header -->

                <section class="order-wrapper">

                   

                        <section class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <!-- <th class="text-center width-16-rem">#</th> -->
                                        <!-- <th class="text-center width-16-rem">نویسنده</th> -->
                                        <th class="text-center width-16-rem"><small>عنوان</small></th>
                                        <th class="text-center width-16-rem"><small>دسته</small></th>
                                        <th class="text-center width-16-rem"><small>اولویت</small></th>
                                        <th class="text-center width-16-rem"><small>پاسخ به تیکت</small></th>
                                        <th class="text-center width-16-rem"><small>وضعیت</small></th>
                                        <th class="text-center width-16-rem"><small>تنظیمات</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $key=>$ticket)
                                    <tr>

                                        <td class="text-center"><small>{{$ticket->subject}}</small></td>
                                        <td class="text-center"><small>{{$ticket->category->name}}</small></td>
                                        <td class="text-center"><small>{{$ticket->priority->name}}</small></td>
                                        <td class="text-center"><small>{{$ticket->parent->subject ?? '_'}}</small></td>
                                        <td class="text-center"><small>{{$ticket->status == 0 ? 'باز' : 'بسته'}}</small></td>
                                        <td class="text-center">

                                            <a class="btn btn-primary text-white btn-sm px-1" href="{{route('customer.profile.ticket.showTicket', $ticket->id)}}" title="مشاهده تیکت"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                            @if($ticket->status == 0)

                                            <a class="btn btn-danger text-white btn-sm" href="{{route('customer.profile.ticket.changeStatus', $ticket->id)}}" title="بستن تیکت"><i class="fa fa-times" aria-hidden="true"></i>                                            </a>

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
    </section>
</section>
<!-- end body -->


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

    $('.code').text(function(i, v) {
        var chars = v.split('');
        for (var i = 0; i < chars.length; i++) {
            if (/\d/.test(chars[i])) {
                chars[i] = arabicNumbers[chars[i]];
            }
        }
        return chars.join('');
    })
    $('.price').text(function(i, v) {
        var chars = v.split('');
        for (var i = 0; i < chars.length; i++) {
            if (/\d/.test(chars[i])) {
                chars[i] = arabicNumbers[chars[i]];
            }
        }
        return chars.join('');
    })
</script>

@endsection
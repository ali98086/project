@extends('customer.layouts.master-two-col')


@section('title')

نمایش تیکت

@endsection


@section('content')


<section>
    <section id="main-body-two-col" class="container-xxl body-container">
        <section class="row">

            @include('customer.layouts.partials.profile-sidebar')

            <section class="content-wrapper bg-white p-3 rounded-2 mb-3 w-50">

                <!-- start vontent header -->
                <section class="content-header m-2">
                    <section class="d-flex justify-content-between align-items-center">
                        <h2 class="content-header-title">
                            <span>نمایش تیکت</span>
                        </h2>
                        <section class="content-header-link mb-2">
                            <a href="{{route('customer.profile.ticket.index')}}" class="btn btn-danger btn-sm text-white">بازگشت</a>
                        </section>
                    </section>
                </section>
                <!-- end vontent header -->

                <section class="order-wrapper">

                    <section class="card mb-2">

                        <section class="card-header bg-dark d-flex justify-content-between">

                            <h6 class="mb-0 text-white name">{{$ticket->user->first_name.' '.$ticket->user->last_name}}</h6>
                            <small class="mb-0 text-white name date">{{jdate($ticket->created_at)->format('H:i:s Y-m-d')}}</small>

                        </section>
                        <section class="card-body">

                            <h6>موضوع : {{$ticket->subject}}</h6>
                            <p class="mb-0"><small>{{$ticket->description}}</small></p>

                        </section>

                        @empty(!$ticket->file)

                        @if($ticket->file->count() > 0)

                        <section class="card-body border-top">

                            <form action="{{route('customer.profile.ticket.downloadFile' , $ticket->id)}}" method="post">
                                @csrf

                                <label>فایل ضمیمه : </label>
                                <button class="btn btn-success btn-sm" type="submit">دانلود فایل</button>

                            </form>

                        </section>

                        @endif

                        @endempty

                    </section>

                    @foreach($ticket->children as $child)

                    <section class="card ms-5">

                        <section class="card-header bg-light d-flex justify-content-between">

                            <h6 class="mb-0 text-dark name">
                                <small>
                                    <b>

                                    @if($child->admin)

                                    {{$child->admin ? 'ادمین '.$child->admin->user->first_name.' '.$child->admin->user->last_name.' در پاسخ به ' : ''}}{{$child->user->first_name.' '.$child->user->last_name}}</h6>

                                    @else

                                    {{$child->user->first_name.' '.$child->user->last_name}}</h6>

                                    @endif

                                    </b>
                                </small>

                            <small class="mb-0 text-dark name date">{{jdate($child->created_at)->format('H:i:s Y-m-d')}}</small>

                        </section>
                        <section class="card-body">

                            <p class="mb-0"><small>{{$child->description}}</small></p>

                        </section>


                    </section>

                    @endforeach

                    <section>

                        <form action="{{route('customer.profile.ticket.answerTicket', $ticket->id)}}" method="post">
                            @csrf

                            <section class="row">
                                <section class="col-12 mt-3">
                                    <section class="form-group">

                                        <label for="">پاسخ</label>
                                        <textarea class="form-control form-control-sm mb-3" name="description" id="" rows="3">{{old('description')}}</textarea>
                                        @error('description')
                                        <span class="text-white bg-danger rounded">
                                            {{$message}}
                                        </span>
                                        @enderror
                                        <section class="col-12 mt-2 pb-2 my-2 d-flex justify-content-center">
                                            <button class="btn btn-primary btn-sm mt-3 col-md-1">ثبت</button>
                                        </section>
                                    </section>
                                </section>
                            </section>
                        </form>
                    </section>


                </section>


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
@extends('admin.layouts.master')


@section('title','نمایش تیکت')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">تیکت ها</a></li>
        <li class="breadcrumb-item"> <a href="#">نمایش تیکت</a></li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    نمایش تیکت
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.ticket.index')}}" class="btn btn-primary btn-sm">بازگشت</a>

                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="card">

                <section class="card-header bg-info">

                    <h6 class="mb-0 text-white name">{{$ticket->id.'- '.$ticket->user->first_name.' '.$ticket->user->last_name}}</h6>

                </section>
                <section class="card-body">

                    <h4>موضوع : {{$ticket->subject}}</h4>
                    <p class="mb-0">{{$ticket->description}}</p>

                </section>

            </section>

            <section>

                <form action="{{route('admin.ticket.answer', $ticket->id)}}" method="post">
                    @csrf

                    <section class="row">
                        <section class="col-12 mt-3">
                            <section class="form-group">
                                
                                <label for="">پاسخ ادمین</label>
                                <textarea class="form-control form-control-sm mb-3" name="description" id="" rows="4">{{old('description')}}</textarea>
                                @error('description')
                                <span class="text-white bg-danger rounded">
                                    {{$message}}
                                </span>
                                @enderror
                                <section class="col-12 mt-2 pb-2 my-2">
                                    <button class="btn btn-primary btn-sm mt-3">ثبت</button>
                                </section>
                            </section>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection


@section('script')

<script>
    var arabicNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $('.name').text(function(i, v) {
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
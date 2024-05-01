@extends('admin.layouts.master')


@section('title','نمایش نظر')



@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">خانه</a></li>
        <li class="breadcrumb-item"> <a href="#">بخش محتوا</a></li>
        <li class="breadcrumb-item"> <a href="{{route('admin.content.comment.index')}}">نظرات</a></li>
        <li class="breadcrumb-item active" aria-current="page"> نمایش نظر ها</li>
    </ol>
</nav>

<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    نمایش نظر ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center border-bottom mt-4 mb-3 pb-2">
                <a href="{{route('admin.content.comment.index')}}" class="btn btn-primary btn-sm">بازگشت</a>
                <div class="width-16-rem">
                    <input class="form-control form-control-sm form-text" list="datalistOptions" id="exampleDataList" placeholder="جستجو">
                </div>
            </section>

            <section class="card">

                <section class="card-header ">

                    <h6 class="mb-0">{{$comment->user->id}} - {{$comment->user->full_name}}</h6>

                </section>
                <section class="card-body">

                    <h4>کد کالا: {{$comment->commentable->id}} _ مشخصات کالا : {{$comment->commentable->title}} </h4>
                    <p class="mb-0">{{$comment->body}}</p>

                </section>

            </section>

            <section>

                <form action="{{route('admin.content.comment.answer', $comment->id)}}" method="post">
                    @csrf
                    <section class="row">
                        <section class="col-12 mt-3">
                            <section class="form-group">
                                <label for="">پاسخ ادمین</label>
                                <textarea class="form-control form-control-sm" id="" name="body" rows="4"></textarea>
                                <button class="btn btn-primary btn-sm mt-3">ثبت</button>
                            </section>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
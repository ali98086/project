@extends('admin.layouts.two-master')

@section('title','ورود ادمین')

@section('content')

<form action="{{route('auth.panel.authenticate')}}" method="post" class="border adminform">
@csrf
    <h3 class="d-flex justify-content-center pt-4">

        ورود ادمین

    </h3>
    <hr>
    <section class="d-flex flex-column p-4">

        <div class="mb-3">
            <label for="email" class="form-label d-flex justify-content-center">ایمیل</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="آدرس ایمیل">
            @error('email')
            <span class="form-text text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label d-flex justify-content-center">رمز عبور</label>
            <input type="password" class="form-control" name="password" placeholder="رمز عبور" id="password">
            @error('password')
            <span id="pass" class="form-text text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="mt-4 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary px-4">ورود</button>
        </div>

    </section>
</form>

@endsection
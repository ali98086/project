@extends('customer.layouts.master-simple')

@section('head-tag')

<style>

    #resend{

        font-size: 1rem;

    }

</style>

@endsection

@section('content')



<section class="vh-100 d-flex justify-content-center align-items-center pb-5">

    <form action="{{route('auth.customer.login-confirm', $otp->token)}}" method="post">
        @csrf

        <section class="login-wrapper mb-0">
            <section class="login-logo mb-5">
                <img src="{{ asset('customer-assets/images/logo/4.png') }}" alt="">
            </section>


            @if($otp->type == 0)

            <section class="login-title text-success mb-4 date">کد تایید به شماره موبایل {{'0'.$otp->login_field}} ارسال گردید.</section>

            @elseif($otp->type == 1)
            
            <section class="login-title text-success mb-4">کد تایید به ایمیل {{$otp->login_field}} ارسال گردید.</section>

            @endif


            <section class="login-info">کد تایید را وارد کنید</section>

            <section class="login-input-text">
                <section class="mb-2">
                    <input type="text" name="otp_code">
                </section>
                @error('otp_code')
                <span class="text-white text-sm bg-danger rounded mt-2">
                    {{$message}}
                </span>
                @enderror
            </section>

            <section class="login-btn d-grid g-2 mt-5 mb-3">
                <button class="btn btn-info">تایید</button>
            </section>

            <section class="login-btn d-grid g-2">
                <a href="{{route('auth.customer.login-register-form')}}" class="btn btn-danger">بازگشت</a>
            </section>

            <section>
                 
                <a href="{{route('auth.customer.login-resend-otp' , $token)}}" id="resend" class="text-primary d-none">دریافت مجدد کد تایید</a>

            </section>

            <section id="timer"></section>

        </section>

    </form>
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
</script>


@php 

$timer = ((new \Carbon\Carbon($otp->created_at))->addMinutes(5)->timestamp - \Carbon\Carbon::now()->timestamp) * 1000;

@endphp


<script>

    var countDownDate = new Date().getTime() + {{ $timer }};
    var timer = $('#timer');
    var resendOtp = $('#resend');

    var x = setInterval(function(){

        var now = new Date().getTime();

        var distance = countDownDate - now;

        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        if(minutes == 0){
            timer.html('ارسال مجدد کد تایید تا ' + seconds + 'ثانیه دیگر')
        }
        else{
            timer.html('ارسال مجدد کد تایید تا ' + minutes + 'دقیقه و ' + seconds + 'ثانیه دیگر');
        }
        if(distance < 0)
        {
            clearInterval(x);
            timer.addClass('d-none');
            resendOtp.removeClass('d-none');
        }

    }, 1000)





</script>

@endsection
@extends('customer.layouts.master-one-col')

@section('title')

{{$page->slug}}

@endsection


@section('content')

{!! $page->body !!}

@endsection


@section('script')


<script>
        var arabicNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
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
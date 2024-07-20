@extends('emails.layouts.master')

@section('content')

<h2>{{ $metadata['title'] }}</h2>
<p>{!! $metadata['body'] !!}</p>

@endsection

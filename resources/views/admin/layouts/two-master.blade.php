<!DOCTYPE html>
<html>

<head>

    @include('admin.layouts.two-head-tag')
    @yield('head-tag')

</head>

<body dir="rtl">


    <section class="body-container justify-content-center">

            @yield('content')

    </section>


    @include('admin.layouts.scripts')
    @yield('script')


</body>

</html>
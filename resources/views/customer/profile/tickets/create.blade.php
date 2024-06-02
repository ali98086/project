@extends('customer.layouts.master-two-col')


@section('title')

ارسال تیکت

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
                            <span>ارسال تیکت</span>
                        </h2>
                        <section class="content-header-link mb-2">
                            <a href="{{route('customer.profile.ticket.index')}}" class="btn btn-danger btn-sm text-white">بازگشت</a>
                        </section>
                    </section>
                </section>
                <!-- end vontent header -->

                <section class="order-wrapper">

                    <section>

                        <form action="{{route('customer.profile.ticket.storeTicket')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <section class="row">
                                <section class="col-12 mt-3">
                                    <section class="form-group">

                                        <section class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="">عنوان</label>
                                                <input type="text" class="form-control form-control-sm mb-3" name="subject" value="{{old('subject')}}">
                                            </div>
                                            @error('subject')
                                            <span class="text-white bg-danger rounded">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </section>


                                        <section class="col-12 col-md-6 my-2">
                                            <div class="form-group">
                                                <label for="">دسته بندی</label>
                                                <select name="category_id" class="form-control form-control-sm mb-3">

                                                    <option value="">دسته بندی را انتخاب کنید</option>
 
                                                    @foreach($ticketCategories as $ticketCategory)

                                                    <option value="{{$ticketCategory->id}}">{{$ticketCategory->name}}</option>

                                                    @endforeach

                                                </select>
                                            </div>
                                            @error('category_id')
                                            <span class="text-white bg-danger rounded">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </section>



                                        <section class="col-12 col-md-6 my-2">
                                            <div class="form-group">
                                                <label for="">اولویت</label>
                                                <select name="priority_id" class="form-control form-control-sm mb-3">

                                                    <option value="">اولویت را انتخاب کنید</option>

                                                    @foreach($ticketPriorities as $ticketPriority)

                                                    <option value="{{$ticketPriority->id}}">{{$ticketPriority->name}}</option>

                                                    @endforeach

                                                </select>
                                            </div>
                                            @error('priority_id')
                                            <span class="text-white bg-danger rounded">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </section>


                                        <section class="col-12">
                                            <div class="form-group">
                                                <label for="">توضیحات</label>
                                                <textarea class="form-control form-control-sm mb-3" name="description" id="" rows="3">{{old('description')}}</textarea>
                                            </div>
                                            @error('description')
                                            <span class="text-white bg-danger rounded">
                                                {{$message}}
                                            </span>
                                            @enderror
                                        </section>


                                        <section class="col-12 my-2">
                                            <div class="form-group">
                                                <label for="file">فایل</label>
                                                <input type="file" class="form-control form-control-sm mb-3" name="file" id="file">
                                            </div>
                                            @error('file')
                                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </section>


                                        <section class="col-12 mt-2 pb-2 my-2">
                                            <button class="btn btn-success btn-sm mt-3">ثبت</button>
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
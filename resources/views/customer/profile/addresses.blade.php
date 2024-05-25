@extends('customer.layouts.master-two-col')

@section('title')

آدرس های من

@endsection



@section('content')

<section class="mb-4">
    <section class="container-xxl">
        <section class="row">

        @include('customer.layouts.partials.profile-sidebar')


            <section class="col">
                <!-- start vontent header -->
                <section class="content-header">
                    <section class="d-flex justify-content-between align-items-center">
                        <h2 class="content-header-title">
                            <span>تکمیل اطلاعات ارسال کالا (آدرس گیرنده، مشخصات گیرنده، نحوه ارسال) </span>
                        </h2>
                        <section class="content-header-link">
                            <!--<a href="#">مشاهده همه</a>-->
                        </section>
                    </section>
                </section>

                @if($errors->any())

                <ul>

                    @foreach($errors->all() as $error)

                    <li>{{$error}}</li>

                    @endforeach

                </ul>

                @endif


                <section class="row mt-4">
                    <section class="col-md-9">
                        <section class="content-wrapper bg-white p-3 rounded-2 mb-4">

                            <!-- start vontent header -->
                            <section class="content-header mb-3">
                                <section class="d-flex justify-content-between align-items-center">
                                    <h2 class="content-header-title content-header-title-small">
                                        انتخاب آدرس و مشخصات گیرنده
                                    </h2>
                                    <section class="content-header-link">
                                        <!--<a href="#">مشاهده همه</a>-->
                                    </section>
                                </section>
                            </section>

                            <section class="address-alert alert alert-primary d-flex align-items-center p-2" role="alert">
                                <i class="fa fa-info-circle flex-shrink-0 me-2"></i>
                                <secrion>
                                    پس از ایجاد آدرس، آدرس را انتخاب کنید.
                                </secrion>
                            </section>


                            <section class="address-select">

                                @foreach($addresses as $address)

                                <input type="radio" name="address_id" form="address-delivery" value="{{$address->id}}" id="address-{{$address->id}}" /> <!--checked="checked"-->
                                <label for="address-{{$address->id}}" class="address-wrapper mb-2 p-2">
                                    <section class="mb-2">
                                        <i class="fa fa-map-marker-alt mx-1"> </i>
                                        <span class="address">آدرس : {{$address->city->province->name.' - '}} {{$address->city->name.' - '}} {{$address->address.' - '}} {{$address->no != null ? 'پلاک '.$address->no.' - ' : ''}} {{$address->unit != null ? 'واحد '.$address->unit : ''}} </span>
                                    </section>
                                    <section class="mb-2">
                                        <i class="fa fa-user-tag mx-1"></i>
                                        <span class="address">گیرنده : {{$address->recipient_first_name ?? '-'}} {{$address->recipient_last_name ?? '-'}}</span>
                                    </section>
                                    <section class="mb-2">
                                        <i class="fa fa-mobile-alt mx-1"></i>
                                        <span class="address"> موبایل گیرنده : {{$address->mobile ?? '-'}} </span>
                                    </section>
                                    <section class=" mb-2 ">
                                        <i class="fa fa-truck mx-1"></i>
                                        <span class="address">کد پستی: {{$address->postal_code ?? '-'}}</span>
                                    </section>

                                    <a class="address-edit-button" data-bs-toggle="modal" data-bs-target="#edit-address-{{$address->id}}"><i class="fa fa-edit"></i> ویرایش آدرس</a>

                                </label>

                                <section class="address-add-wrapper">
                                    <!-- start edit address Modal -->

                                    <section class="modal fade" id="edit-address-{{$address->id}}" tabindex="-1" aria-labelledby="edit-address-label" aria-hidden="true">
                                        <section class="modal-dialog">
                                            <section class="modal-content">
                                                <section class="modal-header">
                                                    <h5 class="modal-title" id="edit-address-label"><i class="fa fa-plus"></i> ویرایش آدرس</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </section>
                                                <section class="modal-body">
                                                    <form class="row" action="{{route('customer.salesProcess.update-address', $address->id)}}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <section class="col-6 mb-2">
                                                            <label for="province" class="form-label mb-1">استان</label>
                                                            <select class="form-select form-select-sm" name="province_id" id="province-{{$address->id}}">

                                                                @foreach($provinces as $province)

                                                                <option value="{{$province->id}}" data-url="{{route('customer.salesProcess.getCities', $province->id)}}" @if($province->id == $address->city->province_id) selected @endif>{{$province->name}}</option>

                                                                @endforeach

                                                            </select>
                                                        </section>

                                                        <section class="col-6 mb-2">
                                                            <label for="city" class="form-label mb-1">شهر</label>
                                                            <select class="form-select form-select-sm" name="city_id" id="city-{{$address->id}}">
                                                                <option selected>شهر را انتخاب کنید</option>

                                                            </select>
                                                        </section>
                                                        <section class="col-12 mb-2">
                                                            <label for="address" class="form-label mb-1">نشانی</label>
                                                            <textarea class="form-control form-control-sm" name="address" id="address" placeholder="نشانی">{{$address->address}}</textarea>
                                                        </section>

                                                        <section class="col-6 mb-2">
                                                            <label for="postal_code" class="form-label mb-1">کد پستی</label>
                                                            <input type="text" class="form-control form-control-sm" name="postal_code" id="postal_code" placeholder="کد پستی" value="{{$address->postal_code}}">
                                                        </section>

                                                        <section class="col-3 mb-2">
                                                            <label for="no" class="form-label mb-1">پلاک</label>
                                                            <input type="text" class="form-control form-control-sm" name="no" id="no" placeholder="پلاک" value="{{$address->no}}">
                                                        </section>

                                                        <section class="col-3 mb-2">
                                                            <label for="unit" class="form-label mb-1">واحد</label>
                                                            <input type="text" class="form-control form-control-sm" name="unit" id="unit" placeholder="واحد" value="{{$address->unit}}">
                                                        </section>

                                                        <section class="border-bottom mt-2 mb-3"></section>

                                                        <section class="col-12 mb-2">
                                                            <section class="form-check">

                                                                <input class="form-check-input" type="checkbox" name="receiver" id="receiver" @if(!empty($address->recipient_first_name) || !empty($address->recipient_last_name) || !empty($address->mobile))
                                                                onclick="document.querySelector('#check-receiver-{{$address->id}}').classList.toggle('d-none')"

                                                                checked

                                                                @else

                                                                onclick="document.querySelector('#check-receiver-{{$address->id}}').classList.toggle('d-none')"

                                                                @endif />

                                                                <label class="form-check-label" for="receiver">
                                                                    گیرنده سفارش خودم نیستم.
                                                                </label>
                                                            </section>
                                                        </section>

                                                        <section class="{{!empty($address->recipient_first_name) || !empty($address->recipient_last_name) || !empty($address->mobile) ? 'd-block' : 'd-none'}}" id="check-receiver-{{$address->id}}">
                                                            <section class="col-6 mb-2">
                                                                <label for="recipient_first_name" class="form-label mb-1">نام گیرنده</label>
                                                                <input type="text" class="form-control form-control-sm" name="recipient_first_name" id="recipient_first_name" placeholder="نام گیرنده" value="{{$address->recipient_first_name ?? ''}}">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="recipient_last_name" class="form-label mb-1">نام خانوادگی گیرنده</label>
                                                                <input type="text" class="form-control form-control-sm" name="recipient_last_name" id="recipient_last_name" placeholder="نام خانوادگی گیرنده" value="{{$address->recipient_last_name ?? ''}}">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="mobile" class="form-label mb-1">شماره موبایل</label>
                                                                <input type="text" class="form-control form-control-sm" name="mobile" id="mobile" placeholder="شماره موبایل" value="{{$address->mobile ?? ''}}">
                                                            </section>
                                                        </section>

                                                </section>
                                                <section class="modal-footer py-1">
                                                    <button type="submit" class="btn btn-sm btn-primary">ثبت آدرس</button>
                                                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                                </section>
                                                </form>
                                            </section>
                                        </section>
                                    </section>
                                </section>
                                <!-- end edit address Modal -->

                                @endforeach


                                <section class="address-add-wrapper">
                                    <button class="address-add-button" type="button" data-bs-toggle="modal" data-bs-target="#add-address"><i class="fa fa-plus"></i> ایجاد آدرس جدید</button>
                                    <!-- start add address Modal -->
                                    <section class="modal fade" id="add-address" tabindex="-1" aria-labelledby="add-address-label" aria-hidden="true">
                                        <section class="modal-dialog">
                                            <section class="modal-content">
                                                <section class="modal-header">
                                                    <h5 class="modal-title" id="add-address-label"><i class="fa fa-plus"></i> ایجاد آدرس جدید</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </section>
                                                <section class="modal-body">
                                                    <form class="row" action="{{route('customer.salesProcess.add-address')}}" method="post">
                                                        @csrf
                                                        <section class="col-6 mb-2">
                                                            <label for="province" class="form-label mb-1">استان</label>
                                                            <select class="form-select form-select-sm" name="province_id" id="province">
                                                                <option selected>استان را انتخاب کنید</option>

                                                                @foreach($provinces as $province)

                                                                <option value="{{$province->id}}" data-url="{{route('customer.salesProcess.getCities', $province->id)}}">{{$province->name}}</option>

                                                                @endforeach

                                                            </select>
                                                        </section>

                                                        <section class="col-6 mb-2">
                                                            <label for="city" class="form-label mb-1">شهر</label>
                                                            <select class="form-select form-select-sm" name="city_id" id="city">
                                                                <option selected>شهر را انتخاب کنید</option>

                                                            </select>
                                                        </section>
                                                        <section class="col-12 mb-2">
                                                            <label for="address" class="form-label mb-1">نشانی</label>
                                                            <textarea class="form-control form-control-sm" name="address" id="address" placeholder="نشانی"></textarea>
                                                        </section>

                                                        <section class="col-6 mb-2">
                                                            <label for="postal_code" class="form-label mb-1">کد پستی</label>
                                                            <input type="text" class="form-control form-control-sm" name="postal_code" id="postal_code" placeholder="کد پستی">
                                                        </section>

                                                        <section class="col-3 mb-2">
                                                            <label for="no" class="form-label mb-1">پلاک</label>
                                                            <input type="text" class="form-control form-control-sm" name="no" id="no" placeholder="پلاک">
                                                        </section>

                                                        <section class="col-3 mb-2">
                                                            <label for="unit" class="form-label mb-1">واحد</label>
                                                            <input type="text" class="form-control form-control-sm" name="unit" id="unit" placeholder="واحد">
                                                        </section>

                                                        <section class="border-bottom mt-2 mb-3"></section>

                                                        <section class="col-12 mb-2">
                                                            <section class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="receiver" id="receiver" onclick="document.querySelector('#check-receiver-add-address').classList.toggle('d-none')">
                                                                <label class="form-check-label" for="receiver">
                                                                    گیرنده سفارش خودم نیستم.
                                                                </label>
                                                            </section>
                                                        </section>

                                                        <section class="d-none" id="check-receiver-add-address">
                                                            <section class="col-6 mb-2">
                                                                <label for="recipient_first_name" class="form-label mb-1">نام گیرنده</label>
                                                                <input type="text" class="form-control form-control-sm" name="recipient_first_name" id="recipient_first_name" placeholder="نام گیرنده">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="recipient_last_name" class="form-label mb-1">نام خانوادگی گیرنده</label>
                                                                <input type="text" class="form-control form-control-sm" name="recipient_last_name" id="recipient_last_name" placeholder="نام خانوادگی گیرنده">
                                                            </section>

                                                            <section class="col-6 mb-2">
                                                                <label for="mobile" class="form-label mb-1">شماره موبایل</label>
                                                                <input type="text" class="form-control form-control-sm" name="mobile" id="mobile" placeholder="شماره موبایل">
                                                            </section>
                                                        </section>

                                                </section>
                                                <section class="modal-footer py-1">
                                                    <button type="submit" class="btn btn-sm btn-primary">ثبت آدرس</button>
                                                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
                                                </section>
                                                </form>
                                            </section>
                                        </section>
                                    </section>
                                    <!-- end add address Modal -->
                                </section>

                            </section>
                        </section>

                    </section>

                </section>
            </section>
        </section>

    </section>
</section>
<!-- end cart -->


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

    $('.address').text(function(i, v) {
        var chars = v.split('');
        for (var i = 0; i < chars.length; i++) {
            if (/\d/.test(chars[i])) {
                chars[i] = arabicNumbers[chars[i]];
            }
        }
        return chars.join('');
    })
</script>

<script>
    $(document).ready(function() {



        $('#province').change(function() {

            var province_element = $('#province option:selected');
            var url = province_element.attr('data-url');

            $.ajax({

                url: url,
                type: 'GET',
                success: function(response) {

                    if (response.status) {

                        let cities = response.cities;
                        $('#city').empty();

                        cities.map((city) => {

                            $('#city').append($('<option/>').val(city.id).text(city.name));

                            //or

                            // $('#city').append($("<option value="+"city.id"+">"+city.name+"</option>"));

                        })

                    } else {

                        errorToast('خطایی رخ داد');

                    }

                },
                error: function() {

                    errorToast('خطایی رخ داد');

                }


            })

        })
    })
</script>
<script>
    $(document).ready(function() {
        // edit
        var addresses = {!!auth()->user()->addresses!!}
        // console.log(addresses);
        addresses.map(function(address) {
            var id = address.id;
            var target = `#province-${id}`;
            var selected = `${target} option:selected`;
            var element = $(selected);
            var url = element.attr('data-url');

            $.ajax({
                url: url,
                type: "GET",
                success: function(response) {
                    if (response.status) {
                        let cities = response.cities;
                        let selected_city = '';
                        $(`#city-${id}`).empty();
                        cities.map((city) => {
                            // $(`#city-${id}`).append($('<option/>').val(city.id).text(city
                            //     .name));
                            if (address.city_id == city.id) {

                                selected_city = 'selected';
                                $(`#city-${id}`).append($("<option value=\" " + city.id + "\" " + selected_city + ">" + city.name + "</option>"));

                            } else {

                                $(`#city-${id}`).append($('<option/>').val(city.id).text(city.name));

                            }

                        });
                    } else {
                        errorToast('خطا پیش آمده است')
                    }
                },
                error: function() {
                    errorToast('خطا پیش آمده است')
                }
            })


            $(target).change(function() {
                var element = $(selected);
                var url = element.attr('data-url');

                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        if (response.status) {
                            let cities = response.cities;
                            $(`#city-${id}`).empty();
                            cities.map((city) => {
                                $(`#city-${id}`).append($('<option/>').val(city.id).text(city.name));
                                // $(`#city-${id}`).append($("<option value="+"city.id"+" {{$address->city_id == "+city.id + "? 'selected' : ''}}>"+city.name+"</option>"));

                            });
                        } else {
                            errorToast('خطا پیش آمده است')
                        }
                    },
                    error: function() {
                        errorToast('خطا پیش آمده است')
                    }
                })
            })
        })
    })
</script>

@endsection
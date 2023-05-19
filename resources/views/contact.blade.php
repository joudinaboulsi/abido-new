@extends('layouts.app')
@section('content')
    <?php
    $language = session('lang');
    if ($language == '') {
        $language = 'ENG';
    }
    ?>

    <!-- Subheader Start -->
    <div class="subheader bg-cover dark-overlay dark-overlay-2"
        style="background-image: url('{{ asset('/img/subheader.jpg') }}');">
        <div class="absolute-subheader">
            <div class="container">
                <div class="subheader-inner">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @if ($language == 'ENG')
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ route('home_path') }}">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active" aria-current="page">اتصل بنا</li>
                            @endif
                        </ol>
                    </nav>





                </div>
            </div>
        </div>
    </div>
    <!-- Subheader End -->

    <!-- Contact Info Start -->
    <div class="section section-padding extra-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="ct-info-box">
                        <div class="ct-info-box-icon">
                            <i class="flaticon-call"></i>
                            @if ($language == 'ENG')
                                <h5>{{ $data->components->section_title_call->value }}</h5>
                            @elseif($data->components->title_call_ar->value != null)
                                <h5>{{ $data->components->title_call_ar->value }}</h5>
                            @endif

                            <span>{{ $data->components->phone->value }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="ct-info-box">
                        <div class="ct-info-box-icon">
                            <i class="flaticon-email"></i>
                            @if ($language == 'ENG')
                                <h5>{{ $data->components->title_mail->value }}</h5>
                            @elseif($data->components->title_mail_ar->value != null)
                                <h5> {{ $data->components->title_mail_ar->value }}</h5>
                            @endif
                            <span>{{ $data->components->text_mail->value }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="ct-info-box">
                        <div class="ct-info-box-icon">
                            <i class="flaticon-location"></i>
                            @if ($language == 'ENG')
                                <h5>{{ $data->components->address->value }}</h5>
                            @elseif($data->components->address_ar->value != null)
                                <h5> {{ $data->components->address_ar->value }}</h5>
                            @endif


                            @if ($language == 'ENG')
                                <span>{{ $data->components->text_address->value }}</span>
                            @elseif($data->components->text_address_ar->value != null)
                                <span> {{ $data->components->text_address_ar->value }}</span>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Info End -->

    <!--Contact Form Start -->
    <section class="section pt-0">
        <div class="container">
            <div class="section-title-wrap section-header">
                @if ($language == 'ENG')
                    <h2 class="title">
                        {{ $data->components->section_title->value }}</h2>
                @elseif($data->components->section_title_ar->value != null)
                    <h2 class="title" style="text-align: right"> {{ $data->components->section_title_ar->value }}</h2>
                @endif
                @if ($language == 'ENG')
                    <p class="subtitle">
                        {{ $data->components->section_subtitle->value }}
                    </p>
                @elseif($data->components->subtitle_ar->value != null)
                    <p class="subtitle">
                        {{ $data->components->subtitle_ar->value }}
                    </p>
                @endif



            </div>
            <form class="mf_form_validate ajax_submit" action="#" method="post" enctype="multipart/form-data">
                <div class="row formcontact">
                    <div class="form-group col-lg-6">
                        @if ($language == 'ENG')
                            <input type="text" placeholder="Full Name" class="form-control" name="name"
                                value="" />
                        @else
                            <input type="text" placeholder="الاسم الكامل" class="form-control" name="name"
                                value="" />
                        @endif
                    </div>
                    <div class="form-group col-lg-6">
                        @if ($language == 'ENG')
                            <input type="text" placeholder="Phone No." class="form-control" name="phone"
                                value="" />
                        @else
                            <input type="text" placeholder="رقم الهاتف." class="form-control" name="phone"
                                value="" />
                        @endif


                    </div>
                    <div class="form-group col-lg-12">
                        @if ($language == 'ENG')
                            <input type="email" placeholder="Email Address" class="form-control" name="email"
                                value="" />
                        @else
                            <input type="email" placeholder="عنوان البريد الإلكتروني" class="form-control" name="email"
                                value="" />
                        @endif

                    </div>
                    <div class="form-group col-lg-12">
                        @if ($language == 'ENG')
                            <input type="text" placeholder="Subject" class="form-control" name="subject"
                                value="" />
                        @else
                            <input type="text" placeholder="موضوع" class="form-control" name="subject" value="" />
                        @endif
                    </div>
                    <div class="form-group col-lg-12">
                        @if ($language == 'ENG')
                            <textarea name="message" class="form-control" placeholder="Type your message" rows="8"></textarea>
                        @else
                            <textarea name="message" class="form-control" placeholder="اكتب رسالتك" rows="8"></textarea>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn-custom primary">
                    @if ($language == 'ENG')
                        {{ $data->components->link->value }}
                    @elseif($data->components->link_ar->value != null)
                        {{ $data->components->link_ar->value }}
                    @endif
                </button>
                <div class="server_response w-100"></div>
            </form>

            <div class="our-stores-location __web-inspector-hide-shortcut__">
                <div class="map-stores">
                    <div class="map-stores-box-icon">
                        <i class="flaticon-location"></i>
                        @if ($language == 'ENG')
                            <h5> {{ $data->components->title->value }}</h5>
                        @elseif($data->components->title_ar->value != null)
                            <h5> {{ $data->components->title_ar->value }}</h5>
                        @endif
                        @if ($language == 'ENG')
                            <span class="map-button" data-map="map-1"> {{ $data->components->subtitle->value }}</span>
                        @elseif($data->components->subtitle_1_ar->value != null)
                            <span class="map-button" data-map="map-1" style="float: right">
                                {{ $data->components->subtitle_1_ar->value }}</span>
                        @endif


                        <hr class="hrmap">

                        @if ($language == 'ENG')
                            <span class="map-button" data-map="map-2"> {{ $data->components->location->value }} </span>
                        @elseif($data->components->location_ar->value != null)
                            <span class="map-button" data-map="map-2">
                                {{ $data->components->location_ar->value }}
                            </span>
                        @endif
                        <hr class="hrmap">


                    </div>
                </div>
                <div class="map-location">
                    <div id="embed-ded-map-canvas" style="height:100%; width:100%;max-width:100%;">
                        <iframe class="map-wrapper active" data-map="map-1" style="height:100%;width:100%;border:0;"
                            frameborder="0"
                            src="https://www.google.com/maps/embed/v1/place?q=abido+lebanon&amp;key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe>
                        <iframe class="map-wrapper" data-map="map-2" style="height:100%;width:100%;border:0;"
                            frameborder="0"
                            src="https://www.google.com/maps/embed/v1/place?q=beirut&amp;key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe>
                    </div><a class="googlemaps-made" rel="nofollow" href="https://www.bootstrapskins.com/themes"
                        id="enable-maps-data">premium bootstrap themes</a>
                    <style>
                        #embed-ded-map-canvas img {
                            max-height: none;
                            max-width: none !important;
                            background: none !important;
                        }
                    </style>
                </div>
            </div>
        </div>
    </section>
    <!--Contact Form End -->
@endsection

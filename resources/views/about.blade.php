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
                                <li class="breadcrumb-item"><a href="{{ route('home_path') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About Us</li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ route('home_path') }}">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active" aria-current="page">معلومات عنا</li>
                            @endif
                        </ol>
                    </nav>

                </div>
            </div>
        </div>
    </div>
    <!-- Subheader End -->

    <!-- About Us Start -->
    <section class="section extra-padding">
        <div class="imgs-wrapper">
            <img src="{{ asset('/img/veg/6.png') }}" alt="veg" class="d-none d-lg-block" />
            <img src="{{ asset('/img/veg/9.png') }}" alt="veg" class="d-none d-lg-block" />
        </div>
        <div class="container">
            <div class="section-title-wrap text-center">
                @if ($language == 'ENG')
                    <h2 class="title"> {!! $data->components->section_1_title->value !!}</h2>
                @else
                    <h2 class="title"> {!! $data->components->subtitle_ar->value !!}</h2>
                @endif
                @if ($language == 'ENG')
                    <p class="subtitle">
                        {!! $data->components->section_1_content->value !!}
                    </p>
                @elseif($data->components->section_1_content_ar->value != null)
                    <p class="subtitle">
                        {!! $data->components->section_1_content_ar->value !!}
                    </p>
                @endif
                @if ($language == 'ENG')
                    <a href="{{ $data->components->link_url->value }}" class="btn-custom primary">
                        {{ $data->components->link->value }}
                        <i class="fas fa-arrow-right"></i>
                    </a>
                @elseif($data->components->link_ar->value != null)
                    <a href="{{ $data->components->link_url->value }}" class="btn-custom primary">
                        {{ $data->components->link_ar->value }}
                        <i class="fas fa-arrow-left"></i>
                    </a>
                @endif
            </div>
        </div>
    </section>
    <!-- About Us End -->

    <!-- CTA Start -->
    <section class="section section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="cta-item item-1">
                        <div class="cta-item-inner">
                            @if ($language == 'ENG')
                                <span class="custom-secondary categ">{{ $data->components->category_title_1->value }}</span>
                            @else
                                <span
                                    class="custom-secondary categ">{{ $data->components->category_title1_ar->value }}</span>
                            @endif
                            @if ($language == 'ENG')
                                <h3>{{ $data->components->section_2_title_1->value }}</h3>
                            @else
                                <h3>{{ $data->components->section_2_title_1_ar->value }}</h3>
                            @endif
                            @if ($language == 'ENG')
                                <p>{{ $data->components->section_2_subtitle_1->value }}</p>
                            @else
                                <p>{{ $data->components->subtitle_1_ar->value }}</p>
                            @endif
                            @if ($language == 'ENG')
                                <a href="{{ $data->components->url->value }}"
                                    class="btn-custom secondary">{{ $data->components->link_1->value }}
                                    <i class="fas fa-arrow-right"></i> </a>
                            @else
                                <a href="{{ $data->components->url->value }}"
                                    class="btn-custom secondary">{{ $data->components->link_1_ar->value }}
                                    <i class="fas fa-arrow-left"></i> </a>
                            @endif
                        </div>
                        <img src=" {{ $data->components->section_2_image_1->md_img }}" alt="cta" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cta-item item-2">
                        <div class="cta-item-inner">
                            @if ($language == 'ENG')
                                <span class="custom-primary categ">{{ $data->components->category_title_2->value }}</span>
                            @else
                                <span
                                    class="custom-primary categ">{{ $data->components->category_title_2_ar->value }}</span>
                            @endif
                            @if ($language == 'ENG')
                                <h3 class="titlecateg">{{ $data->components->section_2_title_2->value }}</h3>
                            @else
                                <h3 class="titlecateg">{{ $data->components->section_2_title_2_ar->value }}</h3>
                            @endif
                            @if ($language == 'ENG')
                                <p>{{ $data->components->section_2_subtitle_2->value }}</p>
                            @else
                                <p>{{ $data->components->subtitle_2_ar->value }}</p>
                            @endif
                            @if ($language == 'ENG')
                                <a href="{{ $data->components->url2->value }}" class="btn-custom primary">
                                    {{ $data->components->link_2->value }} <i class="fas fa-arrow-right"></i> </a>
                            @else
                                <a href="{{ $data->components->url2->value }}" class="btn-custom primary">
                                    {{ $data->components->link_2_ar->value }} <i class="fas fa-arrow-left"></i> </a>
                            @endif
                        </div>
                        <img src="{{ $data->components->section_2_image_2->md_img }}" alt="cta" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CTA End -->

    <!-- About us Start -->
    @if ($language != 'ENG')
        @foreach ($data->components->timeline->value as $sub_page)
            <section class="section pt-0" style="direction:ltr">
                <div class="imgs-wrapper-2">
                    <img src="{{ $sub_page->components->image->md_img }}" alt="veg" class="d-none d-lg-block" />
                    <img src="{{ $sub_page->components->image_1->md_img }}" alt="veg" class="d-none d-lg-block" />
                    <img src="{{ $sub_page->components->image2->md_img }}" alt="veg" class="d-none d-lg-block" />
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="section-title-wrap">

                                <h2 class="title" style="text-align: right"> {!! $sub_page->components->block_1_title_ar->value !!}</h2>

                                <p class="subtitle">

                                    {!! $sub_page->components->block_1_text_ar->value !!}
                                </p>

                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-block"></div>
                    </div>

                    <div class="section pb-0">
                        <div class="row">
                            <div class="col-lg-6"></div>
                            <div class="col-lg-6">
                                <div class="section-title-wrap">

                                    <h2 class="title" style="text-align: right">
                                        {!! $sub_page->components->block_2_title_ar->value !!}
                                    </h2>


                                    <p class="subtitle">

                                        {!! $sub_page->components->block_2_text_ar->value !!}
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @else
        @foreach ($data->components->timeline->value as $sub_page)
            <section class="section pt-0">
                <div class="imgs-wrapper-2">
                    <img src="{{ $sub_page->components->image->md_img }}" alt="veg" class="d-none d-lg-block" />
                    <img src="{{ $sub_page->components->image_1->md_img }}" alt="veg" class="d-none d-lg-block" />
                    <img src="{{ $sub_page->components->image2->md_img }}" alt="veg" class="d-none d-lg-block" />
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="section-title-wrap">
                                <h2 class="title"> {!! $sub_page->components->block_1_title->value !!}</h2>
                                <p class="subtitle">

                                    {!! $sub_page->components->block_1_text->value !!}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 d-none d-lg-block"></div>
                    </div>

                    <div class="section pb-0">
                        <div class="row">
                            <div class="col-lg-6"></div>
                            <div class="col-lg-6">
                                <div class="section-title-wrap">
                                    <h2 class="title">
                                        {!! $sub_page->components->block_2_title->value !!}
                                    </h2>
                                    <p class="subtitle">

                                        {!! $sub_page->components->block_2_text->value !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @endif
    <!-- About us End -->
@endsection

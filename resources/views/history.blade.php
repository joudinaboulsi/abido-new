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
                                <li class="breadcrumb-item active" aria-current="page">History</li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ route('home_path') }}">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active" aria-current="page"> التاريخ</li>
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
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-timeline5">
                        <div class="timeline">
                            <div class="timeline-icon">
                                @if ($language == 'ENG')
                                    <span class="year">{{ $data->components->section_1_title->value }}</span>
                                @elseif($data->components->section_1_title_ar->value != null)
                                    <span class="year">{{ $data->components->section_1_title_ar->value }}</span>
                                @endif
                            </div>
                            <div class="timeline-content">
                                @if ($language == 'ENG')
                                    <h3 class="title">{{ $data->components->section_1_subtitle->value }}</h3>
                                @elseif ($data->components->subtitle_1_ar->value != null)
                                    <h3 class="title">{{ $data->components->subtitle_1_ar->value }}</h3>
                                @endif
                                @if ($language == 'ENG')
                                    <p class="description"> {!! $data->components->section_1_content->value !!}</p>
                                @elseif ($data->components->content_1_ar->value)
                                    <p class="description"> {!! $data->components->content_1_ar->value !!}</p>
                                @endif
                            </div>
                        </div>
                        <div class="timeline">
                            <div class="timeline-icon">
                                @if ($language == 'ENG')
                                    <span class="year">{{ $data->components->section_2_title->value }}</span>
                                @elseif($data->components->section_2_title_ar->value != null)
                                    <span class="year">{{ $data->components->section_2_title_ar->value }}</span>
                                @endif
                            </div>
                            <div class="timeline-content">
                                @if ($language == 'ENG')
                                    <h3 class="title">{{ $data->components->section_2_subtitle->value }}</h3>
                                @elseif ($data->components->subtitle_2_ar->value != null)
                                    <h3 class="title">{{ $data->components->subtitle_2_ar->value }}</h3>
                                @endif
                                @if ($language == 'ENG')
                                    <p class="description">{!! $data->components->section_2_content->value !!}</p>
                                @elseif ($data->components->content_2_ar->value != null)
                                    <p class="description">{!! $data->components->content_2_ar->value !!}</p>
                                @endif
                            </div>
                        </div>
                        <div class="timeline">
                            <div class="timeline-icon">
                                @if ($language == 'ENG')
                                    <span class="year">{{ $data->components->section_3_title->value }}</span>
                                @elseif($data->components->section_3_title_ar->value != null)
                                    <span class="year">{{ $data->components->section_3_title_ar->value }}</span>
                                @endif
                            </div>
                            <div class="timeline-content">
                                @if ($language == 'ENG')
                                    <h3 class="title">{{ $data->components->section_3_subtitle->value }}</h3>
                                @elseif ($data->components->subtitle_3_ar->value != null)
                                    <h3 class="title">{{ $data->components->subtitle_3_ar->value }}</h3>
                                @endif
                                @if ($language == 'ENG')
                                    <p class="description">
                                        {!! $data->components->section_3_content->value !!}
                                    </p>
                                @elseif ($data->components->content_3_ar->value != null)
                                    <p class="description">
                                        {!! $data->components->content_3_ar->value !!}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="timeline">
                            <div class="timeline-icon">
                                @if ($language == 'ENG')
                                    <span class="year">{{ $data->components->section_4_title->value }}</span>
                                @elseif ($data->components->title_4_ar->value != null)
                                    <span class="year">{{ $data->components->title_4_ar->value }}</span>
                                @endif
                            </div>
                            <div class="timeline-content">
                                @if ($language == 'ENG')
                                    <h3 class="title"> {{ $data->components->section_4_subtitle->value }}</h3>
                                @elseif ($data->components->subtitle_4_ar->value != null)
                                    <h3 class="title"> {{ $data->components->subtitle_4_ar->value }}</h3>
                                @endif
                                @if ($language == 'ENG')
                                    <p class="description">
                                        {!! $data->components->section_4_content->value !!}
                                    </p>
                                @elseif ($data->components->content_4_ar->value != null)
                                    <p class="description">
                                        {!! $data->components->content_4_ar->value !!}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us End -->
@endsection

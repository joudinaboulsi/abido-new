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
                                <li class="breadcrumb-item active" aria-current="page">terms and conditions</li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ route('home_path') }}">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active" aria-current="page">سياسة الخصوصية</li>
                            @endif
                        </ol>
                    </nav>

                </div>
            </div>
        </div>
    </div>
    <!-- Subheader End -->
    <div class="section section-padding extra-padding single-post-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Content Start -->
                    @foreach ($data->sub_pages as $sub_page)
                        <article class="post-single">
                            @if ($language == 'ENG')
                                <h2 class="title">{{ $sub_page->components->section_title->value }}</h2>
                            @elseif ($sub_page->components->section_title_ar->value != null)
                                <h2 class="title" style="text-align: right">
                                    {{ $sub_page->components->section_title_ar->value }}</h2>
                            @endif
                            <div class="post-content">
                                <div class="recipe-ingredients">

                                    @if ($language == 'ENG')
                                        <h4 class="custom-primary">{{ $sub_page->components->subtitle->value }}</h4>
                                    @elseif ($sub_page->components->subtitle_ar->value != null)
                                        <h4 class="custom-primary">{{ $sub_page->components->subtitle_ar->value }}</h4>
                                    @endif

                                    @if ($language == 'ENG')
                                        <p>
                                            {!! $sub_page->components->content->value !!}
                                        </p>
                                    @elseif ($sub_page->components->content_ar->value != null)
                                        <p style="text-align: right">
                                            {!! $sub_page->components->content_ar->value !!}
                                        </p>
                                    @endif

                                </div>

                            </div>
                        </article>
                    @endforeach
                    <!-- Content End -->

                </div>


            </div>
        </div>
    </div>
@endsection

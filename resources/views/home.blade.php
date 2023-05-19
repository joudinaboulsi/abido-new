@extends('layouts.app')
@section('content')
    <?php
    $language = session('lang');
    if ($language == '') {
        $language = 'ENG';
    }
    ?>
    <!-- Banner Start -->
    <div class="banner banner-video dark-overlay">
        <video autoplay muted loop id="myVideo">
            <source src="{{ asset('/vids/video-banner.mp4') }}" type="video/mp4" />
        </video>
        <!-- Prev Arrow -->
        <i class="slider-prev fas fa-arrow-left slick-arrow"></i>
        <div class="container">
            <div class="banner-slider" style="direction:ltr">
                @foreach ($data->components->slide_show->value as $slide)
                    <div class="banner-item text-center">
                        <div class="banner-inner">
                            @if ($language == 'ENG')
                                <h1 class="title text-white">{!! $slide->components->section_title->value !!}</h1>
                            @else
                                <h1 class="title text-white">{!! $slide->components->section_title_ar->value !!}</h1>
                            @endif
                            @if ($language == 'ENG')
                                <p class="subtitle text-white">{!! $slide->components->slide_content->value !!}</p>
                            @else
                                <p class="subtitle text-white">{!! $slide->components->slide_content_ar->value !!}</p>
                            @endif
                            @if ($language == 'ENG')
                                <a href="{{ $slide->components->link_url->value }}"
                                    class="btn-custom primary shadow-none">{{ $slide->components->link->value }}
                                    <i class="fas fa-arrow-right"></i> </a>
                            @else
                                <a href="{{ $slide->components->link_url->value }}"
                                    class="btn-custom primary shadow-none">{{ $slide->components->link_ar->value }}
                                    <i class="fas fa-arrow-left"></i> </a>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <!-- Next Arrow -->
        <i class="slider-next fas fa-arrow-right slick-arrow"></i>
    </div>
    <!-- Banner End -->

    <!-- Categories Section Start -->
    <div class="section section-padding ct-categories ct-categories-1">
        <div class="container">
            <div class="row">
                @foreach ($data->components->categories->value as $category)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="{{ $category->components->link_url->value }}" class="ct-category">
                            <div class="ct-category-icon">
                                <img src="{{ $category->components->image->sm_img }}" style="width:50px" alt=""
                                    srcset="">
                                @if ($language == 'ENG')
                                    <h5>{{ $category->components->title->value }}</h5>
                                @else
                                    <h5>{{ $category->components->title_ar->value }}</h5>
                                @endif

                                @if ($language == 'ENG')
                                    <span>{{ $category->components->products->value }}</span>
                                @else
                                    <span>{{ $category->components->products_ar->value }}</span>
                                @endif

                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Categories Section End -->
    <!-- About Start -->
    <section class="section about-sec style-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about-wrapper">
                        <img src="{{ $data->components->img1->lg_img }}" alt="image" />
                        <img src="{{ $data->components->img2->lg_img }}" class="image-2 parallax_scroll_down"
                            alt="image" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-title-wrap">
                        @if ($language == 'ENG')
                            <h2 class="title">{!! $data->components->section_title->value !!}</h2>
                        @elseif ($data->components->section_title_ar->value)
                            <h2 class="title" style="text-align: right">{!! $data->components->section_title_ar->value !!}</h2>
                        @endif
                        @if ($language == 'ENG')
                            <h3 class="subtitle">{!! $data->components->section_subtitle->value !!}</h3>
                        @elseif ($data->components->section_subtitle_ar->value != null)
                            <h3 class="subtitle" style="text-align: right">{!! $data->components->section_subtitle_ar->value !!}</h3>
                        @endif

                        @if ($language == 'ENG')
                            <p class="subtitle mb-0">
                                {!! $data->components->section_text->value !!}
                            </p>
                        @elseif($data->components->section_text_ar->value != null)
                            <p class="subtitle mb-0" style="text-align: right">
                                {!! $data->components->section_text_ar->value !!}
                            </p>
                        @endif




                    </div>
                    <div class="about-content">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <ul>
                                    <li>
                                        <span class="check">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        ISO 9001:2008
                                    </li>
                                    <li>
                                        <span class="check">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        ISO 22000: 2005
                                    </li>
                                    <li>
                                        <span class="check">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        FDA approved
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <div class="experience-box">
                                    @if ($language == 'ENG')
                                        <span class="text">
                                            Since <br />
                                            1950
                                        </span>
                                    @else
                                        <span class="text">
                                            منذ <br />
                                            1950
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="about-btn">

                        @if ($language == 'ENG')
                            <a href="{{ route('about') }}" class="btn-custom primary shadow-none" tabindex="0">
                                {{ $data->components->link->value }}
                                <i class="fas fa-arrow-right"></i></a>
                        @elseif($data->components->link_ar->value)
                            <a href="{{ $data->components->url->value }}" class="btn-custom primary shadow-none"
                                tabindex="0">
                                {{ $data->components->link_ar->value }} <i class="fas fa-arrow-left"></i>
                            </a>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About End -->

    <!-- why choose us Start -->
    <section class="section why-us-2 dark-overlay dark-overlay-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title-wrap">
                        @if ($language == 'ENG')
                            <h2 class="title text-white mb-0">{!! $data->components->section3_title->value !!}</h2>
                        @else
                            <h2 class="title text-white mb-0" style="text-align: right">{!! $data->components->section3_title_ar->value !!}</h2>
                        @endif

                        <div class="d-flex align-items-center mt-5">
                            <span class="icon">
                                <i class="fab fa-whatsapp"></i>
                            </span>
                            <div class="contact-info ml-4">
                                <span>{{ $data->components->email->value }}</span>
                                <h4>{{ $data->components->phone->value }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="progress-icon section pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="progress-bars pt-5">
                        <div class="sigma_progress">
                            @if ($language == 'ENG')
                                <h6>{{ $data->components->progress_title1->value }}</h6>
                            @else
                                <h6>{{ $data->components->progress_title1_ar->value }}</h6>
                            @endif
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                    aria-valuemax="100">
                                    <span></span>
                                </div>
                            </div>
                            <div class="sigma_progress-count">
                                <span>{{ $data->components->progress1->value }}</span>

                            </div>
                        </div>
                        <div class="sigma_progress">
                            @if ($language == 'ENG')
                                <h6>{{ $data->components->progress_title2->value }}</h6>
                            @else
                                <h6>{{ $data->components->progress_title2_ar->value }}</h6>
                            @endif
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0"
                                    aria-valuemax="100">
                                    <span></span>
                                </div>
                            </div>
                            <div class="sigma_progress-count">
                                <span>{{ $data->components->progress2->value }}</span>
                            </div>
                        </div>
                        <div class="sigma_progress">
                            @if ($language == 'ENG')
                                <h6>{{ $data->components->progress_title3->value }}</h6>
                            @else
                                <h6>{{ $data->components->progress_title3_ar->value }}</h6>
                            @endif
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100">
                                    <span></span>
                                </div>
                            </div>
                            <div class="sigma_progress-count">
                                <span>{{ $data->components->progress3->value }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="icon-wrapper">
                        <div class="row no-gutters">
                            <div class="col-lg-6 icon-col">
                                <div class="icon-box">
                                    <span class="icon">
                                        <i class="flaticon-target"></i>
                                        {{-- <img src="{{ $data->components->icon1->md_img }}" alt="" srcset=""> --}}
                                    </span>
                                    <div class="icon-descr">
                                        <h3>{{ $data->components->counter1->value }}</h3>
                                        @if ($language == 'ENG')
                                            <h4>{{ $data->components->counter_text1->value }}</h4>
                                        @else
                                            <h4>{{ $data->components->counter_text1_ar->value }}</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 icon-col">
                                <div class="icon-box">
                                    <span class="icon">
                                        <i class="flaticon-medal"></i>
                                    </span>
                                    <div class="icon-descr">
                                        <h3>{{ $data->components->counter2->value }}</h3>
                                        @if ($language == 'ENG')
                                            <h4>{{ $data->components->counter_text2->value }}</h4>
                                        @else
                                            <h4>{{ $data->components->counter_text2_ar->value }}</h4>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 icon-col">
                                <div class="icon-box">
                                    <span class="icon">
                                        <i class="flaticon-herb"></i>
                                    </span>
                                    <div class="icon-descr">
                                        <h3>{{ $data->components->counter3->value }}</h3>
                                        @if ($language == 'ENG')
                                            <h4>{{ $data->components->counter_text3->value }}</h4>
                                        @else
                                            <h4>{{ $data->components->counter_text3_ar->value }}</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 icon-col">
                                <div class="icon-box">
                                    <span class="icon">
                                        <i class="flaticon-candidate"></i>
                                    </span>
                                    <div class="icon-descr">
                                        <h3>{{ $data->components->counter4->value }}</h3>
                                        @if ($language == 'ENG')
                                            <h4>{{ $data->components->counter_text4->value }}</h4>
                                        @else
                                            <h4>{{ $data->components->counter_text4_ar->value }}</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- why choose us End -->

    <!-- Video Style 1 Start -->
    <section class="section video-style-1 bg-cover bg-center dark-overlay dark-overlay-2"
        style="background-image: url('{{ $data->components->bg_image->lg_img }}');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="video-player-trigger">
                        <a href="{{ $data->components->link_video->value }}" class="popup-youtube">
                            <i class="fas fa-play"></i>
                        </a>
                    </div>
                    @if ($language == 'ENG')
                        <h3>{{ $data->components->section_4_title->value }}</h3>
                    @elseif($data->components->section_4_title_ar->value)
                        <h3>{{ $data->components->section_4_title_ar->value }}</h3>
                    @endif

                    @if ($language == 'ENG')
                        <p>{{ $data->components->section_4_subtitle->value }}</p>
                    @elseif ($data->components->subtitle_4_ar->value)
                        <p>{{ $data->components->subtitle_4_ar->value }}</p>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- Video Style 1 End -->

    <!-- Blog Posts Start -->
    <section class="section section-padding posts">
        <div class="container">
            <div class="section-title-wrap section-header">
                @if ($language == 'ENG')
                    <h2 class="title">{{ $data->components->recipe_title->value }}</h2>
                @else
                    <h2 class="title">{{ $data->components->recipe_title_ar->value }}</h2>
                @endif

                @if ($language == 'ENG')
                    <p class="subtitle">
                        {{ $data->components->recipe_subtitle->value }}
                    </p>
                @else
                    <p class="subtitle">
                        {{ $data->components->recipe_subtitle_ar->value }}
                    </p>
                @endif
            </div>
            <div class="row masonry">
                <!-- Post Start -->
                @foreach ($data->components->recipes_list->value as $recipe)
                    <div class="col-lg-6 col-md-6 masonry-item">
                        <article class="post">
                            <div class="post-thumbnail">
                                <a href="{{ route('recipe_details', $recipe->id) }}"><img
                                        src="{{ $recipe->components->image->lg_img }}"
                                        alt="{{ $recipe->components->section_title->value }}" /></a>
                                <div class="post-meta">
                                    <div class="recipe-steps">
                                        <span><i class="fas fa-concierge-bell"></i>
                                            @if ($language == 'ENG')
                                                {{ $recipe->components->list_items->value }}
                                            @else
                                                {{ $recipe->components->list_items_ar->value }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="recipe-duration">
                                        <span><i class="fas fa-stopwatch"></i>
                                            @if ($language == 'ENG')
                                                {{ $recipe->components->duration->value }}
                                            @else
                                                {{ $recipe->components->duration_ar->value }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="post-body">
                                @if ($language == 'ENG')
                                    <h5 class="post-title"><a href="{{ route('recipe_details', $recipe->id) }}">
                                            {{ $recipe->components->section_title->value }}</a></h5>
                                @else
                                    <h5 class="post-title"><a href="{{ route('recipe_details', $recipe->id) }}">
                                            {{ $recipe->components->section_title_ar->value }}</a></h5>
                                @endif
                                @if ($language == 'ENG')
                                    <p class="post-text">{!! $recipe->components->recipe_body->value !!}</p>
                                @else
                                    <p class="post-text">{!! $recipe->components->recipe_body_ar->value !!}</p>
                                @endif
                            </div>
                        </article>
                    </div>
                @endforeach
                <!-- Post End -->


            </div>
        </div>
    </section>
    <!-- Blog Posts End -->

    <!-- CTA Start -->
    <section class="section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="cta-item item-1">
                        <div class="cta-item-inner">
                            @if ($language == 'ENG')
                                <span class="custom-secondary">{{ $data->components->category->value }}</span>
                            @else
                                <span class="custom-secondary">{{ $data->components->category_ar->value }}</span>
                            @endif
                            @if ($language == 'ENG')
                                <h3>{{ $data->components->section_title_1->value }}</h3>
                            @else
                                <h3>{{ $data->components->section_title_1_ar->value }}</h3>
                            @endif
                            @if ($language == 'ENG')
                                <p>{!! $data->components->section_1_content->value !!}</p>
                            @else
                                <p>{!! $data->components->section_1_content_ar->value !!}</p>
                            @endif
                            @if ($language == 'ENG')
                                <a href="{{ $data->components->link_1_url->value }}" class="btn-custom secondary">
                                    {{ $data->components->link_one->value }} <i class="fas fa-arrow-right"></i> </a>
                            @else
                                <a href="{{ $data->components->link_1_url->value }}" class="btn-custom secondary"
                                    style="float: right">
                                    {{ $data->components->link_1_ar->value }} <i class="fas fa-arrow-left"></i> </a>
                            @endif

                        </div>
                        <img src="{{ $data->components->image1->lg_img }}" alt="cta" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cta-item item-2">
                        <div class="cta-item-inner">
                            @if ($language == 'ENG')
                                <span class="custom-primary">{{ $data->components->category_1->value }}</span>
                            @else
                                <span class="custom-primary">{{ $data->components->category_1_ar->value }}</span>
                            @endif
                            @if ($language == 'ENG')
                                <h3>{{ $data->components->section_title_2->value }}</h3>
                            @else
                                <h3>{{ $data->components->section_title_2_ar->value }}</h3>
                            @endif
                            @if ($language == 'ENG')
                                <p>{!! $data->components->section_2_content->value !!}</p>
                            @else
                                <p>{!! $data->components->section_2_content_ar->value !!}</p>
                            @endif
                            @if ($language == 'ENG')
                                <a href="{{ $data->components->link_2_url->value }}" class="btn-custom primary">
                                    {{ $data->components->link_2->value }} <i class="fas fa-arrow-right"></i> </a>
                            @else
                                <a href="{{ $data->components->link_2_url->value }}" class="btn-custom primary"
                                    style="float: right">
                                    {{ $data->components->link_2_ar->value }} <i class="fas fa-arrow-left"></i> </a>
                            @endif
                        </div>
                        <img src="{{ $data->components->image2->lg_img }}" alt="cta" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CTA End -->

    <!-- Products Start -->
    @include('homepage.products_home')
    <!-- Products End -->
@endsection

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
                                <li class="breadcrumb-item"><a href="{{ route('recipes') }}">Recipes</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Recipe Details</li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ route('home_path') }}">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('recipes') }}">الوصفات</a></li>
                                <li class="breadcrumb-item active" aria-current="page">تفاصيل الوصفة</li>
                            @endif
                        </ol>
                    </nav>

                </div>
            </div>
        </div>
    </div>
    <!-- Subheader End -->

    <!-- Spices Start -->
    <div class="section section-padding extra-padding single-post-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Content Start -->
                    <article class="post-single">
                        <div class="post-thumbnail">
                            <img src="{{ $data->components->img->lg_img }}" alt="post" />
                            <div class="video-player-trigger">
                                <a href="{{ $data->components->video_link->value }}" class="popup-youtube">
                                    <i class="fas fa-play"></i>
                                    <div class="video-player-icons">
                                        <i class="flaticon-spices"></i>
                                        <i class="flaticon-ginger"></i>
                                        <i class="flaticon-spices-2"></i>
                                        <i class="flaticon-anise"></i>
                                        <i class="flaticon-herb"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="post-categories">
                            @if ($language == 'ENG')
                                <a
                                    href="{{ $data->components->category_url->value }}">{{ $data->components->category->value }}</a>
                            @else
                                <a
                                    href="{{ $data->components->category_url->value }}">{{ $data->components->category_ar->value }}</a>
                            @endif
                        </div>
                        @if ($language == 'ENG')
                            <h2 class="title">{{ $data->components->section_title->value }}</h2>
                        @else
                            <h2 class="title">{{ $data->components->section_title_ar->value }}</h2>
                        @endif
                        <div class="post-meta">
                            @if ($language == 'ENG')
                                <span><i class="fas fa-concierge-bell"></i> {{ $data->components->items->value }}</span>
                            @else
                                <span><i class="fas fa-concierge-bell"></i> {{ $data->components->items_ar->value }}</span>
                            @endif
                            @if ($language == 'ENG')
                                <span> <i class="far fa-user"></i> {{ $data->components->chef->value }}</span>
                            @else
                                <span> <i class="far fa-user"></i> {{ $data->components->chef_ar->value }}</span>
                            @endif
                            @if ($language == 'ENG')
                                <div class="recipe-duration">
                                    <span><i class="fas fa-stopwatch"></i> {{ $data->components->duration->value }}</span>
                                </div>
                            @else
                                <div class="recipe-duration">
                                    <span><i class="fas fa-stopwatch"></i>
                                        {{ $data->components->duration_ar->value }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="post-content">

                            <div class="recipe-ingredients">
                                @if ($language == 'ENG')
                                    <h4>{{ $data->components->ingredients->value }}</h4>
                                @else
                                    <h4>{{ $data->components->ingredients_ar->value }}</h4>
                                @endif
                                @if ($language == 'ENG')
                                    <ul class="ct-list"> {!! $data->components->content_ingredients->value !!}</ul>
                                @else
                                    <ul class="ct-list"> {!! $data->components->content_ar->value !!}</ul>
                                @endif
                            </div>
                            <div class="recipe-instructions">
                                @if ($language == 'ENG')
                                    <h4>{{ $data->components->instructions->value }}</h4>
                                @else
                                    <h4>{{ $data->components->instructions_ar->value }}</h4>
                                @endif
                                @if ($language == 'ENG')
                                    <ul>
                                        {!! $data->components->content_instructions->value !!}
                                    </ul>
                                @else
                                    <ul>
                                        {!! $data->components->content_instruct_ar->value !!}
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </article>

                    <!-- Content End -->

                    <!-- Related Products Start -->
                    {{-- <div class="similar-recipes related">
                        <h4>Similar Recipes</h4>
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="recipe">
                                    <div class="recipe-thumbnail">
                                        <a href="{{ route('recipe_details') }}">
                                            <img src="{{ asset('/img/blog/8.jpg') }}" alt="blog post" />
                                        </a>
                                    </div>
                                    <div class="recipe-body">
                                        <h5 class="recipe-title"><a href="{{ route('recipe_details') }}">Oat Generic With
                                                Strawberries and Blueberries </a></h5>
                                        <p class="recipe-text">Some quick example text to build on the card title and make
                                            up the bulk of the card's content...</p>
                                        <div class="recipe-meta">
                                            <div class="recipe-difficulty">
                                                <div class="recipe-difficulty-inner">
                                                    <span class="active"></span>
                                                    <span class="active"></span>
                                                    <span></span>
                                                </div>
                                                <span>Home Cook</span>
                                            </div>
                                            <div class="recipe-steps">
                                                <span><i class="fas fa-concierge-bell"></i> 24 Items</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="recipe">
                                    <div class="recipe-thumbnail">
                                        <a href="{{ route('recipe_details') }}">
                                            <img src="{{ asset('/img/blog/7.jpg') }}" alt="blog post" />
                                        </a>
                                    </div>
                                    <div class="recipe-body">
                                        <h5 class="recipe-title"><a href="{{ route('recipe_details') }}">Sugary Pancake
                                                with Raspberries, Mint and Cream</a></h5>
                                        <p class="recipe-text">Some quick example text to build on the card title and make
                                            up the bulk of the card's content...</p>
                                        <div class="recipe-meta">
                                            <div class="recipe-difficulty">
                                                <div class="recipe-difficulty-inner">
                                                    <span class="active"></span>
                                                    <span class="active"></span>
                                                    <span class="active"></span>
                                                </div>
                                                <span>Expert Chef</span>
                                            </div>
                                            <div class="recipe-steps">
                                                <span><i class="fas fa-concierge-bell"></i> 47 Items</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- Related Products End -->
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            @if ($language == 'ENG')
                                @if ($similar->sub_pages)
                                    <h5>{{ $recipes->components->section_title_1->value }}</5>
                                @endif
                            @else
                                @if ($similar->sub_pages)
                                    <h5>{{ $recipes->components->section_title_1_ar->value }}</h5>
                                @endif
                            @endif
                            @foreach ($similar->sub_pages as $v)
                                @if (($v->components->similar_recipes->value == 'yes') & ($v->id != $data->id))
                                    <div class="recipe featured-recipe">
                                        <div class="recipe-thumbnail">
                                            <a href="{{ route('recipe_details', $v->id) }}">
                                                <img src="{{ $v->components->image->md_img }}"
                                                    style="width:350px; height:214px" alt="blog post" />
                                            </a>
                                        </div>
                                        <div class="recipe-body">
                                            @if ($language == 'ENG')
                                                <h6 class="recipe-title"><a
                                                        href="{{ route('recipe_details', $v->id) }}">{{ $v->components->section_title->value }}</a>
                                                </h6>
                                            @else
                                                <h6 class="recipe-title"><a
                                                        href="{{ route('recipe_details', $v->id) }}">{{ $v->components->section_title_ar->value }}</a>
                                                </h6>
                                            @endif
                                            <div class="recipe-meta">
                                                @if ($language == 'ENG')
                                                    <div class="recipe-difficulty">
                                                        <div class="recipe-difficulty-inner">
                                                            <span class="active"></span>
                                                            <span class="active"></span>
                                                            <span></span>
                                                        </div>
                                                        <span>{{ $v->components->name->value }}</span>
                                                    </div>
                                                @else
                                                    <div class="recipe-difficulty">
                                                        <div class="recipe-difficulty-inner">
                                                            <span class="active"></span>
                                                            <span class="active"></span>
                                                            <span></span>
                                                        </div>
                                                        <span>{{ $v->components->name_ar->value }}</span>
                                                    </div>
                                                @endif
                                                <div class="recipe-steps">
                                                    <span><i class="fas fa-concierge-bell"></i>
                                                        @if ($language == 'ENG')
                                                            {{ $v->components->list_items->value }}
                                                        @else
                                                            {{ $v->components->list_items_ar->value }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

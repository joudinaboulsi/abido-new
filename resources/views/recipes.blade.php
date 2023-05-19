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
                                <li class="breadcrumb-item active" aria-current="page">Recipes</li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ route('home_path') }}">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active" aria-current="page">وصفات</li>
                            @endif
                        </ol>
                    </nav>

                </div>
            </div>
        </div>
    </div>
    <!-- Subheader End -->

    <!-- Spicess Start -->
    <section class="section extra-padding">
        <div class="container">
            <div class="row">
                <!-- Spicess Start -->
                <div class="col-lg-8">
                    @foreach ($data->components->recipes_list->value as $sub_page)
                        <div class="recipe recipe-list">
                            <div class="recipe-thumbnail">
                                <a href="{{ route('recipe_details', $sub_page->id) }}">
                                    <img src="{{ $sub_page->components->image->md_img }}" alt="blog post" />
                                </a>
                            </div>
                            <div class="recipe-body">
                                @if ($language == 'ENG')
                                    <h5 class="recipe-title"><a
                                            href="{{ route('recipe_details', $sub_page->id) }}">{{ $sub_page->components->section_title->value }}</a>
                                    </h5>
                                @else
                                    <h5 class="recipe-title"><a
                                            href="{{ route('recipe_details', $sub_page->id) }}">{{ $sub_page->components->section_title_ar->value }}</a>
                                    </h5>
                                @endif
                                @if ($language == 'ENG')
                                    <p class="recipe-text">
                                        {!! $sub_page->components->recipe_body->value !!}
                                    </p>
                                @else
                                    <p class="recipe-text">
                                        {!! $sub_page->components->recipe_body_ar->value !!}
                                    </p>
                                @endif
                                <div class="recipe-meta">
                                    @if ($language == 'ENG')
                                        <div class="recipe-difficulty">
                                            <div class="recipe-difficulty-inner">
                                                <span class="active"></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                            <span> {{ $sub_page->components->name->value }}</span>
                                        </div>
                                    @else
                                        <div class="recipe-difficulty">
                                            <div class="recipe-difficulty-inner">
                                                <span class="active"></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                            <span>
                                                {{ $sub_page->components->name_ar->value }}</span>
                                        </div>
                                    @endif
                                    @if ($language == 'ENG')
                                        <div class="recipe-steps">
                                            <span><i class="fas fa-concierge-bell"></i>
                                                {{ $sub_page->components->list_items->value }}</span>
                                        </div>
                                    @else
                                        <div class="recipe-steps">
                                            <span><i class="fas fa-concierge-bell"></i>
                                                {{ $sub_page->components->list_items_ar->value }}</span>
                                        </div>
                                    @endif
                                    @if ($language == 'ENG')
                                        <div class="recipe-duration">
                                            <span><i class="fas fa-stopwatch"></i>
                                                {{ $sub_page->components->duration->value }}</span>
                                        </div>
                                    @else
                                        <div class="recipe-duration">
                                            <span><i class="fas fa-stopwatch"></i>
                                                {{ $sub_page->components->duration_ar->value }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Spicess End -->

                <!-- Sidebar Start -->
                <div class="col-lg-4">
                    <div class="sidebar">

                        <div class="sidebar-widget">
                            @if ($language == 'ENG')
                                <h5>{{ $data->components->section_title->value }}</h5>
                            @else
                                <h5>{{ $data->components->section_title_ar->value }}</h5>
                            @endif

                            @foreach ($featured->sub_pages as $v)
                                @if ($v->components->featured_recipes->value == 'yes')
                                    <div class="recipe featured-recipe">
                                        <div class="recipe-thumbnail">
                                            <a href="{{ route('recipe_details', $v->id) }}">
                                                <img src="{{ $v->components->image->md_img }}"
                                                    style="width:350px; height:214px" alt="blog post" />
                                            </a>
                                        </div>
                                        <div class="recipe-body">
                                            @if ($language == 'ENG')
                                                <h6 class="recipe-title"><a href="{{ route('recipe_details', $v->id) }}">
                                                        {{ $v->components->section_title->value }}</a></h6>
                                            @else
                                                <h6 class="recipe-title"><a href="{{ route('recipe_details', $v->id) }}">
                                                        {{ $v->components->section_title_ar->value }}</a></h6>
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
                                                @if ($language == 'ENG')
                                                    <div class="recipe-steps">
                                                        <span><i
                                                                class="fas fa-concierge-bell"></i>{{ $v->components->list_items->value }}</span>
                                                    </div>
                                                @else
                                                    <div class="recipe-steps">
                                                        <span><i
                                                                class="fas fa-concierge-bell"></i>{{ $v->components->list_items_ar->value }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Sidebar End -->
            </div>
        </div>
    </section>
    <!-- Spicess End -->
@endsection

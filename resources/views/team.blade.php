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
                                <li class="breadcrumb-item active" aria-current="page">Team</li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ route('home_path') }}">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active" aria-current="page">الفريق</li>
                            @endif
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Subheader End -->

    <!-- Categories Section Start -->
    <div class="section extra-padding ct-categories ct-categories-3">
        <div class="container">
            <div class="row">
                @foreach ($data->sub_pages as $sub_page)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="#" class="ct-category">
                            <div class="ct-category-img">
                                <img src="{{ $sub_page->components->image->md_img }}" alt="category">
                                @if ($language == 'ENG')
                                    <span>{{ $sub_page->components->quote->value }}</span>
                                @elseif ($sub_page->components->quote_ar->value != null)
                                    <span>{{ $sub_page->components->quote_ar->value }}</span>
                                @endif
                            </div>
                            <div class="ct-category-info">
                                <h5>
                                    @if ($language == 'ENG')
                                        {{ $sub_page->components->name->value }} <br>
                                    @elseif($sub_page->components->name_ar->value != null)
                                        {{ $sub_page->components->name_ar->value }} <br>
                                    @endif
                                    <div class="custom-secondary">
                                        @if ($language == 'ENG')
                                            {{ $sub_page->components->position->value }}
                                        @elseif($sub_page->components->position_ar->value != null)
                                            {{ $sub_page->components->position_ar->value }}
                                        @endif
                                    </div>
                                </h5>
                                <p>
                                    @if ($language == 'ENG')
                                        {!! $sub_page->components->section_content->value !!}
                                    @elseif ($sub_page->components->content_ar->value != null)
                                        {!! $sub_page->components->content_ar->value !!}
                                    @endif
                                </p>

                                <div class="ct-category-email">
                                    <i class="flaticon-email mr-10"></i>
                                    {{ $sub_page->components->email->value }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Categories Section End -->
@endsection

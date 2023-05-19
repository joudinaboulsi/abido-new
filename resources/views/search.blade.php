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
                                <li class="breadcrumb-item active" aria-current="page">Search</li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ route('home_path') }}">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active" aria-current="page">بحث في</li>
                            @endif
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Subheader End -->
    <div class="section extra-padding ct-categories ct-categories-3">
        <div class="container">
            <div class="row">
                @if ($data)
                    <!-- Product item -->
                    @foreach ($data as $product)
                        @include('products.products_list')
                    @endforeach
                @else
                    @if ($language == 'ENG')
                        <div class="col col-md-4 col-sm-6">
                            <h2>No Results Found</h2>
                        </div>
                    @else
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <h2>لم يتم العثور على نتائج</h2>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
@endsection

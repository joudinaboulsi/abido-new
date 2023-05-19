@extends('layouts.app')
<?php
$language = session('lang');
if ($language == '') {
    $language = 'ENG';
}
?>
@section('content')
    <!-- Subheader Start -->
    <div class="subheader bg-cover dark-overlay dark-overlay-2"
        style="background-image: url('{{ asset('/img/subheader.jpg') }}');">
        <div class="absolute-subheader">
            <div class="container">
                <div class="subheader-inner">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>
    </div>
    <!-- Subheader End -->

    <section class="section section-padding extra-padding posts">
        <div class="container">
            <div class="row">
                <div class="col-12">


                    <div class="row">
                        <!-- Product Start -->
                        @foreach ($products as $product)
                            <?php
                            if ($product->seo_url) {
                                $seo_url = str_replace(' ', '-', preg_replace('/[^a-z0-9]/', '-', strtolower($product->seo_url)));
                            } else {
                                $seo_url = str_replace(' ', '-', preg_replace('/[^a-z0-9]/', '-', strtolower($product->title)));
                            }
                            
                            if ($product->firstVariant->compare_at_price != null) {
                                $sale_percentage = (1 - $product->firstVariant->price / $product->firstVariant->compare_at_price) * 100;
                                $sale_percentage = number_format($sale_percentage, 2, '.', "'");
                                $sale_percentage = strpos($sale_percentage, '.') !== false ? rtrim(rtrim($sale_percentage, '0'), '.') : $sale_percentage;
                            }
                            ?>

                            <?php
                            $language = session('lang');
                            if ($language == '') {
                                $language = 'ENG';
                            }
                            ?>

                            <?php
                            $currency_code = session('currency_code');
                            $currency_id = session('currency_id');
                            $rate = session('currency_rate');
                            if ($currency_id == '') {
                                $currency_code = app('settings')->currency;
                                $currency_id = app('settings')->currency_id;
                                $rate = 1;
                            }
                            ?>
                            <div class="col-md-4">
                                <div class="ct-product">
                                    <div class="ct-product-thumbnail">
                                        <a href="{{ route('product_path', [$product->id, $seo_url]) }}"><img
                                                src="{{ $product->firstVariant->md_img }}" alt="product" /></a>
                                        <div class="ct-product-controls">
                                            @if ($language == 'ENG')
                                                <a href="{{ route('product_path', [$product->id, $seo_url]) }}"
                                                    class="btn-custom secondary">Buy Now <i class="fas fa-arrow-right"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('product_path', [$product->id, $seo_url]) }}"
                                                    class="btn-custom secondary">اشتري الآن <i
                                                        class="fas fa-arrow-left"></i>
                                                </a>
                                            @endif
                                        </div>



                                    </div>
                                    <div class="ct-product-body">
                                        @if ($language == 'ENG')
                                            <h5 class="product-title"><a
                                                    href="{{ route('product_path', [$product->id, $seo_url]) }}">{{ $product->title }}</a>
                                            </h5>
                                        @else
                                            <h5 class="product-title"><a
                                                    href="{{ route('product_path', [$product->id, $seo_url]) }}">{{ $product->arabic->title }}</a>
                                            </h5>
                                        @endif


                                        @if ($product->firstVariant->compare_at_price != null)
                                            <div class="d-flex">
                                                <p class="product-price custom-secondary">
                                                    {{ $product->firstVariant->compare_at_price * $rate }}
                                                    {{ $currency_code }}</p>
                                                <del class="old-price"
                                                    style="padding:0 4px">{{ $product->firstVariant->price * $rate }}
                                                    {{ $currency_code }}</del>
                                            </div>
                                        @else
                                            <p class="product-price custom-secondary">
                                                {{ $product->firstVariant->price * $rate }} {{ $currency_code }}</p>
                                        @endif
                                        <div class="product-label-group">
                                            @if ($product->inStock == 0)
                                                @if ($language == 'ENG')
                                                    <p class="product-price custom-secondary">Out of Stock</p>
                                                @else
                                                    <p class="product-price custom-secondary">إنتهى من المخزن</p>
                                                @endif
                                            @elseif($product->firstVariant->compare_at_price != null)
                                                @if ($language == 'ENG')
                                                    <span class="product-price custom-secondary"> Discount :
                                                        {{ $sale_percentage }} %</span>
                                                @else
                                                    <span class="product-price custom-secondary">تخفيض :
                                                        {{ $sale_percentage }} %</span>
                                                @endif
                                            @endif
                                        </div>
                                        @if ($language == 'ENG')
                                            <p class="product-text"> {!! substr(strip_tags($product->description), 0, 80) !!}...</p>
                                        @else
                                            <p class="product-text" style="text-align: right;direction:rtl">
                                                {!! substr(strip_tags($product->arabic->description), 0, 80) !!}...
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- Product End -->

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

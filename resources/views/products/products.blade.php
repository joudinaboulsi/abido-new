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
                                <li class="breadcrumb-item active" aria-current="page">Shop</li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ route('home_path') }}">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active" aria-current="page">تسوق</li>
                            @endif
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
                    <!-- Toggle & Filter Start -->
                    <div class="filter-wrapper">

                        <select class="form-control" name="sort" onchange="filtrProduct()" id="sort">
                            @if ($language == 'ENG')
                                <option value="latest">Sort by latest</option>
                                <option value="price_high_to_low">Sort by price: High to Low</option>
                                <option value="price_low_to_high">Sort by price: Low to High</option>
                            @else
                                <option value="latest"> أحدث</option>
                                <option value="price_high_to_low">الترتيب حسب السعر: من الأعلى إلى الأقل</option>
                                <option value="price_low_to_high">الترتيب حسب السعر: من الأقل إلى الأعلى</option>
                            @endif
                        </select>



                    </div>
                    <!-- Toggle & Filter End -->

                    <div class="row">

                        <!-- Product Start -->
                        @foreach ($category->products as $product)
                            @include('products.products_list')
                        @endforeach
                        <!-- Product End -->

                    </div>

                </div>
            </div>
        </div>
    </section>

    <sctipt>


    </sctipt>



    <script>
        function filtrProduct() {
            let queryString = window.location.search; // get url parameters
            let params = new URLSearchParams(queryString); // create url search params object
            params.delete('sort'); // delete city parameter if it exists, in case you change the dropdown more then once
            params.append('sort', document.getElementById("sort").value); // add selected city
            document.location.href = "?" + params.toString(); // refresh the page with new url
        }
    </script>
@endsection

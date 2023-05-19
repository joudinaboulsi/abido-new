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
        style="background-image: url('{{ $data->components->background->lg_img }}');">
        <div class="absolute-subheader">
            <div class="container">
                <div class="subheader-inner">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @if ($language == 'ENG')
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Packing</li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ route('home_path') }}">الصفحة الرئيسية</a></li>
                                <li class="breadcrumb-item active" aria-current="page">التعبئة</li>
                            @endif
                        </ol>
                    </nav>

                </div>
            </div>
        </div>
    </div>
    <!-- Subheader End -->

    <!--Packing Start -->
    <section class="section section-padding extra-padding single-post-3">
        <div class="container">
            <!-- Cart Table Start -->
            <table class="ct-responsive-table">
                <thead class="theadPacking">
                    @if ($language == 'ENG')
                        <tr>
                            <th>Product</th>
                            <th>Unit Size</th>
                            <th>Units</th>
                            <th>Packs</th>
                            <th>Net WT.</th>
                            <th>Gross</th>
                            <th>Volume</th>
                        </tr>
                    @else
                        <th>المنتج</th>
                        <th>حجم الوحدة</th>
                        <th>الوحدات</th>
                        <th>حزم</th>
                        <th>صافي وزن.</th>
                        <th>إجمالي</th>
                        <th>المقدار</th>
                    @endif
                </thead>
                @if ($language == 'ENG')
                    <tbody>
                        {{-- {{ dd($data->components->packing->value) }} --}}
                        @foreach ($data->components->packing->value as $v)
                            <tr>
                                <td data-title="Product">
                                    <div class="cart-product-wrapper">
                                        <img src="{{ $v->components->logo->sm_img }}" alt="prod1" />
                                        <div class="cart-product-body">
                                            <h6>{{ $v->components->section_title->value }}</h6>
                                            <p>{!! $v->components->section_subtitle->value !!}</p>
                                        </div>
                                    </div>
                                </td>
                                <td data-title="Unit size">{{ $v->components->unit_size->value }} </td>
                                <td data-title="Units">{{ $v->components->units->value }}</td>
                                <td data-title="Packs">{{ $v->components->packs->value }}</td>
                                <td data-title="Net WT.">{{ $v->components->net_wt->value }}</td>
                                <td data-title="Gross">{{ $v->components->gross->value }}</td>
                                <td data-title="Volume">{{ $v->components->volume->value }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                @else
                    <tbody style="text-align: right">
                        {{-- {{ dd($data->components->packing->value) }} --}}
                        @foreach ($data->components->packing->value as $v)
                            <tr>
                                <td data-title="Product">
                                    <div class="cart-product-wrapper">
                                        <img src="{{ $v->components->logo->sm_img }}" alt="prod1" />
                                        <div class="cart-product-body">
                                            <h6>{{ $v->components->section_title_ar->value }}</h6>
                                            <p>{!! $v->components->subtitle_ar->value !!}</p>
                                        </div>
                                    </div>
                                </td>
                                <td data-title="Unit size">{{ $v->components->unit_size_ar->value }} </td>
                                <td data-title="Units">{{ $v->components->units_ar->value }}</td>
                                <td data-title="Packs">{{ $v->components->packs_ar->value }}</td>
                                <td data-title="Net WT.">{{ $v->components->net_wt_ar->value }}</td>
                                <td data-title="Gross">{{ $v->components->gross_ar->value }}</td>
                                <td data-title="Volume">{{ $v->components->volume_ar->value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif
            </table>
            <!-- Content Start -->
            <article class="post-single">
                <!-- Cart Table End -->
                <div class="post-content" style="max-width:100%">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $data->components->image1->md_img }}" alt="post" />
                        </div>
                        <div class="col-md-4">
                            <img src="{{ $data->components->image2->md_img }}" alt="post" />
                        </div>
                        <div class="col-md-4">
                            <img src="{{ $data->components->image3->md_img }}" alt="post" />
                        </div>
                    </div>
                    @if ($language == 'ENG')
                        <p>
                            {!! $data->components->content->value !!}
                        </p>
                    @else
                        <p>
                            {!! $data->components->content_ar->value !!}
                        </p>
                    @endif
                </div>
            </article>
        </div>
    </section>
    <!-- Cart End -->
@endsection

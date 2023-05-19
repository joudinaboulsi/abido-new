@extends('layouts.app')

@section('content')
    <?php
    $language = session('lang');
    if ($language == '') {
        $language = 'ENG';
    } ?>
    <!-- Login FormStart -->
    <section class="section auth-section login-sec bg-cover" style="background-image: url('assets/img/bg/3.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="accordion" id="accordionExample">
                        @foreach ($data->sub_pages as $sub_page)
                            <div class="card">
                                <div class="card-header" id="heading_{{ $sub_page->id }}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapse_{{ $sub_page->id }}" aria-expanded="true"
                                            aria-controls="collapse_{{ $sub_page->id }}">
                                            @if ($language == 'ENG')
                                                {{ $sub_page->components->question->value }}
                                            @else
                                                {{ $sub_page->components->question_ar->value }}
                                            @endif
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse_{{ $sub_page->id }}" class="collapse"
                                    aria-labelledby="heading_{{ $sub_page->id }}" data-parent="#accordionExample">
                                    <div class="card-body">
                                        @if ($language == 'ENG')
                                            {!! $sub_page->components->answer->value !!}
                                        @else
                                            {!! $sub_page->components->answer_ar->value !!}
                                        @endif


                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Collapsible Group Item #2
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                    squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                    tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                    shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                    nesciunt sapiente ea proident. Ad vegan excepteur butcher vice
                                    lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you
                                    probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Collapsible Group Item #3
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                    squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                    quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon
                                    tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                    shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                    nesciunt sapiente ea proident. Ad vegan excepteur butcher vice
                                    lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you
                                    probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Form End -->
@endsection

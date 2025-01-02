@extends(getTemplate().'.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
@endpush

@php
    $agileMastery = [asset('assets/default/img/slider/agile1.jpg'), asset('assets/default/img/slider/agile2.jpg')];

    $artificialIntelligence = [asset('assets/default/img/slider/aiint.jpg')];

    $computerScience = [asset('assets/default/img/slider/compscien.jpg')];

    $iTTechnology = [asset('assets/default/img/slider/ittech.jpg')];

    $languages = [asset('assets/default/img/slider/lang.jpg')];

    $defaultImage = getPageBackgroundSettings('categories'); // Path to your default image
    $images = [$defaultImage];

    $routeParameter = request()->categoryTitle;

    // Check the category title and set the corresponding images
    if ($routeParameter) {
        switch ($routeParameter) {
            case 'Agile-Mastery':
                // $images = array_merge($images, $agileMastery);
                $images = $agileMastery;
                break;
            case 'Artificial-Intelligence':
                $images = array_merge($images, $artificialIntelligence);
                break;
            case 'Computer-Science':
                // $images = array_merge($images, $computerScience);
                $images = $computerScience;
                break;
            case 'IT-Technology':
                // $images = array_merge($images, $iTTechnology);
                $images = $iTTechnology;
                break;
            case 'Languages':
                // $images = array_merge($images, $languages);
                $images = $languages;
                break;
        }
    }
@endphp

@section('content')
    <!-- OLD -->
    <!--<section class="site-top-banner search-top-banner opacity-04 position-relative">-->
    <!--    <img src="{{ getPageBackgroundSettings('categories') }}" class="img-cover" alt=""/>-->

    <!--    <div class="container h-100">-->
    <!--        <div class="row h-100 align-items-center justify-content-center text-center">-->
    <!--            <div class="col-12 col-md-9 col-lg-7">-->
    <!--                <div class="top-search-categories-form">-->
    <!--                    <h1 class="text-white font-30 mb-15">{{ !empty($category) ? $category->title : $pageTitle }}</h1>-->
    <!--                    <span class="course-count-badge py-5 px-10 text-white rounded">{{ $webinarsCount }} {{ trans('product.courses') }}</span>-->

    <!--                    <div class="search-input bg-white p-10 flex-grow-1">-->
    <!--                        <form action="/search" method="get">-->
    <!--                            <div class="form-group d-flex align-items-center m-0">-->
    <!--                                <input type="text" name="search" class="form-control border-0" placeholder="{{ trans('home.slider_search_placeholder') }}"/>-->
    <!--                                <button type="submit" class="btn btn-primary rounded-pill">{{ trans('home.find') }}</button>-->
    <!--                            </div>-->
    <!--                        </form>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    
     {{-- Carousel Section --}}
    <section class="site-top-banner search-top-banner opacity-04 position-relative"
        style="height: 80vh; position: relative; overflow: hidden;">
        <div id="carouselExample" class="carousel slide h-100" data-ride="carousel" data-interval="4000">
            <div class="carousel-inner h-100">

                @foreach ($images as $key => $image)
                    <div class="carousel-item h-100 {{ $key === 0 ? 'active' : '' }}">
                        <img src="{{ $image }}" class="d-block w-100 h-100" alt="Carousel Image"
                            style="object-fit: cover; height: 80vh;" />
                    </div>
                @endforeach

            </div>
            {{-- <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a> --}}
        </div>

        {{-- Search Bar Overlay --}}
        <div class="container h-100" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 10;">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-12 col-md-9 col-lg-7">
                    <div class="top-search-categories-form">
                        <h1 class="text-white font-30 mb-15">{{ !empty($category) ? $category->title : $pageTitle }}</h1>
                        <span class="course-count-badge py-2 px-10 text-white rounded">{{ $webinarsCount }}
                            {{ trans('product.courses') }}</span>

                        <div class="search-input bg-white p-10 flex-grow-1">
                            <form action="/search" method="get">
                                <div class="form-group d-flex align-items-center m-0">
                                    <input type="text" name="search" class="form-control border-0"
                                        placeholder="{{ trans('home.slider_search_placeholder') }}"
                                        style="outline: none; box-shadow: none; border:none;" />
                                    <button type="submit"
                                        class="btn btn-primary rounded-pill">{{ trans('home.find') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-30">

        @if(!empty($featureWebinars) and !$featureWebinars->isEmpty())
            <section class="mb-25 mb-lg-0">
                <h2 class="font-24 text-dark-blue">{{ trans('home.featured_webinars') }}</h2>
                <span class="font-14 text-gray font-weight-400">{{ trans('site.newest_courses_subtitle') }}</span>

                <div class="position-relative mt-20">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">

                            @foreach($featureWebinars as $featureWebinar)
                                <div class="swiper-slide">
                                    @include('web.default.includes.webinar.grid-card',['webinar' => $featureWebinar->webinar])
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

            </section>
        @endif

        <section class="mt-lg-50 pt-lg-20 mt-md-40 pt-md-40">
            <form action="{{ $sortFormAction }}" method="get" id="filtersForm">

                @include('web.default.pages.includes.top_filters')

                <div class="row mt-20">
                    <div class="col-12 col-lg-8">

                        @if(empty(request()->get('card')) or request()->get('card') == 'grid')
                            <div class="row">
                                @foreach($webinars as $webinar)
                                    <div class="col-12 col-lg-6 mt-20">
                                        @include('web.default.includes.webinar.grid-card',['webinar' => $webinar])
                                    </div>
                                @endforeach
                            </div>

                        @elseif(!empty(request()->get('card')) and request()->get('card') == 'list')

                            @foreach($webinars as $webinar)
                                @include('web.default.includes.webinar.list-card',['webinar' => $webinar])
                            @endforeach
                        @endif

                    </div>


                    <div class="col-12 col-lg-4">
                        <div class="mt-20 p-20 rounded-sm shadow-lg border border-gray300 filters-container">

                            <!--<div class="">-->
                            <!--    <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">{{ trans('public.type') }}</h3>-->

                            <!--    <div class="pt-10">-->
                            <!--        @foreach(['webinar','course','text_lesson'] as $typeOption)-->
                            <!--            <div class="d-flex align-items-center justify-content-between mt-20">-->
                            <!--                <label class="cursor-pointer" for="filterLanguage{{ $typeOption }}">{{ trans('webinars.'.$typeOption) }}</label>-->
                            <!--                <div class="custom-control custom-checkbox">-->
                            <!--                    <input type="checkbox" name="type[]" id="filterLanguage{{ $typeOption }}" value="{{ $typeOption }}" @if(in_array($typeOption, request()->get('type', []))) checked="checked" @endif class="custom-control-input">-->
                            <!--                    <label class="custom-control-label" for="filterLanguage{{ $typeOption }}"></label>-->
                            <!--                </div>-->
                            <!--            </div>-->
                            <!--        @endforeach-->
                            <!--    </div>-->
                            <!--</div>-->

                            @if(!empty($category) and !empty($category->filters))
                                @foreach($category->filters as $filter)
                                    <div class="mt-25 pb-25 border-bottom border-gray300">
                                        <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">{{ $filter->title }}</h3>

                                        @if(!empty($filter->options))
                                            <div class="pt-10">
                                                @foreach($filter->options as $option)
                                                    <div class="d-flex align-items-center justify-content-between mt-20">
                                                        <label class="cursor-pointer" for="filterLanguage{{ $option->id }}">{{ $option->title }}</label>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="filter_option[]" id="filterLanguage{{ $option->id }}" value="{{ $option->id }}" @if(in_array($option->id, request()->get('filter_option', []))) checked="checked" @endif class="custom-control-input">
                                                            <label class="custom-control-label" for="filterLanguage{{ $option->id }}"></label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @endif

                            <div class="mt-25 pt-25 border-top border-gray300">
                                <h3 class="category-filter-title font-20 font-weight-bold text-dark-blue">{{ trans('site.more_options') }}</h3>

                                <div class="pt-10">
                                    @foreach(['bundles','subscribe','certificate_included','with_quiz','featured'] as $moreOption)
                                        <div class="d-flex align-items-center justify-content-between mt-20">
                                            <label class="cursor-pointer" for="filterLanguage{{ $moreOption }}">{{ trans('webinars.show_only_'.$moreOption) }}</label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="moreOptions[]" id="filterLanguage{{ $moreOption }}" value="{{ $moreOption }}" @if(in_array($moreOption, request()->get('moreOptions', []))) checked="checked" @endif class="custom-control-input">
                                                <label class="custom-control-label" for="filterLanguage{{ $moreOption }}"></label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <button type="submit" class="btn btn-sm btn-primary btn-block mt-30">{{ trans('site.filter_items') }}</button>
                        </div>
                    </div>
                </div>

            </form>
            <div class="mt-50 pt-30">
                {{ $webinars->appends(request()->input())->links('vendor.pagination.panel') }}
            </div>
        </section>
    </div>

@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
    <script src="/assets/default/vendors/swiper/swiper-bundle.min.js"></script>

    <script src="/assets/default/js/parts/categories.min.js"></script>
@endpush

@extends('app.layouts.app')
@section('head-tag')
    <title>
        property </title>
@endsection
@section('content')
    <div class="hero-wrap" style="background-image: url({{ asset('app-assets/images/bg_1.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">خانه</a></span> <span>آگهی ها</span></p>
                    <h1 class="mb-3 bread">آگهی ها</h1>
                </div>
            </div>
        </div>
    </div>

    @if (!empty($properties))
        <section class="ftco-section bg-light">
            <div class="container">
                <div class="row">
                    @foreach (pageInate($properties, 1) as $property)
                        <div class="col-md-6 ftco-animate">
                            <div class="properties">
                                <a href="{{ route('home.property.single.show', [$property->id]) }}"
                                    class="img img-2 d-flex justify-content-center align-items-center"
                                    style="background-image: url({{ asset($property->image) }});">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <span class="icon-search2"></span>
                                    </div>
                                </a>
                                <div class="text p-3">
                                    <span class="status sale">
                                        @if ($property->sell_status == 0)
                                            خرید
                                        @elseif($property->sell_status == 1)
                                            اجاره
                                        @else
                                            رهن
                                        @endif
                                    </span>
                                    <div class="d-flex">
                                        <div class="one">
                                            <h3><a href="property-single.html">{{ $property->tag }}</a></h3>
                                            <p>
                                            <p>
                                                @if ($property->type == 0)
                                                    آپارتمان
                                                @elseif($property->type == 1)
                                                    ویلایی
                                                @elseif($property->type == 2)
                                                    زمین
                                                @elseif($property->type == 3)
                                                    سوله
                                                @endif
                                            </p>
                                        </div>
                                        <span class="price text-danger">{{ number_format($property->amount) }}
                                            تومان</span>
                                    </div>
                                    <p>{{ $property->title }}</p>
                                    <hr>
                                    <p class="bottom-area d-flex">
                                        <span><i class="flaticon-selection"></i> {{ $property->area }} متر</span>
                                        <span class="ml-auto"><i class="flaticon-bathtub"></i>
                                            {{ $property->storeroom }}</span>
                                        <span><i class="flaticon-bed"></i> {{ $property->room }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ pageInateView($properties , 1) }}
            </div>
        </section>
    @endif
@endsection

@extends('app.layouts.app')
@section('head-tag')
    <title> properties</title>
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

    @if (!empty($ads))
        <section class="ftco-section bg-light">
            <div class="container">
                <div class="row">
                    @foreach ($ads as $item)
                        <div class="col-md-6 ftco-animate">
                            <div class="properties">
                                <a href="{{ route('home.property.single.show' , [$item->id]) }}"
                                    class="img img-2 d-flex justify-content-center align-items-center"
                                    style="background-image: url({{ asset($item->image) }});">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <span class="icon-search2"></span>
                                    </div>
                                </a>
                                <div class="text p-3">
                                    <span class="status sale">
                                        @if ($item->sell_status == 0)
                                            خرید
                                        @elseif($item->sell_status == 1)
                                            اجاره
                                        @else
                                            رهن
                                        @endif
                                    </span>
                                    <div class="d-flex">
                                        <div class="one">
                                            <h3><a href="property-single.html">{{ $item->tag }}</a></h3>
                                            <p>
                                            <p>
                                                @if ($item->type == 0)
                                                    آپارتمان
                                                @elseif($item->type == 1)
                                                    ویلایی
                                                @elseif($item->type == 2)
                                                    زمین
                                                @elseif($item->type == 3)
                                                    سوله
                                                @endif
                                            </p>
                                        </div>
                                        <span class="price text-danger">{{ number_format($item->amount) }}
                                            تومان</span>
                                    </div>
                                    <p>{{ $item->title }}</p>
                                    <hr>
                                    <p class="bottom-area d-flex">
                                        <span><i class="flaticon-selection"></i> {{ $item->area }} متر</span>
                                        <span class="ml-auto"><i class="flaticon-bathtub"></i> {{ $item->storeroom }}</span>
                                        <span><i class="flaticon-bed"></i> {{ $item->room }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-5">
                    <div class="col text-center">
                        <div class="block-27">
                            <ul>
                                <li><a href="#">&lt;</a></li>
                                <li class="active"><span>1</span></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">&gt;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

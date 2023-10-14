@extends('app.layouts.app')
@section('head-tag')
    <title>
        property single</title>
@endsection
@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @if (!empty($property->image))
                            <div class="col-md-12 ftco-animate">
                                <div class="single-slider owl-carousel">
                                    @if (is_array($property->image))
                                        @foreach ($property->image as $item)
                                            <div class="item">
                                                <div class="properties-img"
                                                    style="background-image: url({{ asset($item) }});">
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="item">
                                            <div class="properties-img"
                                                style="background-image: url({{ asset($property->image) }});">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12 Properties-single mt-4 mb-5 ftco-animate">
                            <h2>{{ $property->tag }}</h2>
                            <p class="rate mb-4">
                                <span class="loc"><a href="#"><i
                                            class="icon-map"></i>{{ $property->address }}</a></span>
                            </p>
                            <p>{{ $property->title }}</p>
                            <div class="d-md-flex mt-5 mb-5">
                                <ul>
                                    <li><span>متراژ : </span> {{ $property->area }} متر</li>
                                    <li><span>اتاق خواب : </span> {{ $property->room }}</li>
                                    <li><span>سرویس بهداشتی : </span> {{ $property->toilet }}</li>
                                    <li><span>پارکینگ : </span> {{ $property->parking }}</li>
                                </ul>
                                <ul class="ml-md-5">
                                    <li><span>نوع کفپوش : </span> {{ $property->floor }}</li>
                                    <li><span>سال ساخت : </span> {{ $property->year }}</li>
                                    <li><span>انباری : </span> {{ $property->storeroom }}</li>
                                    <li><span>بالکن : </span> {{ $property->balcony }}</li>
                                </ul>
                            </div>
                            <p>{{ html_entity_decode($property->description) }}</p>
                        </div>

                        @if (!empty($relatedAds))
                            <div class="col-md-12 properties-single ftco-animate mb-5 mt-5">
                                <h4 class="mb-4">آگهی های مرتبط</h4>
                                <div class="row">
                                    @foreach ($relatedAds as $item)
                                        <div class="col-md-6 ftco-animate">
                                            <div class="properties">
                                                <a href="property-single.html"
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
                            </div>
                        @endif

                    </div>
                </div>
                <!-- .col-md-8 -->
                <div class="col-lg-4 sidebar ftco-animate">

                    @if (!empty($categories))
                        <div class="sidebar-box ftco-animate">
                            <div class="categories">
                                <h3>دسته بندی ها</h3>
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('home.category.ads.show', [$category->id]) }}">{{ $category->name }}
                                        <span>({{ count(\App\Ads::where("cat_id" , $category->id)->get()) }})</span></a></li>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if (!empty($lastBlogs))
                        <div class="sidebar-box ftco-animate">
                            <h3>اخرین بلاگ ها</h3>
                            @foreach ($lastBlogs as $item)
                                <div class="block-21 mb-4 d-flex">
                                    <a class="blog-img mr-4" style="background-image: url({{ asset($item->image) }});"></a>
                                    <div class="text">
                                        <h3 class="heading"><a href="#">{{ $item->title }}</a></h3>
                                        <div class="meta">
                                            <div><a href="#"><span class="icon-calendar"></span>
                                                    {{ convertToShamsi($item->created_at) }}</a>
                                            </div>
                                            <div><a href="#"><span class="icon-person"></span>
                                                    {{ $item->user()->first_name . ' ' . $item->user()->last_name }}</a>
                                            </div>
                                            <div><a href="#"><span class="icon-chat"></span>{{ count(\App\Comment::where('post_id', $item->id)->where("approved" , 1)->get()) }}</a></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

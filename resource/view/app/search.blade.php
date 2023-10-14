@extends('app.layouts.app')
@section('head-tag')
    <title>search</title>
@endsection
@section('content')
    <div class="hero-wrap" style="background-image: url('');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span
                            class="mr-2"><a href="index.html"></a></span><span> جستجو</span></p>
                    <h1 class="mb-3 bread">{{ $search }} </h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">آگهی</span>
                    <h2 class="mb-4"></h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                @if (empty($ads))
                    <div class="row col-12 text-center p-0 m-0">
                        <h4 class="col-12 text-center"> هیج موردی یافت نشد </h4>
                    </div>
                @else
                    @foreach ($ads as $item)
                        <div class="col-md-6 ftco-animate">
                            <div class="properties">
                                <a href="{{ route('home.property.single.show', [$item->id]) }}"
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
                                        <span class="ml-auto"><i class="flaticon-bathtub"></i>
                                            {{ $item->storeroom }}</span>
                                        <span><i class="flaticon-bed"></i> {{ $item->room }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>


    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">بلاگ</span>
                    <h2></h2>
                </div>
            </div>
            <div class="row d-flex">
                @if (empty($blogs))
                    <h4 class="col-12 text-center"> هیج موردی یافت نشد </h4>
                @else
                    @foreach ($blogs as $blog)
                        <div class="col-md-3 d-flex ftco-animate">
                            <div class="blog-entry align-self-stretch">
                                <a href="{{ route('home.blog.single.show', [$blog->id]) }}" class="block-20"
                                    style="background-image: url({{ asset($blog->image) }});">
                                </a>
                                <div class="text mt-3 d-block">
                                    <h3 class="heading mt-3"><a href="#">{{ $blog->title }}</a>
                                    </h3>
                                    <div class="meta mb-3">
                                        <div><a href="#">{{ convertToShamsi($blog->created_at) }}</a></div>
                                        <div><a
                                                href="#">{{ $blog->user()->first_name . ' ' . $blog->user()->last_name }}</a>
                                        </div>
                                        <div><a href="#" class="meta-chat"><span
                                            class="icon-chat"></span>{{ count(\App\Comment::where('post_id', $blog->id)->where('approved', 1)->get()) }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        </div>
    </section>
@endsection

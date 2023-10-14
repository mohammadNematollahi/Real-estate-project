@extends('app.layouts.app')
@section('head-tag')
    <title>
        blog </title>
@endsection
@section('content')
    <div class="hero-wrap" style="background-image: url({{ asset('app-assets/images/bg_1.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">خانه</a></span> <span>بلاگ</span></p>
                    <h1 class="mb-3 bread">بلاگ ها</h1>
                </div>
            </div>
        </div>
    </div>
    @if (!empty($blogs))
        <section class="ftco-section bg-light">
            <div class="container">
                <div class="row d-flex">
                    @foreach (pageInate($blogs , 1) as $blog)
                        <div class="col-md-3 d-flex ftco-animate">
                            <div class="blog-entry align-self-stretch">
                                <a href="{{ route("home.blog.single.show" , [$blog->id]) }}" class="block-20"
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
                                                    class="icon-chat"></span>{{ count(\App\Comment::where('post_id', $blog->id)->where("approved" , 1)->get()) }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ pageInateView($blogs , 1) }}
        </section>
    @endif
@endsection

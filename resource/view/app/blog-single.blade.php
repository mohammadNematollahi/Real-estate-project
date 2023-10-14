@extends('app.layouts.app')
@section('head-tag')
    <title>
        blog single
    </title>
@endsection
@section('content')
    <div class="hero-wrap" style="background-image: url({{ asset('app-assets/images/bg_1.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span
                            class="mr-2"><a href="index.html">خاه</a></span> <span class="mr-2"><a href="blog.html">بلاگ
                                ها</a></span> <span>صفحه داخلی بلاگ</span></p>
                    <h1 class="mb-3 bread">بلاگ</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate">
                    <h2 class="mb-3">{{ $blog->title }}</h2>
                    <p>
                        {{ html_entity_decode($blog->body) }}
                    </p>
                    <p>
                        <img src="{{ asset($blog->image) }}" alt="" class="img-fluid">
                    </p>
                    <div class="tag-widget post-tag-container mb-5 mt-5">
                        <div class="tagcloud">
                            <a href="#" class="tag-cloud-link">مسکن</a>
                            <a href="#" class="tag-cloud-link">فروش</a>
                            <a href="#" class="tag-cloud-link">اخبار</a>
                        </div>
                    </div>


                    <div class="pt-5 mt-5">
                        @if (!empty($comments))
                            <h3 class="mb-5">نظرات</h3>
                            <ul class="comment-list">
                                @foreach ($comments as $comment)
                                    <li class="comment">
                                        @if (!empty($comment->image))
                                            <div class="vcard bio">
                                                <img src="{{ asset($comment->user()->image) }}" alt="Image placeholder">
                                            </div>
                                        @endif
                                        @if ($comment->parent_id != null)
                                            <div class="col-11">
                                                <p>{{ $comment->user()->first_name . ' ' . $comment->user()->last_name }}
                                                </p>
                                                <strong class="meta">{{ convertToShamsi($comment->created_at) }}</strong>
                                                <p>{{ $comment->comment }}</p>
                                            </div>
                                        @else
                                            <div class="comment-body">
                                                <h3>{{ $comment->user()->first_name . ' ' . $comment->user()->last_name }}
                                                </h3>
                                                <div class="meta">{{ convertToShamsi($comment->created_at) }}</div>
                                                <p>{{ $comment->comment }}</p>
                                                <p><a href="" class="reply">پاسخ</a></p>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <!-- END comment-list -->

                        @if (\System\Auth\Auth::checkLogin())
                            <div class="comment-form-wrap pt-5">
                                <h3 class="mb-5">درج نظر</h3>
                                <form action="{{ route('comment.insert', [$post_id]) }}" class="p-5 bg-light"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="post">
                                    <div class="form-group">
                                        <label for="message">پیام</label>
                                        <textarea name="comment" id="message" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="ارسال نطر" class="btn py-3 px-4 btn-primary">
                                    </div>

                                </form>
                            </div>
                        @else
                            <p>برای استفاده از این بخش باید در سایت <a href="{{ route('login.index') }}">ثبت نام </a>
                                کرده
                                باشید</p>
                        @endif
                    </div>

                </div> <!-- .col-md-8 -->
                <div class="col-lg-4 sidebar ftco-animate">

                    <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>دسته بندی ها</h3>
                            <li><a href="#">خبری <span>(12)</span></a></li>
                            <li><a href="#">اقتصادی <span>(22)</span></a></li>
                            <li><a href="#">ورزشی <span>(37)</span></a></li>
                            <li><a href="#">سینما <span>(42)</span></a></li>
                            <li><a href="#">فرهنگی <span>(14)</span></a></li>
                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3>اخرین بلاگ ها</h3>
                        @foreach ($lastBlogs as $item)
                            <div class="block-21 mb-4 d-flex">
                                <a class="blog-img mr-4" style="background-image: url(images/image_3.jpg);"></a>
                                <div class="text">
                                    <h3 class="heading"><a href="#">{{ $item->title }}</a></h3>
                                    <div class="meta">
                                        <div><a href="#"><span class="icon-calendar"></span>
                                                {{ convertToShamsi($item->created_at) }} </a></div>
                                        <div><a href="#"><span class="icon-person"></span> ادمین</a></div>
                                        <div><a href="#"><span class="icon-chat"></span>
                                                {{ count(\App\Comment::where('post_id', $item->id)->where('approved', 1)->get()) }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
    </section>
@endsection

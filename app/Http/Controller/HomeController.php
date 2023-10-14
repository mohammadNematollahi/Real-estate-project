<?php

namespace App\Http\Controller;

use App\Ads;
use App\Post;
use App\Slide;
use App\Comment;
use App\Category;
use System\Auth\Auth;
use App\Http\Controller\Controller;
use System\Database\DBBuilder\DBBuilder;
use App\Http\Requests\App\CommentRequest;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::whereNull("deleted_at")->orderBy('created_at', 'desc')->limit(0, 5)->get();
        $lastAds = Ads::whereNull("deleted_at")->orderBy("created_at", 'desc')->limit(0, 5)->get();
        $bestAds = Ads::whereNull("deleted_at")->orderBy("view", 'desc')->limit(0, 5)->get();
        $lastBlogs = Post::whereNull("deleted_at")->orderBy("created_at", 'desc')->limit(0, 4)->get();

        return view("app.welcome", compact('slides', 'lastAds', 'bestAds', 'lastBlogs'));
    }

    public function propertySingle($id)
    {
        $categories = Category::whereNull("deleted_at")->get();
        $lastBlogs = Post::whereNull("deleted_at")->orderBy("created_at", 'desc')->limit(0, 4)->get();
        $property = Ads::find($id);
        $relatedAds = Ads::where("type", $property->type)->get();

        return view("app.property-single", compact('categories', 'lastBlogs', 'property', 'relatedAds'));
    }

    public function property()
    {
        $properties = Ads::whereNull("deleted_at")->orderBy("view", 'desc')->get();
        return view("app.property", compact('properties'));
    }

    public function blog()
    {
        $blogs = Post::whereNull("deleted_at")->get();
        return view("app.blog", compact('blogs'));
    }
    public function categoryAds($id)
    {
        $ads = Ads::where("cat_id", $id)->get();
        return view("app.category-ads", compact('ads'));
    }

    public function blogSingle($id)
    {
        $blog = Post::find($id);
        $comments = Comment::where("post_id", $id)->where("approved", 1)->get();
        $post_id = $id;
        $lastBlogs = Post::whereNull("deleted_at")->orderBy("created_at", 'desc')->limit(0, 3)->get();

        return view("app.blog-single", compact('blog', 'comments', 'post_id', 'lastBlogs'));
    }

    public function aboutUs()
    {
        return view("app.about");
    }

    public function insertComment($id)
    {
        $request = new CommentRequest();
        $inputs = $request->all();
        $inputs["post_id"] = $id;
        $inputs["user_id"] = Auth::user()->id;
        Comment::create($inputs);
        return back();
    }

    public function search()
    {
        if(isset($_GET["search"])){
            $search = $_GET["search"];
            $ads = Ads::whereNull('deleted_at')->where("title", " Like ", "%" . $search . "%")->get();
            $blogs = Post::whereNull('deleted_at')->where("title", " Like ", "%" . $search . "%")->get();
            return view("app.search", compact('ads', 'blogs' , 'search'));
        }
    }
}

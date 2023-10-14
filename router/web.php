<?php

use System\router\Web\Router;

//app
Router::get("", "HomeController@index");
Router::get("/home", "HomeController@index", "home.home");
Router::get("property-single/{id}", "HomeController@propertySingle", "home.property.single.show");
Router::get("category-ads/{id}", "HomeController@categoryAds", "home.category.ads.show");
Router::get("property", "HomeController@property", "home.property.show");
Router::get("blog", "HomeController@blog", "home.blog.show");
// Router::get("category-blog/{id}", "HomeController@categoryBlog", "home.category.blog.show");
Router::get("blog-single/{id}", "HomeController@blogSingle", "home.blog.single.show");
Router::get("about-us", "HomeController@aboutUs", "home.about");

//admin
Router::get("admin", "Admin\PanelController@index", "admin.index");

//admin category
Router::get("admin/category", "Admin\CategoryController@index", "admin.category.index");
Router::get("admin/category/create", "Admin\CategoryController@create", "admin.category.create");
Router::post("admin/category/store", "Admin\CategoryController@store", "admin.category.store");
Router::get("admin/category/edit/{id}", "Admin\CategoryController@edit", "admin.category.edit");
Router::put("admin/category/update/{id}", "Admin\CategoryController@update", "admin.category.update");
Router::delete("admin/category/destroy/{id}", "Admin\CategoryController@destroy", "admin.category.destroy");

//admin news 
Router::get("admin/news", "Admin\PostController@index", "admin.news.show");
Router::get("admin/news/create", "Admin\PostController@create", "admin.news.create");
Router::post("admin/news/store", "Admin\PostController@store", "admin.news.store");
Router::get("admin/news/edit/{id}", "Admin\PostController@edit", "admin.news.edit");
Router::put("admin/news/update/{id}", "Admin\PostController@update", "admin.news.update");
Router::delete("admin/news/destroy/{id}", "Admin\PostController@destroy", "admin.news.destroy");

//ads

Router::get("admin/ads", "Admin\AdsController@index", "admin.ads.show");
Router::get("admin/ads/create", "Admin\AdsController@create", "admin.ads.create");
Router::post("admin/ads/store", "Admin\AdsController@store", "admin.ads.store");
Router::get("admin/ads/edit/{id}", "Admin\AdsController@edit", "admin.ads.edit");
Router::put("admin/ads/update/{id}", "Admin\AdsController@update", "admin.ads.update");
Router::delete("admin/ads/destroy/{id}", "Admin\AdsController@destroy", "admin.ads.destroy");
Router::get("admin/ads/gallery", "Admin\AdsController@gallery", "admin.ads.gallery");

//slide

Router::get("admin/slide", "Admin\SlideController@index", "admin.slide.index");
Router::get("admin/slide/create", "Admin\SlideController@create", "admin.slide.create");
Router::post("admin/slide/store", "Admin\SlideController@store", "admin.slide.store");
Router::get("admin/slide/edit/{id}", "Admin\SlideController@edit", "admin.slide.edit");
Router::put("admin/slide/update/{id}", "Admin\SlideController@update", "admin.slide.update");
Router::delete("admin/slide/destroy/{id}", "Admin\SlideController@destroy", "admin.slide.destroy");

// comment

Router::get("admin/comments", "Admin\CommentController@index", "admin.comment.index");
Router::get("admin/comment-show-response/{id}", "Admin\CommentController@show", "admin.comment.show");
Router::get("admin/comment-desable-enable/{id}", "Admin\CommentController@enableDesable", "admin.comment.disable.enable");
Router::post("admin/comment-response/store/{id}/{id}", "Admin\CommentController@store", "admin.comment.response.store");

// user

Router::get("admin/show-users", "Admin\UserController@index", "admin.user.show");
Router::get("admin/user/edit/{id}", "Admin\UserController@edit", "admin.user.edit");
Router::put("admin/user/update/{id}","Admin\UserController@update" , "admin.user.update");
Router::get("admin/change-active/{id}","Admin\UserController@changeActive" , "admin.user.change.active");

//login
Router::get("Auth/register", "Auth\RegisterController@index", "register.index");
Router::post("Auth/register/store", "Auth\RegisterController@store", "register.store");
Router::get("Auth/check-verifyToken", "Auth\RegisterController@checkToken");
Router::get("Auth/Login", "Auth\LoginController@index", "login.index");
Router::post("Auth/Login/store", "Auth\LoginController@store", "login.store");
Router::get("Auth/Login/Forgot-Password", "Auth\LoginController@forgot", "forgot.password");
Router::put("Auth/Login/Forgot/store", "Auth\LoginController@forgotStore", "forgot.password.store");
Router::get("Auth/Login/check-verifyToken", "Auth\LoginController@checkToken");
Router::get("Auth/Reset-Password/{id}", "Auth\ResetPasswordController@index" , "reset.pass");
Router::post("Auth/Reset-Password/store/{id}", "Auth\ResetPasswordController@sotre" , "reset.pass.sotre");

//set comment

Router::post("insertComment/{id}", "HomeController@insertComment", "comment.insert");

//search

Router::get("results" , "HomeController@search" , 'home.search');
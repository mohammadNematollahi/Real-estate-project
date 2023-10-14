@extends('admin.layouts.app')

@section('head-tag')
    <title>admin create news</title>
    <link rel="stylesheet" type="text/css" href="<?= asset('jalalidatepicker/persian-datepicker.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset('jalalidatepicker/persian-datepicker.min.css.map') ?>">
@endsection

@section('content')
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">


        <div class="content-header row">

        </div>
        <div class="content-body">

            <!-- Zero configuration table -->
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">پست</h4>
                                <span><a href="<?= route('admin.news.show') ?>" class="btn btn-success">بازگشت</a></span>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <?php
                                    if (error('image') != false) {
                                        echo error('image');
                                    }
                                    if (error('cat_id') != false) {
                                        echo error('cat_id');
                                    }
                                    if (error('body') != false) {
                                        echo error('body');
                                    }
                                    if (error('title') != false) {
                                        echo error('title');
                                    }
                                    if (error('published_at') != false) {
                                        echo error('published_at');
                                    }
                                    ?>

                                    <form class="row" action="<?= route('admin.news.update',[$post->id]) ?>" method="post"
                                        enctype="multipart/form-data">
                                        
                                        <input type="hidden" name="_method" value="put">
                                        @csrf
                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="title">عنوان</label>
                                                <input value="<?= oldOrValue('title' , $post->title) ?>" name="title" type="text"
                                                    id="title" class="form-control" placeholder="نام ...">
                                            </fieldset>
                                        </div>



                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="published_at">تاریخ انتشار</label>
                                                <input type="hidden" name="published_at" id="published_at">
                                                <input value="<?= oldOrValue('published_at',$post->published_at) ?>" type="text"
                                                    id="published_at_view" class="form-control">
                                            </fieldset>
                                        </div>


                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="image">تصویر</label>
                                                <input name="image" type="file" id="image" class="form-control">
                                                <img src="<?= asset($post->image) ?>" class="mt-2" alt="">
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <div class="form-group">
                                                    <label for="cat_id">دسته</label>
                                                    <select name="cat_id" class="select2 form-control ">
                                                        <?php
                                                            foreach ($categories as $category) {?>
                                                        <option value="<?= $category->id ?>" <?= $category->id == $post->cat_id ? "selected" : ""; ?>><?= $category->name ?> </option>
                                                        <?}?>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-12">
                                            <section class="form-group">
                                                <label for="body">متن</label>
                                                <textarea class="form-control" id="body" rows="5" name="body" placeholder="متن ..."><?= oldOrValue('body' , $post->body) ?></textarea>
                                            </section>
                                        </div>

                                        <div class="col-md-6">
                                            <section class="form-group">
                                                <button type="submit" class="btn btn-primary">ایجاد</button>
                                            </section>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    </div>
    <!-- END: Content-->
@endsection

@section('scripts')
    <script src="<?= asset('jalalidatepicker/persian-date.min.js') ?>"></script>
    <script src="<?= asset('jalalidatepicker/persian-datepicker.min.js') ?>"></script>
    <script src="<?= asset('CKEditor/ckeditor.js') ?>"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('body');
            $("#published_at_view").persianDatepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                toolbox: {
                    calendarSwitch: {
                        enabled: true
                    }
                },
                observer: true,
                initialValueType: 'gregorian',
                altField: '#published_at',
            })
        })
    </script>
@endsection

@extends('admin.layouts.app')

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
                                <h4 class="card-title">آگهی</h4>
                                <span><a href="<?= route('admin.ads.show') ?>" class="btn btn-success">بازگشت</a></span>
                            </div>
                            <div class="row ml-2">
                                <p class="text-danger">
                                    <?php
                                    if (error('address') != false) {
                                        echo error('address');
                                    }
                                    if (error('description') != false) {
                                        echo error('description');
                                    }
                                    if (error('title') != false) {
                                        echo error('title');
                                    }
                                    if (error('area') != false) {
                                        echo error('area');
                                    }
                                    if (error('image') != false) {
                                        echo error('image');
                                    }
                                    if (error('cat_id') != false) {
                                        echo error('cat_id');
                                    }
                                    if (error('room') != false) {
                                        echo error('room');
                                    }
                                    if (error('amount') != false) {
                                        echo error('amount');
                                    }
                                    if (error('floor') != false) {
                                        echo error('floor');
                                    }
                                    if (error('tag') != false) {
                                        echo error('tag');
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">

                                    <form class="row" action="<?= route('admin.ads.store') ?>" method="post"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="_method" value="post">
                                        @csrf
                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="title">عنوان</label>
                                                <input value="<?= old('title') ?>" name="title" type="text"
                                                    id="title" class="form-control" placeholder="عنوان ...">
                                            </fieldset>
                                        </div>



                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="image">تصویر</label>
                                                <input name="image" type="file" id="image"
                                                    class="form-control-file">
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="address">آدرس</label>
                                                <input value="<?= old('address') ?>" name="address" type="text"
                                                    id="address" class="form-control" placeholder="آدرس ...">

                                            </fieldset>
                                        </div>


                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="floor">کف</label>
                                                <input value="<?= old('floor') ?>" name="floor" type="text"
                                                    id="floor" class="form-control" placeholder="کف ...">

                                            </fieldset>
                                        </div>


                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="year">سال ساخت</label>
                                                <input value="<?= old('year') ?>" name="year" type="number"
                                                    id="year" class="form-control" placeholder="مثال : 1398">

                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="amount">قیمت</label>
                                                <input value="<?= old('amount') ?>" name="amount" type="number"
                                                    id="amount" class="form-control" placeholder="قیمت ...">

                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="area">متراژ</label>
                                                <input value="<?= old('area') ?>" name="area" type="number"
                                                    id="area" class="form-control" placeholder="متر مکعب">

                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="room">اتاق</label>
                                                <input value="<?= old('room') ?>" name="room" type="number"
                                                    id="room" class="form-control" placeholder="مثال : 5">

                                            </fieldset>
                                        </div>


                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="tag">تگ</label>
                                                <input value="<?= old('tag') ?>" name="tag" type="text"
                                                    id="tag" class="form-control" placeholder="تگ ...">

                                            </fieldset>
                                        </div>


                                        <div class="col-md-12">
                                            <section class="form-group">
                                                <label for="description">متن</label>
                                                <textarea class="form-control" id="description" rows="5" name="description" placeholder="متن ..."><?= old('description') ?></textarea>

                                            </section>
                                        </div>


                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <div class="form-group">
                                                    <label for="storeroom">انبار</label>
                                                    <select name="storeroom" class="select2 form-control">
                                                        <option value="0">ندارد</option>
                                                        <option value="1">دارد</option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <div class="form-group">
                                                    <label for="balcony">بالکن</label>
                                                    <select name="balcony" class="select2 form-control">
                                                        <option value="0">ندارد</option>
                                                        <option value="1">دارد</option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <div class="form-group">
                                                    <label for="toilet">توالت</label>
                                                    <select name="toilet" class="select2 form-control">
                                                        <option value="ایرانی">ایرانی</option>
                                                        <option value="فرنگی">فرنگی</option>
                                                        <option value="ایرانی و فرنگی">ایرانی و فرنگی</option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>


                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <div class="form-group">
                                                    <label for="sell_status">نوع آگهی</label>
                                                    <select name="sell_status" class="select2 form-control">
                                                        <option value="0">خرید</option>
                                                        <option value="1">اجاره</option>
                                                        <option value="2">رهن</option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <div class="form-group">
                                                    <label for="type">نوع ملک</label>
                                                    <select name="type" class="select2 form-control">
                                                        <option value="0">آپارتمان</option>
                                                        <option value="1">ویلایی</option>
                                                        <option value="2">زمین</option>
                                                        <option value="3">سوله</option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>


                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <div class="form-group">
                                                    <label for="parking">پارکینگ</label>
                                                    <select name="parking" class="select2 form-control">
                                                        <option value="0">ندارد</option>
                                                        <option value="1">دارد</option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </div>


                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <div class="form-group">
                                                    <label for="cat_id">دسته</label>
                                                    <select name="cat_id" class="select2 form-control">
                                                        <?php 
                                                        foreach ($categories as $category) {?>
                                                        <option value="<?= $category->id ?>"><?= $category->name ?>
                                                        </option>
                                                        <?}
                                                                        ?>
                                                    </select>
                                                </div>
                                            </fieldset>
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
<script src="<?= asset('CKEditor/ckeditor.js') ?>"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('description');
        })
    </script>
@endsection

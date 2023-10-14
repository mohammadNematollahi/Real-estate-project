@extends('admin.layouts.app')

@section('head-tag')
    <title>admin create slide</title>
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
                                <h4 class="card-title">اسلایدشو</h4>
                                <span><a href="<?= route('admin.slide.index') ?>" class="btn btn-success">بازگشت</a></span>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="row">
                                        <p class="text-danger">
                                            <?php
                                            if (error('image') != false) {
                                                echo error('image');
                                            } elseif (error('title') != false) {
                                                echo error('title');
                                            } elseif (error('url') != false) {
                                                echo error('url');
                                            } elseif (error('description') != false) {
                                                echo error('description');
                                            } elseif (error('amount') != false) {
                                                echo error('amount');
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <form class="row" action="<?= route('admin.slide.update' , [$slide->id]) ?>" method="post"
                                        enctype="multipart/form-data">

                                        <input type="hidden" name="_method" value="put">
                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="title">عنوان</label>
                                                <input value="<?= oldOrValue('title' , $slide->title) ?>" name="title" type="text"
                                                    id="title" class="form-control" placeholder="عنوان ...">
                                            </fieldset>
                                        </div>


                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="url">لینک</label>
                                                <input value="<?= oldOrValue('url',$slide->url) ?>" name="url" type="text"
                                                    id="url" class="form-control" placeholder="عنوان ...">
                                            </fieldset>
                                        </div>


                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="address">آدرس</label>
                                                <input value="<?= oldOrValue('address',$slide->address) ?>" name="address" type="text"
                                                    id="address" class="form-control" placeholder="عنوان ...">
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="amount">مبلغ</label>
                                                <input value="<?= oldOrValue('amount',$slide->amount) ?>" name="amount" type="number"
                                                    id="amount" class="form-control" placeholder="عنوان ...">
                                            </fieldset>
                                        </div>


                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="image">تصویر</label>
                                                <input name="image" type="file" id="image"
                                                    class="form-control-file form-control">
                                                    <img src="<?= asset($slide->image) ?>" alt="" width="400" class="mt-2">
                                            </fieldset>
                                        </div>


                                        <div class="col-md-12">
                                            <section class="form-group">
                                                <label for="description">متن</label>
                                                <textarea class="form-control" id="description" rows="5" name="description" placeholder="متن ..."><?= oldOrValue('description',$slide->description) ?></textarea>
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
            CKEDITOR.replace('description');
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

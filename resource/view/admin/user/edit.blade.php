@extends('admin.layouts.app')

@section('head-tag')
    <title>admin show user</title>
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
                                <span><a href="<?= route('admin.user.show') ?>" class="btn btn-success">بازگشت</a></span>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="row">
                                        <p class="text-danger">
                                            <?php
                                            if (error('avatar') != false) {
                                                echo error('avatar');
                                            } elseif (error('first_name') != false) {
                                                echo error('first_name');
                                            } elseif (error('last_name') != false) {
                                                echo error('last_name');
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <form class="row" action="<?= route('admin.user.update', [$user->id]) ?>"
                                        method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_method" value="put">
                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="first_name">نام</label>
                                                <input name="first_name" type="text" id="first_name"
                                                    value="<?= oldOrValue('first_name', $user->first_name) ?>"
                                                    class="form-control" placeholder="نام ...">
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="last_name">نام خانوادگی</label>
                                                <input name="last_name" type="text" id="last_name"
                                                    value="<?= oldOrValue('last_name', $user->last_name) ?>"
                                                    class="form-control" placeholder="نام خانوادگی ...">
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="avatar">تصویر</label>
                                                <input name="avatar" type="file" id="avatar"
                                                    class="form-control-file">
                                            </fieldset>
                                        </div>

                                        <div class="col-md-6">
                                            <section class="form-group">
                                                <button type="submit" class="btn btn-primary">ویرایش</button>
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

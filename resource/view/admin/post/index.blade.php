@extends('admin.layouts.app')

@section('head-tag')
    <title>admin news</title>
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
                                <h4 class="card-title">اخبار</h4>
                                <span><a href="<?= route('admin.news.create') ?>" class="btn btn-success">ایجاد</a></span>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">

                                    <div class="">
                                        <table class="table zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>عنوان</th>
                                                    <th>دسته</th>
                                                    <th>نویسنده</th>
                                                    <th>تصویر</th>
                                                    <th style="min-width: 16rem; text-align: left;">تنظیمات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $id = 1;
                                                foreach($posts as $post){?>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1"><?= $id ?></td>
                                                    <td><?= substr($post->title, 0, 50). " ..." ?></td>
                                                    <td><?= $post->category()->id == $post->cat_id ? $post->category()->name : '' ?>
                                                    </td>
                                                    <td><?= $post->user()->id == $post->user_id ? $post->user()->first_name . ' ' . $post->user()->last_name : '' ?>
                                                    </td>
                                                    <td><img style="" src="<?= asset($post->image) ?>" alt="">
                                                    </td>
                                                    <td style="min-width: 16rem; text-align: left;">
                                                        <a href="<?= route("admin.news.edit" , [$post->id]) ?>"
                                                            class="btn btn-info waves-effect waves-light">ویرایش</a>
                                                        <form class="d-inline" action="<?= route("admin.news.destroy" , [$post->id]) ?>" method="post">
                                                            <input type="hidden" name="_method" value="delete">
                                                            <button type="submit"
                                                                class="btn btn-danger waves-effect waves-light" onclick="return confirm('do you want delete the field  <?= $post->id ?>')">حذف</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <? $id++;}?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Zero configuration table -->
        </div>



    </div>
    </div>
    <!-- END: Content-->
@endsection

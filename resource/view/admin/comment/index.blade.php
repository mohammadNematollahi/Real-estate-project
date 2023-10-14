@extends('admin.layouts.app')

@section('head-tag')
    <title>show and response comment</title>
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
                                <h4 class="card-title">نظرات</h4>
                                <span><a href="#" class="btn btn-success disabled">ایجاد</a></span>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">

                                    <div class="">
                                        <table class="table zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>کاربر</th>
                                                    <th>نظر</th>
                                                    <th>وضعیت</th>
                                                    <th>تنظیمات</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $id = 1;
                                                foreach ($comments as $comment) {?>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1"><?= $id ?></td>
                                                    <td><?= $comment->user()->first_name . ' ' . $comment->user()->last_name ?>
                                                    </td>
                                                    <td><?= substr($comment->comment, 0, 25) . ' ...' ?></td>
                                                    <td>
                                                        <span
                                                            class="<?= $comment->approved == 1 ? 'text-success' : 'text-danger' ?>"><?= $comment->approved == 1 ? 'تایید شده' : 'در انتظار تایید' ?></span>
                                                    </td>
                                                    <td>
                                                        <a href="<?= route('admin.comment.show', [$comment->id]) ?>"
                                                            class="btn btn-success waves-effect waves-light">نمایش</a>
                                                        <a href="<?= route('admin.comment.disable.enable', [$comment->id]) ?>"
                                                            class="btn <?= $comment->approved == 1 ? 'btn-danger' : 'btn-warning' ?> waves-effect waves-light"><?= $comment->approved == 1 ? 'لغو تایید' : 'تایید' ?></a>
                                                    </td>
                                                </tr>
                                                <?$id++;}?>

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

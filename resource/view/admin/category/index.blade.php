@extends('admin.layouts.app')

@section('head-tag')
    <title>admin category</title>
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
                                <h4 class="card-title">دسته بندی</h4>
                                <span><a href="<?= route('admin.category.create') ?>"
                                        class="btn btn-success">ایجاد</a></span>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">

                                    <div class="">
                                        <table class="table zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>نام</th>
                                                    <th>دسته والد</th>
                                                    <th style="min-width: 6rem; text-align: left;">تنظیمات</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $id = 1 ;
                                                foreach($categories as $category){?>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1"><?= $id ?></td>
                                                    <td><?= $category->name ?></td>
                                                    <td><?= $category->parent_id == "" ? "منوی اصلی" : $category->menu()->name ?></td>
                                                    <td style="min-width: 6rem; text-align: left;">
                                                        <a href="<?= route('admin.category.edit', [$category->id]) ?>"
                                                            class="btn btn-info waves-effect waves-light">ویرایش</a>
                                                        <form class="d-inline"
                                                            action="<?= route('admin.category.destroy', [$category->id]) ?>"
                                                            method="post">
                                                            <input type="hidden" name="_method" value="delete">
                                                            <button type="submit"
                                                                class="btn btn-danger waves-effect waves-light"
                                                                id="subDelete"
                                                                onclick="return confirm('do you want delete the field  <?= $category->name ?>')">حذف</button>
                                                        </form>
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

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
                                <span><a href="<?= route('admin.ads.create') ?>" class="btn btn-success">ایجاد</a></span>
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
                                                    <th>آدرس</th>
                                                    <th>تصویر</th>
                                                    <th>مشخصات</th>
                                                    <th>تگ</th>
                                                    <th>کاربر</th>
                                                    <th style="width: 22rem;">تنظیمات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $id = 1;
                                                foreach($ads as $advertise) { ?>
                                                <tr>
                                                    <td><?= $id ?></td>
                                                    <td><?= $advertise->title ?></td>
                                                    <td><?= $advertise->category()->name ?></td>
                                                    <td><?= $advertise->address ?></td>
                                                    <td><img style="width: 90px;" src="<?= asset($advertise->image) ?>"
                                                            alt=""></td>
                                                    <td>
                                                        <ul>
                                                            <li>کف : <?= $advertise->floor ?></li>
                                                            <li>سال ساخت : <?= $advertise->year ?></li>
                                                            <li>انبار : <?= $advertise->storeroom == 0 ? 'ندارد' : 'دارد' ?>
                                                            </li>
                                                            <li>بالاکن : <?= $advertise->balcony == 0 ? 'ندارد' : 'دارد' ?>
                                                            </li>
                                                            <li>متراژ : <?= $advertise->area ?></li>
                                                            <li>تعداد اتاق ها : <?= $advertise->room ?></li>
                                                            <li>نوع دستشویی : <?= $advertise->toilet ?></li>
                                                            <li>پارکینگ : <?= $advertise->parking == 0 ? 'ندارد' : 'دارد' ?>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td><?= $advertise->tag ?></td>
                                                    <td><?= $advertise->user()->first_name . ' ' . $advertise->user()->last_name ?>
                                                    </td>
                                                    <td style="width: 22rem;">
                                                        <a href="" class="btn btn-warning">گالری</a>
                                                        <a href="<?= route('admin.ads.edit', [$advertise->id]) ?>"
                                                            class="btn btn-info">ویرایش</a>
                                                        <form class="d-inline"
                                                            action="<?= route('admin.ads.destroy', [$advertise->id]) ?>"
                                                            method="post">
                                                            <input type="hidden" name="_method" value="delete">
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('do you want delete the field  <?= $advertise->id ?>')">حذف</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php $id++;} ?>
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

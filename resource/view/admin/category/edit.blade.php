@extends('admin.layouts.app')

@section('head-tag')
    <title>create new category</title>
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
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
                                    <span><a href="<?= route("admin.category.index") ?>" class="btn btn-success">بازگشت</a></span>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="row ml-2">
                                            <p class="text-danger">
                                                <?php
                                                if (error('name') != null) {
                                                    echo error('name');
                                                }if(error("parent_id") != null){
                                                    echo error("parent_id");
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <form class="row" action="<?= route('admin.news.update', [$category->id]) ?>"
                                            method="post">
                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                    <label for="helperText">نام دسته</label>
                                                    <input type="hidden" name="_method" value="put">
                                                    <input value="<?= oldOrValue("name",$category->name) ?>" name="name" type="text"
                                                        id="helperText" class="form-control <?= isValid('name') ?>" placeholder="نام ...">
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                    <div class="form-group">
                                                        <label for="helperText">دسته والد</label>
                                                        <select name="parent_id" class="select2 form-control">
                                                            <option value="">درصورت وجود والد انتخاب شود</option>
                                                            <?php 
                                                                foreach ($categories as $cat) {?>
                                                            <option value="<?= $cat->id ?>"
                                                                <?= $category->parent_id == $cat->id ? 'selected' : '' ?>>
                                                                <?= $cat->name ?></option>
                                                            <?}
                                                                    ?>
                                                        </select>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                    <button type="submit" class="btn btn-primary">ایجاد</button>
                                                </fieldset>
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
@endsection

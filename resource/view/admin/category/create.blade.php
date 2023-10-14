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
                                                if (error('name') != false) {
                                                    echo error('name');
                                                }else if(error("parent_id") != false){
                                                    echo error("name");
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <form class="row" action="<?= route('admin.category.store') ?>" method="post">
                                            @csrf
                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                    <label for="helperText">نام دسته</label>
                                                    <input value="<?= old('name') != null ? old('name') : '' ?>"
                                                        name="name" type="text" id="helperText" class="form-control <?= isValid('name') ?>"
                                                        placeholder="نام ...">
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6">
                                                <fieldset class="form-group">
                                                    <div class="form-group">
                                                        <label for="helperText">دسته والد</label>
                                                        <select name="parent_id" class="select2 form-control">
                                                            <option value="">درصورت وجود والد انتخاب شود</option>
                                                            <?php 
                                                                foreach ($categories as $category) {?>
                                                            <option value="<?= $category->id ?>" <?php
                                                            if (old('parent_id') != null) {
                                                                if (old('parent_id') == $category->id) {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>>
                                                                <?= $category->name ?></option>
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

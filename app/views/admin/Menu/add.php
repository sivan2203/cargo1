<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Новый пункт верхнего меню
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/menu/">Верхнее меню</a></li>
        <li class="active">Новый пункт</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if ($count_menu >= 5): ?>
            <div class="alert alert-danger">
                К сожалению, Вы больше не можете добавить новые пункты. Удалите один из пунктов и попробуйте еще раз!
            </div>
            <?php endif; ?>
            <div class="box">
                <form action="<?=ADMIN;?>/menu/add" method="post" data-toggle="validator" id="add_page">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Наименование</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Наименование" value="<?php isset($_SESSION['form_data']['title']) ? h($_SESSION['form_data']['title']) : null; ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="keywords">Адрес страницы</label>
                            <input type="text" name="slug" class="form-control" id="slug" placeholder="Адрес страницы" value="<?php isset($_SESSION['form_data']['slug']) ? h($_SESSION['form_data']['slug']) : null; ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="description">Сортировка</label>
                            <input type="text" name="sort" class="form-control" id="sort" placeholder="Укажите какое место займет пункт в верхнем меню" value="<?php isset($_SESSION['form_data']['sort']) ? h($_SESSION['form_data']['sort']) : null; ?>">
                        </div>
                    </div>
                    <?php if ($count_menu < 5): ?>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Добавить</button>
                    </div>
                    <?php endif; ?>
                </form>
                <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
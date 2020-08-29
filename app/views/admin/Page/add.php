<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Новая страница
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/page">Список страниц</a></li>
        <li class="active">Новая страница</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/page/add" method="post" data-toggle="validator" id="add_page">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Наименование товара" value="<?php isset($_SESSION['form_data']['title']) ? h($_SESSION['form_data']['title']) : null; ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group">
                            <label for="keywords">Ключевые слова</label>
                            <input type="text" name="keyw" class="form-control" id="keyw" placeholder="Ключевые слова" value="<?php isset($_SESSION['form_data']['keyw']) ? h($_SESSION['form_data']['keyw']) : null; ?>">
                        </div>

                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="Описание" value="<?php isset($_SESSION['form_data']['description']) ? h($_SESSION['form_data']['description']) : null; ?>">
                        </div>

                        <div class="form-group has-feedback">
                            <label for="content">Контент</label>
                            <textarea name="text" id="editor1" cols="80" rows="10"><?php isset($_SESSION['form_data']['text']) ? $_SESSION['form_data']['text'] : null; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="description">Позиция</label>
                            <input type="text" name="sort" class="form-control" id="sort" placeholder="Позиция" value="<?php isset($_SESSION['form_data']['sort']) ? h($_SESSION['form_data']['sort']) : null; ?>">
                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success">Добавить</button>
                    </div>
                </form>
                <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
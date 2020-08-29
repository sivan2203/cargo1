<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Редактирование страницы: <?=$page->title;?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/page">Список страниц</a></li>
        <li class="active">Редактирование - <?=$page->alias;?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <form action="<?=ADMIN;?>/page/edit" method="post" data-toggle="validator">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="title">Заголовок</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Наименование товара" value="<?=h($page->title);?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group">
                            <label for="keywords">Ключевые слова</label>
                            <input type="text" name="keyw" class="form-control" id="keywords" placeholder="Ключевые слова" value="<?=h($page->keyw);?>">
                        </div>

                        <div class="form-group">
                            <label for="description">Описание</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="Описание" value="<?=h($page->description);?>">
                        </div>

                        <div class="form-group has-feedback">
                            <label for="content">Контент</label>
                            <textarea name="text" id="editor1" cols="80" rows="10"><?=$page->text;?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="description">Позиция</label>
                            <input type="text" name="sort" class="form-control" id="sort" placeholder="Позиция" value="<?=$page->sort;?>">
                        </div>

                    </div>
                    <div class="box-footer">
                        <input type="hidden" name="id" value="<?=$page->id;?>">
                        <button type="submit" class="btn btn-success">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Верхнее меню
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Список менюшек</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <div class="box">
                            <form action="<?=ADMIN;?>/menu/edit" method="post" data-toggle="validator">
                                <div class="box-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Наименование</th>
                                            <th>Адрес страницы</th>
                                            <th>Сортировка</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; foreach($menu as $item): ?>
                                            <tr>
                                                <td>
                                                    <?=$i;?>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="title_<?=$item['id'];?>" value="<?=$item['title'];?>" required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="slug_<?=$item['id'];?>" value="<?=$item['slug'];?>" required>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="sort_<?=$item['id'];?>" value="<?=$item['sort'];?>" required>
                                                    </div>
                                                </td>
                                                <td><a class="delete" href="<?=ADMIN;?>/menu/delete?id=<?=$item['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a></td>
                                            </tr>
                                        <?php $i++; endforeach; ?>
                                            <tr>
                                                <td colspan="5">
                                                    <div class="box-footer">
                                                        <button type="submit" class="btn btn-success">Обновить</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
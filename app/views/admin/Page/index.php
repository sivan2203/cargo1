<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Список страниц
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Список страниц</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Заголовок</th>
                                <th>Адрес</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($pages as $page): ?>
                                <tr>
                                    <td><?=$page['id'];?></td>
                                    <td><?=$page['title'];?></td>
                                    <td><?=$page['alias'];?></td>
                                    <td><a href="<?=ADMIN;?>/page/edit?id=<?=$page['id'];?>"><i class="fa fa-fw fa-pencil"></i></a> <a class="delete" href="<?=ADMIN;?>/page/delete?id=<?=$page['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <p>(<?=count($pages);?> страниц из <?=$count;?>)</p>
                        <?php if($pagination->countPages > 1): ?>
                            <?=$pagination;?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
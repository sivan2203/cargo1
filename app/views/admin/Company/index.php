<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Список транспортных компаний
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Список компаний</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="company" class="table table-bordered table-hover table-striped dataTable">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Наименований</th>
                                <th>Кол-во перевозок</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; foreach($company as $firm): ?>
                                <tr>
                                    <td><?=$i;?></td>
                                    <td><?=$firm['name'];?></td>
                                    <td><?=$firm['countShips'];?></td>
                                    <td><a title="Детализация по видам перевозок <?=$firm['name'];?>" href="<?=ADMIN;?>/company/edit?id=<?=$firm['id'];?>"><i class="fa fa-fw fa-pencil"></i></a> <a class="delete" title="Удалить все перевозки <?=$firm['name'];?>" href="<?=ADMIN;?>/company/delete?id=<?=$firm['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a></td>
                                </tr>
                            <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
<!--                    <div class="text-center">-->
<!--                        <p>(--><?////=count($company);?><!-- компаний из --><?////=$count;?><!--)</p>-->
<!--                        --><?php//// if($pagination->countPages > 1): ?>
<!--                            --><?////=$pagination;?>
<!--                        --><?php ////endif; ?>
<!--                    </div>-->
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
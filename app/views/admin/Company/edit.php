<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
         Детализация перевозок по видам - <?=$companyData['name']; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="<?=ADMIN;?>/company"><i class="fa fa-dashboard"></i>Список компаний</a></li>
        <li class="active">Детализация по <?=$companyData['name']; ?></li>
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
                                <th>№</th>
                                <th>Вид транспорта</th>
                                <th>Кол-во перевозок</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; foreach($transport as $type): ?>
                                <tr>
                                    <td><?=$i;?></td>
                                    <td><?=$type['name'];?></td>
                                    <td><?=$type['count'];?></td>
                                    <td><a class="delete" title="Удалить все перевозки типа <?=$type['name'];?>" href="<?=ADMIN;?>/company/delete?id=<?=$companyData['id']?>&transport_id=<?=$type['id'];?>"><i class="fa fa-fw fa-close text-danger"></i></a></td>
                                </tr>
                                <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Список пользователей
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Список пользователей</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Логин</th>
                                <th>Имя</th>
                                <th>Email</th>
                                <th>Роль</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <?php foreach ($users as $user): ?>
                                <tr <? if ($user->role == 'admin') echo 'class="success"'; ?>>
                                    <td><?=$user->id; ?></td>
                                    <td><?=$user->login; ?></td>
                                    <td><?=$user->name; ?></td>
                                    <td><?=$user->email; ?></td>
                                    <td><?=$user->role; ?></td>
                                    <td>
                                        <a href="<?=ADMIN; ?>/user/edit?id=<?=$user->id; ?>"><i class="fa fa-fw fa-pencil"></i></a>
                                        <a class="delete text-danger" href="<?=ADMIN; ?>/order/delete?id=<?=$user->id; ?>"><i class="fa fa-fw fa-close"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <div class="text-center">
                    <p><?=count($users); ?> из <b><?=$count; ?></b> пользователей</p>
                    <?php if($pagination->countPages > 1):?>
                        <?=$pagination; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
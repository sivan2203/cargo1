<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Вход в аккаунт
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Вход в аккаунт</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
        </div>
        <div class="box-body">
            <div class="register-main">
                <div class="col-md-6 account-left">
                    <form action="user/login" id="singup" method="post" role="form" data-toggle="validator">
                        <div class="form-group has-feedback">
                            <label for="login">Логин</label>
                            <input type="text" name="login" class="form-control" id="login" placeholder="Логин"
                                   value=""
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="password">Пароль</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Пароль"
                                   value=""
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <button type="submit" class="btn btn-default">Авторизация</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
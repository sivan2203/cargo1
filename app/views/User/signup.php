<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Регистрация пользователя
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Регистрация пользователя</li>
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
                    <form action="user/signup" id="singup" method="post" role="form" data-toggle="validator">
                        <div class="form-group has-feedback">
                            <label for="login">Логин</label>
                            <input type="text" name="login" class="form-control" id="login" placeholder="Логин"
                                   value="<?=isset($_SESSION['form_data']['login']) ? h($_SESSION['form_data']['login']) : ''; ?>"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="password">Пароль</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Пароль" data-error="Пароль должен быть не менне 6 символов!" data-minlength="6"
                                   value="<?=isset($_SESSION['form_data']['password']) ? h($_SESSION['form_data']['password']) : ''; ?>"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="name">Имя</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Имя"
                                   value="<?=isset($_SESSION['form_data']['name']) ? h($_SESSION['form_data']['name']) : ''; ?>"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="email">Электронный адрес</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="email" data-error="Видимо email неверного формата!"
                                   value="<?=isset($_SESSION['form_data']['email']) ? h($_SESSION['form_data']['email']) : ''; ?>"
                                   required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
<!--                        <div class="form-group has-feedback">-->
<!--                            <label for="address">Адрес доставки</label>-->
<!--                            <input type="text" name="address" class="form-control" id="address" placeholder="Адрес доставки"-->
<!--                                   value="--><?//=isset($_SESSION['form_data']['address']) ? h($_SESSION['form_data']['address']) : ''; ?><!--"-->
<!--                                   required>-->
<!--                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>-->
<!--                        </div>-->
                        <button type="submit" class="btn btn-default">Зарегистрировать</button>
                        <?php if (isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Импорт данных 1
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?=ADMIN;?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Импорт данных</li>
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
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">Выберите файл</label>
                                    <input type="file" name="data" id="exampleInputFile">
                                </div>
                                <div class="form-group">
                                    <label for="">Обновить всю базу?</label>
                                    <div>
                                        <select name="flag">
                                            <option value="0" selected>Нет</option>
                                            <option value="1">Да</option>
                                        </select>

                                        <p class="help-block danger">Не рекомендуется без специальных знаний!</p>
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Отправить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
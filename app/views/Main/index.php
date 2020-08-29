<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Тарифный калькулятор
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Главная</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
        </div>
        <div class="box-body">
<!--            <div class="row">-->
<!--                <div class="col-md-12">-->
<!--                    <div class="ban_gr"><p>РЕКЛАМА</p></div>-->
<!--                </div>-->
<!--            </div>-->
            <?php //if (isset($company) && isset($ships)):?>
<!--            <div class="row">-->
<!--                <div class="col-xs-12 col-md-6 text-center margin-bottom">-->
<!--                    <h2>Перевозчиков</h2>-->
<!--                    <div class="circule company">-->
<!--                        <span>--><?//=$company; ?><!--</span>-->
<!--                    </div>-->
<!--                    <div>-->
<!--                        <a href="/company" class="btn btn-primary">Подробнее…</a>-->
<!--                    </div>-->
<!--                </div>-->
<!-- ./col -->
<!--                <div class="col-xs-12 col-md-6 text-center margin-bottom">-->
<!--                    <h2>Перевозок</h2>-->
<!--                    <div class="circule ships">-->
<!--                        <span>--><?//=$ships;?><!--</span>-->
<!--                    </div>-->
<!--                    <div>-->
<!--                        <a href="/company" class="btn btn-primary">Подробнее…</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            <?php //endif; ?>

            <div class="row">
<!--                <div class="col-md-2 hidden-sm hidden-xs">-->
<!--                    <div class="ban_vr"><p>РЕКЛАМА</p></div>-->
<!--                </div>-->
                <div class="col-md-12 col-sm-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Сборный груз / грузовые авиаперевозки</a></li>
                            <li class="disabled"><a href="#tab_2" data-toggle="tab" aria-expanded="false">Контейнерые перевозки FCL (в разработке)</a></li>
                            <li class="disabled"><a href="#tab_3" data-toggle="tab" aria-expanded="false">Автоперевозки FTL (в разработке)</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <h3 class="text-center">Тарифный online-калькулятор всех транспортных компаний</h3>
                                <form class="calc" action="/" method="post" autocomplete="off" data-toggle="validator">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="from">Откуда</label>
                                                <input id="tfrom" class="typeahead form-control" type="text" name="from" value="<? if (isset($from)) echo $from;?>" placeholder="Укажите город отгрузки"
                                                       data-error="Обязательно укажите город отправления!" required>
                                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="pull-left">
                                                    <input disabled type="radio" name="where_from" value="1" <? if (isset($paramQuery['wfrom']) && $paramQuery['wfrom']) echo 'checked'; ?>> От двери
                                                </label>
                                                <label class="pull-right">
                                                    От терминала <input type="radio" name="where_from" value="0" <? if (isset($paramQuery['wfrom']) && !$paramQuery['wfrom']) echo 'checked'; if (!isset($paramQuery['wfrom']))  echo 'checked';?>>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="clearfix visible-xs-block"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="to">Куда</label>
                                                <input id="tto" class="typeahead form-control" type="text" name="to" value="<? if (isset($to)) echo $to;?>" placeholder="Укажите город получатель"
                                                       data-error="Обязательно укажите город получения!" required>
                                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="form-group">
                                                <label class="pull-left">
                                                    <input type="radio" name="to_where" value="0" <? if (isset($paramQuery['wto']) && !$paramQuery['wto']) echo 'checked'; if (!isset($paramQuery['wto'])) echo 'checked';?>> До терминала
                                                </label>
                                                <label class="pull-right">
                                                    До двери <input disabled type="radio" name="to_where" value="1" <? if (isset($paramQuery['wto']) && $paramQuery['wto']) echo 'checked'; ?>>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-lg-offset-3">
                                            <div class="form-group">
                                                <label for="">Общий вес, кг <sup>*</sup></label>
                                                <input type="text" name="massa" value="<? if (isset($paramQuery['massa'])) echo $paramQuery['massa']; ?>" class="form-control" placeholder="Вес груза в кг."
                                                       data-error="Какой вес?" required>
                                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Общий объем, м <sup>3</sup> <sup>*</sup></label>
                                                <input type="text" name="volume" value="<? if (isset($paramQuery['volume'])) echo $paramQuery['volume']; ?>" class="form-control" placeholder="Объем груза в куб.м."
                                                       data-error="Какой объем?" required>
                                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box-footer text-center">
                                                <button class="btn btn-warning" type="submit">Рассчитать стоимость доставки<br> <span class="text-danger">(не является офертой)</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <h3>Раздел в разработке!2</h3>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                <h3>Раздел в разработке!3</h3>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    <!-- nav-tabs-custom -->
                </div>
<!--                    <div class="row">-->
<!--                        <div class="col-md-12">-->
<!--                            <div class="ban_gr"><p>РЕКЛАМА</p></div>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
<!--                <div class="col-md-2 hidden-sm hidden-xs">-->
<!--                    <div class="ban_vr"><p>РЕКЛАМА</p></div>-->
<!--                </div>-->
            </div>

            <!-- Таблица с данными-->

            <?php if (isset($result['not_found'])):?>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="callout callout-danger">
                            <h4><i class="icon fa fa-ban"></i> <?=$result['not_found'];?></h4>
                            <p>В базе есть <?=$result['count']; ?> перевозок по направлению: <?=$from; ?> - <?=$to; ?>.</p>
                            <p>Рекомендуем изменить параметры запроса. не все транспортные компании делаеют забор груза или доставку по месту.</p>
                        </div>
                    </div>
                </div>

            <?php elseif($result && isset($to) && isset($from)): ?>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">По результатам Вашего запроса по направлению <b><i><?=$from; ?>
                                        <span class="fa fa-arrow-right"></span> <?=$to; ?></i></b> (Груз: вес - <?=$paramQuery['massa']; ?> кг., объем - <?=$paramQuery['volume']; ?> м<sup>3</sup>) были получены следующие результаты:</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Компания</th>
                                    <th>Цена</th>
                                    <th>Валюта</th>
                                    <th>Транспорт</th>
                                    <th>Режим</th>
                                    <th>Базис доставки</th>
                                    <th>Время в пути</th>
                                    <th>Контакты</th>
                                    <th>Примечание</th>
                                    <th>Индивидуальное предложение</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $arrLength = count($result);
                                $counter = 0;
                                foreach($result as $key => $value):?>
                                <?php
                                    $counter++;
                                    if ($counter != $arrLength) $bg_tr = 'style="background-color:#FFFB73;"';
                                    else $bg_tr = '';
                                ?>
                                <? $i=1; foreach ($value as $k => $v):?>
                                <? if ($v['L'] = 4 && $v['price'] != 'По запросу'): ?>
                                <tr <?=$bg_tr; ?>>
                                    <td><?=$v['B']?></td>
                                    <td>
                                        <?
                                        if ($v['price'] != 'По запросу') $price = number_format((float) $v['price'],0, '', ' ');
                                        else $price = $v['price'];
                                        echo $price;
                                        ?>
                                    </td>
                                    <td><?=$v['T']?></td>
                                    <td><?=$v['E']?></td>
                                    <td><?=$v['F']?></td>
                                    <td><?=$v['basis']?></td>
                                    <td><?=$v['S']?></td>
                                    <td>
                                        <div class="desktop">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default<?=$i;?>">
                                                Контакты
                                            </button>
                                            <div class="modal fade" id="modal-default<?=$i;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Контакты перевозчика</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?=nl2br($v['J']);?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                        </div>
                                        <div class="mobile">
                                            <?=nl2br($v['J']);?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="desktop">
                                            <?php if (!empty($v['K'])): ?>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default<?='p' . $i;?>">
                                                    Примечание
                                                </button>
                                            <?php endif; ?>
                                            <div class="modal fade" id="modal-default<?='p' . $i;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Дополнительная информация</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?=nl2br($v['K']);?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                        </div>
                                        <div class="mobile">
                                            <?=nl2br($v['K']);?>
                                        </div>
                                    </td>
                                    <td>
                                        <? if (strpos($v['U'], '@')): ?>
                                        <div class="desktop">
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default<?='z' . $i;?>">
                                                Получить
                                            </button>
                                            <div class="modal fade" id="modal-default<?='z' . $i;?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Запрос индивидуального предложения</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Направление: <b><i><?=$from; ?><span class="fa fa-arrow-right"></span> <?=$to; ?></i></b></p>
                                                            <p>Параметры груза: вес - <b><?=$paramQuery['massa']; ?> кг.</b>, объем - <b><?=$paramQuery['volume']; ?> м<sup>3</sup></b></p>
                                                            <p>Предварительная стоимость: <b><?=$price;?> <?=$v['T']?>.<span class="glyphicon glyphicon-asterisk"></span></b></p>
                                                            <form class="zapros" id="zapros_desktop" action="/zapros" method="post" data-toggle="validator">
                                                                <div class="box-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <input type="text" name="name" id="name" placeholder="Ваше имя"
                                                                                   data-error="Обязательно укажите свой телефон!" required>
                                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                                            <div class="help-block with-errors"></div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input type="text" name="phone" id="phone" placeholder="номер телефона"
                                                                                   data-error="Обязательно укажите свой телефон!" required>
                                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                                            <div class="help-block with-errors"></div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <input style="width: 99% !important;" type="email" name="email" id="email" placeholder="email"
                                                                                   data-error="Обязательно укажите свой email в правильном формате!" required>
                                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                                            <div class="help-block with-errors"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <textarea name="dopparam" class="form-control" style="width: 100% !important;" rows="2" placeholder="Если есть особенности груза расскажите о них…"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <input type="checkbox" name="politica" value="1" checked required>
                                                                            <a href="/page/politika-obrabotki-personal-nyh-dannyh-cargo-price-ru" target="_blank">Политика обработки персональных данных Cargo-price.ru</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- /.box-body -->
                                                                <div class="box-footer">
                                                                    <?php
                                                                    $param = $from . ';' . $to . ';' . $paramQuery['massa'] . ';' . $paramQuery['volume'] . ';' . $price . ';' . $v['B'] . ';' . $v['U'];
                                                                    ?>
                                                                    <input type="hidden" name="param" value="<?=$param;?>">
                                                                    <button type="submit" class="btn btn-info btn-default">Отправить запрос</button>
                                                                    <div class="small"><span class="glyphicon glyphicon-asterisk"></span> не является публичной офертой</div>
                                                                </div>
                                                                <!-- /.box-footer -->
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                        </div>
                                        <div class="mobile">
                                            <p>Направление: <b><i><?=$from; ?><span class="fa fa-arrow-right"></span> <?=$to; ?></i></b></p>
                                            <p>Параметры груза: вес - <b><?=$paramQuery['massa']; ?> кг.</b>, объем - <b><?=$paramQuery['volume']; ?> м<sup>3</sup></b></p>
                                            <p>Предварительная стоимость: <b><?=$price;?> руб.</b></p>
                                            <form class="zapros" id="zapros_mobile" action="/zapros" method="post" data-toggle="validator">
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="name">Имя:</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="name" class="form-control" id="name" placeholder="Ваше имя"
                                                                   data-error="Обязательно укажите свое имя!" required>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="phone">Телефон</label>
                                                        </div>

                                                        <div class="col-md-8">
                                                            <input type="text" name="phone" class="form-control" id="phone" placeholder="номер телефона"
                                                                   data-error="Обязательно укажите свой телефон!" required>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="email">Электронный адрес</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="email" name="email" class="form-control" id="email" placeholder="email"
                                                                   data-error="Обязательно укажите свой email в правильном формате!" required>
                                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="email">Ваше дополнение:</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <textarea name="dopparam" class="form-control" rows="3" placeholder="Если есть особенности груза расскажите о них…"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="checkbox" name="politica" value="1" checked required>
                                                            <a href="/page/politika-obrabotki-personal-nyh-dannyh-cargo-price-ru" target="_blank">Политика обработки персональных данных Cargo-price.ru</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                                <div class="box-footer">
                                                    <input type="hidden" name="param" value="<?=$param;?>">
                                                    <button type="submit" class="btn btn-info btn-default">Отправить</button>
                                                </div>
                                                <!-- /.box-footer -->
                                            </form>
                                        </div>
                                        <? endif; ?>
                                    </td>
                                </tr>
                                <? endif; ?>
                                <? $i++; endforeach; ?>
                                <? endforeach; ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Компания</th>
                                    <th>Цена</th>
                                    <th>Валюта</th>
                                    <th>Транспорт</th>
                                    <th>Режим</th>
                                    <th>Базис доставки</th>
                                    <th>Время в пути</th>
                                    <th>Контакты</th>
                                    <th>Примечание</th>
                                    <th>Индивидуальное предложение</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- End Таблица с данными-->
            <?php endif; ?>

        </div>
    </div>

</section>
<!-- /.content -->


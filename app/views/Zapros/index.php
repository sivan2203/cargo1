<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?=$title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$title; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box box-default">
        <div class="box-body">
            <p>Не нашли, что искали? Попробуйте выслать нам запрос. А мы, в свою очередь, постараемся Вам помочь и найти оптимального перевозчика для Вашего груза. Заполните форму ниже.</p>
            <form class="calc" action="/zapros" method="post" autocomplete="off" data-toggle="validator">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="from">Имя</label>
                            <input id="name" class="typeahead form-control" type="text" name="name" value="<? if (isset($name)) echo $name;?>" placeholder="Укажите свое имя"
                                   data-error="Обязательно укажите свое имя!" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-xs-block"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="to">Телефон</label>
                            <input id="phone" class="typeahead form-control" type="text" name="phone" value="<? if (isset($phone)) echo $phone;?>" placeholder="Номер телефона для связи"
                                   data-error="Обязательно укажите номер телефона для связи!" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="clearfix visible-xs-block"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="to">Email</label>
                            <input id="email" class="typeahead form-control" type="email" name="email" value="<? if (isset($email)) echo $email;?>" placeholder="Электронный адрес"
                                   data-error="Обязательно укажите свой email в правильном формате!" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>
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
                        <label for="email">Ваше дополнение:</label>
                        <textarea name="dopparam" class="form-control" rows="3" placeholder="Если есть особенности груза расскажите о них…"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <input type="checkbox" name="politica" value="1" checked required>
                        <a href="/page/politika-obrabotki-personal-nyh-dannyh-cargo-price-ru" target="_blank">Политика обработки персональных данных Cargo-price.ru</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-footer text-center">
                            <button class="btn btn-warning" type="submit">Запросить расчет стоимости</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->


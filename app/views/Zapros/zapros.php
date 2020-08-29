<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=title; ?></title>
</head>
<body>
<p>Здравствуйте! Нужно доставить из <?=$from;?> в <?=$to;?>. Параметры груза:</p>
<ul>
    <li>Вес: <?=$massa;?> кг.</li>
    <li>Объем: <?=$volume;?> м<sup>3</sup></li>
</ul>

<? if ($price): ?>
<p>Предварительный расчет составил: <?=$price;?>руб.</p>
<? endif; ?>

<? if (!empty($dopparam)): ?>
<p>Дополнительные параметры груза: <?=$dopparam;?></p>
<? endif; ?>

<p>С уважением, <?=$name;?> Телефон: <?=$phone;?> <?=$email;?></p>

</body>
</html>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
<?php require_once APP . "/views/layouts/meta.php"; ?>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Шаблон по умолчанию</title>
</head>
<body>
    <h1>Шаблон default</h1>
    <?=$content; ?>

<?
$logs = \RedBeanPHP\R::getDatabaseAdapter()
    ->getDatabase()
    ->getLogger();
debug( $logs->grep( 'SELECT' ) );
?>
</body>
</html>

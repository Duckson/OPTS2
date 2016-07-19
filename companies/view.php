<?php
session_start();
if ($_SESSION['role'] != 1) header('Location: /OPTS2/index.php');
$title = 'ОПТС - Просмотр компании';
if (!empty($_GET['id'])) {
    $sql = new mysqli('localhost', 'root', 'root', 'opts');
    $query = $sql->query('SELECT * FROM companies WHERE id=' . $_GET['id']);
    $result = $query->fetch_assoc();
} else $error = 'Произошла ошибка отображения страницы';
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="../OPTS2.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <title><?= $title ?></title>
</head>
<body class="body-wrap">
<div class="container-fluid wrap">
    <div class="row content">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">ОПТС</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="../report.php">Отчёт</a></li>
                        <li><a href="/OPTS2/practice_types/list.php">Типы практики</a></li>
                        <li><a href="/OPTS2/contracts/list.php">Контракты</a></li>
                        <li><a href="/OPTS2/companies/list.php">Компании</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/OPTS2/index.php">Выход</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
    <div class="row content">
        <div class="marg-sides-10">
            <? if(empty($error)): ?>
            <h3>Компания <?=$result['name']?></h3>
            <b>Телефон:</b> <?=$result['telephone']?><br>
            <b>Адрес:</b> <?=$result['address']?><br>
            <b>Описание:</b> <?=$result['description']?><br>
            <b>ФИО представителя:</b> <?=$result['representative']?><br><br>
            <span class="btn btn-primary">Просмотреть Договора</span>
            <? else : ?>
                <?=$error?>
                <a href="list.php" class="btn btn-primary">Вернутся к списку</a>
            <?endif;?>
        </div>
    </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/footer.php') ?>

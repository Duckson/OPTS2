<?php
session_start();
if ($_SESSION['role'] != 1) header('Location: /OPTS2/index.php');
$title = 'ОПТС - Просмотр контракта';
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
            <h3>Просмотр контракта</h3>
            <b>Компания:</b> «СПА Бэлль»<br>
            <b>Дта заключения:</b> 06.11.2015<br>
            <b>Описание:</b> 0010101001010101010101011010101011010101010101010
            001111110101010101010001010100101010101010101101010101
            101010101010101000111111010101010101000101010010101010101010
            1101010101101010101010101000111111010101010101000101
            01001010101010101011010101011010101010101010001111110101010101010<br>
            <br><span class="h3">Приложения к данному контракту</span><a href="applications/create.php"
                                                                         class="btn btn-success pull-right button-create">Добавить
                Приложение</a>
            <table class="table table-hover table-condensed table-bordered">
                <tr>
                    <th>Дата начала практики</th>
                    <th>Дата окончания практики</th>
                    <th>Тип практики</th>
                    <th>Студенты</th>
                    <th class="glyph_td"></th>
                </tr>
                <tr>
                    <td>13.11.2015</td>
                    <td>02.02.2016</td>
                    <td>Спа</td>
                    <td>
                        <ul>
                            <li>Попкин Илья Васильев</li>
                            <li>НеПопкин НеИлья НеВасильев</li>
                            <li>НуПопкин НуИлья НуВасильев</li>
                        </ul>
                    </td>
                    <td class="glyph_td">
                        <a href="applications/edit.php" class="glyphicon glyphicon-pencil action-glyph"></a>
                        <a class="glyphicon glyphicon-remove action-glyph" onclick="alert('нинада')"></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/footer.php') ?>

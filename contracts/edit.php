<?php
session_start();
if ($_SESSION['role'] != 1) header('Location: /OPTS2/index.php');
$title = 'ОПТС - Редактирование контракта';
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
            <h3>Редактировать контракт</h3>
            <form action="view.php" method="post">
                <div class="well well-lg">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="e_company">Компании:</label>
                                <input type="text" class="form-control" name="e_company" id="e_company" value="«СПА Бэлль»">
                            </div>
                            <div class="form-group">
                                <label for="e_start_date">Дата заключения:</label>
                                <input type="date" class="form-control" name="e_start_date" id="e_start_date" value="2015-11-06">
                            </div>
                            <div class="form-group">
                                <label for="e_end_date">Дата окончания:</label>
                                <input type="date" class="form-control" name="e_end_date" id="e_end_date" value="2016-12-18">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="e_description">Описание:</label>
                                    <textarea rows="7" class="form-control" name="e_description"
                                              id="c_description">0010101001010101010101011010101011010101010101010001111110101010101010001010100101010101010101101010101101010101010101000111111010101010101000101010010101010101010110101010110101010101010100011111101010101010100010101001010101010101011010101011010101010101010001111110101010101010</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Сохранить контракт">
            </form>
        </div>
    </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/footer.php') ?>
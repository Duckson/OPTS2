<?php
session_start();
if ($_SESSION['role'] != 1) header('Location: /OPTS2/index.php');
$title = 'ОПТС - Создание приложения';
?>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="/OPTS2/OPTS2.css">
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
                            <li><a href="/OPTS2/report.php">Отчёт</a></li>
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
                <h3>Создать приложение</h3>
                <form action="../view.php" method="post">
                    <div class="well well-lg">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="c_start_date">Дата начала практики:</label>
                                    <input type="date" class="form-control" name="c_start_date" id="c_start_date">
                                </div>
                                <div class="form-group">
                                    <label for="c_end_date">Дата окончания практики:</label>
                                    <input type="date" class="form-control" name="c_end_date" id="c_end_date">
                                </div>
                                <label for="c_practice_type">Тип практики:</label>
                                <select class="form-control" name="c_practice_type" id="c_practice_type">
                                    <option value="spa">Спа</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <span class="h3">Студенты</span><a href="students.php"
                                                                   class="btn btn-success pull-right button-create">Добавить
                                    Студента</a>
                                <table class="table table-hover table-condensed table-bordered">
                                    <tr>
                                        <th>ФИО</th>
                                        <th>Группа</th>
                                        <th class="glyph_td"></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Создать приложение">
                </form>
            </div>
        </div>
    </div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/footer.php') ?>
<?php
session_start();
if ($_SESSION['role'] != 1) header('Location: /OPTS2/index.php');
$title = 'ОПТС - Создание компании';
if (!empty($_POST) && empty($_POST['c_name'])) $error = 'Не правильно заполнена форма';
elseif(!empty($_POST)) {
    $sql = new mysqli('localhost', 'root', 'root', 'opts');
    $query = "INSERT INTO companies (name, telephone, address, representative, description) VALUES ('{$_POST['c_name']}',
              '{$_POST['c_telephone']}', '{$_POST['c_address']}', '{$_POST['c_fio']}', '{$_POST['c_description']}')";
    $sql->query($query);
    echo $sql->error;
    header('Location: /OPTS2/companies/view.php?id=' . $sql->insert_id);
}
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
            <h3>Создать компанию</h3>
            <? if (isset($error)): ?>
                <span class="form-error"><?= $error ?></span>
            <? endif ?>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="well well-lg">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="c_name">Название компании:</label>
                                <input type="text" class="form-control" name="c_name" id="c_name"
                                       value="<?= $_POST['c_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="c_telephone">Номер телефона:</label>
                                <input type="text" class="form-control" name="c_telephone" id="c_telephone"
                                       value="<?= $_POST['c_telephone'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="c_address">Адрес:</label>
                                <textarea rows="1" class="form-control" name="c_address"
                                          id="c_address"><?= $_POST['c_address'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="c_fio">ФИО представителя:</label>
                                <input type="text" class="form-control" name="c_fio" id="c_fio"
                                       value="<?= $_POST['c_fio'] ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="c_description">Описание:</label>
                                <textarea rows="12" class="form-control" name="c_description"
                                          id="c_description"><?= $_POST['c_description'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Создать компанию">
                </div>
            </form>
        </div>
    </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/footer.php') ?>
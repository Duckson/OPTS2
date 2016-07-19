<?php
session_start();
if ($_SESSION['role'] != 1) header('Location: /OPTS2/index.php');
$title = 'ОПТС - Редактирование компании';
if (!empty($_GET['id'])) {
    if (!empty($_POST) && empty($_POST['e_name'])) $error = 'Не правильно заполнена форма';
    elseif (!empty($_POST)) {
        $sql = new mysqli('localhost', 'root', 'root', 'opts');
        $query = "UPDATE companies SET  name='{$_POST['e_name']}', telephone='{$_POST['e_telephone']}',
                  address='{$_POST['e_address']}', representative='{$_POST['e_fio']}', description='{$_POST['e_description']}' WHERE id={$_GET['id']}";
        $sql->query($query);
        echo $sql->error;
        header('Location: /OPTS2/companies/view.php?id=' . $_GET['id']);
    }

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
            <? if (empty($error)): ?>
                <h3>Редактировать компанию</h3>
                <form action="edit.php?id=<?= $_GET['id'] ?>" method="post">
                    <div class="well well-lg">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="e_name">Название компании:</label>
                                    <input type="text" class="form-control" name="e_name" id="e_name"
                                           value="<?= $result['name'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="e_telephone">Номер телефона:</label>
                                    <input type="text" class="form-control" name="e_telephone" id="e_telephone"
                                           value="<?= $result['telephone'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="e_address">Адрес:</label>
                                    <textarea rows="1" class="form-control" name="e_address"
                                              id="e_address"><?= $result['address'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="e_fio">ФИО представителя:</label>
                                    <input type="text" class="form-control" name="e_fio" id="e_fio"
                                           value="<?= $result['representative'] ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="e_description">Описание:</label>
                                <textarea rows="12" class="form-control" name="e_description"
                                          id="e_description"><?= $result['description'] ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Сохранить компанию">
                    </div>
                </form>
            <? else : ?>
                <?= $error ?>
                <a href="list.php" class="btn btn-primary">Вернутся к списку</a>
            <? endif; ?>
        </div>
    </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/footer.php') ?>
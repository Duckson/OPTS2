<?php
session_start();
if ($_SESSION['role'] != 1) header('Location: /OPTS2/index.php');
$title = 'ОПТС - Список компаний';
$sql = new mysqli('localhost', 'root', 'root', 'opts');

if (!empty($_GET['name'])) $where[] = 'name LIKE "' . $_GET['name'] . '"';
if (!empty($_GET['telephone'])) $where[] = 'telephone LIKE "' . $_GET['telephone'] . '"';
$where_str = '';
if (!empty($where)) {
    $where_str = ' WHERE ' . join(' AND ', $where);
}
$query = $sql->query('SELECT id, telephone, name FROM companies' . $where_str);
while ($row = $query->fetch_assoc()) {
    $result[] = $row;
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
        <div class="col-sm-3">
            <div class="well well-sm">
                <span class="h3">Фильтр</span>
                <form action="list.php" method="get">
                    <div class="form-group">
                        <label for="name">Название:</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?= $_GET['name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="telephone">Номер телефона:</label>
                        <input type="text" class="form-control" name="telephone" id="telephone"
                               value="<?= $_GET['telephone'] ?>">
                    </div>
                    <input class="btn btn-primary" type="submit" value="Применить">
                </form>
                <form action="list.php" method="get">
                    <input class="btn btn-warning" type="submit" value="Очистить">
                </form>
            </div>
        </div>
        <div class="col-sm-9">
            <span class="h3">Компании</span><a href="create.php" class="btn btn-success pull-right button-create">Добавить
                компанию</a>
            <table class="table table-hover table-condensed table-bordered">
                <tr>
                    <th>Название</th>
                    <th>Номер телефона</th>
                    <th class="glyph_td"></th>
                </tr>
                <? if ($result): ?>
                    <? foreach ($result as $row): ?>
                        <tr>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['telephone'] ?></td>
                            <td class="glyph_td">
                                <a href="edit.php?id=<?= $row['id'] ?>"
                                   class="glyphicon glyphicon-pencil action-glyph"></a>
                                <a href="view.php?id=<?= $row['id'] ?>"
                                   class="glyphicon glyphicon-resize-full action-glyph"></a>
                                <a class="glyphicon glyphicon-remove action-glyph" onclick="alert('нинада')"></a>
                            </td>
                        </tr>
                    <? endforeach ?>
                <? endif ?>
            </table>
            <ul class="pagination">
                <li class="active"><a>1</a></li>
                <li><a>2</a></li>
                <li><a>3</a></li>
            </ul>
        </div>
    </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/footer.php') ?>

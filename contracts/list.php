<?php
session_start();
if ($_SESSION['role'] != 1) header('Location: /OPTS2/index.php');
$title = 'ОПТС - Список контрактов';
$sql = new mysqli('localhost', 'root', 'root', 'opts');

if (!empty($_GET['company'])) $where[] = 'companies.name LIKE "' . $_GET['company'] . '"';
if (!empty($_GET['start_date'])) $where[] = 'start_date LIKE "' . $_GET['start_date'] . '"';
$where_str = '';
if (!empty($where)) {
    $where_str = ' WHERE ' . join(' AND ', $where);
}
$query = $sql->query('SELECT contracts.id AS id, contracts.start_date AS start_date, companies.name AS company FROM contracts
                      LEFT JOIN companies ON company_id=companies.id' . $where_str);
while ($row = $query->fetch_assoc()) {
    $result[] = $row;
}
var_dump($result);
include $_SERVER['DOCUMENT_ROOT'] . '/OPTS2/header.php';
?>

<div class="row content">
    <div class="col-sm-3">
        <div class="well well-sm">
            <span class="h3">Фильтр</span>
            <form action="list.php" method="get">
                <div class="form-group">
                    <label for="company">Компании:</label>
                    <input type="text" class="form-control" name="company" id="company" value="<?= $_GET['company'] ?>">
                </div>
                <div class="form-group">
                    <label for="start_date">Дата заключения:</label>
                    <input type="date" class="form-control" name="start_date" id="start_date"
                           value="<?= $_GET['start_date'] ?>">
                </div>
                <input class="btn btn-primary" type="submit" value="Применить">
            </form>
            <form action="list.php" method="get">
                <input class="btn btn-warning" type="submit" value="Очистить">
            </form>
        </div>
    </div>
    <div class="col-sm-9">
        <span class="h3">Контракты</span><a href="create.php" class="btn btn-success pull-right button-create">Добавить
            Контракт</a>
        <table class="table table-hover table-condensed table-bordered">
            <tr>
                <th>Компания</th>
                <th>Дата заключения</th>
                <th class="glyph_td"></th>
            </tr>
            <? if ($result): ?>
                <? foreach ($result as $row): ?>
                    <tr>
                        <td><?= $row['company'] ?></td>
                        <td><?= $row['start_date'] ?></td>
                        <td class="glyph_td">
                            <a href="edit.php<?= $row['id'] ?>" class="glyphicon glyphicon-pencil action-glyph"></a>
                            <a href="view.php<?= $row['id'] ?>"
                               class="glyphicon glyphicon-resize-full action-glyph"></a>
                            <a class="glyphicon glyphicon-remove action-glyph" onclick="alert('нинада')"></a>
                        </td>
                    </tr>
                <? endforeach ?>
            <? endif; ?>
        </table>
    </div>
</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/footer.php') ?>

<?php
session_start();
if ($_SESSION['role'] != 1) header('Location: /OPTS2/index.php');
$title = 'ОПТС - Список компаний';
$sql = new mysqli('localhost', 'root', 'root', 'opts');
$tr_count = 3;
$page = (!empty($_GET['page'])) ? $_GET['page'] : 1;

if(!empty($_GET)){
    if (!empty($_GET['page'])){
        unset($_GET['page']);
    }
    $get = '?' . http_build_query($_GET) . '&page=';
}else $get='?page=';

if (!empty($_GET['name'])) $where[] = 'name LIKE "' . $_GET['name'] . '"';
if (!empty($_GET['telephone'])) $where[] = 'telephone LIKE "' . $_GET['telephone'] . '"';
$where_str = '';
if (!empty($where)) {
    $where_str = ' WHERE ' . join(' AND ', $where);
}
$limit_str = ' LIMIT ' . ($page - 1) * $tr_count . ',' . $tr_count;
$query = $sql->query('SELECT id, telephone, name FROM companies' . $where_str . $limit_str);
while ($row = $query->fetch_assoc()) {
    $result[] = $row;
}
$counter = intval($sql->query('SELECT count(*) FROM companies' . $where_str)->fetch_array()[0]);
include $_SERVER['DOCUMENT_ROOT'] . '/OPTS2/header.php';
?>

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
                <th style="width: 70%">Название</th>
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
        <ul class="pagination" id="pagination">
            <?php for ($i = 0; $i < $counter / $tr_count; $i++): ?>
                <li <?= ($page == $i+1) ? 'class="active"' : NULL ?>><a href="list.php<?= $get . ($i+1) ?>"><?= $i+1 ?></a></li>
            <?php endfor; ?>
        </ul>
    </div>
</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/footer.php') ?>

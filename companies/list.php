<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/session.php');
$title = 'ОПТС - Список компаний';
$tr_count = 3;
$page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
$prep_str = '';

if (!empty($_POST['delete_id'])) {
    $prep = $sql->prepare('DELETE FROM companies WHERE id=?');
    $prep->bind_param('i', $_POST['delete_id']);
    $prep->execute();
    if (!empty($sql->error)) $delete_error = 'Произошла ошибка при удалении! Возможно, что эта запись уже где-то используется.';
    else $delete_success = 'Запись успешно удалена!';
}

if (!empty($_GET)) {
    if (!empty($_GET['page'])) {
        unset($_GET['page']);
    }
    $get = '?' . http_build_query($_GET) . '&page=';
} else $get = '?page=';

if (!empty($_GET['name'])) {
    $where[] = 'name LIKE ?';
    $prep_str .= 's';
    $prep_vals[] = &$_GET['name'];
}
if (!empty($_GET['telephone'])) {
    $where[] = 'telephone LIKE ?';
    $prep_str .= 's';
    $prep_vals[] = &$_GET['telephone'];
}
$where_str = '';
if (!empty($where)) {
    $where_str = ' WHERE ' . join(' AND ', $where);
}
$limit_str = ' LIMIT ' . ($page - 1) * $tr_count . ',' . $tr_count;
if (empty($where_str)) {
    $query = $sql->query('SELECT id, telephone, name FROM companies' . $limit_str);
    $counter = intval($sql->query('SELECT count(*) FROM companies')->fetch_array()[0]);
    while ($row = $query->fetch_assoc()) {
        $result[] = $row;
    }

} else {
    array_unshift($prep_vals, $prep_str);
    $prep = $sql->prepare('SELECT id, telephone, name FROM companies' . $where_str . $limit_str);
    call_user_func_array([$prep, 'bind_param'], $prep_vals);
    $prep->execute();
    $prep->bind_result($id, $telephone, $name);
    $fetch_count = 0;
    while ($prep->fetch()) {
        $result[$fetch_count]['id'] = $id;
        $result[$fetch_count]['telephone'] = $telephone;
        $result[$fetch_count]['name'] = $name;
        $fetch_count++;
    }
    $prep->close();
    $prep = $sql->prepare('SELECT count(*) FROM companies' . $where_str);
    call_user_func_array([$prep, 'bind_param'], $prep_vals);
    $prep->execute();
    $prep->bind_result($counter);
    $prep->fetch();
    $prep->close();
}

include $_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/header.php';
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
        <? if (!empty($delete_error)): ?>
            <span class="text-danger"><?= $delete_error ?></span><br>
        <? endif; ?>
        <? if (!empty($delete_success)): ?>
            <span class="text-success"><?= $delete_success ?></span><br>
        <? endif; ?>
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
                            <form class="form-glyph" method="post" action="list.php?<?= http_build_query($_GET) ?>">
                                <a href="edit.php?id=<?= $row['id'] ?>"
                                   class="glyphicon glyphicon-pencil action-glyph"></a>
                                <a href="view.php?id=<?= $row['id'] ?>"
                                   class="glyphicon glyphicon-resize-full action-glyph"></a>
                                <button type="submit" name="delete_id" value="<?= $row['id'] ?>" class="btn-glyph glyphicon glyphicon-remove action-glyph">
                            </form>
                        </td>
                    </tr>
                <? endforeach ?>
            <? endif ?>
        </table>
        <ul class="pagination" id="pagination">
            <?php for ($i = 0; $i < $counter / $tr_count; $i++): ?>
                <li <?= ($page == $i + 1) ? 'class="active"' : NULL ?>><a
                        href="list.php<?= $get . ($i + 1) ?>"><?= $i + 1 ?></a></li>
            <?php endfor; ?>
        </ul>
    </div>
</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/footer.php') ?>

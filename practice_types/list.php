<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/session.php');
$title = 'ОПТС - Список типов практики';
$prep_str = '';
$sql = new mysqli('localhost', 'root', 'root', 'opts');

if(!empty($_POST['delete_id'])){
    $prep = $sql->prepare('DELETE FROM practice_types WHERE id=?');
    $prep->bind_param('i', $_POST['delete_id']);
    $prep->execute();
    var_dump($sql->error);
    if(!empty($sql->error)) $delete_error = 'Произошла ошибка при удалении! Возможно, что эта запись уже где-то используется.';
    else $delete_success = 'Запись успешно удалена!';
}

if (!empty($_GET['name'])) {
    $where_str = ' WHERE name LIKE ?';
    $prep_str .= 's';
    $prep_vals[] = &$_GET['name'];
}
if (empty($where_str)) {
    $query = $sql->query('SELECT id, name FROM practice_types');
    while ($row = $query->fetch_assoc()) {
        $result[] = $row;
    }
} else {
    array_unshift($prep_vals, $prep_str);
    $prep = $sql->prepare('SELECT id, name FROM practice_types' . $where_str);
    call_user_func_array([$prep, 'bind_param'], $prep_vals);
    $prep->execute();
    $prep->bind_result($id, $name);
    $fetch_count = 0;
    while ($prep->fetch()) {
        $result[$fetch_count]['id'] = $id;
        $result[$fetch_count]['name'] = $name;
        $fetch_count++;
    }
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
                <input class="btn btn-primary" type="submit" value="Применить">
            </form>
            <form action="list.php" method="get">
                <input class="btn btn-warning" type="submit" value="Очистить">
            </form>
        </div>
    </div>
    <div class="col-sm-9">
        <? if(!empty($delete_error)): ?>
            <span class="text-danger"><?= $delete_error ?></span><br>
        <?endif;?>
        <? if(!empty($delete_success)): ?>
            <span class="text-success"><?= $delete_success ?></span><br>
        <?endif;?>
        <span class="h3">Типы практики</span><a href="create.php" class="btn btn-success pull-right button-create">Добавить
            тип практики</a>
        <table class="table table-hover table-condensed table-bordered">
            <tr>
                <th>Название</th>
                <th class="glyph_td"></th>
            </tr>
            <? foreach ($result as $row) : ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td class="glyph_td">
                        <form class="form-glyph" method="post" action="list.php?<?= http_build_query($_GET) ?>">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="glyphicon glyphicon-pencil action-glyph"></a>
                            <button type="submit" name="delete_id" value="<?= $row['id'] ?>" class="btn-glyph glyphicon glyphicon-remove action-glyph">
                        </form>
                    </td>
                </tr>
            <? endforeach; ?>
        </table>
    </div>
</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/footer.php') ?>

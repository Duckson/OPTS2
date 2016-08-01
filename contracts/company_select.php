<?php
include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/session.php');
$title = 'ОПТС - Список компаний';
$tr_count = 3;

if(empty($_GET['action']) || ($_GET['action'] == 'edit') && empty($_GET['id'])) $error = 'Ошибка отображения страницы';

$page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
$counter = 0;

if (!empty($_GET)) {
    if (!empty($_GET['page'])) {
        unset($_GET['page']);
    }
    $get = '?' . http_build_query($_GET) . '&page=';
} else $get = '?page=';

if (!empty($_GET['name'])) {
    $where[] = 'name LIKE :name';
    $prep_names[] = ':name';
    $prep_types[] = PDO::PARAM_STR;
    $prep_vals[] = &$_GET['name'];
}

$limit_str = ' LIMIT ' . ($page - 1) * $tr_count . ',' . $tr_count;
if (empty($where)) {
    $query = $sql->query('SELECT id, name FROM companies' . $limit_str);
    $count = intval($sql->query('SELECT count(*) FROM companies')->fetch()[0]);
    while ($row = $query->fetch()) {
        $result[] = $row;
    }

} else {
    $where_str = '';
    $where_str = ' WHERE ' . join(' AND ', $where);
    $prep = $sql->prepare('SELECT id, name FROM companies' . $where_str . $limit_str);
    foreach ($prep_vals as $key => $value) {
        $prep->bindParam($prep_names[$key], $value, $prep_types[$key]);
    }
    $prep->execute();
    while ($row = $prep->fetch()) {
        $result[] = $row;
    }
    $prep = $sql->prepare('SELECT count(*) FROM companies' . $where_str);
    foreach ($prep_vals as $key => $value) {
        $prep->bindParam($prep_names[$key], $value, $prep_types[$key]);
    }
    $prep->execute();
    $count = $prep->fetch()[0];
}

include $_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/header.php';
?>
<? if (empty($error)): ?>
<script src="form_button.js"></script>
<h2><?= ($_GET['action'] == 'create')? 'Создание': 'Редактирование' ?> контракта</h2>
<h3>Шаг 1: выбор компании</h3>
<div class="well well-lg">
    <form method="get" action="company_select.php">
        <div class="form-group">
            <label for="name">Название:</label>
            <input type="text" name="name" id="name" placeholder="Введите имя компании" value="<?= $_GET['name'] ?>">
            <button type="submit" class="glyphicon glyphicon-search btn btn-success btn-sm"></button>
        </div>
    </form>
    <form id="form" method="get" action="<?= ($_GET['action'] == 'create')? 'create.php': 'edit.php' ?>">
        <?= ($_GET['action'] == 'edit')? '<input type="hidden" name="id" value="' . $_GET['id'] . '">': '' ?>
        <? foreach ($result as $row): ?>
            <?php $counter++ ?>
            <? if (($counter % 3) - 1 == 0): ?>
                <?php $is_open = true ?>
                <div class="row-radio">
            <? endif; ?>
            <div class="div-radio" id="<?= $row['id'] ?>"><input type="radio" class="radio"  name="company" value="<?= $row['id'] ?>"
                                         > <?= $row['name'] ?></div>
            <? if ($counter % 3 == 0): ?>
                <?php $is_open = false ?>
                </div>
            <? endif; ?>
        <? endforeach; ?>
        <? if($is_open == true): ?>
            </div>
        <? endif; ?>
        <ul class="pagination" id="pagination">
            <?php for ($i = 0; $i < $count / $tr_count; $i++): ?>
               <li <?= ($page == $i + 1) ? 'class="active"' : NULL ?>><a
                href="company_select.php<?= $get . ($i + 1) ?>"><?= $i + 1 ?></a></li>
            <?php endfor; ?>
        </ul><br>
        <button type="submit" id="submit" class="btn btn-primary">Выбрать компанию</button>
    </form>
</div>
<? else : ?>
    <?= $error ?>
    <a href="list.php" class="btn btn-primary">Вернутся к списку</a>
<? endif; ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/footer.php') ?>

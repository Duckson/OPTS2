<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/session.php');
$title = 'ОПТС - Просмотр компании';
if (!empty($_GET['id'])) {
    $sql = new mysqli('localhost', 'root', 'root', 'opts');
    $prep = $sql->prepare('SELECT name, telephone, address, representative, description FROM companies WHERE id=?');
    $prep->bind_param('i', $_GET['id']);
    $prep->execute();
    $prep->bind_result($result['name'], $result['telephone'], $result['address'], $result['representative'], $result['description']);
    $prep->fetch();
    $prep->close();
} else $error = 'Произошла ошибка отображения страницы';
include $_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/header.php';
?>

<div class="row content">
    <div class="marg-sides-10">
        <? if (empty($error)): ?>
            <h3>Компания <?= $result['name'] ?></h3>
            <b>Телефон:</b> <?= $result['telephone'] ?><br>
            <b>Адрес:</b> <?= $result['address'] ?><br>
            <b>Описание:</b> <?= $result['description'] ?><br>
            <b>ФИО представителя:</b> <?= $result['representative'] ?><br><br>
            <span class="btn btn-primary">Просмотреть Договора</span>
        <? else : ?>
            <?= $error ?>
            <a href="list.php" class="btn btn-primary">Вернутся к списку</a>
        <? endif; ?>
    </div>
</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/footer.php') ?>

<?php
session_start();
if ($_SESSION['role'] != 1) header('Location: /OPTS2/index.php');
$title = 'ОПТС - Просмотр компании';
if (!empty($_GET['id'])) {
    $sql = new mysqli('localhost', 'root', 'root', 'opts');
    $query = $sql->query('SELECT * FROM companies WHERE id=' . $_GET['id']);
    $result = $query->fetch_assoc();
} else $error = 'Произошла ошибка отображения страницы';
include $_SERVER['DOCUMENT_ROOT'] . '/OPTS2/header.php';
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
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/footer.php') ?>

<?php
session_start();
if ($_SESSION['role'] != 1) header('Location: /OPTS2/index.php');
$title = 'ОПТС - Редактирование типа практики';
include $_SERVER['DOCUMENT_ROOT'] . '/OPTS2/header.php';
?>

    <div class="row content">
        <div class="marg-sides-10">
            <h3>Редактировать тип практики</h3>
            <form action="list.php" method="post">
                <div class="well well-lg">
                    <div class="form-group">
                        <label for="e_name">Название:</label>
                        <input type="text" class="form-control" name="e_name" id="e_name" value="Спа">
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Сохранить тип практики">
            </form>
        </div>
    </div>
    </div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/footer.php') ?>
<?php
session_start();
if ($_SESSION['role'] != 1) header('Location: /OPTS2/index.php');
$title = 'ОПТС - Список типов практики';
include $_SERVER['DOCUMENT_ROOT'] . '/OPTS2/header.php';
?>

<div class="row content">
    <div class="col-sm-3">
        <div class="well well-sm">
            <span class="h3">Фильтр</span>
            <form action="list.php" method="get">
                <div class="form-group">
                    <label for="name">Название:</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <input class="btn btn-primary" type="submit" value="Применить">
            </form>
            <form action="list.php" method="get">
                <input class="btn btn-warning" type="submit" value="Очистить">
            </form>
        </div>
    </div>
    <div class="col-sm-9">
        <span class="h3">Типы практики</span><a href="create.php" class="btn btn-success pull-right button-create">Добавить
            тип практики</a>
        <table class="table table-hover table-condensed table-bordered">
            <tr>
                <th>Название</th>
                <th class="glyph_td"></th>
            </tr>
            <tr>
                <td>Спа</td>
                <td class="glyph_td">
                    <a href="edit.php" class="glyphicon glyphicon-pencil action-glyph"></a>
                    <a class="glyphicon glyphicon-remove action-glyph" onclick="alert('нинада')"></a>
                </td>
            </tr>
        </table>
    </div>
</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/footer.php') ?>

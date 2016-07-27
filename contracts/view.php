<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/session.php');
$title = 'ОПТС - Просмотр контракта';
include $_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/header.php';
?>

<div class="row content">
    <div class="marg-sides-10">
        <h3>Просмотр контракта</h3>
        <b>Компания:</b> «СПА Бэлль»<br>
        <b>Дта заключения:</b> 06.11.2015<br>
        <b>Описание:</b> 0010101001010101010101011010101011010101010101010
        001111110101010101010001010100101010101010101101010101
        101010101010101000111111010101010101000101010010101010101010
        1101010101101010101010101000111111010101010101000101
        01001010101010101011010101011010101010101010001111110101010101010<br>
        <br><span class="h3">Приложения к данному контракту</span><a href="applications/create.php"
                                                                     class="btn btn-success pull-right button-create">Добавить
            Приложение</a>
        <table class="table table-hover table-condensed table-bordered">
            <tr>
                <th>Дата начала практики</th>
                <th>Дата окончания практики</th>
                <th>Тип практики</th>
                <th>Студенты</th>
                <th class="glyph_td"></th>
            </tr>
            <tr>
                <td>13.11.2015</td>
                <td>02.02.2016</td>
                <td>Спа</td>
                <td>
                    <ul>
                        <li>Попкин Илья Васильев</li>
                        <li>НеПопкин НеИлья НеВасильев</li>
                        <li>НуПопкин НуИлья НуВасильев</li>
                    </ul>
                </td>
                <td class="glyph_td">
                    <a href="applications/edit.php" class="glyphicon glyphicon-pencil action-glyph"></a>
                    <a class="glyphicon glyphicon-remove action-glyph" onclick="alert('нинада')"></a>
                </td>
            </tr>
        </table>
    </div>
</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/footer.php') ?>

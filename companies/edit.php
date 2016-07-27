<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/session.php');
$title = 'ОПТС - Редактирование компании';
if (!empty($_GET['id'])) {
    if (!empty($_POST) && empty($_POST['e_name'])) $error = 'Не правильно заполнена форма';
    elseif (!empty($_POST)) {
        $sql = new mysqli('localhost', 'root', 'root', 'opts');
        $query = "UPDATE companies SET  name=?, telephone=?, address=?, representative=?, description=? WHERE id=?";
        $prep = $sql->prepare($query);
        $prep->bind_param('sssssi', $_POST['e_name'], $_POST['e_telephone'], $_POST['e_address'], $_POST['e_fio'], $_POST['e_description'], $_GET['id']);
        $prep->execute();
        $prep->close();
        header('Location: /OPTS2/companies/view.php?id=' . $_GET['id']);
    }

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
                <h3>Редактировать компанию</h3>
                <form action="edit.php?id=<?= $_GET['id'] ?>" method="post">
                    <div class="well well-lg">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="e_name">Название компании:</label>
                                    <input type="text" class="form-control" name="e_name" id="e_name"
                                           value="<?= $result['name'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="e_telephone">Номер телефона:</label>
                                    <input type="text" class="form-control" name="e_telephone" id="e_telephone"
                                           value="<?= $result['telephone'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="e_address">Адрес:</label>
                                    <textarea rows="1" class="form-control" name="e_address"
                                              id="e_address"><?= $result['address'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="e_fio">ФИО представителя:</label>
                                    <input type="text" class="form-control" name="e_fio" id="e_fio"
                                           value="<?= $result['representative'] ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="e_description">Описание:</label>
                                <textarea rows="12" class="form-control" name="e_description"
                                          id="e_description"><?= $result['description'] ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Сохранить компанию">
                    </div>
                </form>
            <? else : ?>
                <?= $error ?>
                <a href="list.php" class="btn btn-primary">Вернутся к списку</a>
            <? endif; ?>
        </div>
    </div>
    </div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/footer.php') ?>
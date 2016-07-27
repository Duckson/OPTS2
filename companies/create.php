<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/session.php');
$title = 'ОПТС - Создание компании';
if (!empty($_POST) && empty($_POST['c_name'])) $error = 'Не правильно заполнена форма';
elseif(!empty($_POST)) {
    $query = "INSERT INTO companies (name, telephone, address, representative, description) VALUES (?, ?, ?, ?, ?)";
    $prep = $sql->prepare($query);
    $prep->bind_param('sssss', $_POST['c_name'], $_POST['c_telephone'], $_POST['c_address'], $_POST['c_fio'], $_POST['c_description']);
    $prep->execute();
    $prep->close();
    header('Location: /OPTS2/companies/view.php?id=' . $sql->insert_id);
}
include $_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/header.php';
?>

    <div class="row content">
        <div class="marg-sides-10">
            <h3>Создать компанию</h3>
            <? if (isset($error)): ?>
                <span class="form-error"><?= $error ?></span>
            <? endif ?>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="well well-lg">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="c_name">Название компании:</label>
                                <input type="text" class="form-control" name="c_name" id="c_name"
                                       value="<?= $_POST['c_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="c_telephone">Номер телефона:</label>
                                <input type="text" class="form-control" name="c_telephone" id="c_telephone"
                                       value="<?= $_POST['c_telephone'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="c_address">Адрес:</label>
                                <textarea rows="1" class="form-control" name="c_address"
                                          id="c_address"><?= $_POST['c_address'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="c_fio">ФИО представителя:</label>
                                <input type="text" class="form-control" name="c_fio" id="c_fio"
                                       value="<?= $_POST['c_fio'] ?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="c_description">Описание:</label>
                                <textarea rows="12" class="form-control" name="c_description"
                                          id="c_description"><?= $_POST['c_description'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Создать компанию">
                </div>
            </form>
        </div>
    </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/dependencies/footer.php') ?>
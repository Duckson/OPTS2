<?php
session_start();
if ($_SESSION['role'] != 1) header('Location: /OPTS2/index.php');
$title = 'ОПТС - Создание контракта';
if (!empty($_POST) && (empty($_POST['c_company']) || empty($_POST['c_start_date']) || empty($_POST['c_end_date']))) $error = 'Не правильно заполнена форма';
elseif(!empty($_POST)) {
    $sql = new mysqli('localhost', 'root', 'root', 'opts');
    $query = "INSERT INTO contracts (company_id, start_date, end_date, description) VALUES ('{$_POST['c_name']}',
              '{$_POST['c_telephone']}', '{$_POST['c_address']}', '{$_POST['c_fio']}', '{$_POST['c_description']}')";
    $sql->query($query);
    echo $sql->error;
    header('Location: /OPTS2/companies/view.php?id=' . $sql->insert_id);
}

include $_SERVER['DOCUMENT_ROOT'] . '/OPTS2/header.php';
?>

    <div class="row content">
        <div class="marg-sides-10">
            <h3>Создать контракт</h3>
            <form action="view.php" method="post">
                <div class="well well-lg">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="c_company">Компания:</label>
                                <input type="text" class="form-control" name="c_company" id="c_company">
                            </div>
                            <div class="form-group">
                                <label for="c_start_date">Дата заключения:</label>
                                <input type="date" class="form-control" name="c_start_date" id="c_start_date">
                            </div>
                            <div class="form-group">
                                <label for="c_end_date">Дата окончания:</label>
                                <input type="date" class="form-control" name="c_end_date" id="c_end_date">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="c_description">Описание:</label>
                                    <textarea rows="7" class="form-control" name="c_description"
                                              id="c_description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Создать контракт">
            </form>
        </div>
    </div>
    </div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/footer.php') ?>
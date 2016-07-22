<?php
session_start();
if ($_SESSION['role'] != 1) header('Location: /OPTS2/index.php');
$title = 'ОПТС - Редактирование контракта';
include $_SERVER['DOCUMENT_ROOT'] . '/OPTS2/header.php';
?>

    <div class="row content">
        <div class="marg-sides-10">
            <h3>Редактировать контракт</h3>
            <form action="view.php" method="post">
                <div class="well well-lg">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="e_company">Компании:</label>
                                <input type="text" class="form-control" name="e_company" id="e_company"
                                       value="«СПА Бэлль»">
                            </div>
                            <div class="form-group">
                                <label for="e_start_date">Дата заключения:</label>
                                <input type="date" class="form-control" name="e_start_date" id="e_start_date"
                                       value="2015-11-06">
                            </div>
                            <div class="form-group">
                                <label for="e_end_date">Дата окончания:</label>
                                <input type="date" class="form-control" name="e_end_date" id="e_end_date"
                                       value="2016-12-18">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="e_description">Описание:</label>
                                    <textarea rows="7" class="form-control" name="e_description"
                                              id="c_description">0010101001010101010101011010101011010101010101010001111110101010101010001010100101010101010101101010101101010101010101000111111010101010101000101010010101010101010110101010110101010101010100011111101010101010100010101001010101010101011010101011010101010101010001111110101010101010</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Сохранить контракт">
            </form>
        </div>
    </div>
    </div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/OPTS2/footer.php') ?>
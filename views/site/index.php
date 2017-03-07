<?php
$pagetitle = 'Главная';
$page_id = 'page_index';

//Подключаем шапку
include ROOT . '/views/layouts/header.php';

?>
    <h2 align="center"><?= $pagetitle ?></h2>

    <form>
        <div class="full_width">
            <input type="text"  />
            <span class="right_indent"></span>
            <input type="text" />
        </div>

    </form>

    <br /><br />
    <div class="head font_size_twelve full_width" align="center">Показано: <?= 0 ?> из <?= 0 ?></div>

<?php include ROOT . '/views/layouts/footer.php'; ?>
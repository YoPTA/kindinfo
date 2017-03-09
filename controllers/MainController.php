<?php

class MainController
{
    public function actionIndex()
    {


        require_once KINDINFO_ROOT . '/views/main/index.php';
        return true;
    }

    public function actionError()
    {
        require_once KINDINFO_ROOT . '/views/main/error.php';
        return true;
    }

    public function actionTest()
    {
        $user = null;
        $user_id = null;


        // Подключаем файл с проверками ролей пользователя
        require_once KINDINFO_ROOT . '/config/role_ckeck.php';

        require_once KINDINFO_ROOT . '/views/main/test.php';
        return true;
    }
}
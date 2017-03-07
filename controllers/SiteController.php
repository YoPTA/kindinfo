<?php

class SiteController
{
    public function actionIndex()
    {
        /*$doc = new DOMDocument('1.0', 'UTF-8');

        $doc->formatOutput = true;
        $root = $doc->createElement('Envelope');
        $root = $doc->appendChild($root);

        $head = $doc->createElement('head');
        $head = $root->appendChild($head);

        $text = $doc->createTextNode('Это Бошка');
        $text = $head->appendChild($text);

        $body = $doc->createElement('Body');
        $body = $root->appendChild($body);

        $text = $doc->createTextNode('Это Тело');
        $text = $body->appendChild($text);

        $path="simple.xml";
        echo $doc->save($path);*/
        /*$users = User::getDOKAUsers();
        print_r($users);*/

        require_once KINDINFO_ROOT . '/views/site/index.php';
        return true;
    }

    public function actionError()
    {
        require_once KINDINFO_ROOT . '/views/site/error.php';
        return true;
    }

    public function actionLogin()
    {
        $login_name = null;
        $password = null;

        $errors = false;

        $dir_path = '/temp/users';
        $clean_utility = new Clean_Utility();

        $abs_root = $_SERVER['DOCUMENT_ROOT'];
        $temp_user_dir = null;
        if(isset($_POST['login']))
        {
            $login_name = htmlspecialchars($_POST['login_name']);
            $password = htmlspecialchars($_POST['password']);
            if(!Validate::checkStr($login_name, 32))
            {
                $errors[] = 'С логином что-то не так...';
            }
            if(!Validate::checkPassword($password))
            {
                $errors[] = 'С паролем что-то не так...';
            }
            $u_id = User::checkUserData($login_name, md5($password));
            if($u_id == false)
            {
                $errors[] = 'Данные для входа заданы не верно';
            }
            else
            {
                User::auth($u_id);
                $temp_user_dir = $abs_root.$dir_path.'/'.$u_id;
                // Удаляем директорию, если она есть
                $clean_utility->removeDirectory($temp_user_dir);

                if (!mkdir($abs_root.$dir_path.'/'.$u_id, 0777, true))
                {
                    $errors['not_dir'] = 'Не удалось создать временную директорию пользователя';
                }
                header('Location: /site/index');
            }
        }

        require_once KINDINFO_ROOT . '/views/site/login.php';
        return true;
    }

    public function actionLogout()
    {
        // Стартуем сессию
        session_start();
        $_SESSION = array();
        session_destroy ();
        // Перенаправляем пользователя на главную страницу
        header("Location: /");
    }

    public function actionTest()
    {
        $user = null;
        $user_id = null;


        // Подключаем файл с проверками ролей пользователя
        require_once KINDINFO_ROOT . '/config/role_ckeck.php';

        require_once KINDINFO_ROOT . '/views/site/test.php';
        return true;
    }
}
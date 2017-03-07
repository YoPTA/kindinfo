<?php
// Общие настройки
error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);

// Подключение файлов системы
define('KINDINFO_ROOT', dirname(__FILE__));
define('SERVER_DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);

require_once(KINDINFO_ROOT.'/components/Autoload.php');

// Подключение констант
require_once(KINDINFO_ROOT.'/config/constants.php');

// Подключение констант с правами администратора
require_once (KINDINFO_ROOT.'/config/constants_admin_access_rights.php');

// Вызов Router
$router = new App();
$router->run();
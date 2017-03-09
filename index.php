<?php

use components\Router;

// Общие настройки
error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);

// Подключение файлов системы
define('KINDINFO_ROOT', dirname(__FILE__));
define('SERVER_DOC_ROOT', $_SERVER['DOCUMENT_ROOT']);

// Подключение констант
require_once(KINDINFO_ROOT.'/config/constants.php');

// Подключение констант с правами администратора
require_once (KINDINFO_ROOT.'/config/constants_admin_access_rights.php');

function GetPrefixDocumentRoot($path = null, $dir = __DIR__)
{
    return trim(str_replace(realpath(isset($path) ? trim($path) : $_SERVER['DOCUMENT_ROOT']), '', realpath(trim($dir))));
}

define('PREFIX_DOCUMENT_ROOT', GetPrefixDocumentRoot());

require_once(KINDINFO_ROOT.'/components/Autoload.php');
$autoload = new Autoload();
spl_autoload_register([$autoload, 'loadClass']);

// Вызов Router
$router = new Router();
$router->run();
<?php

/**
 * Функция __autoload для автоматического подключения классов
 */
function __autoload($class_name)
{
    // Массив папок, в которых могут находиться необходимые классы
    $array_paths = array(
        '/models/',
        '/components/',
        '/controllers/',
    );

    // Проходим по массиву папок
    foreach ($array_paths as $path) {

        // Формируем имя и путь к файлу с классом
        $path = KINDINFO_ROOT . $path . $class_name . '.php';
        // Если такой файл существует, подключаем его
        if (is_file($path)) {
            include_once $path;
        }
    }
    /*
    // Массив папок, в которых могут находиться необходимые классы вне проекрта
    $array_paths_out = array(
        '/apps/components/',
    );
    
    foreach ($array_paths_out as $path) {
        $path = SERVER_DOC_ROOT . $path. $class_name.'.php';
        if (is_file($path)){
            include_once $path;
        }
    }*/
}


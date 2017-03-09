<?php

namespace components;

/**
 * Класс App
 * Компонент для работы с маршрутами
 */
class Router
{

    /**
     * Свойство для хранения массива роутов
     * @var array
     */
    private $routes;

    /**
     * Конструктор
     */
    public function __construct()
    {
        // Путь к файлу с роутами
        $routesPath = KINDINFO_ROOT . '/config/routes.php';



        // Получаем роуты из файла
        $this->routes = include($routesPath);
    }

    /**
     * Возвращает строку запроса
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /*
     * Метод для обработки запроса
     */
    public function run()
    {
        // Получаем строку запроса
        $uri = $this->getURI();

        require_once KINDINFO_ROOT . '/components/PrefixDocumentRoot.php';
        $pdr = new \PrefixDocumentRoot();

        // Проверяем наличие такого запроса в массиве маршрутов (routes.php)
        foreach ($this->routes as $uriPattern => $path) {

            // Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)) {

                $str_to_replace = $pdr->getPDRFromat(PREFIX_DOCUMENT_ROOT, 1);
                $str_to_controlle_file = $pdr->getPDRFromat(PREFIX_DOCUMENT_ROOT, 2);;

                // Получаем внутренний путь из внешнего согласно правилу.
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $internalRoute = str_replace($str_to_replace, '', $internalRoute);
                // Определить контроллер, action, параметры
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';

                $controllerName = ucfirst($controllerName);

                $segments = explode('?', $segments[0]);

                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments;

                //Подключаем файл класса-контроллера
                $controllerFile = $_SERVER['DOCUMENT_ROOT'] . $str_to_controlle_file.'/controllers/'
                    .$controllerName.'.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                    //Создаем объект класса контроллера
                    $controllerObject = new $controllerName;

                    if(!is_callable([$controllerObject, $actionName]))
                    {
                        call_user_func(['MainController', 'actionError']);
                        break;
                    }
                    $result = call_user_func([$controllerObject, $actionName]);

                    if ($result != null) {
                        break;
                    }
                }
            }
        }
    }

}

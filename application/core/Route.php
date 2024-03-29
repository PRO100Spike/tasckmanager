<?php

class Route {

    static function start() {
        // контроллер и действие по умолчанию

        $controller_name = 'Main';
        $action_name = 'index';

        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);

        $routes = explode('/', $uri_parts[0]);

        // получаем имя контроллера
        if (!empty($routes[1])) {
            $controller_name = ucfirst($routes[1]);
        } else if ($_GET['controller']) {
            $controller_name = $_GET['controller'];
        }

        // получаем имя экшена
        if (!empty($routes[2])) {
            $action_name = strtolower($routes[2]);
        } else if ($_GET['action']) {
            $action_name = strtolower($_GET['action']);
        }

        // добавляем префиксы
        $controller_name = 'controller' . $controller_name;
        $action_name = 'action_' . $action_name;


        // подцепляем файл с классом контроллера
        $controller_file = $controller_name . '.php';
        $controller_path = "application/controllers/" . $controller_file;
        if (file_exists($controller_path)) {
            include "application/controllers/" . $controller_file;
        } else {
            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            */
            Route::ErrorPage404();
        }

        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;

        if (method_exists($controller, $action)) {
            // вызываем действие контроллера
            $controller->$action();
        } else {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }

    }

    function ErrorPage404() {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }

}

<?php

class Controller {

    public $model;
    public $view;

    function __construct() {
        $this->view = new View();
    }

    public function model($model) {
        require_once('application/models/' . $model . '.php');
        return new $model();
    }

    public function isAjax () {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    // действие (action), вызываемое по умолчанию
    function action_index() {
        // todo
    }
}

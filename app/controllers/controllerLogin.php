<?php

class controllerLogin extends Controller {

    function action_index() {
        $user = new User();

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

        }

        $this->view->generate('login_view.php', 'template_view.php');
    }
}
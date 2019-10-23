<?php

class controllerAuth extends Controller {

    function action_index() {

        $this->view->generate('login_view.php', 'template_view.php');
    }

    function action_login() {
        if(self::isAjax()) {
            $data = json_decode(file_get_contents('php://input'), true);

            if ($data['name'] == 'admin' && $data['password'] == '123') {
                $_SESSION['user'] = 1;
            }

            die(json_encode(Session::isGuest()));
        }

    }

    function action_logout() {
            unset($_SESSION["user"]);
            session_destroy();
            header("Location: /");
            return true;
    }

}

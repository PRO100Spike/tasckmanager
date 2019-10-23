<?php

class controllerMain extends Controller {

    function action_index() {

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $db = new Db();
            $result = [];

            foreach ($db->getTask() as $task) {
                $curTask['id'] = $task->getId();
                $curTask['name'] = $task->getName();
                $curTask['email'] = $task->getEmail();
                $curTask['text'] = $task->getText();
                $curTask['status'] = $task->getStatus() ? '<i class="fas fa-calendar-check"></i> done' : '<i class="fas fa-calendar-times"></i> undone';

                $result[] = $curTask;
                //id: 1, name: 'Chuck Norris', email: 'infinity@email.com', text: 'Here text task', status: false
            }

            die(json_encode($result));
        }

        $this->view->generate('main_view.php', 'template_view.php');
    }

}
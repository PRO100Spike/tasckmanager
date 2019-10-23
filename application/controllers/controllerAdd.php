<?php

class controllerAdd extends Controller {

    function action_index() {
        if(self::isAjax()) {
            $db = new Db();
            $task = new Task();

            $data = json_decode(file_get_contents('php://input'), true);

            $task->setName($data['name']);
            $task->setEmail($data['email']);
            $task->setText($data['text']);
            $task->setStatus(false);

            $db->entityManager->persist($task);
            $db->entityManager->flush();

            $result = 'done!';

            die(json_encode($result));
        }

        $this->view->generate('add_view.php', 'template_view.php');
    }
}
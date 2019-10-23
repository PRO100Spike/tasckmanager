<?php

require_once 'app/models/Task.php';
require_once 'app/models/User.php';

class controllerMain extends Controller {

    const LIMIT_TASK = 3;

    function action_index() {
        //$user = new User();

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $db = new Db();
            $result = [];

            $taskRepository = $db->entityManager->getRepository('Task');


            $offset = 0;
            $data =  json_decode(file_get_contents('php://input'), true);
            if ($data['page']) {
                $offset = $data['page'] * self::LIMIT_TASK - self::LIMIT_TASK;
            }
            $tasks = $taskRepository->findBy([], [], self::LIMIT_TASK, $offset);

            foreach ($tasks as $task) {
                $curTask['id'] = $task->getId();
                $curTask['name'] = $task->getName();
                $curTask['email'] = $task->getEmail();
                $curTask['text'] = $task->getText();
                $curTask['status'] = $task->getStatus() ? '<i class="fas fa-calendar-check"></i> done' : '<i class="fas fa-calendar-times"></i> undone';

                $result['task'][] = $curTask;
            }
            $result['task_count'] =  $taskRepository->count([]);

            die(json_encode($result));
        }
        //var_dump($user);
        $this->view->generate('main_view.php', 'template_view.php');
    }

}
<?php

class controllerMain extends Controller {

    const LIMIT_TASK = 3;

    function action_index() {
        $task = $this->model('Task');

        if(self::isAjax()) {
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

        $this->view->generate('main_view.php', 'template_view.php', ['isGuest' => Session::isGuest()]);
    }

    function action_add() {
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
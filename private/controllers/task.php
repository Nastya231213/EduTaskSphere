

<?php
/**
 * @file task.php
 * @brief Містить клас, який керує процесом обробки створення, відображення, додавання підзадач, 
 */

/**
 * @class Task
 * @brief Контролер для обробки завдань.
 *
 * Клас Task розширює базовий клас Controller і відповідає за обробку створення, відображення, додавання підзадач, 
 * прийняття, відхилення та виконання завдань.
 */
class Task extends Controller
{

    function index()
    {
    }
    /**
     * @brief Метод для додавання нового завдання.
     *
     * Цей метод обробляє форму додавання завдання, валідує введені дані, створює нове завдання і перенаправляє на 
     * сторінку додавання підзадач.
     *
     * @return void
     */
    function add()
    {
        $errors = array();
        if (count($_POST) > 0) {
            $validator = new Validation();
            if ($validator->validateTask($_POST)) {
                $description = $_POST['description'];
                $deadline = $_POST['deadline'];
                $subjectOfTheTask = $_POST['subject'];
                $type = $_POST['type'];
                $title = $_POST['title'];
                $task_id = randomString();
                $userId = getUserInformation('userId');
                $task = new SimpleTasks();
                $task->addToDatabase($description, $deadline, $subjectOfTheTask, $type, $title, $task_id, $userId);
                $this->redirect('task/addSubtasks/' . $task_id);
            }
            $errors = $validator->getErrors();
        }
        $this->view('createTask', ['errors' => $errors]);
    }
    /**
     * @brief Метод для додавання підзадач до завдання.
     *
     * Цей метод дозволяє користувачу додавати підзадачі до створеного завдання. Включає валідацію введених даних і 
     * додавання підзадач у базу даних.
     *
     * @param string $id Ідентифікатор завдання.
     * @return void
     */
    function addSubtasks($id = '')
    {
        $message = "";
        $pageTab = isset($_GET['tab']) ? $_GET['tab'] : 'test-question';
        if (!empty($id)) {
            $userModel = new UserModel();
            $taskModel = new TaskModel();
            $theCurrentTask = $taskModel->getTaskById($id);

            $creatorOfTheTask = $userModel->findUserByUrlAdress($theCurrentTask->userId);
        }
        if (isset($theCurrentTask->task_id) && $taskModel->findSubtask($theCurrentTask->task_id) && $theCurrentTask->type == 'Simple') {
            session_start();

            $message = 'Simple task consists of the one subtask!';
            $_SESSION['message'] = $message;
            $this->redirect('message');
        }
        if (count($_POST) > 0) {
            $subtaskFactory = new ConcreteSubTaskFactory();
            switch ($pageTab) {
                case 'test-question':
                    $question = $_POST['questionTest'];
                    $choices[] = $_POST['option1'];
                    $choices[] = $_POST['option2'];
                    $choices[] = $_POST['option3'];
                    $choices[] = $_POST['option4'];

                    $correctAnswer = $_POST['correctAnswer'];
                    $testQuestion = $subtaskFactory->createTestTask($question, $correctAnswer, $choices, $id);
                    $strategy = $testQuestion->getStrategy();
                    $strategy->addToDatabase($testQuestion);
                    break;
                case 'open-ended-question':
                    $question = $_POST['question'];
                    $correctAnswer = $_POST['correctAnswer'];
                    $openEndedQuestion = $subtaskFactory->createOpenEndedTask($question, $correctAnswer, $id);
                    $strategy = $openEndedQuestion->getStrategy();
                    $strategy->addToDatabase($openEndedQuestion);
                    break;
                case 'multiplechoice-question':
                    $question = $_POST['questionMultichoice'];
                    $choices = $_POST['choices'];
                    $correctAnswersIndexes = isset($_POST['correctAnswers']) ? $_POST['correctAnswers'] : [];
                    $correctAnswers = array();
                    foreach ($correctAnswersIndexes as $index) {
                        $correctAnswers[] = $choices[$index - 1];
                    }
                    $multiplechoiceQuestion = $subtaskFactory->createMultipleChoiceTask($question, $choices, $correctAnswers, $id);
                    $strategy = $multiplechoiceQuestion->getStrategy();
                    $strategy->addToDatabase($multiplechoiceQuestion);
                    break;
            }
            if ($theCurrentTask->type == 'simple') {
                $message = 'Simple task consists of the one subtask!';
                $this->redirect('messagePage?message=' . $message);
            } else {
                $message = "Subtask was successfully added";
            }
        }

        $this->view('simpleTask', ['task' => $theCurrentTask, 'user' => $creatorOfTheTask, 'pageTab' => $pageTab, 'message' => $message]);
    }
    /**
     * @brief Метод для відображення завдань.
     *
     * Цей метод отримує всі завдання для поточного користувача і відображає їх на сторінці.
     *
     * @return void
     */
    function display()
    {


        $userId = $_SESSION['user']->userId;
        $data['role'] = getUserType();
        $taskModel = new TaskModel();
        //get message from the session if there is present it
        $data = getMessage($data);
        $data['tasks'] = $taskModel->getTasksForDisplaying($data['role'], $userId);
        $this->view('display-task', $data);
    }
    /**
     * @brief Метод для відображення підзадач.
     *
     * Цей метод отримує всі підзадачі для вказаного завдання і відображає їх на сторінці.
     *
     * @param string $id Ідентифікатор завдання.
     * @return void
     */
    function subtasks($id = '')
    {
        $taskModel = new TaskModel();
        $userType = getUserType();
        $flag = false;

        if ($userType == 'pupil') {
            $pupilId = $_SESSION['user']->userId;
            $flag = true;
            $allSubtasksOfTheTask = $taskModel->getAllSubtasks($id, $flag, $pupilId);
        } else {
            $allSubtasksOfTheTask = $taskModel->getAllSubtasks($id, $flag);
        }

        $this->view('display-subtasks', ['subtasks' => $allSubtasksOfTheTask, 'role' => $userType]);
    }

    /**
     * @brief Метод для надсилання завдання учням.
     *
     * Цей метод дозволяє вчителю надіслати завдання учням.
     *
     * @param string $id Ідентифікатор завдання.
     * @return void
     */
    function sendToPupils($id = '')
    {
        $pagination = Pagination::getInstance();
        $offset = $pagination->fromWhich;
        $currentTeacherId = $_SESSION['user']->userId;

        if (!empty($id)) {
            $userModel = new UserModel();
            $taskModel = new TaskModel();
            $theCurrentTask = $taskModel->getTaskById($id);

            $creatorOfTheTask = $userModel->findUserByUrlAdress($theCurrentTask->userId);

            if (count($_POST) > 0) {
                $dataTaskToPupil['pupilId'] = $_POST['userId'];
                $dataTaskToPupil['taskId'] = $id;
                $dataTaskToPupil['completionStatus'] = "Not Started";
                $SendCommand = new SendTaskToPupil($dataTaskToPupil);
                $invoker = new CommandInvoker();
                $invoker->setCommand($SendCommand);
                $invoker->executeCommand();
            }
            if (isset($_GET['keyToFind'])) {
                $pupils = getPupilsThatNotHaveTask($id, $currentTeacherId, $_GET['keyToFind'], $offset);
            } else {
                $pupils = getPupilsThatNotHaveTask($id, $currentTeacherId, $offset);
            }
        }
        $this->view('sendToPupils', ['task' => $theCurrentTask, 'user' => $creatorOfTheTask, 'pupils' => $pupils, 'pagination' => $pagination]);
    }
    /**
     * @brief Метод для прийняття завдання учнем.
     *
     * Цей метод дозволяє учню прийняти завдання.
     *
     * @param string $taskId Ідентифікатор завдання.
     * @return void
     */
    function accept($taskId)
    {

        $pupilId = $_SESSION['user']->userId;
        $inProgressState = new InProgressState();

        if ($inProgressState->updateState($taskId, $pupilId)) {
            $_SESSION['messageSuccess'] = "Successfully the task was accepted";
        } else {
            $_SESSION['messageError'] = "Something goes wrong..";
        }

        $this->redirect('task/display');
    }

    /**
     * @brief Метод для відхилення завдання учнем.
     *
     * Цей метод дозволяє учню відхилити завдання.
     *
     * @param string $taskId Ідентифікатор завдання.
     * @param string $userId Ідентифікатор користувача.
     * @return void
     */
    function reject($taskId, $userId)
    {

        $pupil = new User($userId);
        $deleteCommand = new DeleteTaskFromPupil($taskId, $_SESSION['user']->userId);
        $invoker = new CommandInvoker();
        $invoker->setCommand($deleteCommand);
        $invoker->executeCommand();
        $notificationManger = new NotificationManager();
        $notificationManger->addObserver($pupil);
        $notificationManger->notifyRejection();
        if ($invoker->executeCommand()) {
            $_SESSION['messageSuccess'] = "Successfully the task was rejected";
        } else {
            $_SESSION['messageError'] = "Something goes wrong..";
        }
        $this->redirect('task/display');
    }
    /**
     * @brief Метод для відображення вирішених завдань.
     *
     * Цей метод отримує всі вирішені завдання для учнів вчителя і відображає їх на сторінці.
     *
     * @return void
     */
    function solved()
    {
        $userModel = new UserModel();



        $data['pupils'] = $userModel->getAllPupilsByTeacherId($_SESSION['user']->userId);
        foreach ($data['pupils'] as $pupil) {
            $userSolutions = $userModel->getAllSolutionsToTask($pupil->userId);
            foreach ($userSolutions as $theUserSolution) {
                $data['solutions'][] = $theUserSolution;
            }
        }

        $this->view('solvedTasks', $data);
    }
    /**
     * @brief Метод для додавання коментарів до підзадач.
     *
     * Цей метод дозволяє вчителю додавати коментарі до підзадач учня.
     *
     * @param string $taskId Ідентифікатор завдання.
     * @param string $userId Ідентифікатор користувача.
     * @return void
     */
    function answer($taskId, $userId)
    {
        $taskModel = new TaskModel();
        $userModel = new UserModel();


        $theCurrentTask = $taskModel->getTaskById($taskId);

        $allSubtasksOfTheTask = $taskModel->getAllSubtasks($taskId, true, $userId);

        if (isset($_POST) && count($_POST) > 0) {
            $teachersComments = array();
            foreach ($allSubtasksOfTheTask as $subtask) {
                $teachersComments[] = $_POST['comment' . $subtask->subtaskId];
            }
        }
        $creatorOfTheTask = $userModel->findUserByUrlAdress($theCurrentTask->userId);

        $this->view('perform_task', ['task' => $theCurrentTask, 'user' => $creatorOfTheTask, 'subtasks' => $allSubtasksOfTheTask, 'show_answers' => true]);
    }

    
    /**
     * @brief Метод для виконання завдання учнем.
     *
     * Цей метод дозволяє учню виконувати завдання і зберігати відповіді.
     *
     * @param string $taskId Ідентифікатор завдання.
     * @param string $save Прапорець для збереження відповіді.
     * @return void
     */
    function perfom($taskId, $save = '')
    {

        $taskModel = new TaskModel();
        $userModel = new UserModel();
        $pupilId = $_SESSION['user']->userId;

        $theCurrentTask = $taskModel->getTaskById($taskId);
        if ($taskModel->isCompletedTaskByPupil($taskId, $pupilId)) {
            $_SESSION['messageError'] = "The task has already been done!";
            $this->redirect('task/display');
        } else {
            $allSubtasksOfTheTask = $taskModel->getAllSubtasks($taskId);
            $creatorOfTheTask = $userModel->findUserByUrlAdress($theCurrentTask->userId);
            if (count($_POST) > 0) {
                $_POST['pupilId'] = $pupilId;
                $taskModel->addAnswersToTask($allSubtasksOfTheTask, $_POST);
                if (empty($save)) {
                    $completedState = new CompletedState();
                    $completedState->updateState($theCurrentTask->task_id, $pupilId);
                }
            }

            $this->view('perform_task', ['task' => $theCurrentTask, 'user' => $creatorOfTheTask, 'subtasks' => $allSubtasksOfTheTask, 'show_answers' => false]);
        }
    }
}

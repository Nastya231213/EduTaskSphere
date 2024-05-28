<?php

/**
 * @file pupils.php
 * @brief Клас для управління учнями, пов'язаними з вчителем.
 */
/**
 * Контролер Pupils забезпечує функціонал для перегляду, додавання та видалення учнів
 * для поточного вчителя.
 */
class Pupils extends Controller
{
    /**
     * @brief Відображає список учнів для поточного вчителя.
     * 
     * Цей метод отримує список усіх учнів, пов'язаних з вчителем, за допомогою
     * моделі UserModel, обробляє пагінацію та відображає дані на сторінці.
     */
    function index()
    {
        $userModel = new UserModel();
        $pagination = Pagination::getInstance();
        $offset = $pagination->fromWhich;


        $data['pupils'] = $userModel->getAllPupilsByTeacherId($_SESSION['user']->userId);
        $data['pagination'] = $pagination;

        $data = getMessage($data);

        $this->view("teacher'sPupilsPage", $data);
    }
    /**
     * @brief Додає нового учня до списку вчителя.
     * 
     * Метод обробляє POST-запит для додавання нового учня до списку вчителя.
     * Якщо у GET-запиті присутній ключ для пошуку, він також обробляє пошук
     * учнів за ключовими словами.
     */
    function addPupil()
    {
        $pagination = Pagination::getInstance();
        $teacherId = $_SESSION['user']->userId;

        if (count($_POST) > 0) {
            $dataToAddPupil['pupil_id'] = $_POST['userId'];
            $dataToAddPupil['teacher_id'] = $teacherId;
            $dataToAddPupil['status'] = "pending";
            $addPupilCommand = new AddPupilToTeacher($dataToAddPupil);
            $invoker = new CommandInvoker();
            $invoker->setCommand($addPupilCommand);
            $invoker->executeCommand();

            //send notification
            $user = new User($dataToAddPupil['pupil_id']);
            $notificationManager = new NotificationManager();
            $notificationManager->addObserver($user);
            $notificationManager->notifyObserverAboutPupilAddition();
        }
        if (isset($_GET['keyToFind'])) {

            $userModel = new UserModel();
            $pupilsBySearch = $userModel->findPupilsToAddByKeyword($_GET['keyToFind'], $teacherId);
            $data['searchResult'] = $pupilsBySearch;
        }
        $data['pagination'] = $pagination;
        $this->view("addPupil", $data);
    }
    /**
     * @brief Видаляє учня зі списку вчителя.
     * 
     * Метод видаляє учня з списку вчителя за допомогою командного патерну
     * і перенаправляє на сторінку зі списком учнів.
     * 
     * @param int $id Ідентифікатор учня, якого потрібно видалити.
     */
    function delete($id)
    {
        $teacherId = $_SESSION['user']->userId;
        $deletePupilFromTeacher = new DeletePupilFromTeacher(['pupil_id' => $id, 'teacher_id' => $teacherId]);
        $invoker = new CommandInvoker();
        $invoker->setCommand($deletePupilFromTeacher);
        if ($invoker->executeCommand()) {
            $_SESSION['messageSuccess'] = 'The pupil was successfully deleted from the list of your pupils';
        } else {
            $_SESSION['messageError'] = 'Something goes wrong..';
        }
        $this->redirect('pupils');
    }
}

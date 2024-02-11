<?php


class Pupils extends Controller
{

    function index()
    {
        $userModel = new UserModel();
        $pagination = Pagination::getInstance();
        $offset = $pagination->fromWhich;
        if (isset($_SESSION['messageSuccess'])) {
            $data['messageSuccess'] = $_SESSION['messageSuccess'];
            unset($_SESSION['messageSuccess']);
        } else if (isset($_SESSION['messageError'])) {
            $data['messageError'] = $_SESSION['messageError'];
            unset($_SESSION['messageError']);

        }

        $data['pupils'] = $userModel->getAllPupilsByTeacherId($_SESSION['user']->userId);
        $data['pagination'] = $pagination;
        $this->view("teacher'sPupilsPage", $data);
    }

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

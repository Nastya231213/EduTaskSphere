

<?php
class Notification extends Controller
{
    function index()
    {
        $notificationManager=new NotificationManager();
        $currentUserId=$_SESSION['user']->userId;
        $data['allNotifications']=$notificationManager->getAllNotifications($currentUserId);
        if(isset($_SESSION['messageSuccess'])){
            $data['messageSuccess']=$_SESSION['messageSuccess'];
            unset($_SESSION['messageSuccess']);
        }else if(isset($_SESSION['messageError'])){
            $data['messageError']=$_SESSION['messageError'];
            unset($_SESSION['messageError']);

        }
        $this->view("notifications",$data);
    }
    function accept($id){
        $receiverId=$_SESSION['user']->userId;
        $notificationManager=new NotificationManager();

        $userObserver=new User($receiverId);
        if($userObserver->acceptRequest($id) && $notificationManager->deleteNotificationOfTheTeacher($id)){
            $user = new User($id);
            $notificationManager->addObserver($user);
            $notificationManager->notifyAboutAcception();
            $_SESSION['messageSuccess']="The request was accepted!";
        }else{
            $_SESSION['messageError']="Something goes wrong";
        }
        $this->redirect("notification");

    }

}

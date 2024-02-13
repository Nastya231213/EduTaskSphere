

<?php

class NotificationManager
{
    private $observer;
    private $model;
    private $tableName = "notification";
    private  const typesOfNotifications = ['Alert', 'Confirmation', 'Informational'];

    function __construct()
    {
        $this->model=new Model();
    }
    public function addObserver(Observer $observer)
    {
        $this->observer = $observer;
    }
    public function deleteNotificationById($id){
        return $this->model->delete($this->tableName,['id'=>$id]);
    }
 

    public function notifyObserverAboutPupilAddition()
    {
        $teacherId = $_SESSION['user']->userId;
        $message = "Teacher $teacherId has requested to add a new pupil.";
        $title = "Pupil Addition Request";
        $type = self::typesOfNotifications[1];
        $this->observer->sendNotification($message, $title, $type);
    }
    public function notifyAboutAcception(){
        $pupilId = $_SESSION['user']->userId;
        $message = "Pupil $pupilId has accepted the request.";
        $title = "Pupil Addition Accepted";
        $type = self::typesOfNotifications[2]; 
        $this->observer->sendNotification($message, $title, $type);
        
    }
    public function getAllNotifications($userId)
    {
        return $this->model->select($this->tableName,['receiver_id'=>$userId]);
    }

    public function deleteNotificationOfTheTeacher($senderId){
        $receiverId=$_SESSION['user']->userId;
        return $this->model->delete($this->tableName,['receiver_id'=>$receiverId,'sender_id'=>$senderId]);
    }
}

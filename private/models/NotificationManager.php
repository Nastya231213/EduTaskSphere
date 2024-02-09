

<?php

class NotificationManager
{
    private $observer;
    public function addObserver(Observer $observer)
    {
        $this->observer = $observer;
    }


    public function notifyObserverAboutPupilAddition()
    {
        $teacherId = $_SESSION['user']->userId;
        $message = "Teacher $teacherId has requested to add a new pupil.";
        $title = "Pupil Addition Request";
        $this->observer->sendNotification($message, $title);
    }
}

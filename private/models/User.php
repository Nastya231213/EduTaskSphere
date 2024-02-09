
<?php

class User implements Observer
{
    private $id;
    private $model;
    public function __construct($id)
    {
        $this->model = new Model();
        $this->id = $id;
    }
    public function sendNotification(string $message, string $title)
    {
        $query = "INSERT iNTO notification(title,message,user_id) VALUES (:title,:message,:user_id)";
        $this->model->query($query);
        $this->model->bind(':title', $title);
        $this->model->bind(':message', $message);
        $this->model->bind(':user_id', $this->id);
        $this->model->execute();
    }
}

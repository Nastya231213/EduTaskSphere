
<?php
//Concrete Observer
class User implements Observer
{
    private $id;
    private $model;
    public function __construct($id)
    {
        $this->model = new Model();
        $this->id = $id;
    }
    public function sendNotification(string $message, string $title,string $type)
    {
        $senderId=$_SESSION['user']->userId;
    
        $query = "INSERT INTO notification (title, message, receiver_id, type, sender_id) VALUES (:title, :message, :receiver_id, :type, :sender_id)
        ";
        $this->model->query($query);
        $this->model->bind(':title', $title);
        $this->model->bind(':message', $message);
        $this->model->bind(':receiver_id', $this->id);
        $this->model->bind(':sender_id',$senderId);
        $this->model->bind(':type',$type);
        $this->model->execute();
    }

    public function acceptRequest($teacherId){
        $tableName="teacher_pupil_relation";
        $pupilId=$_SESSION['user']->userId;
       return $this->model->update($tableName,['status'=>'aссepted'],['teacher_id'=>$teacherId,'pupil_id'=>$pupilId]);
    }
    public function getUserId(){
        return $this->id;
    }
}

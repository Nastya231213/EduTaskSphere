

<?php


//Template Method
abstract class Tasks
{

    protected $model;

    protected $tableName = "tasks";

    abstract public  function addSubtask(SubTask $subtask);

    public function addToDatabase($description, $deadline, $subject, $type, $title, $task_id,$userId)
    {        

        $data['task_id']=$task_id;
        $data['description']=$description;
        $data['title']=$title;

        $data['deadline']=$deadline;
        $data['created_at']=date("Y-m-d H:i:s");
        $data['subject']=$subject;
        $data['type']=$type;
        $data['userId']=$userId;

     
        $this->model->insert($this->tableName,$data);

    }   
    public function findTaskInDatabase($task_id)
    {
        return $this->model->selectOne($this->tableName, ['task_id' => $task_id]);
    }
    public function findAllTheTasks(){
        $database=new Database();
    $tasks= $database->query("SELECT tasks.* , users.firstName,users.lastName from tasks INNER JOIN users ON tasks.userId=users.userId");
        return $database->resultSet();
    }
   
    
}

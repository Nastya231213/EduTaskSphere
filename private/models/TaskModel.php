<?php

class TaskModel extends Model
{
    private $tableName='tasks';
    private $tableNameOfOptions='test_options';

    public function __construct()
    {
        parent::__construct();
    }
  
    function getTaskById($task_id)
    {
        $tableName = 'tasks';
        return $this->selectOne($tableName, ['task_id' => $task_id]);
    }
    function getAllSubtasks($taskId){
        $subtasks=$this->select('subtask',['taskId'=>$taskId]);
        $num=count($subtasks);
        for($i=0;$i<$num;$i++){
            if($subtasks[$i]->subtaskType=='test-question' || $subtasks[$i]->subtaskType=='multiplechoice-questions'){
                $subtasks[$i]->choices=$this->getChoices($subtasks[$i]->subtaskId);
            }
        }
    
        return $subtasks;
    }
    function getChoices($subtaskId){


        return $this->select($this->tableNameOfOptions,['subtaskId'=>$subtaskId]);
    }


    function findSubtask($id)
    {
        $tableName='subtask';
       return  $this->selectOne($tableName,['taskId'=>$id]);
    }
}

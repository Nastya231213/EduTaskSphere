
<?php
class SimpleTasks extends Tasks
{
    private $subtask;
 
    function __construct()
    {
        $this->model = new Model();
    }
    function addSubtask(SubTask $subtask)
    {
        
    }
    function findSubtask($id)
    {
        $tableName='subtask';
       return  $this->model->selectOne($tableName,['taskId'=>$id]);
    }

    
    function removeSubtask(SubTask $subtask)
    {
        
    }
   
}

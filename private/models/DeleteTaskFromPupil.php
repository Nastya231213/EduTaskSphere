
<?php

class DeleteTaskFromPupil implements Command
{

    private $model;
    private $taskId;
    private $pupilId;
    private $tableName = "pupilstasks";
    public function __construct($taskId,$pupilId)
    {
        $this->taskId=$taskId;
        $this->pupilId=$pupilId;
        $this->model = new Model();
        
    }

    public function execute()
    {

        return $this->model->delete($this->tableName,['taskId'=>$this->taskId,'pupilId'=>$this->pupilId]);
    }
}

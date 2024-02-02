<?php

class SendTaskToPupil implements Command{

 private $model;
    private $taskData;
    private $tableName="pupilstasks";
    public function __construct($taskData)
    {
        $this->model=new Model();
        $this->taskData=$taskData;
    }

    public function execute(){
        
        $this->model->insert($this->tableName,$this->taskData);

    }

}
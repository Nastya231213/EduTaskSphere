<?php


class CompletedState implements TasksState{
    private $state="Completed";
    private $tableName="pupilstasks";

    public function updateState($taskId,$pupilId) {
       $model=new Model();
       return $model->update($this->tableName,['completionStatus'=>$this->state],['taskId'=>$taskId,'pupilId'=>$pupilId]);

    }
}
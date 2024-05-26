


<?php 

class ReviewState implements TasksState {
    private $state="Review";
    private $tableName="pupilstasks";

    public function updateState($taskId,$pupilId) {
       $model=new Model();
       return $model->update($this->tableName,['completionStatus'=>$this->state],['taskId'=>$taskId,'pupilId'=>$pupilId]);

    }
}
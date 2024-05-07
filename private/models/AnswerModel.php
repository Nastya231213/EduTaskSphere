<?php


class AnswerModel{
    protected $table = 'answers_of_the_pupil';

    protected $model;

    public function __construct()
    {
        $this->model=new Model();
    }
    function getAnswer($answerId){
        return $this->model->selectOne($this->table,['id'=>$answerId]);
    
    }

}
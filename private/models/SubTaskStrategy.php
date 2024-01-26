<?php 

interface SubTaskStrategy{
    public function evaluateAnswer($userAnswer,$correctAnswer);
    public function addToDatabase(SubTask $subTask);
    
}
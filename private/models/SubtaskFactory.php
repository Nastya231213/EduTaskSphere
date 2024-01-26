<?php

interface SubtaskFactory{
    public function createTestTask($question, $correctAnswer,$choices,$taskId): SubTask;
    public function createOpenEndedTask($question, $correctAnswer,$taskId): SubTask;
    public function createMultipleChoiceTask($question, $choices, $correctAnswers,$taskId): SubTask;
}
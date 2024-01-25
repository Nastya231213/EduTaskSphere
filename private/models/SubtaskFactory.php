<?php

interface SubtaskFactory{
    public function createTestTask($question, $correctAnswer,$choices): SubTask;
    public function createOpenEndedTask($question, $correctAnswer): SubTask;
    public function createMultipleChoiceTask($question, $choices, $correctAnswers): SubTask;
}
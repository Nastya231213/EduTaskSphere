<?php
class DifficultyFilter implements Interpreter {
    private $difficulty;

    public function __construct($difficulty) {
        $this->difficulty = $difficulty;
    }

    public function interpret($tasks) {
        if (!is_array($tasks) || empty($tasks)) {
            throw new InvalidArgumentException('Invalid tasks array.');
        }
        return array_filter($tasks, function($task) {
            return $task->getDifficulty() === $this->difficulty;
        });
    }
}
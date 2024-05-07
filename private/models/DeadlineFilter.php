<?php 

class DeadlineFilter implements Interpreter {
    private $deadline;

    public function __construct($deadline) {
        $this->deadline = $deadline;
    }

    public function interpret($tasks) {
        if (!is_array($tasks) || empty($tasks) ) {
            throw new InvalidArgumentException('Invalid tasks array.');
        }

        return array_filter($tasks, function($task) {
            return $task->getDeadline() <= $this->deadline;
        });
    }

  
}

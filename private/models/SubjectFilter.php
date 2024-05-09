<?php
class SubjectFilter implements Interpreter {
    private $subject;

    public function __construct($subject) {
        $this->subject = $subject;
    }

    public function interpret($tasks) {
        if(!is_array($tasks)){
             throw new InvalidArgumentException('Tasks must be provided as an array of tasks');
        }
        return array_filter($tasks, function($task) {
            return $task->subject === $this->subject;
        });
    }
}
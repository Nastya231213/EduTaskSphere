<?php
class SearchKeyFilter implements Interpreter {
    private $searchKey;

    public function __construct($searchKey) {
        $this->searchKey = $searchKey;
    }

    public function interpret($tasks) {
 
        if (!is_array($tasks) || empty($tasks)) {
            throw new InvalidArgumentException('Invalid tasks array.');
        }

        return array_filter($tasks, function($task) {
            $titleMatch = stripos(strtolower($task->title), strtolower($this->searchKey)) !== false;
            $descriptionMatch = stripos(strtolower($task->description), strtolower($this->searchKey)) !== false;
            
            return $titleMatch || $descriptionMatch;
        });
    }
}
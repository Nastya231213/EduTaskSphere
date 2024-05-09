
<?php
class ComplexTask extends Tasks
{
    private $subtasks = [];

    public function addSubtask($subtask) {
        $this->subtasks[] = $subtask;
    }

    public function removeSubtask($subtask) {
        $key = array_search($subtask, $this->subtasks);
        if ($key !== false) {
            unset($this->subtasks[$key]);
        }
    }

    public function updateSubtask($subtaskId, $newSubtask) {
        foreach ($this->subtasks as $key => $subtask) {
            if ($subtask->getId() === $subtaskId) {
                $this->subtasks[$key] = $newSubtask;
                break; 
            }
        }
    }

}

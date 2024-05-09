
<?php
class SimpleTasks extends Tasks {
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

    public function updateSubtask($oldSubtask, $newSubtask) {
        $key = array_search($oldSubtask, $this->subtasks);
        if ($key !== false) {
            $this->subtasks[$key] = $newSubtask;
        }
    }
}


<?php
/**
 * @file ComlexTask.php
 * @brief Файл містить клас ComplexTask , що відповідає за взаємодію зі складними завданнями, що складаються з підзавдань
 */
/**
 * @class ComplexTask
 * @brief Клас для роботи зі складними завданнями, що складаються з підзавдань.
 *
 * Клас ComplexTask наслідує від класу Tasks і додає функціональність для роботи з підзавданнями.
 */
class ComplexTask extends Tasks
{
    /**
     * @var array $subtasks Масив підзавдань, що складають складне завдання.
     */
    private $subtasks = [];
    /**
     * @brief Додає підзавдання до складного завдання.
     *
     * @param mixed $subtask Підзавдання, яке додається до складного завдання.
     */
    public function addSubtask($subtask)
    {
        $this->subtasks[] = $subtask;
    }
    /**
     * @brief Видаляє підзавдання зі складного завдання.
     *
     * @param mixed $subtask Підзавдання, яке потрібно видалити.
     */
    public function removeSubtask($subtask)
    {
        $key = array_search($subtask, $this->subtasks);
        if ($key !== false) {
            unset($this->subtasks[$key]);
        }
    }

    /**
     * @brief Оновлює підзавдання у складному завданні.
     *
     * @param int $subtaskId Ідентифікатор підзавдання, яке потрібно оновити.
     * @param mixed $newSubtask Нове підзавдання для заміни старого.
     */
    public function updateSubtask($subtaskId, $newSubtask)
    {
        foreach ($this->subtasks as $key => $subtask) {
            if ($subtask->getId() === $subtaskId) {
                $this->subtasks[$key] = $newSubtask;
                break;
            }
        }
    }
}

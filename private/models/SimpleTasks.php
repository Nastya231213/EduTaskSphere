
<?php
/**
 * @file SimpleTasks.php
 * @brief Файл містить визначення класу SimpleTasks.
*/
/**
 * @class SimpleTasks
 * @brief Клас для управління простими завданнями, які можуть містити підзавдання.
 *
 * Клас SimpleTasks розширює клас Tasks і надає можливість додавати, видаляти та оновлювати підзавдання.
 */
class SimpleTasks extends Tasks {
    /**
     * @var array $subtasks Масив підзавдань.
     */
    private $subtasks = [];

    /**
     * @brief Додати підзавдання.
     *
     * Цей метод додає нове підзавдання до масиву підзавдань.
     *
     * @param mixed $subtask Підзавдання для додавання.
     */
    public function addSubtask($subtask) {
        $this->subtasks[] = $subtask;
    }

    /**
     * @brief Видалити підзавдання.
     *
     * Цей метод видаляє підзавдання з масиву підзавдань.
     *
     * @param mixed $subtask Підзавдання для видалення.
     */
    public function removeSubtask($subtask) {
        $key = array_search($subtask, $this->subtasks);
        if ($key !== false) {
            unset($this->subtasks[$key]);
        }
    }

    /**
     * @brief Оновити підзавдання.
     *
     * Цей метод оновлює наявне підзавдання новим підзавданням у масиві підзавдань.
     *
     * @param mixed $oldSubtask Підзавдання для оновлення.
     * @param mixed $newSubtask Нове підзавдання.
     */
    public function updateSubtask($oldSubtask, $newSubtask) {
        $key = array_search($oldSubtask, $this->subtasks);
        if ($key !== false) {
            $this->subtasks[$key] = $newSubtask;
        }
    }
}
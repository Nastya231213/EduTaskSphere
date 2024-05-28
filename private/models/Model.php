

<?php
/**
 * @file Model.php
 * @brief Файл містить визначення класу Model.
 */
/**
 * @class Model
 * @brief Клас для взаємодії з базою даних.
 *
 * Клас Model забезпечує методи для вибірки, вставки, оновлення та видалення даних з бази даних.
 * Він успадковується від класу Database, який містить основні методи для роботи з базою даних.
 */
class Model extends Database
{
    /**
     * @brief Конструктор класу Model.
     *
     * Викликає конструктор базового класу Database.
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * @brief Метод для вибірки всіх записів з таблиці.
     *
     * @param string $table Назва таблиці.
     * @param array $where Ассоціативний масив з умовами для вибірки (опціонально).
     * @return array Масив вибраних записів.
     */
    public function select($table, $where = [])
    {
        $sql = "SELECT * FROM $table";
        if (!empty($where)) {
            $sql .= " WHERE ";
            $iterator = 0;
            foreach ($where as $key => $value) {
                $sql .= $key . " = :" . $key;
                if ($iterator < (count($where) - 1)) {
                    $sql .= " AND ";
                }
                $iterator++;
            }
        }

        $this->query($sql);
        if (!empty($where)) {
            foreach ($where as $key => $value) {
                $this->bind(':' . $key, $value);
            }
        }
        return $this->resultset();
    }
    /**
     * @brief Метод для вибірки одного запису з таблиці.
     *
     * @param string $table Назва таблиці.
     * @param array $where Ассоціативний масив з умовами для вибірки (опціонально).
     * @return mixed Вибраний запис або false, якщо запис не знайдений.
     */
    public function selectOne($table, $where = [])
    {
        $sql = "SELECT * FROM $table";
        if (!empty($where)) {
            $sql .= " WHERE ";
            $iterator = 0;
            foreach ($where as $key => $value) {
                $sql .= $key . " = :" . $key;
                if ($iterator < (count($where) - 1)) {
                    $sql .= " AND ";
                }
                $iterator++;
            }
        }

        $this->query($sql);
        if (!empty($where)) {
            foreach ($where as $key => $value) {
                $this->bind(':' . $key, $value);
            }
        }
        return $this->single();
    }
    /**
     * @brief Метод для вставки нового запису в таблицю.
     *
     * @param string $table Назва таблиці.
     * @param array $data Ассоціативний масив з даними для вставки.
     * @return bool Результат виконання операції (true - успіх, false - помилка).
     */
    public function insert($table, $data)
    {
        $keys = implode(',', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($keys) VALUES($values)";

        $this->query($sql);
        foreach ($data as $key => $value) {
            $this->bind(':' . $key, $value);
        }
        return $this->execute();
    }
     /**
     * @brief Метод для видалення записів з таблиці.
     *
     * @param string $table Назва таблиці.
     * @param array $where Ассоціативний масив з умовами для видалення.
     * @return bool Результат виконання операції (true - успіх, false - помилка).
     */
    public function delete($table, $where = [])
    {
        if (empty($where)) {
            return false;
        }
        $sql = "DELETE FROM $table WHERE ";
        $iterator = 0;
        foreach ($where as $key => $value) {
            $sql .= $key . "=:" . $key;
            if ($iterator < (count($where) - 1)) {
                $sql .= " AND ";
            }
            $iterator++;
        }
        $this->query($sql);

        foreach ($where as $key => $value) {
            $this->bind(':' . $key, $value);
        }
        return $this->execute();
    }
    public function update($table, $data = [], $where = [])
    {
        if (empty($where) && empty($data)) {
            return false;
        }

        $sql = "UPDATE $table SET ";
        $iterator = 0;

        foreach ($data as $key => $value) {
            $sql .= $key . " = :" . $key;
            if ($iterator < (count($data) - 1)) {
                $sql .= ", ";
            }
            $iterator++;
        }

        $sql .= " WHERE ";
        $iterator = 0;

        foreach ($where as $key => $value) {
            $sql .= $key . " = :" . $key;
            if ($iterator < (count($where) - 1)) {
                $sql .= " AND ";
            }
            $iterator++;
        }

        $this->query($sql);

        foreach ($data as $key => $value) {
            $this->bind(':' . $key, $value);
        }

        foreach ($where as $key => $value) {
            $this->bind(':' . $key, $value);
        }
        return $this->execute();
    }
}

<?php 
/**
 * @file database.php
 * @brief Файл містить визначення класу Database для роботи з базою даних
 */
/**
 * @class Database
 *
 * @brief Клас для роботи з базою даних, що використовує PDO для виконання запитів.
 */
class Database
{
    /**
     * @var string $host Ім'я хоста бази даних.
     */
    private $host = DB_HOST;
    
    /**
     * @var string $user Ім'я користувача бази даних.
     */
    private $user = DB_USER;
    
    /**
     * @var string $pass Пароль користувача бази даних.
     */
    private $pass = DB_PASS;
    
    /**
     * @var string $dbname Ім'я бази даних.
     */
    private $dbname = DB_NAME;

    /**
     * @var PDO $dbh Об'єкт з'єднання з базою даних.
     */
    private $dbh;

    /**
     * @var string $error Повідомлення про помилку.
     */
    private $error;

    /**
     * @var PDOStatement $stmt Підготовлене твердження.
     */
    private $stmt;

    /**
     * Конструктор класу.
     * 
     * Встановлює з'єднання з базою даних, використовуючи параметри класу.
     */
    public function __construct()
    {
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
        // Встановлення опцій
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        // Створення нового екземпляру PDO
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }

    /**
     * Підготовлює SQL-запит.
     *
     * @param string $query SQL-запит для підготовки.
     */
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    /**
     * Прив'язує значення до параметра в підготовленому запиті.
     *
     * @param string $param Ім'я параметра.
     * @param mixed $value Значення параметра.
     * @param int|null $type Тип даних параметра.
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Виконує підготовлений запит.
     *
     * @return bool Результат виконання запиту.
     */
    public function execute()
    {
        return $this->stmt->execute();
    }

    /**
     * Отримує всі результати виконаного запиту у вигляді об'єктів.
     *
     * @return array Результати запиту у вигляді масиву об'єктів.
     */
    public function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Отримує всі результати виконаного запиту у вигляді асоціативного масиву.
     *
     * @return array Результати запиту у вигляді асоціативного масиву.
     */
    public function resultSetArray()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Отримує один рядок результату виконаного запиту у вигляді об'єкта.
     *
     * @return object Один рядок результату у вигляді об'єкта.
     */
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Повертає кількість рядків, які були змінені останнім SQL-запитом.
     *
     * @return int Кількість змінених рядків.
     */
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
?>


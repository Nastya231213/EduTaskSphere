<?php


class Model extends Database
{
    public $errors = array();
    public function __construct()
    {
        if (!property_exists($this, 'table')) {
            $this->table = strtolower($this::class) . "s";
        }
    }

    public function where($column, $value)
    {
        $column = addslashes($column);

        $query = "select * from $this->table where $column=:value";
        $data = $this->query($query, [
            'value' => $value
        ]);
        if (is_array($data)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                }
            }
        }
        return $data;
    }
    public function whereOne($column, $value)
    {
        $column = addslashes($column);

        $query = "select * from $this->table where $column=:value";
        $data = $this->query($query, [
            'value' => $value
        ]);
        if (is_array($data)) {
            $data = $data[0];
        }

        return $data;
    }

    public function findAll($orderBy = 'asc')
    {
        $query = "select * from $this->table order by id $orderBy";



        $data = $this->query($query);

        //run functions after select
        if (is_array($data)) {
            if (property_exists($this, 'afterSelect')) {
                foreach ($this->afterSelect as $func) {
                    $data = $this->$func($data);
                }
            }
        }
        return $data;
    }

    public function insert($data)
    {

        //delete columns that aren't in the arra
        if (property_exists($this, 'allowedColumns')) {
            foreach ($data as $key => $column) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        if (property_exists($this, 'beforeInsert')) {
            foreach ($this->beforeInsert as $func) {
                $data = $this->$func($data);
            }
        }
        $keys = array_keys($data);
        $columns = implode(', ', $keys);
        $values = implode(', :', $keys);
        $query = "insert into $this->table ($columns) values(:$values)";

        return $this->query($query, $data);
    }
    public function update($id, $data)
    {
        if (property_exists($this, 'allowedColumns')) {
            foreach ($data as $key => $column) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        if (property_exists($this, 'beforeUpdate')) {
            foreach ($this->beforeUpdate as $func) {
                $data = $this->$func($data);
            }
        }
        $data['id'] = $id;
        $str = "";
        foreach ($data as $key => $value) {
            $str .= $key . "=:" . $key . ",";
        }
        $str = trim($str, ",");

        $query = "update $this->table set $str where id=:id";
        echo $query;
        return $this->query($query, $data);
    }
    public function delete($id)
    {

        $query = "delete from $this->table where id=:id";
        $data['id'] = $id;
        return $this->query($query, $data);
    }
}

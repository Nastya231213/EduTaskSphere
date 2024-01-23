

<?php
class UserModel extends Database
{
 
    protected $table='users';
    protected $model;
    public function __construct()
    {
        $this->model=new Model();
        
    }


    public function findUserByEmail($email)
    {

        return $this->model->select($this->table,['email'=>$email,"phone"=>"3erw","dfs"=>"sfds"]);
    }

    public function insertUser($data)
    {
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
        $query = "INSERT INTO users (firstName,lastName,email,password,role,gender) VALUES (:firstName,:lastName,:email,:password,:role,:gender,:date)";
        $this->query($query, [':firstName' => $data['firstName'], ':lastName' => $data['lastName'], ':email' => $data['email'], ':password' => $hashedPassword, ':role' => $data['role'], ':gender' => $data['gender']]);
        return $this->execute();
    }
}

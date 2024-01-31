

<?php
class UserModel 
{
 
    protected $table='users';
    protected $model;
    

    public function __construct()
    {
        $this->model=new Model();
        
    }


    public function findUserByEmail($email)
    {

        return $this->model->selectOne($this->table,['email'=>$email]);
    }

    public function getAllPupils(){
        $this->model->query("SELECT * FROM users WHERE role='pupil'");
        return $this->model->resultset();
    }
 

    public function findUserByUrlAdress($userId){
        return $this->model->selectOne($this->table,['userId'=>$userId]);

    }


    public function insertUser($data)
    {
        return $this->model->insert($this->table,$data);
    }
    
    public function makeUserid($data)
    {

          $data['userId'] = strtolower($data['firstName'] . '.' . $data['lastName']);
          if ($this->findUserByUrlAdress($data['userId'])) {
                $data['userId'] .= rand(100, 9999);
          }

          return $data;
    }

    

}

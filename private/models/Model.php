

<?php
class Model extends Database{
    public function __construct()
    {
        parent::__construct();
    }


    public function select($table,$where=[]){
        $sql="SELECT * FROM $table";
        if(!empty($where)){
            $sql.=" WHERE ";
            $iterator=0;
            foreach($where as $key=>$value){
                $sql.=$key." = :".$key;
                if($iterator<(count($where)-1)){
                    $sql.=" AND ";

                }
                $iterator++;

            }
        }
 
        $this->query($sql);
        if(!empty($where)){
            foreach($where as $key=>$value){
                $this->bind(':'.$key,$value);
            }
        }
        return $this->resultset();
    }
    
    public function selectOne($table,$where=[]){
        $sql="SELECT * FROM $table";
        if(!empty($where)){
            $sql.=" WHERE ";
            $iterator=0;
            foreach($where as $key=>$value){
                $sql.=$key." = :".$key;
                if($iterator<(count($where)-1)){
                    $sql.=" AND ";

                }
                $iterator++;

            }
        }
 
        $this->query($sql);
        if(!empty($where)){
            foreach($where as $key=>$value){
                $this->bind(':'.$key,$value);
            }
        }
        return $this->single();
    }
    public function insert($table,$data){
        $keys=implode(',',array_keys($data));
        $values=':'.implode(', :',array_keys($data));
        $sql="INSERT INTO $table ($keys) VALUES($values)";
     
        $this->query($sql);
        foreach($data as $key=>$value){
            $this->bind(':'.$key,$value);
        }
        return $this->execute();

    }
    public function delete($table,$where=[]){
        if(empty($where)){
            return false;
        }
        $sql="DELETE FROM $table WHERE ";
        $iterator=0;
        foreach($where as $key=>$value){
            $sql.=$key."=:" .$key;
            if($iterator<(count($where)-1)){
                $sql.=" AND ";
            }
            $iterator++;
        }
        $this->query($sql);
     
        foreach($where as $key=>$value){
            $this->bind(':'.$key,$value);
        }
        return $this->execute();

    }
  public function update($table, $data, $where = [])
    {
        if (empty($where)) {
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


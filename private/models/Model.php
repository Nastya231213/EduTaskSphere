

<?php
class Model{
    protected $db;
    public function __construct()
    {
        $this->db=new Database();
        
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
 
        $this->db->query($sql);
        if(!empty($where)){
            foreach($where as $key=>$value){
                $this->db->bind(':'.$key,$value);
            }
        }
        return $this->db->resultset();
    }
}
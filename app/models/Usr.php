<?php
class Usr{
    protected $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function register($data){
        // DB must check duplicate email
        // unique email has been promised by MySQL table restriction
        // ALTER TABLE `usr` ADD UNIQUE(`email`);
        $this->db->query('INSERT INTO usr (email, name, password) VALUES (:email, :name, :password)');
        $this->db->bind(':email', $data['email'], PDO::PARAM_STR);
        $this->db->bind(':name', $data['name'], PDO::PARAM_STR);
        $this->db->bind(':password', $data['password'], PDO::PARAM_STR);
        return $this->db->execute();
    }

    public function login($data){
        $row = $this->getUsrByEmail($data['email']);
        if(!$row) return false;
        if(password_verify($data['password'],$row->password)){
            return $row;
        }else{return false;}
    }

    public function hasRegistered($email){
        if ($this->getUsrByEmail($email)) return true;
        return false; 
    }
    
    private function getUsrByEmail($email){
        $this->db->query('SELECT * FROM usr WHERE email = :email');
        $this->db->bind(':email', $email, PDO::PARAM_STR);
        $this->db->execute();
        return $this->db->single();
    }

    private function getUserById(int $id){
        $this->db->query('SELECT * FROM usr WHERE id = :id');
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        $this->db->execute();
        return $this->db->single();
    }
}
?>
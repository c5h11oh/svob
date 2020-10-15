<?php

class Ord{
    protected $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function wordExist($word, $mode = VOC_CONTAINS){
        return !empty($this->wordLookup($word, $mode));
    }
    
    public function wordLookup($word, $mode = VOC_CONTAINS){
        $user_id = $_SESSION['user_id'];
        
        $modestr = 'LIKE :word';
        if($mode == VOC_EXACT)
            $modestr = '= :word ';
        
        if($user_id){    
            $this->db->query('SELECT * FROM ord WHERE word ' . $modestr . ' AND user_id = :uid');
            $this->db->bind(':uid', $user_id);
        }else{ 
            $this->db->query('SELECT * FROM ord WHERE word ' . $modestr);
        }
        if($mode == VOC_EXACT)
            $this->db->bind(':word', $word);
        else
            $this->db->bind(':word', '%'.$word.'%');

        $err = $this->db->execute();
        $result = $this->db->resultSet();
        return $result;
    }

    public function add($data){
        $this->db->query('INSERT INTO ord (word, user_id, meaning, example, link, visited_times, add_date) VALUES (:word, :userid, :meaning, :example, :link, :visited_times, CURRENT_DATE())');
        $this->db->bind(':word', $data['word']);
        $this->db->bind(':userid', $data['user_id']);
        $this->db->bind(':meaning', $data['meaning']);
        $this->db->bind(':example', $data['example']);
        $this->db->bind(':link', $data['link']);
        $this->db->bind(':visited_times', $data['visited_times']);
        $this->db->stmt->debugDumpParams();
        return $this->db->execute();
    }
}

?>
<?php

class Word
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getWordByString($searchWord)
    {
        $this->db->query('SELECT * from word WHERE word LIKE :searchWord OR form2 LIKE :searchWord OR form3 LIKE :searchWord OR form4 LIKE :searchWord OR form5 LIKE :searchWord');
        $this->db->bind(':searchWord', '%'.$searchWord.'%');
        $this->db->execute();
        $result = $this->db->resultSet();

        return $result;
    }

    public function getWordById($id)
    {
        $this->db->query('SELECT * from word WHERE id = :id ');
        $this->db->bind(':id', $id);
        $this->db->execute();
        $result = $this->db->single();

        return $result;
    }

    public function addWord($data)
    {
        $this->db->query('INSERT INTO word (type_id, word, meaning, form2, form3, form4, form5) VALUES (:type_id, :word, :meaning, :form2, :form3, :form4, form5)');
        //Bind values
        $this->db->bind(':type_id', $data['type_id']);
        $this->db->bind(':word', $data['word']);
        $this->db->bind(':meaning', $data['meaning']);
        $this->db->bind(':form2', $data['form2']);
        $this->db->bind(':form3', $data['form3']);
        $this->db->bind(':form4', $data['form4']);
        $this->db->bind(':form5', $data['form5']);
        //Execute

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editWord($data)
    {
        $this->db->query('UPDATE word SET type_id = :type_id, word = :word, meaning = :meaning, form2 = :form2, form3 = :form3, form4 = :form4, form5 = :form5 WHERE id = :id');
        //Bind values
        $this->db->bind(':type_id', $data['type_id']);
        $this->db->bind(':word', $data['word']);
        $this->db->bind(':meaning', $data['meaning']);
        $this->db->bind(':form2', $data['form2']);
        $this->db->bind(':form3', $data['form3']);
        $this->db->bind(':form4', $data['form4']);
        $this->db->bind(':form5', $data['form5']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteWord($id)
    {
        $flag = false;
        $this->db->query('DELETE FROM tag_word_pair WHERE word_id = :id');
        //Bind values
        $this->db->bind(':id', $id);
        //Execute
        if ($this->db->execute()) {
            $flag = true;
        } else {
            die("Can't delete the word-tag pair");
        }

        $this->db->query('DELETE FROM word WHERE id = :id');
        //Bind values
        $this->db->bind(':id', $id);
        //Execute
        if ($this->db->execute() && $flag) {
            return true;
        } else {
            return false;
        }
    }

    public function editSearchInfo($id)
    {
        $this->db->query('UPDATE word SET search_count = search_count+1 , last_searched_at = NOW() WHERE id = :id');
        //Bind values
        $this->db->bind(':id', $id);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

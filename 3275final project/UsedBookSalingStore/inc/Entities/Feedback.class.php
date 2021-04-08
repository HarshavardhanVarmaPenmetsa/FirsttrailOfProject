<?php

/*
+-----------+--------------+------+-----+---------+----------------+
| Field     | Type         | Null | Key | Default | Extra          |
+-----------+--------------+------+-----+---------+----------------+
| id        | int(5)       | NO   | PRI | NULL    | auto_increment |
| isbn      | int(11)      | YES  | MUL | NULL    |                |
| buyerName | varchar(50)  | YES  |     | NULL    |                |
| comment   | varchar(500) | YES  |     | NULL    |                |
| score     | int(1)       | YES  |     | NULL    |                |
+-----------+--------------+------+-----+---------+----------------+

*/

class Feedback
{
    //Attributes
    private $id;
    private $isbn;
    private $buyerName;
    private $comment;
    private $score;
   
  
    //Getters

    function getBookIsbn(): int
    {
        return $this->isbn;
    }
    
    function getBuyerName(): String
    {
        return $this->buyerName;
    }
    function getComment(): string
    {
        return $this->comment;
    }
    function getFeedbackId()
    {
        return $this->id;
    }
    function getScore()
    {
        return $this->score;
    }
   

    //Setters
    function setFeedbackId(int $newId)
    {
        $this->id= $newId;
    }
    function setBookIsbn(int $newId)
    {
        $this->isbn= $newId;
    }
  
    function setBuyerName(string $newName)
    {
        $this->buyerName= $newName;
    }
    function setComment(string $newComment)
    {
        $this->comment= $newComment;
    }
    function setScore(int $newScore)
    {
        $this->score= $newScore;
    }
   
}
















?>
<?php

    /*
mysql> desc feedback;
+----------+--------------+------+-----+---------+----------------+
| Field    | Type         | Null | Key | Default | Extra          |
+----------+--------------+------+-----+---------+----------------+
| id       | int(5)       | NO   | PRI | NULL    | auto_increment |
| bookIsbn | int(11)      | YES  | MUL | NULL    |                |
| buyerId  | int(11)      | YES  | MUL | NULL    |                |
| comment  | varchar(500) | YES  |     | NULL    |                |
| score    | int(1)       | YES  |     | NULL    |                |
+----------+--------------+------+-----+---------+----------------+
5 rows in set (0.01 sec)
*/

class FeedbackMapper    {
 

    //A place to store our DB connection
    private static $db;

    //This function to initiialize the PDO Agent with the user class
    static function initialize(String $newClass){

    self::$db= new PDOAgent($newClass);
    }

    //This function gets the user by id
    static function getFeedbackbyId(int $id)
     {

        //SQL Query
        $selectQuery= "SELECT * FROM feedback WHERE id=:id";

        //Prepare the query
        self::$db->query($selectQuery);
        //Set the bind parameters
        self::$db->bind(':id', $id);
        //Execute the query
        self::$db->execute();
        //Get the row
       return self::$db->singleResult();
    }


    static function listFeedbackByBookISBN($isbn):array
    {
      //SQL Query
      $selectAll= "SELECT * FROM feedback where isbn= :isbn";

      //Prepare the query
      self::$db->query($selectAll);
      self::$db->bind(':isbn', $isbn); 
      //Execute the query
      self::$db->execute();
      //Get the row
     return self::$db->resultSet();


    }

    static function listFeedbackAll():array
    {
      //SQL Query
      $selectAll= "SELECT * FROM feedback";
      //Prepare the query
      self::$db->query($selectAll);
      //Execute the query
      self::$db->execute();
      //Get the row
     return self::$db->resultSet();


    }


static function createFeedback(Feedback $feedback) : int   {
    $sqlInsert = "INSERT INTO feedback (isbn,buyerName,comment,score ) VALUES 
    (:isbn,:buyerName,:comment,:score);";

  self::$db->query($sqlInsert);
   self::$db->bind(':isbn',(int) $feedback->getBookIsbn());        
   self::$db->bind(':buyerName', $feedback->getBuyerName());    
   self::$db->bind(':comment', $feedback->getComment());
   self::$db->bind(':score', $feedback->getScore()); 
    self::$db->execute();

    return self::$db->lastInsertId();

}

static function deleteFeedback(Feedback $feedback) : int   {
    $sqlDelete = "DELETE FROM feedback WHERE id=:id";

    self::$db->query($sqlDelete);

    self::$db->bind(':id', $feedback->getFeedbackId());        

    self::$db->execute();

    return self::$db->lastInsertId();

}


}

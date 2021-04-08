<?php

/*
mysql> desc book;
+-------------+---------------+------+-----+---------+----------------+
| Field       | Type          | Null | Key | Default | Extra          |
+-------------+---------------+------+-----+---------+----------------+
| isbn        | int(5)        | NO   | PRI | NULL    | auto_increment |
| sellerId    | int(3)        | YES  | MUL | NULL    |                |
| author      | varchar(20)   | YES  |     | NULL    |                |
| bookName    | varchar(20)   | YES  |     | NULL    |                |
| price       | decimal(10,0) | YES  |     | NULL    |                |
| version     | varchar(20)   | YES  |     | NULL    |                |
| description | varchar(100)  | YES  |     | NULL    |                |
| score       | varchar(10)   | YES  |     | NULL    |                |
+-------------+---------------+------+-----+---------+----------------+
8 rows in set (0.00 sec)

*/

class BookMapper    {
 

    //A place to store our DB connection
    private static $db;

    //This function to initiialize the PDO Agent with the user class
    static function initialize(String $newClass){

    self::$db= new PDOAgent($newClass);
    }

    //This function gets the user by id
    static function getBookbyIsbn(int $id)
     {

        //SQL Query
        $selectQuery= "SELECT * FROM book WHERE isbn=:id";

        //Prepare the query
        self::$db->query($selectQuery);
        //Set the bind parameters
        self::$db->bind(':id', $id);
        //Execute the query
        self::$db->execute();
        //Get the row
       return self::$db->singleResult();
    }

    static function listBooks():array
    {
      //SQL Query
      $selectAll= "SELECT a.isbn,a.sellerId, a.bookName,a.author, a.version,a.price,a.description,a.score, s.sellerName as sellerName FROM book AS a
      JOIN seller AS s on s.sellerId= a.sellerId ";

      //Prepare the query
      self::$db->query($selectAll);
      //Execute the query
      self::$db->execute();
      //Get the row
     return self::$db->resultSet();


    }

    static function listBooksBykeyWord($key):array
    {
      //SQL Query
      $selectAll= "SELECT a.isbn,a.sellerId, a.bookName,a.author, a.version,a.price,a.description,a.score, s.sellerName as sellerName FROM book AS a 
      JOIN seller AS s on s.sellerId= a.sellerId where bookName like :key or author like :key";

      //Prepare the query
      self::$db->query($selectAll);
      self::$db->bind(':key','%'. $key.'%');
      //Execute the query
      self::$db->execute();
      //Get the row
     return self::$db->resultSet();


    }

/*
 * author: William Shi
 * Create an object to store information for particular patient
 * 
 mysql> desc book;
+-------------+---------------+------+-----+---------+----------------+
| Field       | Type          | Null | Key | Default | Extra          |
+-------------+---------------+------+-----+---------+----------------+
| isbn        | int(5)        | NO   | PRI | NULL    | auto_increment |
| sellerId    | int(3)        | YES  | MUL | NULL    |                |
| author      | varchar(20)   | YES  |     | NULL    |                |
| bookName    | varchar(20)   | YES  |     | NULL    |                |
| price       | decimal(10,0) | YES  |     | NULL    |                |
| version     | varchar(20)   | YES  |     | NULL    |                |
| description | varchar(100)  | YES  |     | NULL    |                |
| score       | varchar(10)   | YES  |     | NULL    |                |
+-------------+---------------+------+-----+---------+----------------+
8 rows in set (0.00 sec)

  */

static function updateBookAll(Book $book):int
{
    $updateBook="UPDATE book SET sellerId=:sellerId, author=:author, bookName=:bookName,price=:price, version=:version,
     description=:description,score=:score WHERE isbn=:id;";
     self::$db->query($updateBook);
     self::$db->bind(':id', $book->getBookIsbn());  
    self::$db->bind(':sellerId', $book->getBookSellerId());        
    self::$db->bind(':author', $book->getBookAuthor());   
    self::$db->bind(':bookName', $book->getBookName());    
    self::$db->bind(':price',$book->getBookPrice());
    self::$db->bind(':version', $book->getBookVersion());
    self::$db->bind(':description', $book->getBookDescription());
    self::$db->bind(':score', $book->getBookScore());
     self::$db->execute();

     return self::$db->lastInsertId();
}

static function updateBookDescriptionStatus(Book $book):int
{
    $updateBook="UPDATE book SET Description=:description WHERE isbn=:id;";
     self::$db->query($updateBook);
     self::$db->bind(':id', $book->getBookIsbn());  
    self::$db->bind(':description', $book->getBookDescription());

     self::$db->execute();

     return self::$db->lastInsertId();
}


static function createBook(Book $book) : int   {
    $sqlInsert = "INSERT INTO book (sellerId,bookName,author,version,price, description, score ) VALUES 
    (:sellerId,:bookName,:author,:version, :price, :description,:score);";

    self::$db->query($sqlInsert);
   self::$db->bind(':sellerId', $book->getBookSellerId());        
   self::$db->bind(':bookName', $book->getBookName());    
   self::$db->bind(':author', $book->getBookAuthor());
   self::$db->bind(':version', $book->getBookVersion());
   self::$db->bind(':price', $book->getBookPrice());
   self::$db->bind(':description', $book->getBookDescription());
   self::$db->bind(':score', $book->getBookSellerId());


    self::$db->execute();

    return self::$db->lastInsertId();

}

static function deleteBook(Book $book) : int   {
    $sqlDelete = "DELETE FROM book WHERE isbn=:id";

    self::$db->query($sqlDelete);

    self::$db->bind(':id', $book->getBookIsbn());        

    self::$db->execute();

    return self::$db->lastInsertId();

}


}

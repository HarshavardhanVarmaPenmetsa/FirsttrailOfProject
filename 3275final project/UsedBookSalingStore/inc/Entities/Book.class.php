<?php


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



class Book
{
    //Attributes
    private $isbn;
    private $sellerId;
    private $author;
    private $bookName;
    private $price;
    private $version;
    private $description;
    private $score;
    private $sellerName;
  
    

    //Getters
    function getBookIsbn(): int
    {
        return $this->isbn;
    }
    function getBookSellerId()
    {
        return $this->sellerId;
    }
    function getBookAuthor(): String
    {
        return $this->author;
    }
    function getBookName(): String
    {
        return $this->bookName;
    }
    function getBookPrice()
    {
        return $this->price;
    }
    function getBookVersion(): String
    {
        return $this->version;
    }
    
    function getBookDescription(): String
    {
        return $this->description;
    }
   
    function getBookScore(): String
    {
        return $this->score;
    }
    function getBookSellerName():String{

        return $this->sellerName;
    }

    //Setters

    function setBookIsbn(int $newId)
    {
        $this->isbn= $newId;
    }
    function setBookSellerId(int $newId)
    {
        $this->sellerId= $newId;
    }
    function setBookAuthor(string $newName)
    {
        $this->author= $newName;
    }
    function setBookName(string $newName)
    {
        $this->bookName= $newName;
    }
    function setBookPrice(string $newPrice)
    {
        $this->price= $newPrice;
    }
    function setBookVersion(string $newBookVersion)
    {
        $this->version= $newBookVersion;
    }
    function setBookDescription(string $newDesc)
    {
        $this->description= $newDesc;
    }

    function setBookScore(string $newScore)
    {
     $this->score= $newScore;
    }
    function setBookSellerName(string $newSellerName)
    {
     $this->sellerName= $newSellerName;
    }
}

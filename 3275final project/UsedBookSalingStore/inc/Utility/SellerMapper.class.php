<?php

class SellerMapper    {
 
 /*   
mysql> select * from seller;
+----------+-------------+--------------+----------+------------------------+-----------------+
| sellerId | sellerName  | contactNo    | password | email                  | address         |
+----------+-------------+--------------+----------+------------------------+-----------------+
|        1 | AshwinAshok | 779-544-4457 | NULL     | ashwin@gmail.com       | 8th street      |
|        2 | Jill        | 789-996-3864 | NULL     | jadanez1@aboutads.info | New Westminster |
+----------+-------------+--------------+----------+------------------------+-----------------+
2 rows in set (0.00 sec)

*/
    //A place to store our DB connection
    private static $db;

    //This function to initiialize the PDO Agent with the user class
    static function initialize(String $newClass){

    self::$db= new PDOAgent($newClass);
    }

      //This function gets the user by username
      static function getSellerById($id)
      {
 
         //SQL Query
         $selectQuery= "SELECT * FROM seller WHERE sellerId=:id;";
 
         //Prepare the query
         self::$db->query($selectQuery);
         //Set the bind parameters
         self::$db->bind(':id', $id);
         //Execute the query
         self::$db->execute();
         //Get the row
        return self::$db->singleResult();
     }

    //This function gets the user by username
    static function getSellerbyEmail(string $sellerEmail)
     {

        //SQL Query
        $selectQuery= "SELECT * FROM seller WHERE email=:email;";

        //Prepare the query
        self::$db->query($selectQuery);
        //Set the bind parameters
        self::$db->bind(':email', $sellerEmail);
        //Execute the query
        self::$db->execute();
        //Get the row
       return self::$db->singleResult();
    }
    static function listSellers():array
    {
      //SQL Query
      $selectAll= "SELECT * FROM seller;";

      //Prepare the query
      self::$db->query($selectAll);
      //Execute the query
      self::$db->execute();
      //Get the row
     return self::$db->resultSet();


    }
  
static function updateSeller(Seller $seller):int
{
    $updateSeller="UPDATE seller SET sellerId=:sellerId,sellerName=:sellerName, contactNo=:contactNo, password=:password,
  email=:email,address=:address  WHERE email=:email;";
     self::$db->query($updateSeller);

    self::$db->bind(':sellerId', $seller->getSellerId());  
    self::$db->bind(':sellerName', $seller->getSellerName());        
    
    self::$db->bind(':contactNo', $seller->getSellerContactNo());        
    self::$db->bind(':password', $seller->getSellerPassword());
  
    self::$db->bind(':email', $seller->getSellerEmail());        

    self::$db->bind(':address', $seller->getSellerAddress());        
   
     self::$db->execute();

     return self::$db->lastInsertId();
}


static function createSeller(Seller $seller) : int   {
    $sqlInsert = "INSERT INTO seller (sellerName, contactNo, password,email,address) VALUES 
    (:sellerName, :contactNo,:password,:email, :address);";

    self::$db->query($sqlInsert);

    self::$db->bind(':sellerName', $seller->getSellerName());        
    self::$db->bind(':contactNo', $seller->getSellerContactNo());        
    self::$db->bind(':password', $seller->getSellerPassword());
    
    self::$db->bind(':email', $seller->getSellerEmail());        
  
    self::$db->bind(':address', $seller->getSellerAddress());        

    self::$db->execute();

    return self::$db->lastInsertId();

}

static function deleteSeller(Seller $seller) : int   {
    $sqlDelete = "DELETE FROM seller WHERE sellerId=:sellerId";

    self::$db->query($sqlDelete);

    self::$db->bind(':sellerId', $seller->getSellerId());        

    self::$db->execute();

    return self::$db->lastInsertId();

}


}

?>
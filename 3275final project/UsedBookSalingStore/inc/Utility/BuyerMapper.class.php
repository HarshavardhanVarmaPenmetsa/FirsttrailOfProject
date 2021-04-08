<?php

class BuyerMapper    {
 
 /*   
mysql> select * from buyer;
+---------+-----------+----------+-----------------+--------------+--------+------------------------+----------+
| buyerId | firstName | lastName | address         | contactNo    | gender | email                  | password |
+---------+-----------+----------+-----------------+--------------+--------+------------------------+----------+
|    1000 | Ashwin    | Ashok    | Royal Ave       | 779-544-4457 | Male   | ashwin@gmail.com       | NULL     |
|    1001 | Jill      | Adanez   | New Westminster | 789-996-3864 | Female | jadanez1@aboutads.info | NULL     |
+---------+-----------+----------+-----------------+--------------+--------+------------------------+----------+
2 rows in set (0.00 sec)
*/
    //A place to store our DB connection
    private static $db;

    //This function to initiialize the PDO Agent with the user class
    static function initialize(String $newClass){

    self::$db= new PDOAgent($newClass);
    }

     static function getBuyerbyId($id)
     {

        //SQL Query
        $selectQuery= "SELECT * FROM buyer WHERE buyerId=:id;";

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
    static function getBuyerbyEmail(string $buyerEmail)
     {

        //SQL Query
        $selectQuery= "SELECT * FROM buyer WHERE email=:email;";

        //Prepare the query
        self::$db->query($selectQuery);
        //Set the bind parameters
        self::$db->bind(':email', $buyerEmail);
        //Execute the query
        self::$db->execute();
        //Get the row
       return self::$db->singleResult();
    }
    static function listBuyers():array
    {
      //SQL Query
      $selectAll= "SELECT * FROM buyer;";

      //Prepare the query
      self::$db->query($selectAll);
      //Execute the query
      self::$db->execute();
      //Get the row
     return self::$db->resultSet();


    }
   
static function updateBuyer(Buyer $buyer):int
{
    $updatePassword="UPDATE buyer SET firstName=:firstName, lastName=:lastName, address=:address, contactNo=:contactNo, 
     gender=:gender, email=:email, password=:password WHERE buyerId=:id;";
     self::$db->query($updatePassword);
     self::$db->bind(':id', $buyer->getBuyerId());  
    self::$db->bind(':firstName', $buyer->getBuyerFirstName());        
    self::$db->bind(':lastName', $buyer->getBuyerLastName());
    self::$db->bind(':address', $buyer->getBuyerAddress());
    self::$db->bind(':contactNo', $buyer->getBuyerContactNo());        
    
    self::$db->bind(':gender', $buyer->getBuyerGender());
    self::$db->bind(':email', $buyer->getBuyerEmail());        
    self::$db->bind(':password', $buyer->getBuyerPassword());
    
  
     self::$db->execute();

     return self::$db->lastInsertId();
}


static function createBuyer(Buyer $buyer) : int   {
    $sqlInsert = "INSERT INTO buyer (firstName, lastName, address,contactNo,gender,email,password) VALUES 
    (:firstName, :lastName, :address,:contactNo,:gender,:email,:password);";

    self::$db->query($sqlInsert);

    self::$db->bind(':firstName', $buyer->getBuyerFirstName());        
    self::$db->bind(':lastName', $buyer->getBuyerLastName());
    self::$db->bind(':address', $buyer->getBuyerAddress());
    self::$db->bind(':contactNo', $buyer->getBuyerContactNo());        
 
    self::$db->bind(':gender', $buyer->getBuyerGender());
    self::$db->bind(':email', $buyer->getBuyerEmail());        
    self::$db->bind(':password', $buyer->getBuyerPassword());
    


    self::$db->execute();

    return self::$db->lastInsertId();

}

static function deleteBuyer(Buyer $buyer) : int   {
    $sqlDelete = "DELETE FROM buyer WHERE buyerId=:id";

    self::$db->query($sqlDelete);

    self::$db->bind(':id', $buyer->getBuyerId());        

    self::$db->execute();

    return self::$db->lastInsertId();

}


}

?>
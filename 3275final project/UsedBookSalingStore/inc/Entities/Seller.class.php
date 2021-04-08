
<?php


class Seller
{
    /*
mysql> desc seller;
+------------+--------------+------+-----+---------+----------------+
| Field      | Type         | Null | Key | Default | Extra          |
+------------+--------------+------+-----+---------+----------------+
| sellerId   | int(3)       | NO   | PRI | NULL    | auto_increment |
| sellerName | varchar(50)  | NO   |     | NULL    |                |
| contactNo  | varchar(15)  | NO   |     | NULL    |                |
| password   | varchar(100) | YES  |     | NULL    |                |
| email      | varchar(100) | NO   |     | NULL    |                |
| address    | varchar(100) | NO   |     | NULL    |                |
+------------+--------------+------+-----+---------+----------------+
6 rows in set (0.00 sec)

 */

    private $sellerId;
    private $sellerName;
    private $contactNo;
    private $password;
    private $email;
    private $address;

 
    
    //getter methods
    function getSellerId()
    {
        return $this->sellerId;
    }

    function getSellerName()
    {
        return $this->sellerName;
    }
    function getSellerContactNo()
    {
        return $this->contactNo;
    }
    function getSellerPassword()
    {
        return $this->password;
    }
    
    function getSellerEmail()
    {
        return $this->email;
    }
    function getSellerAddress()
    {
        return $this->address;
    }

     //setter methods
     function setSellerId($newId)
     {
        $this->SellerId= $newId;
     }
 
     function setSellerName($newName)
     {
         $this->sellerName=$newName;
     }
     function setSellerContactNo($newConactNo)
     {
        $this->contactNo=$newConactNo;
     }
     function setSellerEmail($currEmail)
     {
         $this->email= $currEmail;
     }
     function setSellerAddress($newAddress)
     {
          $this->address= $newAddress;
     }


     public function setDrHashPassword(string $newPassword)
     {
         //Hash password
         $hash = password_hash($newPassword, PASSWORD_DEFAULT);
         //Write the password
         $this->password = $hash;
     
     }
 
     //Verify password
     public function verifyDrPassword($verifyPassword): bool
     {
         //check password_verify
 
         if (password_verify($verifyPassword, $this->password) == 1)
         // if ($verifyPassword == $this->password)
             return true;
 
         else
             return false;
     }
}

?>
<?php
/*
mysql> desc buyer;
+-----------+--------------+------+-----+---------+----------------+
| Field     | Type         | Null | Key | Default | Extra          |
+-----------+--------------+------+-----+---------+----------------+
| buyerId   | int(11)      | NO   | PRI | NULL    | auto_increment |
| firstName | varchar(100) | NO   |     | NULL    |                |
| lastName  | varchar(100) | NO   |     | NULL    |                |
| address   | varchar(200) | NO   |     | NULL    |                |
| contactNo | varchar(15)  | NO   | UNI | NULL    |                |
| gender    | varchar(10)  | NO   |     | NULL    |                |
| email     | varchar(100) | NO   |     | NULL    |                |
| password  | varchar(100) | YES  |     | NULL    |                |
+-----------+--------------+------+-----+---------+----------------+
8 rows in set (0.00 sec)

  */



class Buyer
{
    //Attributes
    private $buyId;
    private $password;
    private $firstName;
    private $lastName;
    // eamil attribute for login
    private $email;
    private $gender;
    private $contactNo;
    private $address;

    //Getters
    function getBuyerId(): int
    {
        return $this->buyerId;
    }


    function getBuyerFirstName(): String
    {
        return $this->firstName;
    }
    function getBuyerLastName(): String
    {
        return $this->lastName;
    }
    function getBuyerEmail(): String
    {
        return $this->email;
    }
    function getBuyerGender(): String
    {
        return $this->gender;
    }
    function getBuyerContactNo(): String
    {
        return $this->contactNo;
    }
    function getBuyerAddress(): String
    {
        return $this->address;
    }

    function getBuyerPassword(): String
    {
        return $this->password;
    }


    //Setters

    function setBuyerId(int $newID)
    {
        $this->buyeyId = $newID;
    }
    function setBuyerFirstName(String $newFirstName)
    {
        $this->firstName = $newFirstName;
    }
    function setBuyerLastName(String $newLastName)
    {
        $this->lastName = $newLastName;
    }
    function setBuyerEmail(String $newEmail)
    {
        $this->email = $newEmail;
    }

    function setBuyerContactNo(String $newContactNo)
    {
        $this->contactNo = $newContactNo;
    }

    function setBuyerGender(String $newGender)
    {
        $this->gender = $newGender;
    }

    function setBuyerAddress(String $newAddress)
    {
        $this->address = $newAddress;
    }

    public function setHashPassword(string $newPassword)
    {
        //Hash password
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        //Write the password
        $this->password = $hash;
    
    }

    //Verify password
    public function verifyPassword($verifyPassword): bool
    {
        //check password_verify

        if (password_verify($verifyPassword, $this->password) == 1)
        // if ($verifyPassword == $this->password)
            return true;

        else
            return false;
    }
}

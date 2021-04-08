<?php

class Validation {
 
    //Initialize and empty array
    public static $errors=array();

    public static function validate()   {
     
         //validate for the email
        if(empty($_POST["email"])||is_null($_POST["email"])){
            self::$errors['email']="The email wasn't entered,please enter your email address.";
           }
          else {
              if(strlen(trim($_POST["email"]))==0)
              // another way :if(trim($_POST["email"])=="")
              self:: $errors["email"]="Please enter a valid email";
           
           }
  
          
           //validate the password
           if(empty($_POST["password"])||is_null($_POST["password"])){
           self::$errors['password']="The password wasn't entered,please enter your password.";
           }
          else {
           if(trim($_POST["password"])=="")
            self::$errors['password']="Please enter a valid password";
          
          }
  
          
        return self::$errors;
       }



     
       
       
        
    }

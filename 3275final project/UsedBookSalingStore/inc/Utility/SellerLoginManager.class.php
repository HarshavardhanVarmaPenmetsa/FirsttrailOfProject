<?php


class SellerLoginManager  {


    //This function checks if the user is logged in, 
    //if they are not they are redirected to the login page
    static function verifyLogin()   {
     //session_start();
         //Check for a session_id or the $_SESSION variable
        if(session_id()==""&&!isset($_SESSION))
        {
             //Start it up    
             session_start();
         //If te user is logged in
         //The user is loggedin
           $now = time(); // Checking the time now when home page starts.
           if($_SESSION["sellerLoggedin"] &&$now<$_SESSION['expire'])
              return true;
             //The user is not logged in
            else{

              if($now>$_SESSION['repire']){
                echo"<script>alert(' 30 Minutes over!');</script>";
               }
              unset($_SESSION);
              //Destroy any session just in case
              session_destroy();
              //Send them back to the login page
              //Redirect the user to the login page
              header('Location: ../Controller/Store_seller_login.php');
             
              return false;
            }
     
        }
        else{
             //Send them back to the login page
            //Redirect the user to the login page
            header('Location:../Controller/Store_seller_login.php');
            return false;
        }
    }  
    
}

?>
<?php

/*  
    Author:Ashwin

    THis is control file to logout for Buyer
*/

//Include the page and the login manager
require("../Utility/BuyerPage.class.php");
require("../Utility/BuyerLoginManager.class.php");

Buyerpage::$title = "Good bye";
Buyerpage::header();
//Verify if the user is logged in
if (BuyerLoginManager::verifyLogin())    
{

    //Call the Page goodbye
    Buyerpage::thankYou();
    BuyerPage::footer();

}


    //Unset the session or destroy the session
    unset($_SESSION);
   //session_destroy;
    session_destroy();
    Buyerpage::$title="";
    Buyerpage::header("logout");


?>
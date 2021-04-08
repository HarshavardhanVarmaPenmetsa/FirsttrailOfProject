<?php

/*  
    Author:Ashwin

    THis is control file to logout for seller
*/

//Include the page and the login manager
require("../Utility/SellerPage.class.php");
require("../Utility/SellerLoginManager.class.php");

SellerPage::$title = "Good bye";
SellerPage::header("kjjkk");
//Verify if the user is logged in
if (SellerLoginManager::verifyLogin())    
{

    //Call the Page goodbye
    SellerPage::thankYou();
    SellerPage::footer();

}


    //Unset the session or destroy the session
    unset($_SESSION);
   //session_destroy;
    session_destroy();
    SellerPage::$title="";
    SellerPage::header("logout");

?>
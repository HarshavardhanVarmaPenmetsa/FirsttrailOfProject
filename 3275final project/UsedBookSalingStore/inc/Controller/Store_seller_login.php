
<?php

/*  
    Author:Ashwin

    THis is control file to manipulate whole actions related seller

    For the page html format, I get the model as referneces from the bootstrap
  
*/

//Require the config
require_once("../Config/config.inc.php");
//Require entities
require_once("../Entities/Seller.class.php");
//Require Utilities
require_once("../Utility/SellerPage.class.php");



require_once("../Utility/PDOAgent.class.php");
require_once("../Utility/SellerMapper.class.php");
require_once("../Utility/SellerLoginManager.class.php");
require_once("../Utility/Validation.class.php");

//If they not continue
//Set title
SellerPage::$title = "Used Book Store for Seller";
//header
SellerPage::header();
//DoctorPage::navigationBar();



$errors= array();
if (!empty($_POST)) {

  //Initialize the seller mapper
  SellerMapper::initialize("Seller");

  switch ($_POST["submit"]) {

    case "confirmSellerLogin":
      //Check the vlaidation
      $errors=Validation::validate();
      if (count($errors)==0) {
        //Get the seller by email (because thats all we have in the form)
        $seller = SellerMapper::getSellerbyEmail(strtolower($_POST["email"]));
        //Check the mapper returned an object and the object is a seller (in case the email is invalid)
        if (is_object($seller) && get_class($seller)) {
          //Verify that users password against the password in the form
          if ($seller->verifyDrPassword($_POST["password"])) {
            //If true log them in by starting a sesssion and forwarding them to the main page
            session_start();
            //Set the logged in to true
            $_SESSION['sellerLoggedin'] = $seller;
            $_SESSION['start'] = time(); // Taking now logged in time.
            // Ending a session in 30 minutes from the starting time.
            $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
            //Send the seller to the home page
            header('Location:Store_seller_home.php');
          } else {
            $errors['password'] = "the password is not correct";
            SellerPage::showSellerLogin($errors);
          }
        } else {
          $errors['email'] = "the email can not find"; 
          SellerPage::showSellerLogin($errors);
        }
      } else {
        SellerPage::showSellerLogin($errors);
      }
      break;

    case 'confirmSellerRegister':
       
      //Check the vlaidation
      $errors=Validation::validate();
      if (count($errors)==0) {
        //Get the seller by email (because thats all we have in the form)
        $seller = new Seller();
        $seller->setSellerName($_POST['sellerName']);
        $seller->setSellerAddress($_POST['address']);
        $seller->setSellerContactNo($_POST['contactNo']);
        $seller->setSellerEmail($_POST['email']);
        $seller->setDrHashPassword($_POST['password']);
       
        //check if eamil has already existed
        $currList = array();
        $currList = SellerMapper::listSellers();

        $existed = false;
        foreach ($currList as $s) {
          if ($s->getSellerEmail() == $seller->getSellerEmail()) {
            $existed = true;
            break;
          }
        }
        //insert a new seller to database
        if (!$existed) {
          SellerMapper::createSeller($seller);
          SellerPage::showSellerLogin($errors);
        } else {
          $errors['email'] = "Warning:it has existed!";
          SellerPage::SellerRegisterForm($errors);
        }
      } else {
        SellerPage::SellerRegisterForm($errors);
      }
      break;
  }
} else {

  if (!empty($_GET)) {
   
    SellerPage::SellerRegisterForm($errors);
  } else {
   
    SellerPage::showSellerLogin($errors);
  }
}



//footer
SellerPage::footer();

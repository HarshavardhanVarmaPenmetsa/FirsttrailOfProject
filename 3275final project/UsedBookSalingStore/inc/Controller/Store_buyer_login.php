
<?php


//Require the config
require_once("../Config/config.inc.php");
//Require entities
require_once("../Entities/Buyer.class.php");
require_once("../Entities/Book.class.php");
//Require Utilities
require_once("../Utility/BuyerPage.class.php");
require_once("../Utility/PDOAgent.class.php");
require_once("../Utility/BuyerMapper.class.php");
require_once("../Utility/BuyerLoginManager.class.php");
require_once("../Utility/Validation.class.php");
require_once("../Utility/BookMapper.class.php");



//If they not continue
//Set title
BuyerPage::$title = "Used Book System for Buyer";
//header
BuyerPage::header();
//Page::navigationBar();



$errors = array();
if (!empty($_POST)) {

  //Initialize the buyer mapper
  BuyerMapper::initialize("Buyer");

  switch ($_POST["submit"]) {

    case "confirmBuyerLogin":
      //Check the vlaidation
      $errors=Validation::validate();
      if (count($errors)==0) {
        //Get the buyer by email (because thats all we have in the form)
        $buyer = BuyerMapper::getBuyerbyEmail(strtolower($_POST["email"]));
        //Check the mapper returned an object and the object is a buyer (in case the email is invalid)
        if (is_object($buyer) && get_class($buyer)) {
          //Verify that users password against the password in the form
          if ($buyer->verifyPassword($_POST["password"])) {
            //If true log them in by starting a sesssion and forwarding them to the main page
            session_start();
            //Set the logged in to true
            $_SESSION['loggedin'] = $buyer;
            $_SESSION['start'] = time(); // Taking now logged in time.
            // Ending a session in 30 minutes from the starting time.
            $_SESSION['expire'] = $_SESSION['start'] + (30*60);
            //Send the buyer to the buyer home page
            header('Location:Store_buyer_home.php');
          } else {
            $errors['password'] = "the password is not correct";
            BuyerPage::showLogin($errors);
          }
        } else {
          $errors['email'] = "the email can not find"; 
          BuyerPage::showLogin($errors);
        }
      } else {
        BuyerPage::showLogin($errors);
      }
      break;

    case 'confirmBuyerRegister':
       
      //Check the vlaidation
      $errors=Validation::validate();
      if (count($errors)==0) {
        //Get the buyer by email (because thats all we have in the form)
        $buyer = new Buyer();
        $buyer->setBuyerFirstName($_POST['firstName']);
        $buyer->setBuyerLastName($_POST['lastName']);
        $buyer->setBuyerAddress($_POST['address']);
        $buyer->setBuyerContactNo($_POST['contactNo']);
        $buyer->setBuyerGender($_POST['gender']);
        $buyer->setBuyerEmail($_POST['email']);
        $buyer->setHashPassword($_POST['password']);
  
        //check if eamil has already existed
        $currList = array();
        $currList = BuyerMapper::listBuyers();

        $existed = false;
        foreach ($currList as $b) {
          if ($b->getBuyerEmail() == $buyer->getBuyerEmail()) {
            $existed = true;
            break;
          }
        }
        //insert a new buyer to database
        if (!$existed) {
          BuyerMapper::createBuyer($buyer);
          BuyerPage::showLogin($errors);
        } else {
          $errors['email'] = "Warning:it has existed!";
          BuyerPage::buyerRegisterForm($errors);

        }
      } else {
        BuyerPage::buyerRegisterForm($errors);
      }
      break;
  }
} else {

  if (!empty($_GET)) {
    BuyerPage::buyerRegisterForm($errors);
  } else {
    BuyerPage::showLogin($errors);
  }
}

BuyerPage::footer();

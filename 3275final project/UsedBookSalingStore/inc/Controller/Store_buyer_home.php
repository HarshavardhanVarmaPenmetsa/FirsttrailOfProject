<?php


//Require the config
require_once("../Config/config.inc.php");
//Require entities
require_once("../Entities/Buyer.class.php");
require_once("../Entities/Book.class.php");
require_once("../Entities/Seller.class.php");
require_once("../Entities/Feedback.class.php");

//Require Utilities
require_once("../Utility/BuyerPage.class.php");
require_once("../Utility/BookPage.class.php");
require_once("../Utility/SellerPage.class.php");


require_once("../Utility/PDOAgent.class.php");
require_once("../Utility/BuyerLoginManager.class.php");
require_once("../Utility/SellerLoginManager.class.php");
require_once("../Utility/BookMapper.class.php");
require_once("../Utility/BuyerMapper.class.php");
require_once("../Utility/SellerMapper.class.php");
require_once("../Utility/ParseBook.class.php");
require_once("../Utility/FeedbackPage.class.php");
require_once("../Utility/FeedbackMapper.class.php");

require_once("../Utility/Validation.class.php");


//check login by session value and if true, and then start session 
BuyerLoginManager::verifyLogin();
//display header and navigation bar
BuyerPage::$title = "Used Book System for Buyer";
BuyerPage::header();
BuyerPage::navigationBar();

$errors = array();
//retrive the curr object of Doctor from session
$currBuyer = new Buyer();
$currBuyer = $_SESSION['loggedin'];

//instantiate an object of Book to display the list of books
$currBook = new Book();
BookMapper::initialize("Book");

$currBookList = array();
$currFeedback= new Feedback();
FeedbackMapper::initialize("Feedback");
$currFeedbackList= array();

$currFeedbackList= FeedbackMapper::listFeedbackAll();



BuyerMapper::initialize("Buyer");


if (isset($_POST["submit"])) {


    switch ($_POST["submit"]) {

        case 'confirmBuyerEdit':


            $currBuyer->setBuyerFirstName($_POST["firstName"]);
            $currBuyer->setBuyerLastName($_POST["lastName"]);

            $currBuyer->setBuyerContactNo($_POST["contactNo"]);
           // $currBuyer->setSellerHashPassword($_POST["password"]);

            $currBuyer->setBuyerEmail($_POST["email"]);
            $currBuyer->setBuyerAddress($_POST["address"]);
            $currBuyer->setBuyerGender($_POST["gender"]);


            $result = BuyerMapper::updateBuyer($currBuyer);
            if ($result >= 0) {
                $_SESSION['loggedin'] = $currBuyer;
                echo '<div class="usedBookStoreAlert">successfully updated your profile</div>';
            } else {
                echo "some thing is wrong, can not edit your profile";
            }

            //after the post action , because of refresh the list of books
            $currBookList = BookMapper::listBooks();
            $currImages= array();
            $currBookList= ParseBook::parseBookList($currBookList, $currImages);
            if (empty($currBookList)) {
                BuyerPage::welcome($currBuyer);
            } else {
                BookPage::showListOfBookForBuyer($currBookList,$currFeedbackList);
            }
           

            break;


        case "confirmFeedbackCreationbyBuyer":
            $isbn= (int)$_POST['isbn'];
            $currFeedback->setBookIsbn($isbn);
            $currFeedback->setBuyerName($_POST['firstName']);
            $currFeedback->setComment($_POST['comment']);
            $currFeedback->setScore($_POST['score']);
      
            $result = FeedbackMapper::createFeedback($currFeedback);

            if ($result >= 0) {
                echo '<div class="usedBookStoreAlert">successfully created the feedback of book<div>';
             
            } else {
                echo "Fail, can not change";
            }

            $currFeedbackList= FeedbackMapper::listFeedbackAll();
            //after the post action , because of refresh the list of book

            $currBookList = BookMapper::listBooks();
            $currImages= array();
            $currBookList= ParseBook::parseBookList($currBookList, $currImages);
            if (empty($currBookList)) {
                BuyerPage::welcome($currBuyer);
            } else {
                BookPage::showListOfbookForBuyer($currBookList,$currFeedbackList);
            }

              //avoid refresh issue, redirect page to home page 

              echo ("<script>location.href = 'Store_buyer_home.php';</script>");

            break;

        case "showBookListForBuyer":
            //after the post action , because of refresh the list of Book
            $currBookList = BookMapper::listBooks();
            $currImages= array();
            $currBookList= ParseBook::parseBookList($currBookList, $currImages);

            if (empty($currBookList)) {
                BuyerPage::welcome($currBuyer);
            } else {
                BookPage::showListOfBookForBuyer($currBookList,$currFeedbackList);
            }

            break;
    }
}

if (!empty($_GET['action'])) {
    switch ($_GET["action"]) {

        case "FeedbackCreateByBuyer":
            $isbn=(int)$_GET['isbn'];
            var_dump($isbn);
            FeedbackPage::createFeedbackFormByBuyer($currBuyer,$isbn );
           
            break;
        case "cancelAnyChange":
            $currBookList = BookMapper::listBooks();
            $currImages = array();
            $currBookList = ParseBook::parseBookList($currBookList, $currImages);

            if (empty($currBookList)) {
                BuyerPage::welcome($currBuyer);
            } else {
                BookPage::showListOfBookForBuyer($currBookList, $currFeedbackList);
            }
            break;
        default:

            # code...
            break;
    }
}




if (empty($_POST) && empty($_GET)) {


    //after the post action , because of refresh the list of Book
    $currBookList = BookMapper::listBooks();
    $currImages= array();
    $currBookList= ParseBook::parseBookList($currBookList, $currImages);
    $currFeedbackList= FeedbackMapper::listFeedbackAll();

    if (empty($currBookList)) {
        BuyerPage::welcome($currBuyer);
    } else {
        BookPage::showListOfBookForBuyer($currBookList,$currFeedbackList);
    }
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['sort'])) {
    $currBookList = BookMapper::listBooks();
    $currImages = array();
    $currBookList = ParseBook::parseBookList($currBookList, $currImages);
    
    switch ($_GET['sort']) {
        case 'BookName':
            $currBookList = ParseBook::sortbyBookName($currBookList);
            if (empty($currBookList)) {
                buyerPage::welcome($currSeller);
            } else {
                BookPage::showListOfBookForBuyer($currBookList,$currFeedbackList);
            }
            break;
        case 'Author':
            $currBookList = ParseBook::sortbyAuthor($currBookList,$currFeedbackList);
            if (empty($currBookList)) {
                buyerPage::welcome($currSeller);
            } else {
                BookPage::showListOfBookForBuyer($currBookList,$currFeedbackList);}
            break;
        case 'Price':
            $currBookList = ParseBook::sortbyPrice($currBookList);
            if (empty($currBookList)) {
                buyerPage::welcome($currSeller);
            } else {
                BookPage::showListOfBookForBuyer($currBookList,$currFeedbackList);}
            break;
        case 'Score':
            $currBookList = ParseBook::sortbyScore($currBookList,$currFeedbackList);
            if (empty($currBookList)) {
                buyerPage::welcome($currSeller);
            } else {
                BookPage::showListOfBookForBuyer($currBookList,$currFeedbackList);}
            break;

            
            case 'Search':
                $key= trim($_GET['search']);
              
                    $currBookList = BookMapper::listBooksBykeyWord($key);  
                if (empty($currBookList)) {
                    BuyerPage::welcome($currBuyer);
                } else {
                    $currBookList = ParseBook::parseBookList($currBookList, $currImages);
                    BookPage::showListOfBookForBuyer($currBookList,$currFeedbackList);}
                break;
        default:
            # code...
            break;
    }


}
//show edit form but initialize status is hidden
BuyerPage::buyerEditForm($currBuyer, $errors);
BuyerPage::footer();

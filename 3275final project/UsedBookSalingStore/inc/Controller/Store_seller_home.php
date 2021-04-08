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

require_once("../Utility/FeedbackMapper.class.php");
require_once("../Utility/FeedbackPage.class.php");

require_once("../Utility/Validation.class.php");

//check login by session value and if true, and then start session 
SellerLoginManager::verifyLogin();
//display header and navigation bar
SellerPage::$title = "Used Book Store System for Seller";
SellerPage::header();
SellerPage::navigationBar();
SellerMapper::initialize("Seller");

BuyerMapper::initialize("Buyer");
$currBuyerList = array();
$currBuyerList = BuyerMapper::listBuyers();

$currSeller = new Seller();
//call session value to catch the information of current user of Seller
$currSeller = $_SESSION['sellerLoggedin'];

$errors = array();
$currBook = new Book();
$currBookList = array();
BookMapper::initialize("Book");
$currFeedbackList= array();
FeedbackMapper::initialize("Feedback");

$currFeedbackList= FeedbackMapper::listFeedbackAll();

if (isset($_POST["submit"])) {

    switch ($_POST["submit"]) {

        case 'confirmSellerEdit':
            SellerMapper::initialize("Seller");

            $currSeller->setSellerName($_POST['sellerName']);
            $currSeller->setSellerAddress($_POST['address']);
            $currSeller->setSellerContactNo($_POST['contactNo']);
            // $patient->setPatientEmail($_POST['email']);

            //$currSeller->setHashPassword($_POST['password']);
            $result = SellerMapper::updateSeller($currSeller);
            if ($result >= 0) {
                $_SESSION['sellerLoggedin'] = $currSeller;
                echo '<div class="usedBookStoreAlert">successfully updated your profile</div>';
            } else {
                echo "some thing is wrong, can not edit your profile";
            }

            //after the post action , because of refresh the list of books
            $currBookList = BookMapper::listBooks();
            $currImages = array();
            $currBookList = ParseBook::parseBookList($currBookList, $currImages);
            if (empty($currBookList)) {
                sellerPage::welcome($currSeller);
            } else {
                BookPage::showListOfBookForSeller($currBookList,$currFeedbackList);
            }



            break;
        case 'confirmBookCreationbySeller':

            $newBook = new Book();

            $newBook->setBookSellerId((int)$currSeller->getSellerId());
            $newBook->setBookAuthor($_POST["author"]);
            $newBook->setBookName($_POST["bookName"]);
            $newBook->setBookPrice($_POST["price"]);
            $newBook->setBookScore('0');
            $newBook->setBookVersion($_POST["version"]);
            $newBook->setBookDescription($_POST["description"]);



            $result = BookMapper::createBook($newBook);

            $currBookList = BookMapper::listBooks();
            $currImages = array();
            $currBookList = ParseBook::parseBookList($currBookList, $currImages);

            BookPage::createBookFormBySeller($currSeller);

            //avoid refresh issue, redirect page to home page 

            echo ("<script>location.href = 'Store_seller_home.php';</script>");

            break;

        case 'confirmBookEditBySeller':

            $newBook = new Book();
            $id = (int)$_POST['isbn'];

            $newBook->setBookIsbn($id);
            $newBook->setBookSellerId((int)$currSeller->getSellerId());
            $newBook->setBookAuthor($_POST["author"]);
            $newBook->setBookPrice($_POST["price"]);
            $newBook->setBookName($_POST["bookName"]);
            $newBook->setBookScore("0");
            $newBook->setBookVersion($_POST["version"]);
            $newBook->setBookDescription($_POST["description"]);
            $result = BookMapper::updateBookAll($newBook);


            //avoid refresh issue, redirect page to home page 

            echo ("<script>location.href = 'Store_seller_home.php';</script>");

            break;
    }
}


if (!empty($_GET['action'])) {
    switch ($_GET["action"]) {
        case 'BookDeleteBySeller':
            $deletedBook = BookMapper::getBookbyIsbn($_GET["isbn"]);
            if (is_object($deletedBook)) {

                BookMapper::deleteBook($deletedBook);
            } else {
                //keep previous position, meantime it can avoid resubmitting issue while refresh the page
            }

            $currBookList = BookMapper::listBooks();
            $currImages = array();
            $currBookList = ParseBook::parseBookList($currBookList, $currImages);

            if (empty($currBookList)) {
                SellerPage::welcome($currSeller);
            } else {
                BookPage::showListOfBookForSeller($currBookList,$currFeedbackList);
            }

            break;

        case "BookEditBySeller":
            $id = $_GET['isbn'];
            $currBook = BookMapper::getBookbyIsbn($id);
            BookPage::bookEditFormBySeller($currBook, $currSeller);
            break;

        case "createNewBookBySeller":

            BookPage::createBookFormBySeller($currSeller);
            //AppointmentPage::createAppointmentFormByPatient($currPatient, $DrList);
            break;
        case "cancelAnyChange":
            $currBookList = BookMapper::listBooks();
            $currImages = array();
            $currBookList = ParseBook::parseBookList($currBookList, $currImages);

            if (empty($currBookList)) {
                SellerPage::welcome($currSeller);
            } else {
                BookPage::showListOfBookForSeller($currBookList,$currFeedbackList);
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
    $currImages = array();
    $currBookList = ParseBook::parseBookList($currBookList, $currImages);

    if (empty($currBookList)) {
        SellerPage::welcome($currSeller);
    } else {
        BookPage::showListOfBookForSeller($currBookList,$currFeedbackList);
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
                SellerPage::welcome($currSeller);
            } else {
                BookPage::showListOfBookForSeller($currBookList,$currFeedbackList);
            }
            break;
        case 'Author':
            $currBookList = ParseBook::sortbyAuthor($currBookList);
            if (empty($currBookList)) {
                SellerPage::welcome($currSeller);
            } else {
                BookPage::showListOfBookForSeller($currBookList,$currFeedbackList);}
            break;
        case 'Price':
            $currBookList = ParseBook::sortbyPrice($currBookList);
            if (empty($currBookList)) {
                SellerPage::welcome($currSeller);
            } else {
                BookPage::showListOfBookForSeller($currBookList,$currFeedbackList);}
            break;
        case 'Score':
            $currBookList = ParseBook::sortbyScore($currBookList);
            if (empty($currBookList)) {
                SellerPage::welcome($currSeller);
            } else {
                BookPage::showListOfBookForSeller($currBookList,$currFeedbackList);}
            break;

            case 'Search':
                $key= trim($_GET['search']);
              
                    $currBookList = BookMapper::listBooksBykeyWord($key);  
                if (empty($currBookList)) {
                    SellerPage::welcome($currSeller);
                } else {
                    $currBookList = ParseBook::parseBookList($currBookList, $currImages);
                    BookPage::showListOfBookForSeller($currBookList,$currFeedbackList);}
                break;
        default:
            # code...
            break;
    }
  
  
    
}


SellerPage::sellerEditForm($currSeller, $errors);

SellerPage::footer();

<?php

class buyerPage
{

    public static $title = "";

    static function header($logoff = null)
    { ?>

        <!doctype html>
        <html lang="en">

        <head>

            <!-- Basic Page Needs
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            <meta charset="utf-8">
            <title><?php echo self::$title; ?></title>
            <meta name="description" content="">
            <meta name="author" content="">
            <!--  add for jquery  -->
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- Check if its a logout page, if it is, then put in the redirect -->
            <?php if (!is_null($logoff)) {
                echo '<meta http-equiv="refresh" content="3; url=../Controller/Store_buyer_home.php">';
            } ?>

            <!-- Check in 15 mins if it is expired , if it is, then put in the redirect -->
            <meta http-equiv="refresh" content="1810; url=../Controller/Store_buyer_home.php">
            <!-- Mobile Specific Metas
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- FONT
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

            <!-- Favicon
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            <link rel="icon" type="image/png" href="../../images/favicon.png">


            <!-- CSS -->
            <link rel="stylesheet" href="../../css/bootstrap.min.css">
            <link rel="stylesheet" href="../../css/store.css">

            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="../../js/jquery-1.11.1.min.js"></script>-->
           
            <script src="../../js/jquery-3.5.1.min.js"></script>
            <script src="../../js/jquery-1.11.1.min.js"></script>


            <!-- Popper JS -->
            <script src="../../js/popper.min.js"></script>
            <script src="../../js/bootstrap.min.js"></script>
            <script src="../../js/store.js"></script>
  

        </head>

        <body>
            <div class="grid-container" id="grid-container">
                <div class="usedBookStore-header">
                    <h2><?php echo self::$title; ?></h2>
                </div>

            <?php }


        static function navigationBar()
        { ?>
                <div class="usedBookStore-navigation" id="usedBookStoreNavigationBar">
                    <nav class="navbar navbar-expand-lg navbar-light">

                    

                        <ul class="navbar-nav mr-auto">

                            <li class="nav-item active">
                                    <div class="nav-link">
                                    <form method="POST" ACTION="Store_buyer_home.php" ENCTYPE="multipart/form-data">
                                    <button type="submit" name="submit" value="showBookListForBuyer" id="showBookListForBuyer" class="btn  btn-link my-2 my-sm-0 ">
                                                Show Book List</button>               
                                    </form>
                                      
                                    </div>
                              
                            </li>

                            <li class="nav-item">
                                <div class="nav-link">
                                    <button type="submit" name="submit" value="editProfileByBuyer" id="editBuyerProfileByBuyer" class="btn  btn-link my-2 my-sm-0">Edit Profile
                                    </button>
                                </div>
                            </li>
                            
                            <li class="nav-item">
                                <div class="nav-link">
                                    <button type="submit"  class="btn  btn-link my-2 my-sm-0"><a href="../../checkoutPage.html">Transaction </a>
                                    </button>
                                </div>
                            </li>


                            <li class="nav-item">
                                <div class="nav-link">
                                    <form method="POST" ACTION="Store_buyer_logout.php" ENCTYPE="multipart/form-data">
                                        <button type="submit" name="logOut" value="logout" class="btn  btn-link my-2 my-sm-0">Log Out</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <form method="GET" ACTION="<?php $_SERVER["PHP_SELF"];?>" ENCTYPE="multipart/form-data">
                            <input class="form-control mr-sm-2" type="text" name="search" placeholder="key words" aria-label="Search">
                            <button class="btn btn-outline-info btn-dark my-2 my-sm-0 " type="submit" name="sort" value="Search">Search</button>
                            </form>
                        </form>

                    </nav>

                </div>




            <?php
        }



        static function footer()
        { ?>



                <div id="usedBookStore-footer">
                    <h6> Address of Used Book Store : Royal ave New Westminster</h6>
                </div>

            </div>
            <div id="usedBookStore-overlay"></div>




        </body>

        </html>
    <?php }


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

        static function showLogin($errors)
        { ?>

        <div id="popupBuyerLoginForm">
            <div class="form-head">
                <p>Login to your account</p>
            </div>
            <form method="POST" ACTION="<?PHP echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="email">Email</label>
                        <input type="text" class="form-control " cssClass="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your Email" required>
                        <span class="usedBookStore-message"> <?php if (!empty($errors['email'])) {
                                                            echo $errors['email'];
                                                        } ?> </span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="password">Passowrd</label>
                        <input type="password" class="form-control" cssClass="form-control" name="password" placeholder="Your Password" required>
                        <span class="usedBookStore-message"> <?php if (!empty($errors['password'])) {
                                                            echo $errors['password'];
                                                        } ?> </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">

                        <button type="submit" name="submit" value="confirmBuyerLogin" class="btn  btn-success btn-block ">Sign In</button>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <a class="dropdown-item" href='Store_buyer_login.php?mode=registerBuyer'>New around here? Sign up</a>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <a class="dropdown-item" href="#">Forgot password?</a>
                    </div>
                </div>

            </form>



        </div>



    <?php }


        static function buyerRegisterForm($errors)
        { ?>

        <div id="popupBuyerRegisterForm">


            <div class="form-head">
                <div><?php echo "New Buyer Register:"; ?> </div>
                <form method="POST" ACTION="Store_buyer_login" enctype="multipart/form-data">
                    <button class="form-closeMark"> &times</button>
                </form>
            </div> <br>


            <form method="POST" ACTION="<?PHP echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="firstName" placeholder="First Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="lastName" placeholder="Last Name" required>
                    </div>
                </div>

                <div class="form-row">
                <div class="form-group col-md-6">
                        <label>Password</label>
                        <input type="password" class="form-control " name="password" placeholder="Password" required>
                        <span class="usedBookStore-message"> <?php if (!empty($errors['password'])) {
                                                            echo $errors['password'];
                                                        } ?> </span>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Gender</label>
                        <select name="gender" class="form-control" required>
                            <option selected disabled value="">Choose...</option>
                            <option class="form-control col-md-6" value="Male">Male</option>
                            <option class="form-control col-md-6" value="Female">Female</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" class="form-control " name="email" placeholder="E-mail" required>
                        <span class="usedBookStore-message"> <?php if (!empty($errors['email'])) {
                                                            echo $errors['email'];
                                                        } ?> </span>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input type="text" class="form-control " name="contactNo" placeholder="Phone Number" required>

                    </div>
                </div>

              


                <div class="form-row">
                    <div class="form-group col-md-full">
                        <label>Address</label>
                        <textarea type="text" rows="2" cols="55" class="form-control" name="address" placeholder="Full Address" required></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" name="submit" value="confirmBuyerRegister" class="btn btn-success my-2 my-sm-0">Submit Register</button>
                    </div>
                </div>

            </form>
        </div>

    <?php
        }


        static function buyerEditForm($currBuyer, $errors)
        { ?>

        <div id="popupBuyerEditForm">

            <div class="form-head">
                <div><?php echo "Buyer Profile Edit:"; ?> </div>
                <button class="form-closeMark" id="cancelEditBuyerProfileByBuyer"> &times</button>

            </div> <br>

            <form method="POST" ACTION="<?PHP echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

                <input type="hidden" class="form-control" value="<?php echo $currBuyer->getBuyerId(); ?>" name="id" placeholder="" required>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label>First Name</label>
                        <input type="text" class="form-control" value="<?php echo $currBuyer->getBuyerFirstName(); ?>" name="firstName" placeholder="First Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Last Name</label>
                        <input type="text" class="form-control" value="<?php echo $currBuyer->getBuyerLastName(); ?>" name="lastName" placeholder="Last Name" required>
                    </div>
                </div>

                <div class="form-row">
               
                    <div class="form-group col-md-6">
                        <label>Gender</label>
                        <select name="gender" class="form-control" required>
                            <option selected disabled value="">Choose...</option>
                            <option class="form-control col-md-6" <?php if ($currBuyer->getBuyerGender() == 'Male') {
                                                                        echo 'selected';
                                                                    } ?> value="Male">Male</option>
                            <option class="form-control col-md-6" <?php if ($currBuyer->getBuyerGender() == 'Female') {
                                                                        echo 'selected';
                                                                    } ?> value="Female">Female</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" class="form-control " value="<?php echo $currBuyer->getBuyerEmail(); ?>" name="email" readonly placeholder="E-mail" required>
                        <span class="usedBookStore-message"> <?php if (!empty($errors['email'])) {
                                                            echo $errors['email'];
                                                        } ?> </span>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Phone</label>
                        <input type="text" class="form-control " value=<?php echo $currBuyer->getBuyerContactNo(); ?> name="contactNo" placeholder="Phone Number" required>

                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-full">
                        <label>Password</label>
                        <input type="password" class="form-control " cssClass="form-control" value=<?php echo $currBuyer->getBuyerPassword(); ?> name="password"  readonly placeholder="Password" required>
                        <span class="usedBookStore-message"> <?php if (!empty($errors['password'])) {
                                                            echo $errors['password'];
                                                        } ?> </span>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-full">
                        <label>Address</label>
                        <textarea type="text" rows="2" cols="55" class="form-control" name="address" placeholder="Full Address" required><?php echo $currBuyer->getBuyerAddress(); ?></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" name="submit" value="confirmBuyerEdit" class="btn btn-success my-2 my-sm-0">Submit Changes</button>
                    </div>

                </div>

            </form>
        </div>

    <?php
        }

        static function welcome($currentBuyer)
        { ?>
        <div class="usedBookStore-welcome">
            <table class="table table-borderless table-hover table-info">
                <tbody>
                    <tr>
                        <td>Hello <?php echo $currentBuyer->getBuyerFirstName(); ?>.</td>
                    </tr>
                    <tr>
                        <td>There is no any record of book! You may try to enter anoter key word.</td>
                    </tr>
                    <tr>
                        <td>We currently have the following email address on file for you: <?php echo $currentBuyer->getBuyerEmail(); ?>.</td>
                    </tr>
                    <tr>
                        <Td>Please contact us if you would like to change it.</td>
                    </tr>
                </tbody>
            </table>
        </div>

    <?php }


        

        static function createNewBuyerBar($currSeller)
        { ?>
        <div id="createNewPatientBar">


            <form method="POST" ACTION="<?PHP echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <div class="form-row">

                    <div class="form-group col-md-full">
                        <label>Hi <?php echo $currSeller->getSellerName(); ?>, click here to get a new buyer : </label>
                        <button type="submit" name="submit" value="createNewBuyerBySeller" class="btn btn-success my-2 my-sm-0">Create New Buyer</button>
                    </div>
                </div>

            </form>
        </div>
    <?php
        }

        static function showValidation($messages)
        { ?>

        <?php foreach ($messages as $message) {
                echo '<p style="color:blue; font-family:sans-serif">'
                    . $message . '</p>' . "\n";
            }

        ?>

    <?php   }


        static function thankYou()
        { ?>

        <div class="usedBookStore-goodbye">
            <p>Thanks for coming, bye.</p>
        </div>

<?php

        }
    }

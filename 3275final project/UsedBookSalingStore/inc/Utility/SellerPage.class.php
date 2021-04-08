<?php

class SellerPage
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
                echo '<meta http-equiv="refresh" content="3; url=../Controller/Store_seller_home.php">';
            } ?>
            <!-- Check in 15 mins if it is expired , if it is, then put in the redirect -->
            <meta http-equiv="refresh" content="1810; url=../Controller/Store_seller_home.php">
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
            <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

                                <div class="nav-link dropdown">
                                    <button type="button" class="btn  btn-link my-2 my-sm-0 dropdown-toggle" data-toggle="dropdown">
                                        Book Management
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="../Controller/Store_seller_home.php"> <button type="button" class="btn  btn-link my-2 my-sm-0 ">
                                                Book List</button></a>
                                        <a class="dropdown-item" href="../Controller/Store_seller_home.php?action=createNewBookBySeller">
                                            <button type="button" class="btn  btn-link my-2 my-sm-0 ">Create New book</button></a>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item">
                                <div class="nav-link">
                                    <button type="submit" name="submit" value="editProfileByDoctor" id="editSellerProfileBySeller" class="btn  btn-link">Edit Profile</button>
                                </div>
                            </li>




                            <li class="nav-item">
                                <div class="nav-link">
                                    <form method="POST" ACTION="../Controller/Store_seller_logout.php" ENCTYPE="multipart/form-data">
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
                    <h6> Address of Book Store : Royal ave New Westminster</h6>
                </div>

            </div>
            <div id="usedBookStore-overlay"></div>

        </body>

        </html>
    <?php }

      



        static function showSellerLogin($errors)
        { ?>

        <div id="popupSellerLoginForm">

            <div>
                <h3>sign in</h3>
            </div>
            <form method="POST" ACTION="<?PHP echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="email">Email</label>
                        <input type="text" class="form-control " cssClass="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email address" required>
                        <span class="usedBookStore-message"> <?php if (!empty($errors['email'])) {
                                                            echo $errors['email'];
                                                        } ?> </span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="password">Passowrd</label>
                        <input type="password" class="form-control" cssClass="form-control" name="password" placeholder="your password" required>
                        <span class="usedBookStore-message"> <?php if (!empty($errors['password'])) {
                                                            echo $errors['password'];
                                                        } ?> </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" value="confirmSellerLogin" class="btn  btn-success btn-block ">Sign In</button>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <a class="dropdown-item" href='../Controller/Store_seller_login.php?mode=registerSeller'>New around here? Sign up</a>
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


        static function SellerRegisterForm($errors)
        { ?>

        <div id="popupSellerRegisterForm">


            <div class="form-head">
                <div><?php echo "Seller Register:"; ?> </div>
                <form method="POST" ACTION="Store_seller_login" enctype="multipart/form-data">
                    <button class="form-closeMark"> &times</button>
                </form>
            </div>


            <form method="POST" ACTION="<?PHP echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Seller Name</label>
                        <input type="text" class="form-control" name="sellerName" placeholder="Seller full Name" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Password</label>
                        <input type="password" class="form-control " name="password" placeholder="Password" required>
                        <span class="usedBookStore-message"> <?php if (!empty($errors['password'])) {
                                                            echo $errors['password'];
                                                        } ?> </span>
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
                        <label>Contact Number</label>
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
                    <div class="form-group col-md-9">
                        <button type="submit" name="submit" value="confirmSellerRegister" class="btn btn-success my-2 my-sm-0">Submit Register</button>
                    </div>
                </div>

            </form>
        </div>

    <?php
        }


        static function sellerEditForm($currSeller, $errors)
        { ?>

        <div id="popupSellerEditForm">

            <div class="form-head">
                <div><?php echo "Seller Profile Edit:"; ?> </div>
                <button class="form-closeMark" id="cancelEditSellerProfileBySeller"> &times;</button>

            </div> <br>

            <form method="POST" ACTION="<?PHP echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

                <input type="hidden" class="form-control" value="<?php echo $currSeller->getSellerId(); ?>" name="sellerId" placeholder="" required>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Seller Name</label>
                        <input type="text" class="form-control" name="sellerName" value="<?php echo $currSeller->getSellerName(); ?>" placeholder="Seller full Name" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Password</label>
                        <input type="password" class="form-control " name="password" value="<?php echo $currSeller->getSellerPassword(); ?>" placeholder="Password" required>
                        <span class="usedBookStore-message"> <?php if (!empty($errors['password'])) {
                                                            echo $errors['password'];
                                                        } ?> </span>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" class="form-control " name="email" value="<?php echo $currSeller->getSellerEmail(); ?>" placeholder="E-mail" readonly required>
                        <span class="usedBookStore-message"> <?php if (!empty($errors['email'])) {
                                                            echo $errors['email'];
                                                        } ?> </span>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Contact Number</label>
                        <input type="text" class="form-control " name="contactNo" value="<?php echo $currSeller->getSellerContactNo(); ?>" placeholder="Phone Number" required>

                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Address</label>
                        <textarea type="text" rows="2" cols="55" class="form-control" name="address" placeholder="Full Address" required>
                        <?php echo $currSeller->getSellerAddress(); ?></textarea>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" name="submit" value="confirmSellerEdit" class="btn btn-success my-2 my-sm-0">Submit Changes</button>
                    </div>

                </div>

            </form>
        </div>

    <?php
        }




        static function welcome($currentSeller)
        { ?>


        <div class="usedBookStore-welcome">
            <table class="table table-borderless table-hover table-info">
                <tbody>
                    <tr>
                        <td>Hi <?php echo $currentSeller->getSellerName(); ?>,</td>
                    </tr>
                    <tr>
                        <td>There is no any record of Book!<a href="../Controller/Store_seller_home.php?action=createNewBookBySeller">
                                <button type="button" class="btn btn-info btn-success my-2 my-sm-0 "> Click here to create a new Book</button></a></td>
                    </tr>
                    <tr>
                        <td>We currently have the following email address on file for you: <?php echo $currentSeller->getSellerEmail(); ?>.</td>
                    </tr>
                    <tr>
                        <Td>Please contact us if you would like to change it.</td>
                    </tr>
                </tbody>
            </table>
        </div>

    <?php }


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

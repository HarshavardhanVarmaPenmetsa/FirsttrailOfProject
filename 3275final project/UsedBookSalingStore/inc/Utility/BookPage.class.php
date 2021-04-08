<?php


class BookPage

{

    static function showListOfbookForBuyer($listOfBook, $feedbackList)
    { ?>


        <div id="bookList">
            <div class="table-head">
                <p>Book List
                <p>
            </div>

            <FORM METHOD="GET" ACTION="<?php $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
                <table class="table table-info table-hover">
                    <thead>
                        <tr>


                            <th scope="col"> <input type="submit" class="btn btn-outline-info" name="sort" value="BookName"></th>
                            <th scope="col"> <input type="submit" class="btn btn-outline-info" name="sort" value="Author"></th>
                            <th scope="col">Version</th>

                            <th scope="col"> <input type="submit" class="btn btn-outline-info" name="sort" value="Price"></th>
                            <th scope="col">Description</th>

                            <th scope="col"> <input type="submit" class="btn btn-outline-info" name="sort" value="Score"></th>
                            <th scope="col">SellerName</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($listOfBook as $item) {
                            echo '<TR>
                       
                        <TD scope="row">' . $item[3] . '</TD>
                        <TD>' . $item[2] . '</TD>
                        <TD>' . $item[5] . '</TD>
                        <TD>' . $item[4] . '</TD>
                        <TD>' . $item[6] . '</TD>
                        <TD>' . $item[7] . '</TD>
                        <TD>' . $item[8] . '</TD>
                    <TD>' . '<button  class="btn btn-warning btn-info my-2 my-sm-0"><a href="?action=FeedbackCreateByBuyer&isbn=' . $item[0] . '">Adding Feedback</span></a>' . '</button></TD>
                    </TR>';
                            foreach ($feedbackList as $feedback) {
                                if ($item[0] ==(int)$feedback->getBookIsbn()) {
                                    echo '<tr><td></td><td colspan="5"><li >'.$feedback->getBuyerName()." marks the book score as ".$feedback->getScore()." and comment as following:"
                           
                                     .$feedback->getComment().
                                    ' </li><td><tr>';
                                }
                            }
                        }

                        ?>

                    </tbody>
                </table>
            </FORM>
        </div>




    <?php
    }



    static function showListOfBookForSeller($listOfBook,$feedbackList)
    { ?>

        <div id="bookList">
            <div class="table-head">
                <p> Book List
                <p>
            </div>
            <FORM METHOD="GET" ACTION="<?php $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
                <table class="table table-hover table-success">
                    <thead>
                        <tr>




                            <th scope="col">ISBN</th>

                            <th scope="col"> <input type="submit" name="sort" value="BookName" class="btn btn-outline-info"></th>
                            <th scope="col"> <input type="submit" name="sort" value="Author" class="btn btn-outline-info"></th>
                            <th scope="col">Version</th>

                            <th scope="col"> <input type="submit" name="sort" value="Price" class="btn btn-outline-info"></th>
                            <th scope="col">Description</th>

                            <th scope="col"> <input type="submit" name="sort" value="Score" class="btn btn-outline-info"></th>
                            <th scope="col">Seller Name</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($listOfBook as $item) {
                            echo '<TR>
                    <TD scope="row">' . $item[0] . '</TD>
                    <TD>' . $item[3] . '</TD>
                    <TD>' . $item[2] . '</TD>
                    <TD>' . $item[5] . '</TD>
                    <TD>' . $item[4] . '</TD>
                    <TD>' . $item[6] . '</TD>
                    <TD>' . $item[7] . '</TD>
                    <TD>' . $item[8] . '</TD>
                  
                    <TD>' . '<button class="btn btn-outline-info btn-warning my-2 my-sm-0"><a href="?action=BookEditBySeller&isbn=' . $item[0] . '">Edit</a>' . '</button></TD>
                    <TD>' . '<button class="btn btn-outline-info btn-danger my-2 my-sm-0"><a href="?action=BookDeleteBySeller&isbn=' . $item[0] . '">Delete</a>' . '</button></TD>

                    </TR>';
                    foreach ($feedbackList as $feedback) {
                        if ($item[0] ==(int)$feedback->getBookIsbn()) {
                            echo '<tr><td></td><td colspan="6"><li >'.$feedback->getBuyerName()." marks the book score as ".$feedback->getScore()." and comment as following:"
                   
                             .$feedback->getComment().
                            ' </li><td><tr>';
                        }
                    }
                        }

                        ?>

                    </tbody>
                </table>
            </FORM>
        </div>

    <?php
    }
    /*
    <th scope="col">Id</th>
    <th scope="col">Seller Name</th>
    <th scope="col">Book Name</th>
    <th scope="col">Auther</th>
    <th scope="col">Version</th>
    <th scope="col">Price</th>
    <th scope="col">Description</th>
    <th scope="col">Score</th>
*/
    static function createBookFormBySeller($currSeller)
    { ?>

        <div id="popupBookCreate">

            <div class="form-head">
                <div> <?php echo "Hi " . $currSeller->getSellerName() . ",please create a new book:"; ?></div>
                <a href="Store_seller_home.php?action=cancelAnyChange"><button class="form-closeMark"> &times</button></a>

            </div>

            <form method="POST" ACTION="<?PHP echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Book Name</label>
                        <input type="text" class="form-control" name="bookName" placeholder="Book Name" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Author</label>
                        <input type="text" class="form-control" name="author" placeholder="Author Name" required>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Book Version</label>
                        <input type="text" class="form-control" name="version" placeholder="Version of Book" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Book Price</label>
                        <input type="text" class="form-control" name="price" placeholder="Price of Book" required>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Book Description</label>
                        <textarea class="form-control" name="description" cols="10" rows="3" required></textarea>
                    </div>
                </div>



                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" name="submit" value="confirmBookCreationbySeller" class="btn btn-success my-2 my-sm-0">Submit</button>
                    </div>

                </div>

            </form>
        </div>

    <?php }

    static function bookEditFormBySeller($book, $seller)
    { ?>

        <div id="popupBookEdit">
            <div class="form-head">
                <div> <?php echo "Hi " . $seller->getSellerName() . ", please edit the Book"; ?></div>
                <a href="Store_seller_home.php?action=cancelAnyChange"><button class="form-closeMark"> &times</button></a>

            </div>
            <!-- the form format reference by https://getbootstrap.com/docs/4.3/components/forms/-->
            <form method="POST" ACTION="<?PHP echo $_SERVER["PHP_SELF"]; ?>" ENCTYPE="multipart/form-data">

                <input type="hidden" name="isbn" value="<?php echo $book->getBookIsbn(); ?>">
                <input type="hidden" name="sellerId" value="<?php echo $seller->getSellerId(); ?>">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="bookName">Book Name: </label>
                        <input type="text" class="form-control" name="bookName" placeholder="" value="<?php echo $book->getBookName(); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Author</label>
                        <input type="text" name="author" class="form-control" placeholder="" value="<?php echo $book->getBookAuthor(); ?>" required>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Book Version</label>
                        <input type="text" name="version" class="form-control" placeholder="" value="<?php echo $book->getBookVersion(); ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Book Price</label>
                        <input type="text" name="price" class="form-control" placeholder="" value="<?php echo $book->getBookPrice(); ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Book Description</label>
                        <textarea name="description" class="form-control" placeholder="" cols="10" rows="3" required><?php echo $book->getBookDescription(); ?></textarea>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" name="submit" value="confirmBookEditBySeller" class="btn  btn-success my-2 my-sm-0">Submit Changes</button>
                    </div>

                </div>
            </form>
        </div>


<?php }
}

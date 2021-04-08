<?php


class FeedbackPage

{

    static function showFeedback($feedbackList)
    { ?>


            <table class="table table-info table-hover">
                <thead>
                    <tr>

                       
                      
                      
                        <th scope="col">Version</th>
                        
                     
                        <th scope="col">Description</th>
                        <th scope="col">BuyerName</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($feedbackList as $item) {
                        echo '<TR>
                       
                        <TD scope="row">' . $item[3] . '</TD>
                        <TD>' . $item[2] . '</TD>
                        <TD>' . $item[5] . '</TD>    

                    </TR>';
                    }

                    ?>

                </tbody>
            </table>
            </FORM>
        </div>




    <?php
    }



    
    static function createFeedbackFormByBuyer($currBuyer, $isbn)
    { ?>

        <div id="popupBookCreate">

            <div class="form-head">
                <div> <?php echo "Hi " . $currBuyer->getBuyerFirstName() . ",please create a new feedback:"; ?></div>
                <a href="Store_buyer_home.php?action=cancelAnyChange"><button class="form-closeMark"> &times</button></a>

            </div>

            <form method="POST" ACTION="<?PHP echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <input type="hidden" name="isbn" value=<?php echo $isbn;?>>
                <input type="hidden" name="firstName" value=<?php echo $currBuyer->getBuyerFirstName();?>>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Feedback</label>
                        <textarea class="form-control" name="comment" cols="10" rows="3" placeholder="enter your feedback" required></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Score</label>
                        <select name="score" class="form-control" required>
                            <option selected disabled value="">Choose...</option>
                            <option class="form-control col-md-6" value="0">0</option>
                            <option class="form-control col-md-6" value="1">1</option>
                            <option class="form-control col-md-6" value="2">2</option>
                            <option class="form-control col-md-6" value="3">3</option>
                            <option class="form-control col-md-6" value="4">4</option>
                            <option class="form-control col-md-6" value="5">5</option>
                        </select>
                    </div>
              
                </div>
             
             
              
             



                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" name="submit" value="confirmFeedbackCreationbyBuyer" class="btn btn-success my-2 my-sm-0">Submit</button>
                    </div>

                </div>

            </form>
        </div>

    <?php }

   
}

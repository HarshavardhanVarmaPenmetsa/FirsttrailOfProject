<?php



class StorePage
{


    static function showAlertForSeller($alert, $currentUser)
    { ?>

        <div class="usedBookStoreAlert">
            <div class="alert alert-info" role="alert">
                Hi <?php echo $currentUser->getSellerName() . $alert; ?> A simple info alert—check it out!
            </div>

        </div>
    <?php
    }


    static function showAlertForBuyer($alert, $currentUser)
    { ?>

        <div class="usedBookStoreAlert">
            <div class="alert alert-info" role="alert">
                Hi <?php echo $currentUser->getBuyerFirstName() . $alert; ?> A simple info alert—check it out!
            </div>

        </div>
<?php
    }
}


?>
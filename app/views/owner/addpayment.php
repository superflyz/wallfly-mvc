<?php
/**
 * Created by PhpStorm.
 * User: jimmykovacevic
 * Date: 3/10/2015
 * Time: 4:51 PM
 */
require_once '../app/views/templates/interfaceStart.php';
?>
<!--Content here-->
<div class="container">
    <!--    <div class="row">-->
    <!--        <div class="col-md-12">-->
    <!--            <h1 class="wlcm-h1">Welcome <span class="user-color"> User!</span></h1>-->
    <!--        </div>-->
    <!--    </div>-->
    <div class="row">
        <div class="col-md-12">
            <!-- Features Section -->
            <section id="dash-links">
                <div class="container-fluid">
                    <div class="row text-center">
                        <?php if (isset($_SESSION['selectedProperty'])) { ?>
                        <form id="addPayment" method="post" action="<?=WEBDIR?>/propertyowner/processPayment">
                            <label>Date Processed</label><br/><input type="text" name="date" placeholder="dd/mm/yyyy" value=""/><br/>
                            <label>Name</label><br/><input type="text" name="name" placeholder="Payee name" value=""/><br/>
                            <label>Amount</label><br/><input type="text" name="amount" placeholder="$0.00" value=""/><br/>
                            <input type="submit" name="addPaymentButton" value="add">
                        </form>
                        <?php }?>
                    </div>
            </section>
        </div>
    </div>
</div>

<?php
require_once '../app/views/templates/interfaceEnd.php';
?>


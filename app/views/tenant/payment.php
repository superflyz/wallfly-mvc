<?php
require_once '../app/views/templates/interfaceStart.php';
require_once '../app/views/templates/selectProperty.php';
?>
<!--Content here-->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="row text-center">
                    <?php if (isset($_SESSION['selectedProperty'])) { ?>
                    <div class="col-md-3 col-sm-6">
                        <a href="<?=WEBDIR?>/propertytenant/viewPayments">
                            <div class="dash-link">
                                <span class="icons">
                                    <i class="fa fa-calendar fa-inverse"></i>
                                </span>
                                <h4 class="link-heading">View Payments</h4>
                                <?php
                                    $result = $_SESSION['selectedProperty']->getPayments();

                                    for ($i = 0; $i < 1; $i++) {
                                        echo "<p class='link-text'>Last payment was $".$result[$i]['amount']." payed on ".$result[$i]['time'].".";
                                    }
                                ?>
                                <p class="link-text">View more payments.</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="<?=WEBDIR?>/propertytenant/addPayment">
                            <div class="dash-link">
                                <span class="icons">
                                    <i class="fa fa-home fa-inverse"></i>
                                </span>
                                <h4 class="link-heading">Add Payment</h4>
                            </div>
                        </a>
                    </div>
                    <?php } else {?>
                        <h4 class="link-heading">Please select a property.</h4>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../app/views/templates/interfaceEnd.php';
?>


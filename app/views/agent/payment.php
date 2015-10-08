<?php
require_once '../app/views/templates/interfaceStart.php';
?>

<?php
$properties = $_SESSION['user']->getProperties();

//dropdown for property list
echo '<div class="container">

<div class="btn-group">
    <a class="btn btn-primary dropdown-toggle show-properties selector" data-toggle="dropdown" href="#" style="margin-left: 15px;">Select a Property</a>
</div>';

?>

<div id="reducedPadding" class="container">
    <div id="propertyHolder">
        <input placeholder="type to search..." id="box" type="text"/>
        <ul class="navList ">
            <?php

            for($i=0;$i<count($properties);$i++){

                echo '<li id="'.$i.'"><a>' . $properties[$i]->address . '</a></li>';
            }
            ?>
        </ul>
    </div>
</div>

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
                        <div class="col-md-3 col-sm-6">
                            <a href="<?=WEBDIR?>/propertyagent/viewPayments">
                                <div class="dash-link">
                                    <span class="icons">
                                    <i class="fa fa-calendar fa-inverse"></i>
                                    </span>
                                    <h4 class="link-heading">View Payments</h4>
                                    <?php
                                    $result = $_SESSION['selectedProperty']->getPayments();

                                    for ($i = 0; $i < 1; $i++) {
                                        echo "<p class='link-text'>Last payment was $" . $result[$i]['amount'] . " payed on " . $result[$i]['time'] . ".";
                                    }
                                    ?>
                                    <p class="link-text">View more payments.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="<?=WEBDIR?>/propertyagent/addPayment">
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
            </section>
        </div>
    </div>
</div>



<?php
require_once '../app/views/templates/interfaceEnd.php';
?>


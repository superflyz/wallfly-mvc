<?php
require_once '../app/views/templates/interfaceStart.php';
//require_once '../app/views/templates/selectProperty.php';
?>
<!--Content here-->

<div class="row">
    <div class="col-md-12">
        <div class="page_heading">
            <p>Payments</p>
            <hr />
        </div>
        <div class="pull-right">
            <img class="paypal" src="<?=WEBDIR?>/images/paypal.png" />
        </div>
          
    </div>
</div>
            
 <div class="row">
    <div class="col-md-12">
        <div class="manage_properties_pills">
          <!-- Nav pills -->
          <ul class="nav nav-pills nav-justified properties_pills">
   
             <li role="presentation" id="hi"><a href="#home4" aria-controls="home4" role="pill" data-toggle="pill" >Payment History</a></li>
              <li role="presentation"><a href="#profile2" aria-controls="profile2" role="pill" data-toggle="pill">Add Payment</a></li>
          </ul>
        
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- Pill panes -->
        <div class="pill-content manage_properties_view">
            <div role="pillpanel" class="pill-pane active" id="home">
              <?php
                if (isset($_SESSION['selectedProperty'])) {
                    $result = $_SESSION['selectedProperty']->getPayments();
                    $rent = $_SESSION['selectedProperty']->getRent();
                    $rentType = $_SESSION['selectedProperty']->payment_schedule;
                    if ($result) {
                        for ($i = 0; $i < 1; $i++) {
                            echo "<div class='last_payment'>
                                        <p>Your weekly rent is $" . $rent . " and it is due " . $rentType . "</p>
                                        <p>Last payment was <b>$" . $result[$i]['amount'] . "</b> payed on <i>" . date('M, d Y', strtotime($result[$i]['time'])) . "</i></p>
                                    </div>";                        }
                    } else {
                        echo "<div class='last_payment'>
                                <p>Your weekly rent is $" . $rent . " and it is due " . $rentType . "</p>
                            </div>";
                    }
                }
              ?>
            </div>
            <div role="pillpanel" class="pill-pane" id="home4">
                <?php if (isset($_SESSION['selectedProperty'])) { ?>
                <div class="row">
                    <div class="col-md-12">
                    <?php if (isset($_SESSION['selectedProperty'])) { ?>
                        <?php
                        $result = $_SESSION['selectedProperty']->getPayments();
                        if ($result) {
                            foreach ($result as $row) {
                                echo "
                                <div class='row payment_history'>
                                    <div class='col-md-4 col-sm-4 col-xs-4'>
                                        <div class='payment_history_date'>
                                            <div class='hd-text-date'>Date<hr class='payment_hr'></div>
                                            <div class='bd-text-date'>" . date('M, d Y', strtotime($row['time'])) .
                                            "</div>
                                        </div>
                                    </div>" .

                                    "<div class='col-md-4 col-sm-4 col-xs-4'>
                                        <div class=''>
                                            <div class='hd-text-amount'>Payee Name<hr class='payment_hr'></div>
                                            <div class='bd-text-amount'>" . $row['payee'] . "</div>
                                        </div>
                                    </div>" .

                                    "<div class='col-md-4 col-sm-4 col-xs-4 payment_history_amount'>
                                        <div class='payment_history_amount'>
                                            <div class='hd-text-amount'>Amount<hr class='payment_hr'></div>
                                            <div class='bd-text-amount'>$" . $row['amount'] . "</div>
                                        </div>
                                    </div>
                            </div>";
                            }
                        }
                        ?>
                    <?php }?>
                    </div>
                </div>
                <?php }?>
            </div>
            <div role="pillpanel" class="pill-pane" id="profile2">
                <div class="add_payments">
                <?php if (isset($_SESSION['selectedProperty'])) { ?>
                    <form id="addPayment" method="post" action="<?=WEBDIR?>/propertytenant/processPayment">
                    <div class="row first_row">
                        <div class="col-md-4 col-md-offset-1">
                        <div class="form-field ">
                            <label for="payeeName">Payee Name</label>
                            <input name="payeeName" type="text" class="form-control">
                            <span class="error"></span>
                        </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                        <div class="form-field  ">
                            <label for="amount">Payment Amount</label>
                            <input name="amount" type="text" class="form-control">
                            <span class="error"></span>
                        </div>
                        </div>
                    </div>
                        <!-- date picker -->
                            <div class="row second_row">
                                <div class="col-md-4 col-md-offset-1 ">
                        <div class="form-field">
                            <label for="startDate">Rent Start Week</label>
                            <input name="startDate" id="startDate" type="text"  class="form-control" >
                            <pre hidden id="hidden" class="event-receiver"></pre>
                            <span class="error"></span>
                            <section style="height:160px">
                                <div class="col-md-12 zeropad">
                                    <div class="dzscalendar skin-aurora" id="trauroradatepicker" style="height:160px">
                                    </div>
                                </div>
                            </section>

                        </div>
                                    </div>

                        <!-- end date picker -->

                        <!-- date picker -->
                                <div class="col-md-4 col-md-push-1">
                        <div class="form-field">
                            <label for="endDate">Rent End Week</label>
                            <input name="endDate" id="endDate" type="text"  class="form-control" >
                            <pre hidden id="hidden2" class="event-receiver2"></pre>
                            <span class="error"></span>
                            <section style="height:160px">
                                <div class="col-md-12 zeropad">
                                    <div class="dzscalendar skin-aurora" id="trauroradatepicker2" style="height:160px">
                                    </div>
                                </div>
                            </section>
                                    </div>
                        </div>


                        </div>

                        <!-- end date picker -->
                        <div class="row first_row">
                            <div class="col-md-4 col-md-offset-1">
                                <div class="form-field">
                                    <label for="creditCard">Credit Card Number</label>
                                    <input name="creditCard" id= "creditCard" type="text" class="form-control">
                                    <span class="error"></span>
                                </div>
                            </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                       <div class="form-field">
                                <label for="ccv">CCV</label>
                                <input name="ccv" type="text" class="form-control">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" name="Submit" value="submit" id="submit-btn" style="margin-top: 10px;" class="btn btn-primary submit eventsubmit pull-right">Add Payment</button>
                        </div>
                        </div>
                    </form>
                    <?php }?>
                </div>

            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    
    $('.manage_properties_pills ul li').click(function (e) {
        e.preventDefault()
        $(this).pill('show')
    })

    document.title = 'Payments - WallFly';
</script>

<?php
require_once '../app/views/templates/interfaceEnd.php';
?>


<?php
require_once '../app/views/templates/interfaceStart.php';
?>

<!--Content here-->
<div class="row">
    <div class="col-md-12">
        <div class="page_heading">
            <p>Payments</p>
            <hr />
        </div>
    </div>
</div>
            
 <div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="manage_properties_pills">
          <!-- Nav pills -->
          <ul class="nav nav-pills nav-justified properties_pills">
   
             <li role="presentation"><a href="#payment_history" aria-controls="payment_history" role="pill" data-toggle="pill" >Payment History</a></li>
              <li role="presentation"><a href="#add_payment" aria-controls="add_payment" role="pill" data-toggle="pill">Add Payment</a></li>
          </ul>
        
        </div>
    </div>
</div>
</div>
</div>

<div class="row bottom-section">
<div class="row">
    <div class="col-md-12">
        <!-- Pill panes -->
        <div class="pill-content payments_view">
            <div role="pillpanel" class="pill-pane active">
                <?php
                    if (isset($_SESSION['selectedProperty'])) {
                        $result = $_SESSION['selectedProperty']->getPayments();
                        $rent = $_SESSION['selectedProperty']->getRent();
                        $rentType = $_SESSION['selectedProperty']->payment_schedule;
                        if ($result) {
                            for ($i = 0; $i < 1; $i++) {
                                echo "<div class='weekly_rent'>
                                        <p>Your weekly rent is <b>$" . $rent . "</b> and it is due <i>" . $rentType . "</i></p>
                                        </div>
                                        <div class='last_payment'>
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
            <div role="pillpanel" class="pill-pane" id="payment_history">
                <?php if (isset($_SESSION['selectedProperty'])) { ?>
                    <?php
                    $result = $_SESSION['selectedProperty']->getPayments();
                    if ($result) {
                        foreach ($result as $row) {
                            echo "
                            <div class='row payment_history'>
                                <div class='col-md-4 col-sm-4 col-xs-12'>
                                    <div class='payment_history_date'>
                                    <div class='hd-text-date'>Date<hr class='payment_hr'></div>
                                        <div class='bd-text-date'>" . date('M, d Y', strtotime($row['time'])) .
                                "       </div>
                                    </div>
                                </div>" .

                                "<div class='col-md-4 col-sm-4 col-xs-12'>
                                    <div class='payment_history_date'>
                                        <div class='hd-text-amount'>Payee Name<hr class='payment_hr'></div>
                                        <div class='bd-text-amount'>" . $row['payee'] . "</div>
                                    </div>
                                </div>" .
                            
                                "<div class='col-md-4 col-sm-4 col-xs-12 payment_history_amount'>
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
            <div role="pillpanel" class="pill-pane" id="add_payment">
                <div class="add_payments">
                <?php if (isset($_SESSION['selectedProperty'])) { ?>
                    <form id="addPayment" method="post" action="<?=WEBDIR?>/propertyowner/processPayment">
                    <div class="row add_payment_inpt">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="add_payment_inpt1">
                                <label for="payeeName">Payee Name</label>
                                <input name="payeeName" type="text" class="form-control" />
                                <span class="error"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="add_payment_inpt2">
                                <label for="amount">Payment Amount</label>
                                <input name="amount" type="text" class="form-control" />
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                    <!-- date picker -->
                    <div class="row add_payment_cal">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="add_payment_cal1">
                                <label for="startDate">Rent Start Week</label>
                                <pre hidden id="hidden" class="event-receiver"></pre>
                                <span class="error"></span>
                                <div class="dzscalendar skin-aurora" id="trauroradatepicker" style="max-height:160px">
                                </div>
                            </div>
                        </div>
                        <!-- end date picker -->

                        <!-- date picker -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="add_payment_cal2">
                                <label for="endDate">Rent End Week</label>
                                <pre hidden id="hidden2" class="event-receiver2"></pre>
                                <span class="error"></span>
                                    
                                <div class="dzscalendar skin-aurora" id="trauroradatepicker2" style="max-height:160px">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end date picker -->
                    <div class="row add_payment_btn">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <button type="submit" name="add" class="btn btn-add-payment pull-right">Add Payment</button>
                        </div>
                    </div>
                </form>
                <?php }?>
            </div>
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


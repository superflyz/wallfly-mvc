<?php
/**
 * Created by PhpStorm.
 * User: jimmykovacevic
 * Date: 3/10/2015
 * Time: 4:51 PM
 */
require_once '../app/views/templates/interfaceStart.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <!-- Features Section -->
            <div class="container-fluid center-block">
                <div class="text-center">
                    <?php if (isset($_SESSION['selectedProperty'])) { ?>
                        <form id="addPayment" method="post" action="<?=WEBDIR?>/propertytenant/processPayment">
                            <div class="form-field">
                                <label for="payeeName">Payee Name</label>
                                <input name="payeeName" type="text" class="form-control">
                                <span class="error"></span>
                            </div>

                            <!-- date picker -->

                            <div class="form-field">
                                <label for="startDate">Rent Start Week</label>
                                <input name="startDate" id="startDate" type="text"  class="form-control" >
                                <pre hidden id="hidden" class="event-receiver"></pre>
                                <span class="error"></span>
                                <section style="height:160px">
                                    <div class="col-md-12">
                                        <div class="dzscalendar skin-aurora" id="trauroradatepicker" style="height:160px">
                                        </div>
                                    </div>
                                </section>

                            </div>

                            <!-- end date picker -->

                            <!-- date picker -->

                            <div class="form-field">
                                <label for="endDate">Rent End Week</label>
                                <input name="endDate" id="endDate" type="text"  class="form-control" >
                                <pre hidden id="hidden2" class="event-receiver2"></pre>
                                <span class="error"></span>
                                <section style="height:160px">
                                    <div class="col-md-12">
                                        <div class="dzscalendar skin-aurora" id="trauroradatepicker2" style="height:160px">
                                        </div>
                                    </div>
                                </section>

                            </div>

                            <!-- end date picker -->

                            <div class="form-field">
                                <label for="creditCard">Credit Card Number</label>
                                <input name="creditCard" id= "creditCard" type="text" class="form-control">
                                <span class="error"></span>
                            </div>
                            <div class="form-field">
                                <label for="ccv">CCV</label>
                                <input name="ccv" type="text" class="form-control">
                                <span class="error"></span>
                            </div>

                            <div class="form-field">
                                <label for="amount">Payment Amount</label>
                                <input name="amount" type="text" class="form-control">
                                <span class="error"></span>
                            </div>

                            <div>
                                <button type="submit" name="Submit" value="submit" id="submit-btn" style="width: 120px;"
                                        class="btn btn-primary submit eventsubmit">Make Payment
                                </button>
                            </div>
                        </form>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../app/views/templates/interfaceEnd.php';
?>


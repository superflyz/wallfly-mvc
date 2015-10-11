<?php
/**
 * Created by PhpStorm.
 * User: jimmykovacevic
 * Date: 3/10/2015
 * Time: 4:51 PM
 */
require_once '../app/views/templates/interfaceStart.php';
require_once '../app/views/templates/selectProperty.php';
?>
    <!--Content here-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="wlcm-h1">Make a Repair Request</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="container-fluid">
                    <?php if (isset($_SESSION['selectedProperty'])) { ?>
                        <form id="addPayment" enctype="multipart/form-data" method="post" action="<?=WEBDIR?>/propertytenant/processRepairRequest">
                            <div class="form-field">
                                <label for="subject">Subject</label>
                                <input name="subject" type="text" class="form-control">
                                <span class="error"></span>
                            </div>

                            <div class="form-field">
                                <label for="description">Description</label>
                                <input name="description" id= "description" type="text" class="form-control">
                                <span class="error"></span>
                            </div>

                            <div class="form-field">
                                <label for="severity">Severity Level</label>
                                <input name="severity" type="text" class="form-control">
                                <span class="error"></span>
                            </div>

                            <div class="form-field">
                                <label for="image">Image</label>
                                <input type="file" name="image" size="2000000"
                                       accept="image/jpeg, image/x-ms-bmp, image/x-png" id="image">
                                <span class="error"></span>
                                <br />
                            </div>

                            <div>
                                <button type="submit" name="Submit" value="submit" id="submit-btn" style="width: 120px;"
                                        class="btn btn-primary submit eventsubmit">Submit Request
                                </button>
                            </div>
                        </form>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

<?php
require_once '../app/views/templates/interfaceEnd.php';
?>
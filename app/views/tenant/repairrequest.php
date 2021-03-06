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
<div class="row">
    <div class="col-md-12">
        <div class="page_heading">
            <p>Repair Request</p>
            <hr />
        </div>
    </div>
</div>

        <div class="row">
            <div class="col-md-4">
                <div class="container-fluid">
                    <?php if (isset($_SESSION['selectedProperty'])) { ?>
                        <form id="repairRequest" enctype="multipart/form-data" method="post" action="<?=WEBDIR?>/propertytenant/processRepairRequest">
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
                                <select name="severity" class="form-control formSelect">
                                    <option value="" class="form-control">Please select...</option>
                                    <option value="low" class="form-control">Low</option>
                                    <option value="medium" class="form-control">Medium</option>
                                    <option value="high" class="form-control">High</option>
                                </select>
                                <span class="error"></span>
                            </div>

                            <div class="form-field">
                                <label for="image">Image</label>
                                <input type="file" name="image" size="2000000"
                                       accept="image/jpeg, image/x-ms-bmp, image/png" id="image">
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


<?php
require_once '../app/views/templates/interfaceEnd.php';
?>
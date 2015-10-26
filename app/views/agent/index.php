<?php
require_once '../app/views/templates/interfaceStartIndex.php';
?>

<!--Content here-->
<div class="row">
    <div class="col-md-12">
        <div class="col-md-8">
            <h1 class="wlcm-h1">Welcome <span class="user-color"><?php echo $_SESSION['user']->firstname?>!</span></h1>
        </div>
        <div class="col-md-4">
            <button class="btn btn-add-property pull-right" data-toggle="modal" data-target="#addpropertyform"><i class="fa fa-plus-square"></i>Add property</button>
        </div>
    </div>
</div>
</div>
</div>

<div class="row bottom-section">
    <div class="col-md-12">
        <div class="row dash_p_list">
            <?php
            $properties = $_SESSION['user']->getProperties();
            $count = 0;
            foreach ($properties as $property) {
                ?>
                <div class="col-md-3">
                    <form id="viewDetails" method="post" action="<?=WEBDIR?>/propertyagent/viewDetails">
                        <div class="dash_p">
                            <div class="dash_p_img">
                                <img class="img-responsive" src="<?php echo $property->photo?>">
                            </div>
                            <div class="dash_p_add_btn">
                                <div class="dash_p_add">
                                    <p><?php echo $property->address?></p>
                                </div>
                                <div class="dash_p_btn">
                                    <button type="submit" name="submit" value="<?php echo $count;?>" class="btn btn-view-details">View Details</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                $count++;
            }
            ?>
        </div>
    </div>
</div>
<!-- add property modal -->
<div class="modal modal-vcenter fade" id="addpropertyform" tabindex="-1" role="dialog"  aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <p class="modal-title">Add Property</p>
            </div>
            <div class="modal-body">
                <!-- FORM STARTS HERE -->
                <form action="<?=WEBDIR?>/propertyagent/addproperty" method="post">
                    <div class="add_property">
                        <div class="ap_field_a">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="ap_field_r">
                                    <label for="rent_amount">Rent amount ($)</label>
                                    <input type="text" class="form-control" id="rent_amount" name="rent_amount" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ap_field_ps">
                                    <label for="payment_schedule">Payment schedule</label>
                                    <select name="payment_schedule" id="payment" class="form-control">
                                        <option disabled selected hidden>Please select...</option>
                                        <option value="WEEKLY">Weekly</option>
                                        <option value="FORTNIGHTLY">Fortnightly</option>
                                        <option value="MONTHLY">Monthly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="ap_btnz">
                                <button type="submit" class="btn btn-save-changes pull-right">Save changes</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- FORM ENDS HERE -->
            </div>
        </div>
    </div>
</div>
<script>
    document.title = 'Dashboard - WallFly';
</script>
<?php
require_once '../app/views/templates/interfaceEnd.php';
?>




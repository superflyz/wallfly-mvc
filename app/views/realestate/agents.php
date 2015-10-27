<?php
    require_once '../app/views/templates/interfaceStartIndex.php';
?>

<!--Content here-->
<div class="row">
    <div class="col-md-12">
        <div class="col-md-8">
        <h1 class="wlcm-h1">Your agents</h1>
    </div>   
            <div class="col-md-4">
             <button class="btn btn-add-property pull-right" data-toggle="modal" data-target="#addpropertyform"><i class="fa fa-plus-square"></i>Add agent</button>
    </div>
         </div>
</div>
</div>
</div>
<div class="row bottom-section">
    <div class="col-md-12">
        <div class="row dash_p_list">
            <?php foreach($data->getAgents() as $agent): ?>
                <div class="col-md-3">
                    <form id="viewDetails" method="post" action="<?=WEBDIR?>/realest/viewagent">
                        <div class="dash_p">
                            <div class="dash_p_img">
                                <img class="img-responsive" src="<?=WEBDIR . '/' . $agent->photo?>">
                            </div>
                            <div class="dash_p_add_btn">
                                <div class="dash_p_add">
                                    <p><strong><?=$agent->firstname?> <?=$agent->lastname?></strong></p>
                                </div>
                                <div class="dash_p_btn">
                                    <button type="submit" name="submit" value="<?php echo $count;?>" class="btn btn-view-details">View Details</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php endforeach ?>
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
                <form action="<?=WEBDIR?>/realest/addagent" method="post">
                    <div class="col-md-6">
                        <div class="at_field_fn">
                            <label for="firstname">First name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="at_field_ln">
                            <label for="lastname">Last name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-field">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="col-md-12">
                        <div class="at_btnz">
                            <button type="submit" class="btn btn-save-changes pull-right">Save changes</button>
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




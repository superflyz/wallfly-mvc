<?php
require_once '../app/views/templates/interfaceStart.php';
?>
<!--Content here-->
<div class="row">
    <div class="col-md-12">
        <div class="page_heading">
            <p>Properties</p>
            <hr />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="manage_properties_pills">
          <!-- Nav pills -->
          <ul class="nav nav-pills nav-justified properties_pills">
            <li role="presentation"><a href="#detail" aria-controls="detail" role="pill" data-toggle="pill">Property Details</a></li>
            <li role="presentation"><a href="#documents" aria-controls="documents" role="pill" data-toggle="pill">Documents</a></li>
            <li role="presentation"><a href="#inspections" aria-controls="inspections" role="pill" data-toggle="pill">Inspections</a></li>
            <li role="presentation"><a href="#rta" aria-controls="rta" role="pill" data-toggle="pill">R.T.A</a></li>
          </ul>
        
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- Pill panes -->
        <div class="pill-content manage_properties_view">
            <div role="pillpanel" class="pill-pane" id="detail">
                <?php if ($property = $data['property']): ?>
                    <!-- This is to get the property address -->
                    Address: <span class="edit"><?=$data['property']->address?></span> <br>

                    <!-- This is to get the property photo -->
                    <img src="<?=$data['property']->photo?>" alt="property_photo" width="250" height="200"> <br>

                    <!-- This is to get the rent amount -->
                    Rent amount: $<?=$data['property']->rent_amount?> (<?=$data['property']->payment_schedule?>) <br>

                    <!-- This is to get the real estate -->
                    <?php if ($realest = $data['property']->getRealEstate()):?>
                        Real Estate: <?=$realest->name?> <br>
                    <?php else: ?>
                        <!-- This is if this property does not belong to any real estate -->
                        Real Estate: - <br>
                    <?php endif ?>

                    <!-- This is to get the agent -->
                    <?php if ($agent = $data['property']->getAgent()): ?>
                        Agent: <?=$agent->firstname . ' ' . $agent->lastname?> <br>
                    <?php else: ?>
                        <!-- This is if there is currently no agent assigned to this property -->
                        Agent: - <br>
                    <?php endif ?>

                    <!-- This is to get the tenant -->
                    <?php if ($tenant = $data['property']->getTenant()): ?>
                        Tenant: <?=$tenant->firstname . ' ' . $tenant->lastname?> <br>
                    <?php else: ?>
                        Tenant: - <br>
                    <?php endif ?>



                    <a href="<?=WEBDIR?>/propertyowner/editproperty" class="btn btn-default">Edit</a>
                    <button class="btn btn-success" id="triggermodal" data-toggle="modal" data-target="#tenantForm">Assign a tenant</button>
                <?php endif ?>
            </div>
            <div role="pillpanel" class="pill-pane" id="documents">2</div>
            <div role="pillpanel" class="pill-pane" id="inspections">3</div>
            <div role="pillpanel" class="pill-pane" id="rta">4</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- Modal -->
        <div class="modal fade" id="tenantForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
              </div>
              <div class="modal-body">
                <!-- FORM STARTS HERE -->
                <form>
                    
                    <div class="form-field">
                        <label for="firstname">First name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname">
                    </div>

                    <div class="form-field">
                        <label for="lastname">Last name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname">
                    </div>

                </form>
                <!-- FORM ENDS HERE -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    
    
</script>
    
<?php
require_once '../app/views/templates/interfaceEnd.php';
?>

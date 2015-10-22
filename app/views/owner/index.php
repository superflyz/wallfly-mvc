<?php
    require_once '../app/views/templates/interfaceStartIndex.php';
?>

<script src="/wallfly-mvc/public/js/dropdown/dropdown.js"></script>
<link href="/wallfly-mvc/public/js/dropdown/dropdown.css" rel="stylesheet">
          

<!--Content here-->
<div class="row">
    <div class="col-md-12">
        <h1 class="wlcm-h1">Welcome <span class="user-color"><?php echo $_SESSION['user']->firstname?>!
             <button class="btn btn-default" data-toggle="modal" data-target="#addpropertyform">+ Add property</button></span></h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- create address dropdown list only if agent or owner usertype -->
        <?php
        $properties = $_SESSION['user']->getProperties();
        $count = 0;
        foreach ($properties as $property) {
        ?>
            <div>
                <form id="viewDetails" method="post" action="<?=WEBDIR?>/propertyowner/viewDetails">
                    <img src="<?php echo $property->photo?>">
                    <p><?php echo $property->address?></p>
                    <button type="submit" name="submit" value="<?php echo $count;?>" class="btn btn-upload-pdf">Details</button>
                </form>
            </div>
        <?php
            $count++;
        }
        ?>
    </div>
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
                <form action="<?=WEBDIR?>/propertyowner/addproperty" method="post">            
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
                        </div></div>
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
        $('.ui.search.dropdown').dropdown({
            fullTextSearch: true, 
            sortSelect: true, 
            match:'text',
            onChange: function(value) {
                var arraypos = value;
                jQuery.ajax({
                    url: '/wallfly-mvc/public/dashboard/selectedProperty',
                    type: "POST",
                    data: {
                        selected: arraypos
                    },
                    success: function (result) {
                        window.location.reload();
                    },
                    error: function (result) {
                        alert('Exeption:' + exception);
                    }
                });
            }

    });
    
 document.title = 'Dashboard - WallFly';

</script>


<?php
require_once '../app/views/templates/interfaceEnd.php';
?>




<?php
    require_once '../app/views/templates/interfaceStart.php';
?>
<!--Content here-->
<div class="row">
    <div class="col-md-12">
        <h1 class="wlcm-h1">Welcome <span class="user-color"> User!</span></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <section id="select_property">  
            <!-- create address dropdown list only if agent or owner usertype -->
            <?php if ($userType == 2) {
            //    if ($properties = $_SESSION['user']->getProperties()) {
            //      echo $properties[1]->address;
            //    }

                  $properties = $_SESSION['user']->getProperties();
            //
            }

            ?>

            <select id="select-property-dropdown" class="demo-default" placeholder="Select a property...">
                <option value="">Select a property...</option>
                <?php
            for($i=0;$i<count($properties);$i++){
                $selected = '';
                echo value;
                if ($properties[$i]->id === $pID) {
                    $selected = 'selected';
                }
                echo '<option value="'.$i.'" ' . $selected . '>' . $properties[$i]->address . '</option>';

            } ?>
            </select>
        </section>
    </div>
</div>	
 

<script src="/wallfly-mvc/public/js/selectize/dist/js/standalone/selectize.js"></script>
<script src="/wallfly-mvc/public/js/selectize/js/selectize_no_results.js"></script>  
       
<script>    
    $('#select-property-dropdown').selectize({
    plugins: ['no_results'],
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

</script>



<?php
require_once '../app/views/templates/interfaceEnd.php';
?>




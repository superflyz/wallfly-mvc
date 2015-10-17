<?php
    require_once '../app/views/templates/interfaceStartIndex.php';

/**
 * Created by PhpStorm.
 * User: jimmykovacevic
 * Date: 4/10/2015
 * Time: 6:13 PM
 */

?>

<script src="/wallfly-mvc/public/js/dropdown/dropdown.js"></script>
<link href="/wallfly-mvc/public/js/dropdown/dropdown.css" rel="stylesheet">
          

<!--Content here-->
<div class="row">
    <div class="col-md-12">
        <h1 class="wlcm-h1">Welcome <span class="user-color"><?php echo $_SESSION['user']->firstname?>!</span></h1>

<div class="row">
    <div class="col-md-12">
        <section id="select_property">

            <!-- create address dropdown list only if agent or owner usertype -->
            <?php

                  $properties = $_SESSION['user']->getProperties();


            ?>
            <div class="select-property-dropdown">
<!--                 <h3>Please select a property:</h3>-->
                <select class="ui search dropdown">
                    <option value="">Select a property...</option>
                    <?php
                for($i=0;$i<count($properties);$i++){
                    $selected = '';

                    if ($properties[$i]->id === $pID) {
                        $selected = 'selected';
                    }
                    echo '<option value="'.$i.'" ' . $selected . '>' . $properties[$i]->address . '</option>';

                } ?>
                </select>
            </div>
        </section>
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

</script>

<?php
require_once '../app/views/templates/interfaceEnd.php';
?>




<?php
require_once '../app/views/templates/interfaceStartIndex.php';
?>

<!--Content here-->
<div class="row">
    <div class="col-md-12">
        <div class="col-md-8">
            <h1 class="wlcm-h1">Welcome <span class="user-color"><?php echo $_SESSION['user']->firstname?>!</span></h1>
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
                    <form id="viewDetails" method="post" action="<?=WEBDIR?>/propertytenant/viewDetails">
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

<script>
    document.title = 'Dashboard - WallFly';
</script>


<?php
require_once '../app/views/templates/interfaceEnd.php';
?>




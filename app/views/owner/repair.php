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
            <p>Repairs</p>
            <hr />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
         <?php if (isset($_SESSION['selectedProperty'])) { ?>
      
            <form id="repairApproveDeny" method="post" action="<?=WEBDIR?>/propertyowner/processRepairRequest">
                <?php
                $result = $_SESSION['selectedProperty']->getRepairRequests();
                if ($result) {
                    $count = 0;
                    foreach ($result as $row) {
                        if ($row['status'] == 0){
                            $row['status']= "Pending";
                        }elseif($row['status'] == 1){
                            $row['status']= "Approved";
                        }else{$row['status']= "Denied";}

                        if ($row['severity_level'] == "low"){
                            $row['severity_level']= WEBDIR."/img/repair/green.jpg";
                        }elseif($row['severity_level'] == "medium"){
                            $row['severity_level']= WEBDIR."/img/repair/orange.jpg";
                        }else{$row['severity_level']= WEBDIR."/img/repair/red.jpg";}

                         $splitImgSource = explode("/", $row['image']);
                         $lastpos = end($splitImgSource);
                         $checkIfImageExists= explode(".", $lastpos);
                         if(!empty($checkIfImageExists[1])){
                         $repairPic = "<img height='100' width='100' src='" . $row['image']."'/>";
                         }else{  $repairPic = ""; }

                        echo "<div class='pall'><p class='ptimestamp'>Timestamp: " . $row['timestamp'] . " Subject: " . $row['subject'] .
                            " Description: " . $row['description'] . "Severity:  <image height='15' width='15' src='" . $row['severity_level'] . "'/>" .
                            " Status: " . $row['status'] . "<div class='pimg'>". $repairPic ."
                            </div></p>";
                        ?>
                        <div class="form-field">
                            <label for="<?php echo($count)?>">Comment</label>
                            <textarea name="<?php echo($count)?>" id="<?php echo($count)?>" rows="5" cols="10" type="text" class="form-control"><?php echo($row['comment'])?></textarea>
                            <span class="error"></span>
                        </div>
                        <div class="pbtns">
                            <button type='submit' name='submit' value='<?php echo $row['timestamp']?>/approve/<?php echo($count)?>' id='submit-btn' class='btn btn-primary submit eventsubmit'>Approve</button>
                            <button type='submit' name='submit' value='<?php echo $row['timestamp']?>/deny/<?php echo($count++)?>' id='submit-btn' class='btn btn-primary submit eventsubmit'>Deny</button>
                        </div>
                    </div>
                    <?php
                    }
                }
                ?>
            </form>
     
        <?php }?>           
            
            </div>

        </div>



<script type="text/javascript">
    
    $('.manage_properties_pills ul li').click(function (e) {
        e.preventDefault()
        $(this).pill('show')
    })
    
    document.title = 'Repairs - WallFly';
</script>

<?php
require_once '../app/views/templates/interfaceEnd.php';
?>
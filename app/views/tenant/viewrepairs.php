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
                <h1 class="wlcm-h1">Repair Requests</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid">
                    <?php if (isset($_SESSION['selectedProperty'])) { ?>
                        <div class="row text-left">
                            <?php
                            $result = $_SESSION['selectedProperty']->getRepairRequests();
                            if ($result) {
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
                                    }else{
                                        $row['severity_level']= WEBDIR."/img/repair/red.jpg";
                                    }

                                    $splitImgSource = explode("/", $row['image']);
                                    $lastpos = end($splitImgSource);
                                    $checkIfImageExists= explode(".", $lastpos);
                                    if(!empty($checkIfImageExists[1])){
                                        $repairPic = "<img height='100' width='100' src='" . $row['image']."'/>";
                                    }else{  $repairPic = ""; }
                                        echo "<p>Timestamp: " . $row['timestamp'] . "<br/> Subject: " . $row['subject'] .
                                            "<br/>  Description: " . $row['description'] . "<br/>  Severity:  <image height='15' width='15' src='" . $row['severity_level'] . "'/>" .
                                            "<br/>  Status: " . $row['status'] . "<br/>". $repairPic ."</p>";
                                    ?>
                                    <form id="changeSeverity" enctype="multipart/form-data" method="post" action="<?=WEBDIR?>/propertytenant/changeSeverity">
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
                                        <div>
                                            <button type="submit" name="submit" value="<?php echo ($row['timestamp'])?>" id="submit-btn" style="width: 120px;"
                                                    class="btn btn-primary submit eventsubmit">Change Severity
                                            </button>
                                        </div>
                                    </form>
                                    <?php
                                    }
                                }
                            ?>
                        </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

<?php
require_once '../app/views/templates/interfaceEnd.php';
?>
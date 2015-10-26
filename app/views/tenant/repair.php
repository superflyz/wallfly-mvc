<?php
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
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="manage_properties_pills">
            <!-- Nav pills -->
            <ul class="nav nav-pills nav-justified properties_pills">

                <li role="presentation"><a href="#view_repairs" aria-controls="view_repairs" role="pill" data-toggle="pill" >View Requests</a></li>
                <li role="presentation"><a href="#make_repair" aria-controls="make_repair" role="pill" data-toggle="pill">Make Request</a></li>
            </ul>

        </div>
    </div>
</div>
</div>
</div>

<div class="row bottom-section">
    <div class="row">
        <div class="col-md-12">
            <!-- Pill panes -->
            <div class="pill-content view_repairs">
                <div role="pillpanel" class="pill-pane active">

                </div>


                <div role="pillpanel" class="pill-pane" id="view_repairs">
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
                                        "<br/>  Status: " . $row['status'] . "<br/>". $repairPic ."</p>" . $row['comment'];
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
                <div role="pillpanel" class="pill-pane" id="make_repair">
                    <div class="make_repair">
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
        </div>
    </div>
</div>




<script type="text/javascript">

    $('.manage_properties_pills ul li').click(function (e) {
        e.preventDefault()
        $(this).pill('show')
    })

    document.title = 'Payments - WallFly';
</script>

<?php
require_once '../app/views/templates/interfaceEnd.php';
?>


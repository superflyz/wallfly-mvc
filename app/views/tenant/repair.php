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

                <li class="active" role="presentation"><a href="#view_repairs" aria-controls="view_repairs" role="pill" data-toggle="pill" >View Requests</a></li>
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
            <div class="pill-content view_repairs_tenant">
                <div role="pillpanel" class="pill-pane active" id="view_repairs">
                    
                    <div class="repair_view">
                    <?php if (isset($_SESSION['selectedProperty'])) { ?>
                            <?php
                            $result = $_SESSION['selectedProperty']->getRepairRequests();
                            $count = 0;
                            if ($result) {
                                foreach ($result as $row) {
                                    if ($row['status'] == 0){
                                        $status = "<p class='repair_sp'>Pending</p>";
                                        $row['status']= "<div class='status_p'><i class='fa fa-question'></i></div>";
                                    }elseif($row['status'] == 1){
                                        $status = "<p class='repair_sp'>Approved</p>";
                                        $row['status']= "<div class='status_a'><i class='fa fa-check'></i></div>";
                                    }else{
                                        $status = "<p class='repair_sp'>Denied</p>";
                                        $row['status']= "<div class='status_d'><i class='fa fa-times'></i></div>";}
                                    if ($row['severity_level'] == "low"){
                                        $row['severity_level']= "<div class='s_lvl_low'>LOW</div>";
                                    }elseif($row['severity_level'] == "medium"){
                                        $row['severity_level']= "<div class='s_lvl_med'>MEDIUM</div>";
                                    }else{$row['severity_level']= "<div class='s_lvl_hi'>HIGH</div>";}


                                    $splitImgSource = explode("/", $row['image']);
                                     $lastpos = end($splitImgSource);
                                     $checkIfImageExists= explode(".", $lastpos);
                                     if(!empty($checkIfImageExists[1])){
                                     $repairPic = "<img data-toggle='modal' class='img-responsive repair_image_enlarge' title='Repair image' alt='Repair image' src='" . $row['image']."'/>";
                                     }else{  $repairPic = "<img data-toggle='modal' class='img-responsive repair_image_enlarge' title='Repair image' alt='No image' src='/wallfly-mvc/public/img/noimage.png'/>"; }


                                                echo "
                                    <div class='row repair_view_head_t'>
                                        <div class='col-md-12 col-sm-12 col-xs-12 hd'>
                                            <div class='hd-text'>" . $row['subject'] . "
                                            </div>
                                        </div>
                                    </div>" .
                                    "<div class='row repair_view_body_t'>
                                        <div class='col-md-5 col-sm-5 col-xs-7 hd'>
                                            <div class='row ss'>
                                                <div class='col-md-6 col-sm-6 col-xs-7 hd'>
                                                    <div class='repair_img_view'>
                                                        <div class='repair_img_view_img'>" . $repairPic . "
                                                        </div>
                                                    </div>
                                                </div>" .
                                                "<div class='col-md-6 col-sm-6 col-xs-5 hd'>
                                                    <div class='hd-text-severity'>Severity<hr class='repair_hr'>
                                                    </div>
                                                    <div class='bd-text-severity'>". $row['severity_level'] ."
                                                    </div>
                                                </div>
                                            </div>" .
                                            "<div class='hd-text-description'>Description<hr class='repair_hr'>
                                            </div>
                                            <div class='bd-text-description'>" . $row['description'] . "
                                            </div>" .
                                        "</div>
                                        <div class='col-md-5 col-sm-5 col-xs-5 hd'>
                                            <div class='hd-text-status'>Status<hr class='repair_hr'>
                                            </div>
                                            <div class='bd-text-status'>" . $status . $row['status'] . "
                                            </div>
                                        </div>";


                          ?>
                            
                            <div class="hidden-xs col-md-2 col-sm-2 hd">
                                <div class="hd-text repair_dt"><?php echo(date('M, d Y - h:sa', strtotime($row['timestamp'])))?></div>
                                <div class="btn-text">
                                    <button id="triggermodal" data-toggle="modal" data-target="#changeSeverity<?php echo $count;?>" class='btn btn_repair_cs'>Change Severity</button>
                                </div>
                            </div>
            
                            <div class="visible-xs xsbtnz row">
                                <div class="col-xs-6 hd">
                                    <div class="hd-text repair_dt"><?php echo(date('M, d Y - h:sa', strtotime($row['timestamp'])))?>    
                                    </div>
                                </div>
                                <div class="col-xs-6 hd">
                                    <div class="btn-text">
                                        <button id="triggermodal" data-toggle="modal" data-target="#changeSeverity<?php echo $count;?>" class='btn btn_repair_cs'>Change Severity</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="modal modal-vcenter fade" id="changeSeverity<?php echo $count++;?>" tabindex="-1" role="dialog" aria-labelledby="changeSeverity">

                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                                    <p class="modal-title">Change Severity</p>
                                </div>
                                <div class="modal-body">
                                    <form id="changeSeverity" enctype="multipart/form-data" method="post" action="<?=WEBDIR?>/propertytenant/changeSeverity">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <label for="severity">Severity Level</label>
                                            <select name="severity" class="form-control formSelect">
                                                <option value="low" class="form-control">Low</option>
                                                <option value="medium" class="form-control">Medium</option>
                                                <option value="high" class="form-control">High</option>
                                            </select>
                                            <span class="error"></span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">

                                            <button type="submit" name="submit" value="<?php echo ($row['timestamp'])?>" id="submit-btn"
                                                    class="btn btn-save-changes_t pull-right">Save Changes</button>
                                        </div>
                                    </form>


                                    <!-- FORM ENDS HERE -->
                                </div>
                            </div>
                        </div>
                    </div>
    
            <?php
        }
    }
    ?>

        </div>
    </form>
        
    <?php }?>

 </div>
              
                
                
                <div role="pillpanel" class="pill-pane" id="make_repair">
                    <div class="make_repair">
                        <?php if (isset($_SESSION['selectedProperty'])) { ?>
                            <form id="repairRequest" enctype="multipart/form-data" method="post" action="<?=WEBDIR?>/propertytenant/processRepairRequest">
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <div class="t_add_payment_inpt1">
                                        <label for="subject">Subject</label>
                                        <input name="subject" type="text" class="form-control">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                 <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="t_add_payment_inpt2">
                                        <label for="severity">Severity Level</label>
                                        <select name="severity" class="form-control formSelect">
                                            <option value="" class="form-control">Please select...</option>
                                            <option value="low" class="form-control">Low</option>
                                            <option value="medium" class="form-control">Medium</option>
                                            <option value="high" class="form-control">High</option>
                                        </select>
                                        <span class="error"></span>
                                     </div>
                                </div>

                                 <div class="col-md-12 col-sm-12 col-xs-12">
                                     <div class="t_add_payment_inpt3">
                                        <label for="description">Description</label>
                                         <textarea name="description" id= "description" type="text" class="form-control"></textarea>
                                        <span class="error"></span>
                                     </div>
                                </div>
                                
                                <div class="row add_payment_btn">    
                 <div class="col-md-8 col-sm-8 col-xs-12">
           <label for="image">Image</label>
                                         <div class="t_ep_field_img_file">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <span class="btn btn-choose btn-file">
                                <span>Choose file</span>
                                <input type="file" name="image" size="2000000"
                                           accept="image/jpeg, image/x-ms-bmp, image/png" id="image">
                            </span>
                            <span class="fileinput-filename">
                                <span class="fileinput-new">No file chosen</span>
                            </span></div>
                    
                            <span class="error"></span>
                                             </div>
                    </div>
                                
                                
                        
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                     <button type="submit" name="Submit" class="btn t_btn-add-payment pull-right">Submit</button>
                                </div>
                                                          </div>          

                            </form>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change severity modal -->
<div class="modal modal-vcenter fade" id="changeSeverity" tabindex="-1" role="dialog" aria-labelledby="changeSeverity">

    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <p class="modal-title">Change Severity</p>
            </div>
            <div class="modal-body">
                <form id="changeSeverity" enctype="multipart/form-data" method="post" action="<?=WEBDIR?>/propertytenant/changeSeverity">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <label for="severity">Severity Level</label>
                        <select name="severity" class="form-control formSelect">
                            <option value="low" class="form-control">Low</option>
                            <option value="medium" class="form-control">Medium</option>
                            <option value="high" class="form-control">High</option>
                        </select>
                        <span class="error"></span>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                    
                        <button type="submit" name="submit" value="<?php echo ($row['timestamp'])?>" id="submit-btn"
                class="btn btn-save-changes_t pull-right">Save Changes</button>
                     </div>
                </form>

      
                <!-- FORM ENDS HERE -->
            </div>
        </div>
    </div>
</div>

<!-- Repair image enlage modal -->
<div class="modal fade enlarge_repair_img modal-vcenter" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content display_enlarged_repair_imgs">
        <img src="" width="100%" height="100%" >
    </div>
  </div>
</div>

<script src="/wallfly-mvc/public/js/jasny-bootstrap.js"></script>
<script type="text/javascript">
    
    $('.manage_properties_pills ul li').click(function (e) {
        e.preventDefault()
        $(this).pill('show')
    })
    
    document.title = 'Repairs - WallFly';
     
    $(document).ready(function () {

            
        $(".repair_image_enlarge").on("click", function() {
    
            var src = $(this).attr('src'); 
            $('.enlarge_repair_img img').attr('src', src);
            $('.enlarge_repair_img').modal('show');
     
        });
           
    });
            
</script>

<?php
require_once '../app/views/templates/interfaceEnd.php';
?>


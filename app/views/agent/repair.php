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
</div>
</div>

<div class="row bottom-section">
<div class="row">
    <div class="col-md-12">
        <?php if (isset($_SESSION['selectedProperty'])) { ?>
        <form id="repairApproveDeny" method="post" action="<?=WEBDIR?>/propertyagent/processRepairRequest">
            
            <div class="repair_view">


                <?php
                $result = $_SESSION['selectedProperty']->getRepairRequests();
                if ($result) {
                    $count = 0;
                    foreach ($result as $row) {
                        if ($row['status'] == 0){
                            $row['status']= "<div class='status_p'><i class='fa fa-question'></i></div>";
                        }elseif($row['status'] == 1){
                            $row['status']= "<div class='status_a'><i class='fa fa-check'></i></div>";
                        }else{$row['status']= "<div class='status_d'><i class='fa fa-times'></i></div>";}

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
//<div class='no_repair_img_view img-responsive' title='Repair image'><p>No image</p></div>
                   
                        echo "<div class='row repair_view_head'>
                        <div class='col-md-12 col-sm-12 col-xs-12 hd'>
                        <div class='hd-text'>" . $row['subject'] . "</div></div></div>" .
                             "<div class='row repair_view_body'>
            <div class='col-md-5 col-sm-5 col-xs-7 hd'>
            <div class='row ss'>
       
            <div class='col-md-6 col-sm-6 col-xs-7 hd'>
            <div class='repair_img_view'><div class='repair_img_view_img'>" . $repairPic . "</div></div>
            </div>" .
                        "<div class='col-md-6 col-sm-6 col-xs-5 hd'>
                            <div class='hd-text-severity'>Severity<hr class='repair_hr'></div>
            <div class='bd-text-severity'>". $row['severity_level'] ."</div></div></div>" . 
                       
           "<div class='hd-text-description'>Description<hr class='repair_hr'></div><div class='bd-text-description'>" . $row['description'] . "</div>" .
                            "</div><div class='col-md-5 col-sm-5 col-xs-5 hd'>
    
                        
                            <div class='hd-text-status'>Status<hr class='repair_hr'></div>
            <div class='bd-text-status'>" . $row['status'] . "</div>"
                            ;
                            
                        ?>
                
                        
                            <div class="hd-text">Comments<hr class='repair_hr'></div>
                            <div class="bd-text">
                                <!-- <?php echo($count)?>-->
                                <textarea name="<?php echo($count)?>" id="<?php echo($count)?>" class="form-control custom-control btn-comment-inpt" placeholder="Type your comment here..." ><?php echo($row['comment'])?></textarea>
                           </div>
                            </div>
                        
    
                         <div class="hidden-xs col-md-2 col-sm-2 hd">
                                    <div class="hd-text repair_dt"><?php echo(date('M, d Y - h:sa', strtotime($row['timestamp'])))?></div>
                                    <div class="btn-text">
                               <button type='submit' name='submit' value='<?php echo $row['timestamp']?>/approve/<?php echo($count)?>' class='btn btn_repair_approve'>Approve</button>
                            <button type='submit' name='submit' value='<?php echo $row['timestamp']?>/deny/<?php echo($count++)?>' class='btn btn_repair_deny'>Deny</button></div>
                                </div>
            
            <div class="visible-xs xsbtnz row">
                <div class="col-xs-6 hd">
                                    <div class="hd-text repair_dt"><?php echo(date('M, d Y - h:sa', strtotime($row['timestamp'])))?></div>
                        </div>
                   <div class="col-xs-6 hd">
                                    <div class="btn-text">
                               <button type='submit' name='submit' value='<?php echo $row['timestamp']?>/approve/<?php echo($count)?>' class='btn btn_repair_approve'>Approve</button>
                            <button type='submit' name='submit' value='<?php echo $row['timestamp']?>/deny/<?php echo($count++)?>' class='btn btn_repair_deny'>Deny</button></div>
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
</div>
    </div>


<div class="modal fade enlarge_repair_img modal-vcenter" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content display_enlarged_repair_imgs">
    <img src="" width="100%" height="100%" >
    </div>
  </div>
</div>

<script src="/wallfly-mvc/public/js/textarea-autosize.js"></script>
<script type="text/javascript">
    
    $('.manage_properties_pills ul li').click(function (e) {
        e.preventDefault()
        $(this).pill('show')
    })
    
    document.title = 'Repairs - WallFly';
     
        $(document).ready(function () {
     autosize(document.querySelectorAll('textarea'));
            
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
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
      
        <form id="repairApproveDeny" method="post" action="<?=WEBDIR?>/propertyowner/processRepairRequest">
                
        <div class="repair_view">
     
<!--

<div class="repair_view">
    <div class="row repair_view_head">
        <div class="col-md-12 hd">
            <div class="hd-text">Subject</div>
        </div>
    </div>

    <div class="row repair_view_body">
        <div class="col-md-5 hd">
            <div class="hd-text-description">Description</div>
            <div class="bd-text-description"></div>
            <div class="hd-text-status">Status</div>
            <div class="bd-text-status"></div>
        </div>
        <div class="col-md-5 hd">
            <div class="hd-text-severity">Severity</div>
            <div class="bd-text-severity"></div>
            <div class="hd-text">Comments</div>
            <div class="bd-text">
                <textarea class="form-control custom-control btn-comment-inpt" placeholder="Type your comment here..." ></textarea>
           </div>
        </div>
        <div class="col-md-2 hd">
            <div class="hd-text">Time</div>
            <div class="bd-text"></div>
        </div>
    </div> 
</div>
-->



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
                            $row['severity_level']= "<div class='s_lvl_low'>LOW</div>";
                        }elseif($row['severity_level'] == "medium"){
                            $row['severity_level']= "<div class='s_lvl_med'>MEDIUM</div>";
                        }else{$row['severity_level']= "<div class='s_lvl_hi'>HIGH</div>";}

                         $splitImgSource = explode("/", $row['image']);
                         $lastpos = end($splitImgSource);
                         $checkIfImageExists= explode(".", $lastpos);
                         if(!empty($checkIfImageExists[1])){
                         $repairPic = "<img height='100' width='100' src='" . $row['image']."'/>";
                         }else{  $repairPic = ""; }

                   
                        echo "<div class='row repair_view_head'>
                        <div class='col-md-12 hd'>
                        <div class='hd-text'>" . $row['subject'] . "</div></div></div>" .
                             "<div class='row repair_view_body'>
            <div class='col-md-5 hd'>
            <div class='hd-text-description'>Description<hr class='repair_hr'></div>
                             
            <div class='bd-text-description'>" . $row['description'] . "</div>      
            <div class='hd-text-status'>Status<hr class='repair_hr'></div>
            <div class='bd-text-status'>" . $row['status'] . "</div>" .
                            "</div><div class='col-md-5 hd'>
                            <div class='hd-text-severity'>Severity<hr class='repair_hr'></div>
            <div class='bd-text-severity'>". $row['severity_level'] ."</div>";
                            
                        ?>
                
                        
                            <div class="hd-text">Comments<hr class='repair_hr'></div>
                            <div class="bd-text">
                                <!-- <?php echo($count)?>-->
                                <textarea name="<?php echo($count)?>" id="<?php echo($count)?>" class="form-control custom-control btn-comment-inpt" placeholder="Type your comment here..." ><?php echo($row['comment'])?></textarea>
                           </div>
                            </div>
                        
    
                         <div class="col-md-2 hd">
                                    <div class="hd-text repair_dt"><?php echo($row['timestamp'])?></div>
                                    <div class="bd-text">
                               <button type='submit' name='submit' value='<?php echo $row['timestamp']?>/approve/<?php echo($count)?>' class='btn btn_repair_approve'>Approve</button>
                            <button type='submit' name='submit' value='<?php echo $row['timestamp']?>/deny/<?php echo($count++)?>' class='btn btn_repair_deny'>Deny</button></div>
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

<!--<script src="/wallfly-mvc/public/js/textarea-autosize.js"></script>-->
<script type="text/javascript">
    
    $('.manage_properties_pills ul li').click(function (e) {
        e.preventDefault()
        $(this).pill('show')
    })
    
    document.title = 'Repairs - WallFly';
    
  
//    var $table = $('table');
//    $table.floatThead({
//        });
//    
//    $(".sticky-header").floatThead({scrollingTop:150});
    
//    var $table = $('table');
//float the headers
//$table.floatThead();
//$table.floatThead('reflow');
//var $table = $('.mytable');
////    $table.floatThead('reflow');
//$table.floatThead({
//   
//    scrollContainer: function($table){
//		return $table.closest('.to-here');
//	}
//});
    
// $("table.table").floatThead();
//    
//$('#sidebar').affix({
//
//});
//    
//        $(document).ready(function () {
//     autosize(document.querySelectorAll('textarea'));
// });
</script>



<?php
require_once '../app/views/templates/interfaceEnd.php';
?>
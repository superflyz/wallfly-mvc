<?php
require_once '../app/views/templates/interfaceStart.php';
?>
<!--Content here-->
<div class="row">
    <div class="col-md-12">
        <div class="page_heading">
            <p>Properties</p>
            <hr />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="manage_properties_pills">
          <!-- Nav pills -->
          <ul class="nav nav-pills nav-justified properties_pills">
            <li role="presentation"><a href="#detail" aria-controls="detail" role="pill" data-toggle="pill">Property Details</a></li>
            <li role="presentation"><a href="#documents" aria-controls="documents" role="pill" data-toggle="pill">Documents</a></li>
            <li role="presentation"><a href="#inspections" aria-controls="inspections" role="pill" data-toggle="pill">Inspections</a></li>
            <li role="presentation"><a href="#rta" aria-controls="rta" role="pill" data-toggle="pill">R.T.A</a></li>
          </ul>
        
        </div>
    </div>
</div>
<?php if ($error = Flash::get('pdferror')): ?>
    <div class="alert alert-default" role="alert" style="color:rgb(159, 221, 94)"><?=$error?>!!!</div>
<?php endif ?>

<div class="row">
    <div class="col-md-12">
        <!-- Pill panes -->
        <div class="pill-content manage_properties_view">
            <div role="pillpanel" class="pill-pane" id="detail">
                <?php if ($property = $data['property']): ?>
                    <!-- This is to get the property address -->
                    Address: <span class="edit"><?=$data['property']->address?></span> <br />

                    <!-- This is to get the property photo -->
                    <img src="<?=$data['property']->photo?>" alt="property_photo" width="250" height="200"> <br />

                    <!-- This is to get the rent amount -->
                    Rent amount: $<?=$data['property']->rent_amount?> (<?=$data['property']->payment_schedule?>) <br />

                    <!-- This is to get the real estate -->
                    <?php if ($realest = $data['property']->getRealEstate()):?>
                        Real Estate: <?=$realest->name?> <br>
                    <?php else: ?>
                        <!-- This is if this property does not belong to any real estate -->
                        Real Estate: - <br>
                    <?php endif ?>

                    <!-- This is to get the agent -->
                    <?php if ($agent = $data['property']->getAgent()): ?>
                        Agent: <?=$agent->firstname . ' ' . $agent->lastname?> <br />
                    <?php else: ?>
                        <!-- This is if there is currently no agent assigned to this property -->
                        Agent: - <br>
                    <?php endif ?>

                    <!-- This is to get the tenant -->
                    <?php if ($tenant = $data['property']->getTenant()): ?>
                        Tenant: <?=$tenant->firstname . ' ' . $tenant->lastname?> <br />
                    <?php else: ?>
                        Tenant: - <br />
                    <?php endif ?>



                    <a href="<?=WEBDIR?>/propertyowner/editproperty" class="btn btn-default">Edit</a>
                    <button class="btn btn-success" id="triggermodal" data-toggle="modal" data-target="#tenantForm">Assign a tenant</button>
                <?php endif ?>
            </div>
            <div role="pillpanel" class="pill-pane" id="documents">
                <form id="repairRequest" enctype="multipart/form-data" method="post" action="<?=WEBDIR?>/propertyowner/processDocument">

                    <label for="image">Upload PDF</label>
                    <div class="form-field">

                        <input type="file" name="image"
                               accept="application/pdf" id="image" style="float: left;">
                        <span class="error"></span>  <button style="width: 120px;margin-top: 0;float: left;margin-left: 20px;" type="submit" name="Submit" value="submit" id="submit-btn" style="width: 120px;"
                                                             class="btn btn-primary submit eventsubmit">Submit
                        </button>

                    </div>
                </form><br/><br/><br/><br/>
                <?php
                  if(isset($_SESSION['selectedProperty'])) {
                      $getdocuments = HandleDocuments::loadDocuments($_SESSION['selectedProperty']->id);
                      if ($getdocuments != null) {
                          foreach ($getdocuments as $key => $value) {
                              echo $value;
                          }
                      }
                  }


           ?>


                </div>
            <div role="pillpanel" class="pill-pane" id="inspections">
                <form id="repairRequest" enctype="multipart/form-data" method="post" action="<?=WEBDIR?>/propertyowner/processInspection">

                    <label for="image">Upload PDF</label>
                    <div class="form-field">

                        <input type="file" name="image"
                               accept="application/pdf" id="image" style="float: left;">
                        <span class="error"></span>  <button style="width: 120px;margin-top: 0;float: left;margin-left: 20px;" type="submit" name="Submit" value="submit" id="submit-btn" style="width: 120px;"
                                                             class="btn btn-primary submit eventsubmit">Submit
                        </button>

                    </div>
                </form><br/><br/><br/><br/>
                <?php
                if(isset($_SESSION['selectedProperty'])) {
                    $getinspections = HandleDocuments::loadInspections($_SESSION['selectedProperty']->id);
                    if ($getinspections != null) {
                        foreach ($getinspections as $key => $value) {
                            echo $value;
                        }
                    }
                }


                ?>


            </div>














            <div role="pillpanel" class="pill-pane" id="rta">
                <br/>
                <table width="100%">
                    <tr>
                        <td width="45%"><h2>Applying to QCAT</h2></td>
                        <td width="50px"> </td>
                        <td width="45%"><h2>RTA Links</h2></td>
                    </tr>
                    <tr>
                        <td>1.	First you should try and resolve your dispute directly. <br><br>
                            2.	If you cannot reach agreement, you must try to resolve the dispute assisted by the RTAs dispute resolution service (unless your dispute is considered urgent by the legislation). Lodge a Dispute resolution request (Form 16).<br><br>
                            3.	If you go through the RTAs dispute resolution process and the dispute remains unresolved the RTA will send you a notice of unresolved dispute. You can then choose to lodge an application to have your matter heard at QCAT for an order to be made.<br><br>
                            4.	Once you have applied to QCAT and paid the application fee notices will be sent to attend a hearing on a set date. When the case is heard a decision will be made by the adjudicator or magistrate and you must follow the order given.<br><br></td>
                        <td></td>
                        <td><a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/How-to-prevent-disputes">Preventing Disputes</a> <br>
                            <br><br> <a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/How-to-prevent-disputes/Preventing-bond-disputes">Preventing Bond Disputes</a> <br>
                            <br><br> <a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/How-to-resolve-tenancy-issues">Resolving Tenancy Issues:</a> <br>
                            <br><br><a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/Applying-for-dispute-resolution">Dispute Resolution by RTA</a> <br>
                            <br><br><a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/Applying-for-dispute-resolution/Matters-unsuitable-for-conciliation">Matters unsuitable for conciliation</a> <br>
                            <br><br> <a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/Applying-to-QCAT">Queensland Civil and Administrative Tribunal</a> <br>
                        </td>
                    </tr>
                </table>




            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- Modal -->
        <div class="modal fade" id="tenantForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
              </div>
              <div class="modal-body">
                <!-- FORM STARTS HERE -->
                <form>
                    
                    <div class="form-field">
                        <label for="firstname">First name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname">
                    </div>

                    <div class="form-field">
                        <label for="lastname">Last name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname">
                    </div>

                </form>
                <!-- FORM ENDS HERE -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>




<script type="text/javascript">
    
    
</script>
<script src="<?php echo WEBDIR?>/pdf_js/shared/util.js"></script>
<script src="<?php echo WEBDIR?>/pdf_js/display/api.js"></script>
<script src="<?php echo WEBDIR?>/pdf_js/display/metadata.js"></script>
<script src="<?php echo WEBDIR?>/pdf_js/display/canvas.js"></script>
<script src="<?php echo WEBDIR?>/pdf_js/display/webgl.js"></script>
<script src="<?php echo WEBDIR?>/pdf_js/display/pattern_helper.js"></script>
<script src="<?php echo WEBDIR?>/pdf_js/display/font_loader.js"></script>
<script src="<?php echo WEBDIR?>/pdf_js/display/annotation_helper.js"></script>

<script>
    // Specify the main script used to create a new PDF.JS web worker.
    // In production, leave this undefined or change it to point to the
    // combined `pdf.worker.js` file.
    PDFJS.workerSrc = '<?php echo WEBDIR?>/pdf_js/worker_loader.js';
</script>
<?php
  if(isset($_SESSION['selectedProperty'])) {
      $pdfMagic = HandleDocuments::setPdfThumbs($_SESSION['selectedProperty']->id);
      foreach ($pdfMagic as $key => $value) {
          //echo "<script>alert('".$key."');</script>";
          echo "<script>
                 /* -*- Mode: Java; tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */
                 /* vim: set shiftwidth=2 tabstop=2 autoindent cindent expandtab: */

                //
                // See README for overview
                //

                'use strict';

                //
                // Fetch the PDF document from the URL using promises
                //
                 PDFJS.getDocument('/wallfly-mvc/public/" . $value . "').then(function(pdf) {
        // Using promise to fetch the page
        pdf.getPage(1).then(function(page) {
            var scale = 0.2;
            var viewport = page.getViewport(scale);

            //
            // Prepare canvas using PDF page dimensions
            //
            var canvas = document.getElementById('" . $key . "');
            var context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            //
            // Render PDF page into canvas context
            //
            var renderContext = {
                canvasContext: context,
                viewport: viewport
            };
            page.render(renderContext);
        });
    });

             </script>";
      }
  }


?>
<?php
if(isset($_SESSION['selectedProperty'])) {
    $pdfMagic2 = HandleDocuments::setInspectionPdfThumbs($_SESSION['selectedProperty']->id);
    foreach ($pdfMagic2 as $key => $value) {
        //echo "<script>alert('".$key."');</script>";
        echo "<script>
                 /* -*- Mode: Java; tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */
                 /* vim: set shiftwidth=2 tabstop=2 autoindent cindent expandtab: */

                //
                // See README for overview
                //

                'use strict';

                //
                // Fetch the PDF document from the URL using promises
                //
        PDFJS.getDocument('/wallfly-mvc/public/" . $value . "').then(function(pdf) {
        // Using promise to fetch the page

        pdf.getPage(1).then(function(page) {
            var scale = 0.2;
            var viewport = page.getViewport(scale);

            //
            // Prepare canvas using PDF page dimensions
            //
            var canvas = document.getElementById('" . $key . "');
            var context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            //
            // Render PDF page into canvas context
            //
            var renderContext = {
                canvasContext: context,
                viewport: viewport
            };
            page.render(renderContext);
        });

    });

             </script>";
    }
}


?>
<script>
    $(document).ready(function () {
    var docAdded = <?php if(isset($_SESSION['docAdded'])){echo "'".$_SESSION['docAdded']."'";}else{echo "false";}?>;
    if (docAdded == "true") {
        swal("Success", "You have uploaded a document", "success");
        <?php unset($_SESSION['docAdded']);?>
    } else if (docAdded == "false") {
        <?php unset($_SESSION['docAdded']);?>

    }

    });
</script>
<script>
    $(document).ready(function () {
        var inspectionAdded = <?php if(isset($_SESSION['inspectionAdded'])){echo "'".$_SESSION['inspectionAdded']."'";}else{echo "false";}?>;
        if (inspectionAdded == "true") {
            swal("Success", "You have uploaded an inspection", "success");
            <?php unset($_SESSION['inspectionAdded']);?>
        } else if (inspectionAdded == "false") {
            <?php unset($_SESSION['inspectionAdded']);?>

        }
    });
</script>
    
<?php
require_once '../app/views/templates/interfaceEnd.php';
?>

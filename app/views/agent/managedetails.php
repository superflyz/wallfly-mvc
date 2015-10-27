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

<?php
if(isset($_SESSION['selectedProperty'])) {
?>
<div class="row">
    <div class="col-md-12">
        <div class="manage_properties_pills">
          <!-- Nav pills -->
          <ul class="nav nav-pills nav-justified properties_pills">
            <li role="presentation" class="active"><a href="#detail" aria-controls="detail" role="pill" data-toggle="pill">Property Details</a></li>
            <li role="presentation"><a href="#documents" aria-controls="documents" role="pill" data-toggle="pill">Documents</a></li>
            <li role="presentation"><a href="#inspections" aria-controls="inspections" role="pill" data-toggle="pill">Inspections</a></li>
            <li role="presentation"><a href="#rta" aria-controls="rta" role="pill" data-toggle="pill">R.T.A</a></li>
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
        <div class="pill-content manage_properties_view">
            <div role="pillpanel" class="pill-pane active" id="detail">
                <div class="row property_details">
                    <?php if ($property = $data['property']): ?>
                    <div class="col-md-4">
                        <div class="pd_img">
                        <!-- This is to get the property photo -->
                        <img src="<?=$data['property']->photo?>" class="img-responsive" alt="property_photo" title="Property photo">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="pd_address">
                        <!-- This is to get the property address -->
                            <div class="pd_hd">Address<hr class='pd_hr'></div>
                            <div class="pd_bd"> <span class="edit"><?=$data['property']->address?></span></div>
                        </div>
                        <div class="pd_rent_amount">
                            <!-- This is to get the rent amount -->
                            <div class="pd_hd">Rent amount<hr class='pd_hr'></div>
                            <div class="pd_bd">$<?=$data['property']->rent_amount?> (<?=$data['property']->payment_schedule?>)</div>
                        </div>
                        <div class="pd_realest">
                            <!-- This is to get the real estate -->
                            <?php if ($realest = $data['property']->getRealEstate()):?>
                            <div class="pd_hd">Real Estate<hr class='pd_hr'></div>
                            <div class="pd_bd"><?=$realest->name?></div>
                            <?php else: ?>
                            <!-- This is if this property does not belong to any real estate -->
                            <div class="pd_hd">Real Estate<hr class='pd_hr'></div>
                            <div class="pd_bd_not">Not assigned</div>
                            <?php endif ?>
                        </div>
                        <div class="pd_agent">
                            <!-- This is to get the owner -->
                            <?php if ($owner = $data['property']->getOwner()): ?>
                            <div class="pd_hd">Owner<hr class='pd_hr'></div>
                            <div class="pd_bd"> <?=$owner->firstname . ' ' . $owner->lastname?></div>
                            <?php else: ?>
                            <!-- This is if there is currently no agent assigned to this property -->
                            <div class="pd_hd">Owner<hr class='pd_hr'></div>
                            <div class="pd_bd_not">Not assigned</div>
                            <?php endif ?>
                        </div>
                        <div class="pd_tenant">
                            <!-- This is to get the tenant -->
                            <?php if ($tenant = $data['property']->getTenant()): ?>
                            <div class="pd_hd">Tenant<hr class='pd_hr'></div>
                            <div class="pd_bd"><?=$tenant->firstname . ' ' . $tenant->lastname?></div>
                            <?php else: ?>
                            <div class="pd_hd">Tenant<hr class='pd_hr'></div>
                            <div class="pd_bd_not">Not assigned</div>
                            <?php endif ?>
                        </div>
                        <div class="pd_btns">
                            <div class="pull-right">
                                <button class="btn btn-edit_property" id="triggermodal" data-toggle="modal" data-target="#editPropertyForm">Edit</button>
                                <button class="btn btn-add-tenant" id="triggermodal" data-toggle="modal" data-target="#tenantForm">Assign a tenant</button>
                                <button class="btn btn-warning" id="triggermodal" data-toggle="modal" data-target="#assignOwner">Assign an owner</button>
                            <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="pillpanel" class="pill-pane" id="documents">
                <div class="row d_upload_pdf">
                    <form id="repairRequest" enctype="multipart/form-data" method="post" action="<?=WEBDIR?>/propertyagent/processDocument">
                        <div class="col-md-12 pdf_upload">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <span class="btn btn-choose btn-file">
                                    <span>Choose file</span>
                                    <input  type="file" name="image" accept="application/pdf" id="image"  />
                                </span>
                                <span class="fileinput-filename">
                                    <span class="fileinput-new">No file chosen</span>
                                </span>
                                <button type="submit" name="Submit" class="btn btn-upload-pdf">Upload PDF</button>
                                <span class="error"></span>
                            </div>
                        </div>
                    </form>
                    <?php if ($error = Flash::get('pdferror')): ?>
                    <div class="alert alert-default" role="alert" style="color:rgb(159, 221, 94)"><?=$error?>!!!</div>
                    <?php endif ?>
                    <div class="col-md-12">
                        <div class="row pdf_view">
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
                    </div>
                </div>
            </div>
            <div role="pillpanel" class="pill-pane" id="inspections">
                <div class="row d_upload_pdf">
                    <form id="repairRequest" enctype="multipart/form-data" method="post" action="<?=WEBDIR?>/propertyagent/processInspection">
                    <div class="col-md-12 pdf_upload">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <span class="btn btn-choose btn-file">
                                <span>Choose file</span>
                                <input  type="file" name="image" accept="application/pdf" id="image"  />
                            </span>
                            <span class="fileinput-filename">
                                <span class="fileinput-new">No file chosen</span>
                            </span>
                            <button type="submit" name="Submit" class="btn btn-upload-pdf">Upload PDF</button>
                            <span class="error"></span>
                        </div>
                    </div>
                    </form>
                    <div class="col-md-12">
                        <div class="row pdf_view">
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
                    </div>
                </div>
            </div>
            <div role="pillpanel" class="pill-pane" id="rta">
                <div class="row p_rta">
                    <div class="col-md-8">
                        <div class="p_rta_1">
                            <p>Applying to QCAT</p>
                            <ul>
                                <li>First you should try and resolve your dispute directly. </li>
                                <li>If you cannot reach agreement, you must try to resolve the dispute assisted by the RTAs dispute resolution service (unless your dispute is considered urgent by the legislation). Lodge a Dispute resolution request (Form 16).</li>
                                <li>If you go through the RTAs dispute resolution process and the dispute remains unresolved the RTA will send you a notice of unresolved dispute. You can then choose to lodge an application to have your matter heard at QCAT for an order to be made.</li>
                            <li>Once you have applied to QCAT and paid the application fee notices will be sent to attend a hearing on a set date. When the case is heard a decision will be made by the adjudicator or magistrate and you must follow the order given.</li>
                            </ul>
                        </div>              
                    </div>
                    <div class="col-md-4">
                        <div class="p_rta_2">
                            <p>RTA Links</p>
                            <ul>
                                <a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/How-to-prevent-disputes"><li>Preventing Disputes</li></a>
                                <a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/How-to-prevent-disputes/Preventing-bond-disputes"><li>Preventing Bond Disputes</li></a>
                                <a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/How-to-resolve-tenancy-issues"><li>Resolving Tenancy Issues</li></a>
                                <a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/Applying-for-dispute-resolution"><li>Dispute Resolution by RTA</li></a>
                                <a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/Applying-for-dispute-resolution/Matters-unsuitable-for-conciliation"><li>Matters unsuitable for conciliation</li></a>
                                <a href="https://www.rta.qld.gov.au/Disputes/Dispute-resolution/Applying-to-QCAT"><li>Queensland Civil and Administrative Tribunal</li></a>
                            </ul>
                        </div>              
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
<!-- edit property modal -->
<div class="modal modal-vcenter fade" id="editPropertyForm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <p class="modal-title">Edit Property</p>
            </div>
            <div class="modal-body">
                <?php
                    $selected = array_map(function($value) {
                        return $value === $_SESSION['selectedProperty']->payment_schedule ? 'selected' : '';
                    }, ['WEEKLY', 'FORTNIGHTLY', 'MONTHLY']);
                ?>
                <form action="<?=WEBDIR?>/propertyagent/editproperty" method="post" enctype="multipart/form-data">
                    <div class="ep_field_a">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" value="<?=$_SESSION['selectedProperty']->address?>">
                        <span class="error"></span>
                    </div>
                    <div class="col-md-6">
                        <div class="ep_field_ra">
                            <label for="rent_amount">Rent amount</label>
                            <input type="text" name="rent_amount" class="form-control" value="<?=$_SESSION['selectedProperty']->rent_amount?>">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="ep_field_ps">
                            <label for="payment_schedule">Payment schedule</label>
                            <select name="payment_schedule" class="form-control">
                                <option value="" hidden>Please select...</option>
                                <option value="WEEKLY" <?=$selected[0]?>>Weekly</option>
                                <option value="FORTNIGHTLY" <?=$selected[1]?>>Fortnightly</option>
                                <option value="MONTHLY" <?=$selected[2]?>>Monthly</option>
                            </select>
                            </select>
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="ep_field_img">
                            <label for="photo_file">Change image</label>
                            <div class="ep_field_img_img">
                                <img src="<?=$_SESSION['selectedProperty']->photo?>" class="img-responsive" alt="property_photo" title="Property photo"> </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="ep_field_img_file">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <span class="btn btn-choose btn-file"><span>Choose file</span>
                                <input type="file" name="photo_file" />
                                </span>
                                <span class="fileinput-filename"><span class="fileinput-new">No file chosen</span></span>
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ep_btnz pull-right">
                            <button type="submit" class="btn btn-save-changes">Save changes</button>
                        </div>
                    </div>
                </form>
                <!-- FORM ENDS HERE -->
            </div>
        </div>
    </div>
</div>

<!-- assign tenant modal -->
<div class="modal modal-vcenter fade" id="tenantForm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <p class="modal-title">Assign Tenant</p>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="assignmode">Select action</label>
                        <select id="assignmode" class="form-control">
                            <option value="new">Create a new tenant account</option>
                            <option value="existing">Assign existing tenant</option>
                        </select>
                    </div>
                </div>
                <form action="<?=WEBDIR?>/propertyagent/assigntenant" id="assignNewForm" method="post">
                    <div class="col-md-6">
                        <div class="at_field_fn">
                            <label for="firstname">First name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="at_field_ln">
                            <label for="lastname">Last name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-field">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="col-md-12">
                        <div class="at_btnz">
                            <button type="submit" class="btn btn-save-changes pull-right">Save changes</button>
                        </div>
                    </div>
                </form>
                <form action="<?=WEBDIR?>/propertyagent/assignexistingtenant" id="assignExistingForm" method="post">
                    <div class="form-field">
                        <label for="email2">Email address</label>
                        <input type="email" class="form-control" id="email2" name="email" autocomplete="off" required>
                        <p id="tenantError" style="color: red"></p>
                    </div>
                    <div class="col-md-12">
                        <div class="at_btnz">
                            <button type="submit" id="submit2" class="btn btn-save-changes pull-right">Save changes</button>
                        </div>
                    </div>
                </form>
                <!-- FORM ENDS HERE -->
            </div>
        </div>
    </div>
</div>

<div class="modal modal-vcenter fade" id="assignOwner" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <p class="modal-title">Assign an owner</p>
            </div>
            <div class="modal-body">
                <form action="<?=WEBDIR?>/propertyagent/assignowner" id="assignNewForm" method="post">
                    <div class="form-field">
                        <label for="ownerEmail">Email address</label>
                        <input type="email" class="form-control" id="ownerEmail" name="ownerEmail" autocomplete="off" required>
                        <p id="ownerMessage" style="color: red"></p>
                        <p id="ownerFound" style="color: green"></p>
                    </div>
                    <div class="col-md-12">
                        <div class="at_btnz">
                            <button type="submit" id="ownersubmit" class="btn btn-save-changes pull-right">Save changes</button>
                        </div>
                    </div>
                </form>
                <!-- FORM ENDS HERE -->
            </div>
        </div>
    </div>
</div>

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
<script src="/wallfly-mvc/public/js/jasny-bootstrap.js"></script>
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
    document.title = 'Properties - WallFly';
</script>
<?php } else {?>
    <h4>Please select a property</h4>
<?php } ?>
<?php
require_once '../app/views/templates/interfaceEnd.php';
?>

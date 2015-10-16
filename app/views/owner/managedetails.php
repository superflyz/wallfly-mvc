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

<div class="row">
    <div class="col-md-12">
        <!-- Pill panes -->
        <div class="pill-content manage_properties_view">
            <div role="pillpanel" class="pill-pane" id="detail">
                <?php if ($property = $data['property']): ?>
                    <!-- This is to get the property address -->
                    Address: <span class="edit"><?=$data['property']->address?></span> <br>

                    <!-- This is to get the property photo -->
                    <img src="<?=$data['property']->photo?>" alt="property_photo" width="250" height="200"> <br>

                    <!-- This is to get the rent amount -->
                    Rent amount: $<?=$data['property']->rent_amount?> (<?=$data['property']->payment_schedule?>) <br>

                    <!-- This is to get the real estate -->
                    <?php if ($realest = $data['property']->getRealEstate()):?>
                        Real Estate: <?=$realest->name?> <br>
                    <?php else: ?>
                        <!-- This is if this property does not belong to any real estate -->
                        Real Estate: - <br>
                    <?php endif ?>

                    <!-- This is to get the agent -->
                    <?php if ($agent = $data['property']->getAgent()): ?>
                        Agent: <?=$agent->firstname . ' ' . $agent->lastname?> <br>
                    <?php else: ?>
                        <!-- This is if there is currently no agent assigned to this property -->
                        Agent: - <br>
                    <?php endif ?>

                    <!-- This is to get the tenant -->
                    <?php if ($tenant = $data['property']->getTenant()): ?>
                        Tenant: <?=$tenant->firstname . ' ' . $tenant->lastname?> <br>
                    <?php else: ?>
                        Tenant: - <br>
                    <?php endif ?>

                    <a href="<?=WEBDIR?>/propertyowner/editproperty" class="btn btn-default">Edit</a> <a href="#" class="btn btn-success">Assign a tenant</a>
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
                  if($_SESSION['selectedProperty']) {
                      $getdocuments = HandleDocuments::loadDocuments($_SESSION['selectedProperty']->id);
                      if ($getdocuments != null) {
                          foreach ($getdocuments as $key => $value) {
                              echo $value;
                          }
                      }
                  }


           ?>


                </div>
            <div role="pillpanel" class="pill-pane" id="inspections">3</div>
            <div role="pillpanel" class="pill-pane" id="rta">4</div>
        </div>
    </div>
</div>





<script type="text/javascript">
    
    $('.manage_properties_pills ul li').click(function (e) {
        e.preventDefault()
        $(this).pill('show')
    })
    
    document.title = 'Properties - WallFly';
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
  $pdfMagic = HandleDocuments::setPdfThumbs($_SESSION['selectedProperty']->id);
   foreach ($pdfMagic as $key=>$value ) {
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
                 PDFJS.getDocument('/wallfly-mvc/public/".$value."').then(function(pdf) {
        // Using promise to fetch the page
        pdf.getPage(1).then(function(page) {
            var scale = 0.2;
            var viewport = page.getViewport(scale);

            //
            // Prepare canvas using PDF page dimensions
            //
            var canvas = document.getElementById('".$key."');
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


?>
<script>



        /* -*- Mode: Java; tab-width: 2; indent-tabs-mode: nil; c-basic-offset: 2 -*- */
        /* vim: set shiftwidth=2 tabstop=2 autoindent cindent expandtab: */

        //
        // See README for overview
        //

        //'use strict';

        //
        // Fetch the PDF document from the URL using promises
        //





   // PDFJS.getDocument('/wallfly-mvc/public/documents/56211230e1313@@@@@@INFS2244 Assignment Part2 2015.pdf').then(function(pdf) {
        // Using promise to fetch the page
//        pdf.getPage(1).then(function(page) {
//            var scale = 0.2;
//            var viewport = page.getViewport(scale);

            //
            // Prepare canvas using PDF page dimensions
            //
//            var canvas = document.getElementById('6');
//            var context = canvas.getContext('2d');
//            canvas.height = viewport.height;
//            canvas.width = viewport.width;

            //
            // Render PDF page into canvas context
            //
//            var renderContext = {
//                canvasContext: context,
//                viewport: viewport
//            };
//            page.render(renderContext);
//        });
//    });
//




    //$.each(thumbs, function (key, value) {






</script>
    
<?php
require_once '../app/views/templates/interfaceEnd.php';
?>

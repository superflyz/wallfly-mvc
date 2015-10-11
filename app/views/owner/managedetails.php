<?php
require_once '../app/views/templates/interfaceStart.php';
?>
<!--Content here-->
<div class="container">
    <!--    <div class="row">-->
    <!--        <div class="col-md-12">-->
    <!--            <h1 class="wlcm-h1">Welcome <span class="user-color"> User!</span></h1>-->
    <!--        </div>-->
    <!--    </div>-->

    <h1><?=$data['property']->address?></h1>
    <img src="<?=$data['property']->photo?>">
    <ul>
        <li>Your agent: -</li>
        <li>Your tenant: -</li>
    </ul>
    <a href="<?=WEBDIR?>/propertyowner/addtenant/<?=$data['property']->id?>" class="btn btn-success">Add a tenant</a>


    <div class="row">
        <div class="col-md-12">
            <!-- Features Section -->
            <section id="dash-links">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-md-4 col-sm-8">
                            <a href="">
                                <div class="dash-link">
                            <span class="icons">
                                <i class="fa fa-home fa-inverse"></i>
                            </span>
                                    <h4 class="link-heading">Documents</h4>
                                    <!--                                    <p class="link-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur adipisicing elit.</p>-->
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-8">
                            <a href="">
                                <div class="dash-link">
                            <span class="icons">
                                <i class="fa fa-home fa-inverse"></i>
                            </span>
                                    <h4 class="link-heading">Inspections</h4>
                                    <!--                                    <p class="link-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur adipisicing elit.</p>-->
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-8">
                            <a href="">
                                <div class="dash-link">
                            <span class="icons">
                                <i class="fa fa-home fa-inverse"></i>
                            </span>
                                    <h4 class="link-heading">R.T.A</h4>
                                    <!--                                    <p class="link-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur adipisicing elit.</p>-->
                                </div>
                            </a>
                        </div>


                    </div>
            </section>
        </div>
    </div>

    <br>
    <a href="<?=WEBDIR . '/propertyowner/removeprop/' . $data['property']->id ?>" class="btn btn-danger">Remove this property!</a>



</div>

<?php
require_once '../app/views/templates/interfaceEnd.php';
?>

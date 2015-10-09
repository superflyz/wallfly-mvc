<?php
/**
 * Created by PhpStorm.
 * User: jimmykovacevic
 * Date: 4/10/2015
 * Time: 6:13 PM
 */
require_once '../app/views/templates/interfaceStart.php';
?>
<!--Content here-->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="wlcm-h1">Welcome <span class="user-color"> <?php echo $_SESSION['user']->firstname?></span></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- Features Section -->
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-md-4 col-sm-6">
                            <a href="">
                                <div class="dash-link">
                                    <span class="icons">
                                        <i class="fa fa-calendar fa-inverse"></i>
                                    </span>
                                    <h4 class="link-heading">Calendar</h4>
                                    <p class="link-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur adipisicing elit.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <a href="">
                                <div class="dash-link">
                                    <span class="icons">
                                        <i class="fa fa-home fa-inverse"></i>
                                    </span>
                                    <h4 class="link-heading">Manage Properties</h4>
                                    <p class="link-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur adipisicing elit.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <a href="">
                                <div class="dash-link">
                                    <span class="icons">
                                        <i class="fa fa-comments-o fa-inverse"></i>
                                    </span>
                                    <h4 class="link-heading">Messages</h4>
                                    <p class="link-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur adipisicing elit.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once '../app/views/templates/interfaceEnd.php';
?>



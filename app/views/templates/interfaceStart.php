<?php

//include(__DIR__ . "/../classes/PropertyFunctions.php");
//require_once(__DIR__ . '/../logincheck.php');

//set up page variables
$_SESSION['propertyId'] = "";
$userID = $_SESSION["user"]->id;
$userType = $_SESSION["usertype"];
$properties = [];
$selectedProperty = "";
$pID = '';


//set the propertyID from the $_SESSION['selectedChatProperty'] if set
if (isset($_SESSION['selectedProperty'])) {
    $selectedProperty = $_SESSION['selectedProperty'];
    //$pID = PropertyFunctions::GetPropertyID($userName, $userType, $selectedProperty);
    $pID = $_SESSION['selectedProperty']->id;
    //unset($_SESSION['selectedChatProperty']);

}

//set pID if a tenant because only has one property to display
//if ($userType == 'TENANT') {
//    $tenantArray = [];
//    $tenantArray = PropertyFunctions::GetProperties($userName, $userType);
//    $selectedProperty = $tenantArray[0];
//    $pID = PropertyFunctions::GetPropertyID($userName, $userType, $selectedProperty);
//
//}

?>

<script src="/wallfly-mvc/public/js/dropdown2/dropdown2.js"></script>
    <link href="/wallfly-mvc/public/js/dropdown2/dropdown2.css" rel="stylesheet">

          
<div class="container-fluid">
    <div class="row no-gutter row-offcanvas row-offcanvas-left">
        <div class="col-md-2 col-sm-2 sidebar-offcanvas">
            <div class="navbar-dashboard-left">
                <div id="ui_logo">
                    <img src="<?=WEBDIR?>/images/wallfly_logo.svg" alt="WallFly logo">
                </div>
                <nav>
                    <ul id="tab-nav" class="nav nav-pills nav-stacked">
                        <li  id="dashboard" <?php if($_SESSION['sidebar']== 'dashboard'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/index'>Dashboard<i class="fa fa-desktop pull-right"></i></a></li>
                        <li id="manage" <?php if($_SESSION['sidebar']== 'manage'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/manage'><span class="wrap">Properties</span><i class="fa fa-home pull-right"></i></a></li>
                        <li id="calendar" <?php if($_SESSION['sidebar']== 'calendar'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/calendar'>Calendar<i class="fa fa-calendar pull-right"></i></a></li>
                        <li id="chat" <?php if($_SESSION['sidebar']== 'chat'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/chat'>Messages<i class="fa fa-comments-o pull-right"></i></a></li>
                        <li id="payment" <?php if($_SESSION['sidebar']== 'payment'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/payment' >Payments<i class="fa fa-credit-card pull-right"></i></a></li>
                        <li id="repair" <?php if($_SESSION['sidebar']== 'repair'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/repair' >Repairs<i class="fa fa-wrench pull-right"></i></a></li>
                    </ul>
                </nav>
                <div id="ui_footer">
                    <p>Copyright &copy; <span class="diff-color"><span class="diff-font">WallFly</span> 2015</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-sm-10">
            <div class="navbar-dashboard-main">
                <div class="visible-xs pull-left smtog">
                    <a class="tog" href="" data-toggle="offcanvas">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="user pull-right">
                    <div class="btn-group top-navbar-controls">
                        <span class="btn-separator"></span>
                        <div class="btn-group user-btn-focus" data-container="body" data-toggle="tooltip" title="Announcements">
                            <a class="btn user-btn-t dropdown-toggle"  data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span>
                            <span class="badge anown">3</span></a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href=""><i class="i"></i>Payment is due on 19/10/15</a></li>
                                <li class="divider"></li>
                                <li><a href=""><i class="i"></i>New message from owner</a></li>
                                <li class="divider"></li>
                                <li><a href=""><i class="i"></i>Repair request approved</a></li>
                            </ul>
                        </div>
                        <span class="btn-separator"></span>
                        <div class="btn-group user-btn-focus" data-container="body" data-toggle="tooltip" title="User Info">
                            <a class="btn user-btn-t dropdown-toggle" data-toggle="dropdown" href="#"><span
                                    class="glyphicon glyphicon-user"></span></a>
                            <ul class="dropdown-menu">
                                <li><i class="i"></i><span class="user-name">User name</span></li>
                                <li class="divider"></li>
                                <li><a href=""><i class="i"></i>User Profile</a></li>
                                <li><a href=""><i class="i"></i>Account Settings</a></li>
                            </ul>
                        </div>
                        <span class="btn-separator"></span>
                        <button type="button" class="btn user-btn inc" aria-label="Left Align" data-container="body" data-toggle="tooltip" title="Help">
                            <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                        </button>
                        <span class="btn-separator"></span>
                        <a href="<?=WEBDIR?>/home/logout"><button type="button" class="btn user-btn-diff inc" aria-label="Left Align" data-container="body" data-toggle="tooltip" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </button></a>

                    </div>
                </div>
            </div>
            <div class="container content_body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="property-display pull-left">
                            <div class="pull-left">
                                <div class="property-label"><p>Property</p></div>
                                <div class="property-address">
                                    <!-- create address dropdown list only if agent or owner usertype -->
                                    <?php if ($userType == 2) {
                                    //    if ($properties = $_SESSION['user']->getProperties()) {
                                    //      echo $properties[1]->address;
                                    //    }

                                          $properties = $_SESSION['user']->getProperties();
                                    //
                                    }

                                    ?>
                                   <select class="ui search dropdown">
                                        <option value="">Select a property...</option>
                                        <?php
                                    for($i=0;$i<count($properties);$i++){
                                        $selected = '';
                                        echo value;
                                        if ($properties[$i]->id === $pID) {
                                            $selected = 'selected';
                                        }
                                        echo '<option value="'.$i.'" ' . $selected . '>' . $properties[$i]->address . '</option>';

                                    } ?>
                                    </select> 
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
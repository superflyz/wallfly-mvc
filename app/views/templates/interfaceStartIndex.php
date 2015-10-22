<body class="ui_body">
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
          
<div class="container-fluid">
    <div class="row no-gutter row-offcanvas row-offcanvas-left">
        <div class="col-md-2 col-sm-2 sidebar-offcanvas">
            <div class="navbar-dashboard-left">
                <div id="ui_logo">
                    <img src="<?=WEBDIR?>/images/wallfly_logo.svg" alt="WallFly logo">
                </div>
                <nav>
                    <ul id="tab-nav" class="nav nav-pills nav-stacked">
                        <?php if($_SESSION['usertype'] == USERTYPE_OWNER) {;?>
                         <li  id="dashboard" <?php if($_SESSION['sidebar']== 'dashboard'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/index'>Dashboard<i class="fa fa-desktop pull-right"></i></a></li>
                        <li id="manage" <?php if($_SESSION['sidebar']== 'manage'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/manage'><span class="wrap">Properties</span><i class="fa fa-home pull-right"></i></a></li>
                        <li id="calendar" <?php if($_SESSION['sidebar']== 'calendar'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/calendar'>Calendar<i class="fa fa-calendar pull-right"></i></a></li>
                        <li id="chat" <?php if($_SESSION['sidebar']== 'chat'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/chat'>Messages<i class="fa fa-comments-o pull-right"></i></a></li>
                        <li id="payment" <?php if($_SESSION['sidebar']== 'payment'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/payment' >Payments<i class="fa fa-credit-card pull-right"></i></a></li>
                        <li id="repair" <?php if($_SESSION['sidebar']== 'repair'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/repair' >Repairs<i class="fa fa-wrench pull-right"></i></a></li>
                        <?php }?>
                        <?php if($_SESSION['usertype'] == USERTYPE_AGENT) {;?>
                            <li  id="dashboard" <?php if($_SESSION['sidebar']== 'dashboard'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyagent/index'>Dashboard<i class="fa fa-desktop pull-right"></i></a></li>
                            <li id="manage" <?php if($_SESSION['sidebar']== 'manage'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyagent/manage'><span class="wrap">Properties</span><i class="fa fa-home pull-right"></i></a></li>
                            <li id="calendar" <?php if($_SESSION['sidebar']== 'calendar'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyagent/calendar'>Calendar<i class="fa fa-calendar pull-right"></i></a></li>
                            <li id="chat" <?php if($_SESSION['sidebar']== 'chat'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyagent/chat'>Messages<i class="fa fa-comments-o pull-right"></i></a></li>
                            <li id="payment" <?php if($_SESSION['sidebar']== 'payment'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyagent/payment' >Payments<i class="fa fa-credit-card pull-right"></i></a></li>
                            <li id="repair" <?php if($_SESSION['sidebar']== 'repair'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyagent/repair' >Repairs<i class="fa fa-wrench pull-right"></i></a></li>
                        <?php }?>
                        <?php if($_SESSION['usertype'] == USERTYPE_TENANT) {;?>
                            <li  id="dashboard" <?php if($_SESSION['sidebar']== 'dashboard'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertytenant/index'>Dashboard<i class="fa fa-desktop pull-right"></i></a></li>
                            <li id="manage" <?php if($_SESSION['sidebar']== 'manage'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertytenant/manage'><span class="wrap">Properties</span><i class="fa fa-home pull-right"></i></a></li>
                            <li id="calendar" <?php if($_SESSION['sidebar']== 'calendar'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertytenant/calendar'>Calendar<i class="fa fa-calendar pull-right"></i></a></li>
                            <li id="chat" <?php if($_SESSION['sidebar']== 'chat'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertytenant/chat'>Messages<i class="fa fa-comments-o pull-right"></i></a></li>
                            <li id="payment" <?php if($_SESSION['sidebar']== 'payment'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertytenant/payment' >Payments<i class="fa fa-credit-card pull-right"></i></a></li>
                            <li id="repair" <?php if($_SESSION['sidebar']== 'repair'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertytenant/repair' >Repairs<i class="fa fa-wrench pull-right"></i></a></li>
                        <?php }?>
                        <?php if($_SESSION['usertype'] == USERTYPE_REALESTATE) {;?>
                            <li  id="dashboard" <?php if($_SESSION['sidebar']== 'dashboard'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/realest/index'>Dashboard<i class="fa fa-desktop pull-right"></i></a></li>
                            <li id="manage" <?php if($_SESSION['sidebar']== 'manage'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/realest/manage'><span class="wrap">Properties</span><i class="fa fa-home pull-right"></i></a></li>
                            <li id="calendar" <?php if($_SESSION['sidebar']== 'calendar'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/realest/calendar'>Calendar<i class="fa fa-calendar pull-right"></i></a></li>
                            <li id="chat" <?php if($_SESSION['sidebar']== 'chat'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/realest/chat'>Messages<i class="fa fa-comments-o pull-right"></i></a></li>
                            <li id="payment" <?php if($_SESSION['sidebar']== 'payment'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/realest/payment' >Payments<i class="fa fa-credit-card pull-right"></i></a></li>
                            <li id="repair" <?php if($_SESSION['sidebar']== 'repair'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/realest/repair' >Repairs<i class="fa fa-wrench pull-right"></i></a></li>
                        <?php }?>
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
                    <a class="tog" data-toggle="offcanvas">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="user pull-right">
                    <div class="btn-group top-navbar-controls">
                        <span class="btn-separator"></span>
                        <div class="btn-group user-btn-focus" data-container="body" data-toggle="tooltip" title="Announcements">
                            <a class="btn user-btn-t dropdown-toggle"  data-toggle="dropdown" href="#" id="notifications">
                                <span class="glyphicon glyphicon-bell" aria-hidden="true"></span>
                                <?php $notifications = Notification::getUnreadNotifications($_SESSION['user']->id); ?>
                                <span class="badge anown"><?php echo count($notifications);?></span>
                            </a>
                            <ul class="dropdown-menu pull-right enable-overflow">
                                <?php
                                $count = 0;
                                foreach ($notifications as $notification) {
                                    $id = $notification['id'];
                                    echo ("<li class='notifs' id='{$id}'>" . $notification['message'] . "</li>");
                                    $count++;
                                    if ($count == 4) {
                                        break;
                                    }
                                }
                                if ($count == 0) {
                                    echo "<li>No new notifications</li>";
                                }
                                ?>
                                <?php
                                if ($userType == USERTYPE_TENANT) {
                                    echo ("<a href='" . WEBDIR . "/propertytenant/viewnotifications'>View all notifications</a>");
                                } else if ($userType == USERTYPE_AGENT) {
                                    echo ("<a href='" . WEBDIR . "/propertyagent/viewnotifications'>View all notifications</a>");
                                } else if ($userType == USERTYPE_OWNER) {
                                    echo ("<a href='" . WEBDIR . "/propertyowner/viewnotifications'>View all notifications</a>");
                                } else if ($userType == USERTYPE_REALESTATE) {
                                    echo ("<a href='" . WEBDIR . "/propertyrealestate/viewnotifications'>View all notifications</a>");
                                }
                                ?>
                            </ul>
                        </div>
                        <span class="btn-separator"></span>
                        <div class="btn-group user-btn-focus" data-container="body" data-toggle="tooltip" title="User Info">
                            <a class="btn user-btn-t dropdown-toggle" data-toggle="dropdown" href="#"><span
                                    class="glyphicon glyphicon-user"></span></a>
                            <ul class="dropdown-menu">
                                <li><i class="i"></i><span class="user-name"><?php echo $_SESSION['user']->firstname . " " . $_SESSION['user']->lastname?></span></li>
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
            <div id="pagecontentstart" class="container content_body">
                <div class="row top-section">
            <div clas="col-md-12">
                
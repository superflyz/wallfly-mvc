<div class="container-fluid fill">
    <div class="row no-gutter row-offcanvas row-offcanvas-left">
        <div class="col-md-2 col-sm-2 sidebar-offcanvas">
            <div class="navbar-dashboard-left">
                <div id="uilogo">
                    <img src="<?=WEBDIR?>/images/wallfly_logo.svg" alt="WallFly logo">
                </div>
                <nav id="navbg">
                    <ul id="tab-nav" class="nav nav-pills nav-stacked">
                        <?php if($_SESSION['usertype'] == USERTYPE_OWNER) {;?>
                        <li  id="dashboard" <?php if($_SESSION['sidebar']== 'dashboard'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/index'>Dashboard<i class="fa fa-desktop pull-right"></i></a></li>
                        <li id="manage" <?php if($_SESSION['sidebar']== 'manage'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/manage'><span class="wrap">Properties</span><i class="fa fa-home pull-right"></i></a></li>
                        <li id="calendar" <?php if($_SESSION['sidebar']== 'calendar'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/calendar'>Calendar<i class="fa fa-calendar pull-right"></i></a></li>
                        <li id="chat" <?php if($_SESSION['sidebar']== 'chat'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/chat'>Messages<i class="fa fa-comments-o pull-right"></i></a></li>
                        <li id="payment" <?php if($_SESSION['sidebar']== 'payment'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/payment' >Payment<i class="fa fa-credit-card pull-right"></i></a></li>
                        <li id="repair" <?php if($_SESSION['sidebar']== 'repair'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyowner/repair' >Repairs<i class="fa fa-wrench pull-right"></i></a></li>
                        <?php }?>
                        <?php if($_SESSION['usertype'] == USERTYPE_AGENT) {;?>
                            <li  id="dashboard" <?php if($_SESSION['sidebar']== 'dashboard'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyagent/index'>Dashboard<i class="fa fa-desktop pull-right"></i></a></li>
                            <li id="manage" <?php if($_SESSION['sidebar']== 'manage'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyagent/manage'><span class="wrap">Properties</span><i class="fa fa-home pull-right"></i></a></li>
                            <li id="calendar" <?php if($_SESSION['sidebar']== 'calendar'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyagent/calendar'>Calendar<i class="fa fa-calendar pull-right"></i></a></li>
                            <li id="chat" <?php if($_SESSION['sidebar']== 'chat'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyagent/chat'>Messages<i class="fa fa-comments-o pull-right"></i></a></li>
                            <li id="payment" <?php if($_SESSION['sidebar']== 'payment'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyagent/payment' >Payment<i class="fa fa-credit-card pull-right"></i></a></li>
                            <li id="repair" <?php if($_SESSION['sidebar']== 'repair'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertyagent/repair' >Repairs<i class="fa fa-wrench pull-right"></i></a></li>
                        <?php }?>
                        <?php if($_SESSION['usertype'] == USERTYPE_TENANT) {;?>
                            <li  id="dashboard" <?php if($_SESSION['sidebar']== 'dashboard'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertytenant/index'>Dashboard<i class="fa fa-desktop pull-right"></i></a></li>
                            <li id="manage" <?php if($_SESSION['sidebar']== 'manage'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertytenant/manage'><span class="wrap">Properties</span><i class="fa fa-home pull-right"></i></a></li>
                            <li id="calendar" <?php if($_SESSION['sidebar']== 'calendar'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertytenant/calendar'>Calendar<i class="fa fa-calendar pull-right"></i></a></li>
                            <li id="chat" <?php if($_SESSION['sidebar']== 'chat'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertytenant/chat'>Messages<i class="fa fa-comments-o pull-right"></i></a></li>
                            <li id="payment" <?php if($_SESSION['sidebar']== 'payment'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertytenant/payment' >Payment<i class="fa fa-credit-card pull-right"></i></a></li>
                            <li id="repair" <?php if($_SESSION['sidebar']== 'repair'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/propertytenant/repair' >Repairs<i class="fa fa-wrench pull-right"></i></a></li>
                        <?php }?>
                        <?php if($_SESSION['usertype'] == USERTYPE_REALESTATE) {;?>
                            <li  id="dashboard" <?php if($_SESSION['sidebar']== 'dashboard'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/realest/index'>Dashboard<i class="fa fa-desktop pull-right"></i></a></li>
                            <li id="manage" <?php if($_SESSION['sidebar']== 'manage'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/realest/manage'><span class="wrap">Properties</span><i class="fa fa-home pull-right"></i></a></li>
                            <li id="calendar" <?php if($_SESSION['sidebar']== 'calendar'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/realest/calendar'>Calendar<i class="fa fa-calendar pull-right"></i></a></li>
                            <li id="chat" <?php if($_SESSION['sidebar']== 'chat'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/realest/chat'>Messages<i class="fa fa-comments-o pull-right"></i></a></li>
                            <li id="payment" <?php if($_SESSION['sidebar']== 'payment'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/realest/payment' >Payment<i class="fa fa-credit-card pull-right"></i></a></li>
                            <li id="repair" <?php if($_SESSION['sidebar']== 'repair'){echo 'class="active"'; } ?>><a href='<?=WEBDIR?>/realest/repair' >Repairs<i class="fa fa-wrench pull-right"></i></a></li>
                        <?php }?>
                    </ul>
                </nav>
                <div id="dfooter">
                    <p>Copyright &copy; <span class="diff-color"><span class="diff-font">WallFly</span> 2015</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-sm-10">
            <div class="navbar-dashboard-main">
                <div class="visible-xs pull-left smtog">
                    <a class="tog" href="#" data-toggle="offcanvas">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>
                <div class="user pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn user-btn inc" aria-label="Left Align">
                            <span class="glyphicon glyphicon-bell" aria-hidden="true"></span><span
                                class="badge anown">3</span>
                        </button>
                        <div class="btn-group">
                            <a class="btn user-btn dropdown-toggle" data-toggle="dropdown" href="#"><span
                                    class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp;<span class="user-name"><?=$_SESSION['user']->firstname . ' ' . $_SESSION['user']->lastname?></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="icon-pencil"></i> Edit</a></li>
                                <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
                                <li><a href="#"><i class="icon-ban-circle"></i> Ban</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="i"></i> Make admin</a></li>
                            </ul>
                        </div>
                        <button type="button" class="btn user-btn inc" aria-label="Left Align">
                            <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                        </button>
                        <a href="<?=WEBDIR?>/home/logout"><button type="button" class="btn user-btn-diff inc" aria-label="Left Align">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </button></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid fill">
<div class="container-fluid fill">
    <div class="row no-gutter row-offcanvas row-offcanvas-left">
        <div class="col-md-2 col-sm-2 sidebar-offcanvas">
            <div class="navbar-dashboard-left">
                <div id="logo">
                    <img src="<?=WEBDIR?>/images/wallfly_logo.svg" alt="WallFly logo">
                </div>
                <nav id="navbg">
                    <ul id="tab-nav" class="nav nav-pills nav-stacked">
                        <li class="active" data-info="<?=WEBDIR?>/propertyowner/home"><a href="#dashboard" data-toggle="pill">Dashboard<i class="fa fa-desktop pull-right"></i></a></li>
                        <li data-info='<?=WEBDIR?>/propertyowner/manage'><a href="#properties" data-toggle="pill"><span class="wrap">Properties</span><i class="fa fa-home pull-right"></i></a></li>
                        <li data-info='<?=WEBDIR?>/propertyowner/calendar'><a href="#calendar" data-toggle="pill">Calendar<i class="fa fa-calendar pull-right"></i></a></li>
                        <li><a href='<?=WEBDIR?>/propertyowner/chat'>Messages<i class="fa fa-comments-o pull-right"></i></a></li>
                        <li data-info='paymentsys/payment.php'><a href="#payment" data-toggle="pill">Payment<i class="fa fa-credit-card pull-right"></i></a></li>
                        <li><a href="#repairs" data-toggle="pill">Repairs<i class="fa fa-wrench pull-right"></i></a></li>
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
                                    class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp;<span class="user-name">User</span></a>
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
                        <a href="logout.php"><button type="button" class="btn user-btn-diff inc" aria-label="Left Align">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </button></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid fill">
                Testing Chat Page
        </div>
    </div>
</div>
</div>
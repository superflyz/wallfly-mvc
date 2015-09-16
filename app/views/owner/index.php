<div class="index d-body">

<div class="container-fluid fill">
    <div class="row no-gutter row-offcanvas row-offcanvas-left">
        <div class="col-md-2 col-sm-2 sidebar-offcanvas">
            <div class="navbar-dashboard-left">
                <div id="logo">
                    <img src="<?=WEBDIR?>/images/wallfly_logo.svg" alt="WallFly logo">
                </div>
                <nav id="navbg">
                    <ul id="tab-nav" class="nav nav-pills nav-stacked">
                        <li class="active"><a href="#dashboard" data-toggle="pill">Dashboard<i class="fa fa-desktop pull-right"></i></a></li>
                        <li data-info='properties.php'><a href="#properties" data-toggle="pill"><span class="wrap">Properties</span><i class="fa fa-home pull-right"></i></a></li>
                        <li data-info='calendar/calendar.php'><a href="#calendar" data-toggle="pill">Calendar<i class="fa fa-calendar pull-right"></i></a></li>
                        <li data-info='chatsys/chat.php'><a href="#messages" data-toggle="pill">Messages<i class="fa fa-comments-o pull-right"></i></a></li>
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
                                    class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp;<span class="user-name"><?=$data->firstname?></span></a>
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
                <div class="pill-content">
                    <div class="pill-pane active" id="dashboard">


                        <div class="container">
                            <div class="row">
                                <div class="col-md-9 col-md-offset-1">
                                    <h1 class="wlcm-h1">Welcome <span class="user-color"> <?=$data->firstname?>!</span></h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-md-offset-1">
                                    <!-- Features Section -->
                                    <section id="dash-links">
                                        <div class="container-fluid">
                                            <div class="row text-center">
                                                <div class="col-md-4 col-sm-6">
                                                    <a href="#calendar" data-toggle="pill">
                                                        <div class="dash-link">
                                                            <span class="icons">
                                                                <i class="fa fa-calendar fa-inverse"></i>
                                                            </span>
                                                            <h4 class="link-heading">Calendar</h4>
                                                            <p class="link-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur adipisicing elit.</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="col-md-4 col-sm-6">
                                                    <a href="#properties" data-toggle="pill">
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
                                                    <a href="#messages" data-toggle="pill">
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
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="pill-pane fade" id="properties">
                        <object class="iiframe" data="<?=WEBDIR?>/propertyowner/manage" type="text/html"></object>
                    </div>
                    <div class="pill-pane fade" id="calendar">
                        <object class="iiframe" data="#" type="text/html"></object>
                    </div>
                    <div class="pill-pane fade" id="messages">
                        <object class="iiframe" data="#" type="text/html"></object>
                    </div>
                    <div class="pill-pane fade" id="payment">
                        <object class="iiframe" data="#" type="text/html"></object>
                    </div>
                    <div class="pill-pane fade" id="repairs">
                        <object class="iiframe" data="#">
                        </object>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="<?=WEBDIR?>/js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?=WEBDIR?>/js/bootstrap.min.js"></script>
<!-- Plugin JavaScript -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="<?=WEBDIR?>/js/classie.js"></script>
<script src="<?=WEBDIR?>/js/cbpAnimatedHeader.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?=WEBDIR?>/js/wallfly.js"></script>
<script src="<?=WEBDIR?>/js/offcanvas.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $("#tab-nav li").click(function () {
        $("object").empty();
        var objecturl = $(this).attr('data-info');
        $('object').attr('data', objecturl);


    });

    //http://jsfiddle.net/s6bP9/
    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
        var target = this.href.split('#');
        $('.nav a').filter('a[href="#' + target[1] + '"]').tab('show');
    });

});
</script>
</div>

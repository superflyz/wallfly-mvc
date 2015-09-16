<!-- Navigator-->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a style="color: #ffffff;" class="navbar-brand" href="home.php"><span style="color: #ffffff;" class="glyphicon glyphicon-home"></span>&nbsp;Wall Fly</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <!-- notification test -->
            <li>
                <div class="dropdown" id="alert">
                    <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#" style="background-color: #036E2C;">
                        <i class="glyphicon glyphicon-bell"></i>
                    </a>

                    <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">

                        <div class="notification-heading">
                            <h4 class="menu-title"><b>Notifications</b></h4>
                        </div>
                        <li class="divider"></li>
                        <div class="notifications-wrapper">
                            <a class="content" href="calendar.php">
                                <div class="notification-item">
                                    <h4 class="item-title">An Event has been updated (1 hour ago)</h4>
                                </div>
                            </a>

                            <a class="content" href="#">
                                <div class="notification-item">
                                    <h4 class="item-title">You have got a message (1 hour ago)</h4>
                                </div>
                            </a>

                            <a class="content" href="#">
                                <div class="notification-item">
                                    <h4 class="item-title">You have got a message (2 hour ago)</h4>
                                </div>
                            </a>

                            <a class="content" href="calendar.php">
                                <div class="notification-item">
                                    <h4 class="item-title">An event has been updated (4 hour ago)</h4>
                                </div>
                            </a>
                        </div>
                        <li class="divider"></li>
                    </ul>
                </div>
            </li>
            <li>
                <ul class="nav navbar-nav" id="user_dropdown">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $data['owner']->email ?>(<?php echo $_SESSION["usertype"]; ?>) <span class="glyphicon glyphicon-user pull-right"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                            <li class="divider"></li>
                            <li><a href="property.php">Property <span class="glyphicon glyphicon-home pull-right"></span></a></li>
                            <li class="divider"></li>
                            <li><a href="calendar.php">Calendar <span class="glyphicon glyphicon-calendar pull-right"></span></a></li>
                            <li class="divider"></li>
                            <li><a href="chatsys/chat.html">Messages <span class="glyphicon glyphicon-comment pull-right"></span></a></li>
                            <li class="divider"></li>
                            <li><a href="login_page.html">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <button type="button" class="logout" onclick="window.location.href='login_page.html'"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout
                </button>
            </li>
        </ul>
    </div>
</nav>

<!-- contents -->

<div class="container-fluid2" id="content">

    <div class="row">

      <?php foreach ((array) $data['properties'] as $property): ?>
        <div class='col-md-4' id='items'>
          <img class='img-rounded' border='0' src="<?=$property->photo?>" width="250" height="200"><br><br>
          <h4>Owner: <?=$data['owner']->firstname . ' ' . $data['owner']->lastname?></h4>
          <?php if ($agent = $property->getAgent()): ?>
            <h4>Agent: <?=$agent->firstname . ' ' . $agent->lastname;?></h4>
          <?php endif ?>
          <?php //if ($tenant = $property->getTenant()): ?>
            <!-- <h4>Tenant: <?php //$tenant = $property->getTenant(); echo $tenant->firstname . ' ' . $tenant->lastname; ?></h4> -->
          <?php //endif ?>
          <h3><a href="propertyowner/propertydetail/<?=$property->id?>" class="divLink">Click</a></h3>
        </div>
      <?php endforeach ?>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div>
                <button class="add_btn"
                        onclick="javascript:void window.open('add_popup.php','1428456850982','width=700,height=500,toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=1,left=0,top=0');return false;">
                    <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Add Property
                </button>
            </div>

            <div>
                <button id="calendar_btn"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;Calendar
                </button>
            </div>
        </div>
    </div>


</div>

<br>

<div>
    <ul style="list-style-type: none; text-align: center; text-decoration: none;">
        <li style="display:inline; padding:25px;"><a href="#">About Us</li>
        <li style="display:inline; padding:25px;"><a href="#">Contact Us</li>
        <li style="display:inline; padding:25px;"><a href="#">RTA Website</li>
        <li style="display:inline; padding:25px;"><a href="#">Report an Issue</li>
    </ul>
</div>

<script type="text/javascript">
    document.getElementById("calendar_btn").onclick = function () {
        location.href = "calendar.php";
    };
</script>

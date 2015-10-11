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
            <li role="presentation"><a href="#home" aria-controls="home" role="pill" data-toggle="pill">Property Details</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="pill" data-toggle="pill">Documents</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="pill" data-toggle="pill">Inspections</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="pill" data-toggle="pill">R.T.A</a></li>
          </ul>
        
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- Pill panes -->
        <div class="pill-content manage_properties_view">
            <div role="pillpanel" class="pill-pane" id="home">1</div>
            <div role="pillpanel" class="pill-pane" id="profile">2</div>
            <div role="pillpanel" class="pill-pane" id="messages">3</div>
            <div role="pillpanel" class="pill-pane" id="settings">4</div>
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
    
<?php
require_once '../app/views/templates/interfaceEnd.php';
?>

<?php
require_once '../app/views/templates/interfaceStartCalendar.php';
?>

<!--Content here-->

<div class="row">
    <div class="col-md-12">
        <div class="page_heading">
            <p>Calendar</p>
            <hr />
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
     <div class="manage_properties_pills">
          <!-- Nav pills -->
          <ul class="nav nav-pills nav-justified properties_pills">

             <li id="add-event"><a href="#"  data-toggle="modal" >Add Event</a></li>
              <li id="select-event"><a href="#"  data-toggle="modal">Remove Event</a></li>
          </ul>

        </div>
        
<!--start calendar-->
<section id="calender">
    <div class="dzscalendar skin-responsive-galileo mode-normal tooltip_transition-tooltipDef" style="max-width: 960px; margin: 25px auto;">
        <div class="dzscalendar skin-responsive-galileo auto-init " style="" data-options="{
            design_month_covers : ['../images/calendar/jan.jpg','../images/calendar/feb.jpg','../images/calendar/mar.jpg','../images/calendar/apr.jpg','../images/calendar/may.jpg','../images/calendar/jun.jpg','../images/calendar/jul.jpg','../images/calendar/aug.jpg','../images/calendar/sep.jpg','../images/calendar/oct.jpg','../images/calendar/nov.jpg','../images/calendar/dec.jpg']
            ,start_weekday: 'Monday'
            ,header_weekdayStyle: 'responsivefull'
        }">
            <div class="events">
                <div class="event-tobe" data-date="3-14-2014"></div>

                <?php
                //$count = 0;
                if (!isset($_SESSION['selectedProperty'])) {


                    $events = CalendarEvents::getAllEvents($userEmail);
                    if($events != null){
                        foreach ($events as $event) {

                        $interval = $event->eventInterval;
                        $explodeDate = explode("/", $event->eventDate);
                        echo ' <div class="event-tobe" data-tag="blue" data-repeat=' . $interval . ' data-day="' . $explodeDate[0] . '" data-month="' . $explodeDate[1] . '"
                            data-year="' . $explodeDate[2] . '" data-type="link" data-href="#">
                            <span class="tooltip-heading ">' . $event->eventName . '</span>';
                        if ($event->eventTime != "") {
                            echo '<span class="label eventlabel">Time:</span>' . $event->eventTime . '<br/>';
                        }
                        echo '<br/>' . $event->description . '</div>';
//                                    $count++;


                        }
                    }

                } else {

                    $events = CalendarEvents::getPropertyEvents($pID);
                    if($events != null){
                        foreach ($events as $event) {

                        $interval = $event->eventInterval;
                        $explodeDate = explode("/", $event->eventDate);
                        echo ' <div class="event-tobe" data-tag="blue" data-repeat=' . $interval . ' data-day="' . $explodeDate[0] . '" data-month="' . $explodeDate[1] . '"
                            data-year="' . $explodeDate[2] . '" data-type="link" data-href="#">
                            <span class="tooltip-heading">' . $event->eventName . '</span>';
                        if ($event->eventTime != "") {
                            echo '<span class="label">Time:</span>' . $event->eventTime . '<br/>';
                        }
                        echo '<br/>' . $event->description . '</div>';
                        //$count++;

                        }
                    }
                }
                ?>
                </div>
            </div>
        </div>
        <div style="height:  <?php //echo ($count * 80)?>px"></div>
    </div>
</section>
<!--end calendar-->
    
<!--add event modal-->
<div class="modal modal-vcenter fade event-modal-md" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <p class="modal-title flabel">Add Event</p>
            </div>

            <div class="modal-body">
                <form id="setEvent" name="addEvent" method="post" action="../dashboard/addevent">
                    <div class="form-field ff1">
                        <label for="eventName">Event Name</label>
                        <input name="eventName" type="text" class="form-control">
                        <span class="error"></span>
                    </div>
                    <div class="form-field">
                        <label for="time">Time</label>
                        <br/>
                        <input id='timepicker' type='text' name='timepicker1'/>

                    </div>
                    <div class="form-field">
                        </br>
                        <label for="interval">Select Interval</label>
                        <select name="interval" class="form-control">
                            <option value="onetime">One Time</option>
                            <option value="everyweek">Weekly</option>
                            <option value="everyotherweek">Fortnightly</option>
                            <option value="everymonth">Monthly</option>
                        </select>
                        <span class="error"></span>
                    </div>
                    <div class="form-field">
                        </br>
                        <label for="description">Description</label>
                        <input name="description" type="text" id="description" class="form-control">
                        <span class="error"></span>
                    </div>
                    <div class="form-field">
                        <input type="hidden" name="propertyID" id="propertyID" class="form-control"
                               value="<?php echo $pID; ?> ">
                    </div>
                    <div class="form-field">
                        <input type="hidden" name="email" id="email" class="form-control"
                               value="<?php echo $userEmail; ?> ">
                    </div>
                    <!-- date picker -->

                    <div class="form-field">

                        <label for="date">Event Date</label>
                        <input name="date" id="date" type="text"  class="form-control" >
                        <pre hidden id="hidden" class="event-receiver"></pre>
                        <span class="error"></span>
                        <section style="height:200px">
                            <div class="col-md-12">
                                <div class="dzscalendar skin-aurora" id="trauroradatepicker" style="height:200px">
                                </div>
                            </div>
                        </section>

                    </div>

                    <!-- end date picker -->
                    <div>
                        <button type="submit" name="Submit" value="submit" id="submit-btn"
                                class="btn btn-primary submit eventsubmit">Add event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end add event modal-->

<!--select event modal-->
<div class="modal modal-vcenter fade select-modal-md" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <p class="modal-title flabel">Select Event</p>
            </div>

            <div id="select-modal-body" class="modal-body">
                <form id="selectEvent" name="addEvent" method="post" action="addevent.php">
                    <div id="dynamic-edit" class="clearfix">

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- end add event modal-->

  </div>
</div>

<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<script>

    $(document).ready(function () {

        var eventAdded = <?php echo "'".$_SESSION['eventAdded']."'";?>;
        if (eventAdded == "true") {
            swal("Success", "You have added an event to the calendar", "success");
        } else if (eventAdded == "true") {
            sweetAlert("Oops...", "Something went wrong with adding that event", "error");

        }
        <?php unset($_SESSION['eventAdded']);?>


        $('#add-event').click(function () {
            var checkID = <?php echo "'".$pID."'";?>;
            if (checkID == 0) {
                swal("Just a reminder", "To please select a property first to add an event");
            } else {
                $('.event-modal-md').modal('show');
            }

        });

        $('#select-event').click(function () {
            var checkID = <?php echo "'".$pID."'";?>;
            if (checkID == 0) {
                swal("Just a reminder", "To please select a property first to add an event");
            } else {

                jQuery.ajax({
                    url: '/wallfly-mvc/public/dashboard/getPropertyEvents',
                    type: "POST",
                    data: {
                        selected: checkID
                    },
                    success: function (result) {
                        $("#dynamic-edit").empty();
                        $("#dynamic-edit").append(result);
                        $('.select-modal-md').modal('show');

                    }
                });
            }
        });


        // cover pictures for calendar jan->dec in order
        var design_month_covers = ['img/jan.jpg', 'img/feb.jpg', 'img/mar.jpg', 'img/apr.jpg', 'img/may.jpg', 'img/jun.jpg', 'img/jul.jpg', 'img/aug.jpg', 'img/sep.jpg', 'img/oct.jpg', 'img/nov.jpg', 'img/dec.jpg'];

        //set cover pictures
        dzscal_init("#cal-responsive-galileo2", {
            design_month_covers: design_month_covers
        });

        dzscal_init("#trauroradatepicker", {
            design_transitionDesc: 'tooltipDef'
            , mode: 'datepicker'
            , header_weekdayStyle: 'three'
            , design_transition: 'fade'
        });

        dzscal_init("#calendar_datepicker", {
            design_transitionDesc: 'tooltipDef'
            , mode: 'datepicker'
            , date_format: 'j-F-Y'
            , header_weekdayStyle: 'three'
            , design_transition: 'fade'
            , mode_datepicker_setTodayAsDefault: 'on'
        });


        function dp1_event(arg) {
            //console.log(arg);
            $('.event-receiver').html(arg);

        }

        var dp1 = document.getElementById('trauroradatepicker');
        if (dp1) {
            dp1.arr_datepicker_events.push(dp1_event);

        }


        $('#hidden').bind("DOMSubtreeModified", function () {
            var date = $('#hidden').html();
            var dateArray = date.split("-");
            var dateString = dateArray[1] + "/" + dateArray[0] + "/" + dateArray[2];
            $('#date').val(dateString);

        });


        $('#pagecontentstart').addClass( "reduce_page_height" );



        $("body").on('click', ".removeEvent", function(){ var removeID = $(this).parent().attr("id"); swal({   title: "Are you sure?",   text: "This will permanently remove the event!",
           type: "warning",   showCancelButton: true, confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false },
           function(){


             jQuery.ajax({
                    url: '/wallfly-mvc/public/dashboard/removePropertyEvents',
                    type: "POST",
                    data: {
                        remove: removeID
                    },
                    success: function (result) {
                        swal("Deleted!", "The Event has been removed.", "success");
                        location.reload();
                    },
                    error: function(result){

                        sweetAlert("Sorry", "Unable to remove Event!", "error");

                    }
                });
             })
         });


    });

</script>



<script>
$(document).ready(
    function() {
        $("#timepicker").timepicki();

    }
);

$('#setEvent').validate({ // initialize the plugin
    ignore: [],
    rules: {
        eventName: {
            required: true,
            maxlength: 20
        },
        date: {
            required: true
        },
        description: {
            maxlength: 100
        }

    }
});
</script>
    
<script type="text/javascript">
    document.title = 'Calendar - WallFly';
</script>


<?php
require_once '../app/views/templates/interfaceEnd.php';
?>
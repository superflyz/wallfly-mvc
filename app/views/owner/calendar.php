<?php
//set up page variables
$_SESSION['propertyId'] = "";
$userID = $_SESSION["user"]->id;
$userEmail = $_SESSION["user"]->email;
$userType = $_SESSION["usertype"];
$properties = [];
$selectedProperty = "";
$pID = 0;

if (!isset($_SESSION['eventAdded'])) {

    $_SESSION['eventAdded'] = "";
}


//set the propertyID from the $_SESSION['selectedChatProperty'] if set
if (isset($_SESSION['selectedProperty'])) {
    $selectedProperty = $_SESSION['selectedProperty'];
    $pID = $_SESSION['selectedProperty']->id;


}


?>
<?php
require_once '../app/views/templates/interfaceStart.php';
?>
<?php
$properties = $_SESSION['user']->getProperties();
//dropdown for property list
echo '<div class="container">

            <div class="btn-group">
                <a class="btn btn-primary dropdown-toggle show-properties selector" data-toggle="dropdown" href="#" style="margin-left: 15px;">Select a Property</a>
            </div>';
?>
<div id="reducedPadding" class="container">
    <div id="propertyHolder">
        <input placeholder="type to search..." id="box" type="text"/>
        <ul class="navList ">
            <?php

            for ($i = 0; $i < count($properties); $i++) {

                echo '<li id="' . $i . '"><a>' . $properties[$i]->address . '</a></li>';
            }
            ?>
        </ul>
    </div>
</div>

<?php
echo '</div>';
echo '<div class="btn-group pull-right">';
echo '<a id="add-event" class="btn btn-primary dropdown-toggle add-event" data-toggle="modal"  href="#">Add Calander Event</a>';
echo '</div>';

echo '<div class="btn-group pull-right">';
echo '<a id="select-event" class="btn btn-primary" data-toggle="modal"  href="#">Edit Calander Event</a>';
echo '</div>';
echo '</div>';
?>

<!--start calendar-->
<section id="calender">
    <div class="container">
        <div class="row">
            <div class="col-md-8 extend">
                <div class="dzscalendar skin-responsive-galileo mode-normal tooltip_transition-tooltipDef under-240" style="max-width: 960px; margin: 25px auto;">
                    <div class="dzscalendar skin-responsive-galileo auto-init " style="" data-options="{
            design_month_covers : ['../images/calendar/jan.jpg','../images/calendar/feb.jpg','../images/calendar/mar.jpg','../images/calendar/apr.jpg','../images/calendar/may.jpg','../images/calendar/jun.jpg','../images/calendar/jul.jpg','../images/calendar/aug.jpg','../images/calendar/sep.jpg','../images/calendar/oct.jpg','../images/calendar/nov.jpg','../images/calendar/dec.jpg']
            ,start_weekday: 'Monday'
            ,header_weekdayStyle: 'responsivefull'
        }">
                        <div class="events">


                            <div class="event-tobe" data-date="3-14-2014"></div>

                            <?php
                            if ($pID == 0) {


                                $events = CalendarEvents::getAllEvents($userEmail);

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


                                };

                            } else {

                                $events = CalendarEvents::getPropertyEvents($pID);

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

                                };
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!--end calendar-->





<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>




<script>

    $(document).ready(function () {

        $("#propertyHolder").hide();
        $(".show-properties").click(function () {
            $("#propertyHolder").toggle();
        });

        $('.navList li ').on('click', function () {
            var arraypos = $(this).attr('id');
            jQuery.ajax({
                url: '/wallfly-mvc/public/dashboard/selectedProperty',
                type: "POST",
                data: {
                    selected: arraypos
                },
                success: function (result) {
                    $("#propertyHolder").hide();
                    window.location.reload();
                },
                error: function (result) {
                    alert('Exeption:' + exception);
                }
            });
        });

        $('#box').keyup(function () {
            var valThis = this.value.toLowerCase(),
                lenght = this.value.length;

            $('.navList>li>a').each(function () {
                var text = $(this).text(),
                    textL = text.toLowerCase(),
                    htmlR = '<b>' + text.substr(0, lenght) + '</b>' + text.substr(lenght);
                (textL.indexOf(valThis) == 0) ? $(this).html(htmlR).show() : $(this).hide();
            });

        });

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



    });

</script>


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

<script>
    jQuery(function($) {
        $("#timepicker").timepicki();
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



    });
</script>
<script>



</script>

<?php
require_once '../app/views/templates/interfaceEnd.php';
?>




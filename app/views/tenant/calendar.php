<?php
require_once '../app/views/templates/interfaceStart.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="page_heading">
            <p>Calendar</p>
            <hr />
        </div>
    </div>
</div>
</div>
</div>

<!--Content here-->
<div class="row bottom-section">
    <div class="col-md-12">
<!--start calendar-->
<div id="calender">
    <div class="dzscalendar skin-responsive-galileo mode-normal tooltip_transition-tooltipDef">
        <div class="dzscalendar skin-responsive-galileo auto-init " style="" data-options="{
            design_month_covers : ['../images/calendar/jan.jpg','../images/calendar/feb.jpg','../images/calendar/mar.jpg','../images/calendar/apr.jpg','../images/calendar/may.jpg','../images/calendar/jun.jpg','../images/calendar/jul.jpg','../images/calendar/aug.jpg','../images/calendar/sep.jpg','../images/calendar/oct.jpg','../images/calendar/nov.jpg','../images/calendar/dec.jpg']
            ,start_weekday: 'Monday'
            ,header_weekdayStyle: 'responsivefull'
        }">
            <div class="events">
                <div class="event-tobe" data-date="3-14-2014"></div>

                <?php
                //$count = 0;
                if ($pID == 0) {


                    $events = CalendarEvents::getAllEvents($userEmail);

                    foreach ($events as $event) {

                        $interval = $event->eventInterval;
                        $explodeDate = explode("/", $event->eventDate);
                        echo ' <div class="event-tobe" data-tag="blue" data-repeat=' . $interval . ' data-day="' . $explodeDate[0] . '" data-month="' . $explodeDate[1] . '"
                            data-year="' . $explodeDate[2] . '" data-type="link" data-href="#">
                            <span class="tooltip-heading">' . $event->eventName . '</span>';
                        if ($event->eventTime != "") {
                            echo '<span class="label eventlabel">Time:</span>' . $event->eventTime . '<br/>';
                        }
                        echo '<br/>' . $event->description . '</div>';
//                                    $count++;


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
                            echo '<div class="event_time">Time<hr class="repair_hr"><div class="event_time_p"><p>' . $event->eventTime . '</p></div></div>';
                        }
                        echo '<div class="event_description">Description<hr class="repair_hr"><div class="event_description_p"><p>' . $event->description . '</p></div></div></div>';
                        //$count++;

                    };
                }
                ?>
                </div>
            </div>
        </div>
        <div style="height:  <?php //echo ($count * 80)?>px"></div>
    </div>
</div>
<!--end calendar-->

</div>
</div>
</div>


<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

<script type="text/javascript">
    document.title = 'Calendar - WallFly';
</script>


<?php
require_once '../app/views/templates/interfaceEnd.php';
?>
<?php
/**
 * Created by PhpStorm.
 * User: jimmykovacevic
 * Date: 8/10/2015
 * Time: 11:48 AM
 */
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

            for($i=0;$i<count($properties);$i++){

                echo '<li id="'.$i.'"><a>' . $properties[$i]->address . '</a></li>';
            }
            ?>
        </ul>
    </div>
</div>
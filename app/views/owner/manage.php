<?php
require_once '../app/views/templates/interfaceStart.php';
?>

<h1>My Properties</h1>
<ul>
	<?php foreach ($data['properties'] as $property): ?>
		<li><a href='<?=WEBDIR?>/propertyowner/manageDetails/<?=$property->id?>'><?=$property->address?></a></li>
	<?php endforeach ?>

	<br>
	<a href="<?=WEBDIR . '/propertyowner/addproperty'?>" class="btn btn-success">Add Property</a>
</ul>



<?php
require_once '../app/views/templates/interfaceEnd.php';
?>


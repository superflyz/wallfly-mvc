<?php require_once '../app/views/templates/interfaceStart.php'; ?>

<?php
	$selected = array_map(function($value) {
		return $value === $_SESSION['selectedProperty']->payment_schedule ? 'selected' : '';
	}, ['WEEKLY', 'FORTNIGHTLY', 'MONTHLY']);
?>

<form action="<?=WEBDIR?>/propertyowner/editproperty" method="post" enctype="multipart/form-data">
	Address: <input type="text" name="address" value="<?=$_SESSION['selectedProperty']->address?>"> <br>
	Rent amount: <input type="text" name="rent_amount" value="<?=$_SESSION['selectedProperty']->rent_amount?>"> <br>
	Payment schedule:
	<select name="payment_schedule">
		<option value="WEEKLY" <?=$selected[0]?>>Weekly</option>
		<option value="FORTNIGHTLY" <?=$selected[1]?>>Fortnightly</option>
		<option value="MONTHLY" <?=$selected[2]?>>Monthly</option>
	</select> <br>

	Change image: <br> <img src="<?=$_SESSION['selectedProperty']->photo?>"><input type="file" name="photo_file"> <br>

	<button type="submit">Save changes</button>
</form>


<?php require_once '../app/views/templates/interfaceEnd.php'; ?>
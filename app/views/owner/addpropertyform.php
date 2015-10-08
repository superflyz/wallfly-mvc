<?php
require_once '../app/views/templates/interfaceStart.php';
?>

<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Add New Property</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="address">Address</label>  
  <div class="col-md-4">
  <input id="address" name="address" type="text" placeholder="1234 Street Name, Suburb STATE 1234" class="form-control input-md" required="">
  <span class="help-block">Your property address</span>  
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="payment_schedule">Payment Schedule</label>
  <div class="col-md-4">
    <select id="payment_schedule" name="payment_schedule" class="form-control">
      <option value="weekly">Weekly</option>
      <option value="fortnightly">Fortnightly</option>
      <option value="monthly">Monthly</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="rent_amount">Rent Amount</label>  
  <div class="col-md-4">
  <input id="rent_amount" name="rent_amount" type="text" placeholder="$$$" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for=""></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-success">Submit</button>
  </div>
</div>

</fieldset>
</form>




<?php
require_once '../app/views/templates/interfaceEnd.php';
?>


<form class="form-horizontal" action="<?=WEBDIR?>/realest/submit" method="post" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend>We need information about your institution!</legend>

<?php if ($error = Flash::get('error_message')): ?>
  <div class="alert alert-danger" role="alert"><?=$error?></div>
<?php endif ?>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name">Name:</label>
  <div class="col-md-6">
  <input id="name" name="name" type="text" placeholder="Company Inc." class="form-control input-md"
    required="" data-validation="required">
  <span class="help-block">The name of your institution/company.</span>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="address">Address:</label>
  <div class="col-md-6">
  <input id="address" name="address" type="text" placeholder="2222 High St, Toowong QLD 4066"
    class="form-control input-md" required="" data-validation="required">
  <span class="help-block">The primary address of your office.</span>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">E-mail:</label>
  <div class="col-md-6">
  <input id="email" name="email" type="email" placeholder="contact@company.com" class="form-control input-md"
    required="" data-validation="email">
  <span class="help-block">The e-mail address of your support team.</span>
  </div>
</div>

<!-- Prepended text-->
<div class="form-group">
  <label class="col-md-4 control-label" for="phone">Phone:</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">+61</span>
      <input id="phone" name="phone" class="form-control" placeholder="444555666"
        type="text" required="" data-validation="required">
    </div>
    <p class="help-block">The contact number of your support team</p>
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Password:</label>
  <div class="col-md-6">
    <input id="password" name="password" type="password" placeholder="" class="form-control input-md"
      required="" data-validation="required">
    <span class="help-block">Choose your password. It should contain at least: a lowercase character, an uppercase character, and a number. It cannot be less than 8 characters.</span>
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="passwordrepeat">Re-enter Password:</label>
  <div class="col-md-6">
    <input id="passwordrepeat" name="passwordrepeat" type="password" placeholder=""
      class="form-control input-md" required="" data-validation="required">
  </div>
</div>

<!-- File Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="photo">Company Logo (Opt.)</label>
  <div class="col-md-4">
    <input id="photo" name="photo" class="input-file" type="file">
  </div>
</div>

<!-- Multiple Checkboxes (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for=""></label>
  <div class="col-md-4">
    <label class="checkbox-inline" for="-0">
      <input type="checkbox" name="" id="-0" value="1">
      You agree to our <a href="#">terms &amp; conditions</a>.
    </label>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submitbtn"></label>
  <div class="col-md-4">
    <button type="submit" id="submitbtn" class="btn btn-success">Register now</button>
  </div>
</div>

</fieldset>
</form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.43/jquery.form-validator.min.js"></script>
<script> $.validate(); </script>

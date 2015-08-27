<?php include '../app/views/templates/header.php'; ?>

<div class="container-fluid3">

  <nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">
          <img alt="Brand" src="...">
        </a>
      </div>
    </div>
  </nav>
    
  <section>
    <div class="row">
        <div id="banner" class="col-md-12 banner">
            <img src="img/view.jpg">
            <div class="text">
            <p>The rental experience that actually works</p>
          </div>
        </div>
    </div>

    <div class="container">
     <div class="row row-centered">
        <div id="loginandsignup" class="col-md-4 col-centered ">

          <form id="login" name="login" method="post" action="login.php">
           
            <input name="username" type="text" id="username" class="form-control" placeholder="Username">
            <input name="password" type="password" id="password" class="form-control " placeholder="Password">
            
            <div id="controlbuttons">
              <input type="submit" name="Submit" value="Login" id="login_btn" class="btn btn-custom custom"> 
              <br>
              <br>
              <button type="button" class="btn btn-custom custom" data-toggle="modal" data-target="#signup" onclick="clearForm()">Sign Up</button>
            </div>
                   
          </form>
        </div>
       </div>
    </div>
  </section>

  <section>
    <hr>
    <div id="sectiondisplay" class="row">
      <div class="col-md-4 icon">
        <img height="100px" src="img/icon1.png">
        <p>here is some text talking about the icon</p>
      </div>
      <div class="col-md-4 icon">
        <img height="100px" src="img/icon2.png">
        <p>here is some text talking about the icon</p>
      </div>
      <div class="col-md-4 icon">
        <img height="100px" src="img/icon3.png">
        <p>here is some text talking about the icon</p>
      </div>
    </div>
  </section>


  <section>
    <hr>
    <div id="sectiondisplay" class="row">
      <div class="col-md-6 icon">
        <img  src="img/logo.jpg">
      </div>
      <div class="col-md-4 icon ">
        <p>
        Franz Eilert, has been in the information technology field for most of his career. He sits on a few boards including the Spatial Information Business Association and is the director for Information Ecosystems.
        He is interested in this project as he sees the need to have some type of communication between all parties of the rental industry
        <br>
        <br>
        Wall Fly is a repository of information where owners, agents and tenants can communicate and share important information.
        Currently in the rental industry, all three parties are losing.
        <br>
        <br>
        The owner of a property has limited visibility of the property and related documents.
        The agent is busy with a lot of properties and needs a streamline process to keep both owners and tenants content with the correct and up to date information.
        The tenant has limited or nonexistent communication with all parties and does not have an easy documented outlet to ask for repairs.
        </p>
      <div>
    </div>
  </section>

  <section>
    <hr>
    <div id="sectiondisplay" class="row">
      <div class="col-md-12 ">
        <p>Footer here</p>
      </div>
    </div>
  </section>


            
            
           
<!-- Modal -->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Wallfly Sign Up</h4>
      </div>
      <div class="modal-body">
        <form id="signup_form" name="signup_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <!-- <label for="username">Username</label> -->
          <input class="form-control" type="text" size="12" name="username" placeholder="Username" value="<?php echo $username ?>" id="usrname"/>
          <span class="error"><?php echo $usernameErr;?></span>
          <br>
          <!-- <label for="password">Password</label> -->
          <input class="form-control" type="password" size="12" name="password" placeholder="Password" value="<?php echo $password ?>" id="psswrd"/>
          <span class="error"><?php echo $passwordErr;?></span>
          <br>
          <!-- <label for="first_name">First Name</label> -->
          <input class="form-control" type='text' name='first_name' maxlength='50' size='30' placeholder='First Name' value="<?php echo $first_name ?>" id="fname"/>
          <span class="error"><?php echo $first_nameErr;?></span>
          <br>
          <!-- <label for="last_name">Last Name</label> -->
          <input class="form-control" type='text' name='last_name' maxlength='50' size='30' placeholder='Last Name' value="<?php echo $last_name ?>" id="lname"/>
          <span class="error"><?php echo $last_nameErr;?></span>
          <br>
          <!-- <label for="email">Email Address</label> -->
          <input class="form-control" type="text" name="email" maxlength="50" size="12" placeholder='Email Address' value="<?php echo $email ?>" id="email"/>
          <span class="error"><?php echo $emailErr;?></span>
          <br>
          <!-- <label for="usertype">User Type</label> -->
          <select class="form-control" name="usertype" placeholder='Please Select'>
              <option value="">Please Select</option>
              <option value="AGENT">Agent</option>
              <option value="OWNER">Owner</option>
              <option value="TENANT">Tenant</option>
          </select>
          <span class="error"><?php echo $usertypeErr;?></span>
          <br>
    
    
          <input class="btn btn-success" type="submit" name="btnAdd" value="Add"> &nbsp;&nbsp;
          <input class="btn btn-warning" type="button" class="button" value="Reset" onclick="clearForm()"> &nbsp;&nbsp;
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
        

   
    




   
           
       
</div>

<?php include '../app/views/templates/footer.php'; ?>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<body id="page-top" class="index home_body">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <a class="navbar-toggle toggled" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                 <i class="fa fa-bars visible-xs"></i>
                </a>
                <a class="navbar-brand page-scroll" href="#page-top"><img id="logo" src="images/wallfly_logo.svg" alt="WallFly logo" title="Go Top"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#features">Features</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about-i-e">About I. E.</a>
                    </li>
                    <li class="re_link">
                        <a href="" data-toggle="modal" data-target=".re-sign-up-modal">Real Estate Sign Up</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro">
                <div class="row">
                    <div class="col-md-12 intro-text-1">
                        Welcome To WallFly!
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 intro-text-2">
                        The rental experience that works
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn login-btn" data-toggle="modal" data-target=".login-modal-sm">Login</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 p-text">
                    <p>Own a property? <a href="#" class="s-link" data-toggle="modal" data-target=".sign-up-modal-sm">Sign Up</a></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 p-text">
                    <a href="#features" class="btn-scroll-down page-scroll" title="Scroll down">  <span><i class="fa fa-angle-double-down"></i></span>

                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section id="features">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-sm-6">
                    <div class="feature">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                            <i class="fa fa-home fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="feature-heading">Property Management</h4>
                        <p class="text-muted">Manage your property by setting tenants, documents and inspection reports</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                            <i class="fa fa-comments-o fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="feature-heading">Communicate</h4>
                        <p class="text-muted">Conveniently create and view calender events or send chat messages</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                            <i class="fa fa-credit-card fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="feature-heading">Payments</h4>
                        <p class="text-muted">Make payments quickly and safely through the  payment system powered by PayPal</p>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="feature">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                            <i class="fa fa-wrench fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="feature-heading">Repairs</h4>
                        <p class="text-muted">Approve or Deny repair requests after viewing images, severity and description </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Information Ecosystems Section -->
    <section id="about-i-e">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-6">
                    <img src="images/information_ecosystems.png" alt="Information Ecosystems Logo" />
                </div>
                <div class="col-md-6">
                    <p>Franz Eilert, has been in the information technology field for most of his career. He sits on a few boards including the Spatial Information Business Association and is the director for Information Ecosystems. He is interested in this project as he sees the need to have some type of communication between all parties of the rental industry.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-right">
            <p>Copyright &copy; <span class="diff-color">WallFly 2015</span></p>
        </div>
    </footer>


    <!-- Login & sign up forms -->
    <div class="modal modal-vcenter fade sign-up-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-md">
               <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <p class="modal-title">Owner sign up</p>
            </div>

                <div class="modal-body">
                    <form id="signup_form" name="signup_form" method="post" action="propertyowner/submit">
                            <p class="re_p">
                         
                          <a href="" data-toggle="modal" data-target=".re-sign-up-modal" data-dismiss="modal" aria-hidden="true">Click here for real estate sign-up!</a>
                     
                        </p>
                     <div class="row">
                        <div class="col-md-6 col-sm-6">
                         <div class="su_field_fn">
                             <label for="first_name">First Name<span class="req"> *</span></label>
                            <input class="form-control" type='text' name='first_name' maxlength='50' size='30'  value="" id="fname" />
                            <span class="error"></span>
                          </div>
                                </div>
                        
                           <div class="col-md-6 col-sm-6">
                         <div class="su_field_ln">
                            <label for="last_name">Last Name<span class="req"> *</span></label>
                            <input class="form-control" type='text' name='last_name' maxlength='50' size='30'  value="" id="lname" />
                            <span class="error"></span>
                          </div>
                            </div>
                            </div>
                        
                          <div class="row">
                        <div class="col-md-6 col-sm-6">
                         <div class="su_field_em">
                             <label for="email">Email Address<span class="req"> *</span></label>
                            <input class="form-control" type="email" name="email" maxlength="50" size="12" value="" id="email" />
                            <span class="error"></span>
                              </div>
                                </div>
                        
                           <div class="col-md-6 col-sm-6">
                         <div class="su_field_ph">
                             <label for="phone">Phone<span class="req"> *</span></label>
                             <input type="tel" class="form-control" size="12" name="phone">
                             
                            <span class="error"></span>
                           </div>
                            </div>
                            </div>
                        
                          <div class="row">
                        <div class="col-md-6 col-sm-6">
                         <div class="su_field_pass">
                             <label for="password">Password<span class="req"> *</span></label>
                            <input class="form-control" type="password" size="12" name="password" value="" id="password" />
                            <span class="error"></span>
                              </div>
                                </div>
                        
                           <div class="col-md-6 col-sm-6">
                         <div class="su_field_repass">
                             <label for="passwordrepeat">Re-enter Password<span class="req"> *</span></label>
                            <input class="form-control" type="password" size="12" name="password_repeat" value="" id="password_repeat" />
                            <span class="error"></span>
                           </div>
                            </div>
                            </div>

                           <div class="row">
                        <div class="col-md-6 col-sm-6">
                         <div class="su_field_add1">
                             <label for="address">Address Line 1<span class="req"> *</span></label>
                             <input type="text" class="form-control" size="12" name="address">
                            <span class="error"></span>
                              </div>
                                </div>
                        
                           <div class="col-md-6 col-sm-6">
                         <div class="su_field_add2">
                             <label for="address2">Address Line 2<span class="opt"> (Optional)</label>
                             <input type="text" class="form-control" size="12" name="address2">
                           </div>
                            </div>
                            </div>
    

                        <p class="su_p">
                          <span class="req">*required</span>
                     
                        </p>

                        

                        <span class="error"></span>
                        <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <p class="su_p pull-left">
                          By clicking "sign up" you agree to our <a href="#">Terms &amp; Conditions</a>.
                        </p>
                            <div class="su_btnz">
                                <button type="submit" class="btn btn-sign-up pull-right">Sign Up</button>
                            </div>
                             </div>
                        </form>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>

<div class="modal modal-vcenter fade login-modal-sm" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
               <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <p class="modal-title">Login</p>
            </div>

                <div class="modal-body">
                    <form id="login" name="login" method="post" action="home/login">
                         <?php if ($error = Flash::get('error_message')): ?>
            <div class="alert alert-default" role="alert" style="color:rgb(159, 221, 94)"><?=$error?>!!!</div>
          <?php endif ?>
          <?php if ($success = Flash::get('success_message')): ?>
            <div class="alert alert-default" role="alert" style="color:rgb(159, 221, 94)">
              <?=$success?><a href="#" class="alert-link" data-toggle="modal" data-target="#loginmodal">log in!</a>
            </div>
          <?php endif ?>
                        <div class="l_field_ut">
                            <label for="usertype">Are you a/an...</label>
                            <select class="form-control select-style" name="usertype" id="usertypes">
                                <option disabled selected hidden>Please select...</option>
                                
                                <option value="tenant">Tenant</option>
                                <option value="owner">Owner</option>
                                <option value="agent">Agent</option>
                                <option value="real_estate">Real Estate</option>
                            </select>
                        </div>
                        
                        <div class="l_field_em" id="differentinput">
                          <div id="email-login">
                            <label for="email">Email</label>
                            <input name="email" type="email" id="email" class="form-control">
                          </div>
                            
                          <div id="realestate-login">
                            <label for="realestatelist">Select your institution</label>
                            <select class="form-control select-style" name="name" id="realestatelist">

                            </select>
                          </div>
                        </div>
                        <div class="l_field_pass">
                            <label for="password">Password</label>
                            <input name="password" type="password" id="password" class="form-control">
                        </div>
                        <p class="l_p pull-right">
                         <a href=""> Forgot your password?</a>
                        </p>
                        <span class="error"></span>
                        
                        
                        <div class="l_btnz">
                            <button type="submit" name="Submit" value="Login" id="login_btn" class="btn btn-login">Login</button>
                        </div>
                         
                    </form>
                    </div>
                </div>
            </div>
        </div>
        
            <!-- Realestate sign up form -->
    <div class="modal modal-vcenter fade re-sign-up-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg">
               <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <p class="modal-title">Real Estate sign up</p>
            </div>

                <div class="modal-body">
                   <form class="form-horizontal" action="<?=WEBDIR?>/realest/submit" method="post" enctype="multipart/form-data">
<?php if ($error = Flash::get('error_message')): ?>
  <div class="alert alert-danger" role="alert"><?=$error?></div>
<?php endif ?>
<!--
                        <p>
                          <a href="<?=WEBDIR?>/realest/signup">Click here for real estate sign-up!</a>
                        </p>
-->                     <div class="row">
                        <div class="col-md-12 col-sm-12">
                         <div class="su_field_fn">
                             <label for="name">Name<span class="req"> *</span></label>
                              <input id="name" name="name" type="text"  class="form-control input-md"
    required="" data-validation="required">
                       
                           
                          </div>
                        </div>
                       <div class="col-md-12 col-sm-12">
                         <div class="su_field_fn">
                             <label for="address">Address<span class="req"> *</span></label>
                                <input id="address" name="address" type="text"
    class="form-control input-md" required="" data-validation="required">
 
                           
                          </div>
                        </div>
                        
                        </div>
                        
                          <div class="row">
                        <div class="col-md-6 col-sm-6">
                         <div class="su_field_em">
                             <label for="email">Email Address<span class="req"> *</span></label>
                             <input id="email" name="email" type="email" class="form-control input-md"
    required="" data-validation="email">
                           
                              </div>
                                </div>
                        
                           <div class="col-md-6 col-sm-6">
                         <div class="su_field_ph">
                             <label for="phone">Phone<span class="req"> *</span></label>
                            <input id="phone" name="phone" class="form-control"
        type="text" required="" data-validation="required">
                             
                     
                           </div>
                            </div>
                            </div>
                        
                          <div class="row">
                        <div class="col-md-6 col-sm-6">
                         <div class="su_field_pass">
                             <label for="password">Password<span class="req"> *</span></label>
                             <input id="password" name="password" type="password" class="form-control input-md"
      required="" data-validation="required">

                              </div>
                                </div>
                        
                           <div class="col-md-6 col-sm-6">
                         <div class="su_field_repass">
                             <label for="passwordrepeat">Re-enter Password<span class="req"> *</span></label>
                              <input id="passwordrepeat" name="passwordrepeat" type="password"
      class="form-control input-md" required="" data-validation="required">
                           </div>
                            </div>
                            </div>

                           <div class="row">
                    
                           <div class="col-md-12 col-sm-12">
                         <div class="su_field_ulogo">
                             <label for="photo">Company Logo<span class="opt"> (Optional)</label>
                             <div class="su_field_img_file"> 
                        <div class="fileinput fileinput-new" data-provides="fileinput">
    <span class="btn btn-choose btn-file"><span>Choose file</span><input  type="file" name="photo_file"
                      /></span>
    <span class="fileinput-filename"><span class="fileinput-new">No file chosen</span></span>
                            
                      
</div>                      </div>
                           </div>
                            </div>
                            </div>
    

                        <p class="su_p">
                          <span class="req">*required</span>
                        </p>

                        

                        <span class="error"></span>
                        <div class="row">
                        <div class="col-md-12 col-sm-12">
                        <p class="su_p pull-left">
                          By clicking "register" you agree to our <a href="#">Terms &amp; Conditions</a>.
                        </p>
                            <div class="su_btnz">
                                <button type="submit" id="submitbtn" class="btn btn-sign-up pull-right">Register</button>
                            </div>
                             </div>
                        </form>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
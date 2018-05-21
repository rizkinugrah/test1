<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html class="login-pf" lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="<?php echo assetsUrl().'css/patternfly.min.css'; ?>" >
<link rel="stylesheet" type="text/css" href="<?php echo assetsUrl().'css/patternfly-additions.min.css'; ?>">
</head>
<body>

<div class="login-pf-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
        <header class="login-pf-page-header">
          <img class="login-pf-brand" src="<?php echo assetsUrl().'img/Logo_Horizontal_Reversed.svg'; ?>" alt=" logo" />
          <p>
          Project Document
          </p>
        </header>
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
            <div class="card-pf">
              <header class="login-pf-header">
              <h1>Log In to Your Account</h1>
              </header>

              <?php echo form_open(base_url(''), array( 'id' => 'loginForm', 'class' => 'login' ));?>
                <div id="errorLocation">
                </div>

                <div class="form-group">
                  <label class="sr-only" for="exampleInputEmail1">Username / Email address</label>
                  <input type="email" name="username" class="form-control input-lg" id="username" placeholder="Email address">
                </div>
                <div class="form-group">
                  <label class="sr-only"  for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control input-lg" id="password" placeholder="Password">
                </div>
                <button type="button" id="submit" class="btn btn-primary btn-block btn-lg" onclick="formLogin()">Log In</button>
              </form>
            </div><!-- card -->
          </div><!-- col -->
        </div><!-- row -->
      </div><!-- col -->
    </div><!-- login-pf-page -->
  </div><!--row-->
</div><!--container-->

<script src="<?php echo assetsUrl().'vendors/jquery/jquery.min.js'; ?> "></script>
<script src="<?php echo assetsUrl().'vendors/bootstrap/bootstrap.min.js'; ?> "></script>
<script src="<?php echo assetsUrl().'js/patternfly.min.js'; ?>"></script>

<script>
var errorLocation = document.getElementById("errorLocation");

var title = "<?php echo $title; ?>";
window.document.title = title;

function formLogin() {

  var username = $('#username').val();
  var password = $('#password').val();
  var url = "<?php echo base_url().'api/rest/authToken/'; ?>";
  var successUrl = "<?php echo base_url().'dashboard/'; ?>";
  var csrf_value = '<?php echo $this->security->get_csrf_hash(); ?>';

  $.ajax({
      url: url,
      data: {'username': username, 'password': password,  'csrf_test_name': csrf_value},
      method: 'post',
      success: function(response) {
        localStorage.setItem('apps', JSON.stringify(response));
        window.location = successUrl;
      },
      error: function (xhr, ajaxOptions, thrownError) {
        var errObj = JSON.parse(xhr.responseText);

        errorLocation.innerHTML = "<div class='alert alert-danger'><span class='pficon pficon-error-circle-o'></span> <span id='errorMessage'>Login failed</span>.</div>";
        var errorMessage = document.getElementById("errorMessage");
        errorMessage.innerHTML = errObj.message;

      }
  });

}
</script>
</body>
</html>

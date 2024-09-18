<?php include 'core/int.php'; protect_page();
$get = mysqli_query($con, "select * from customer where customer_id = '".$_SESSION['customer_id']."'");
$show = mysqli_fetch_array($get);
if($show['two_fa_flag']!='1'){
  header('Location: dashboard');
  exit(); 
}
if(isset($_SESSION['two_fa_verify_flag']) && $_SESSION['two_fa_verify_flag']!=''){
  header('Location: dashboard');exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>CBM</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="dist/css/font-awesome.min.css">
<link rel="stylesheet" href="dist/css/ionicons.min.css">
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<link rel="stylesheet" type="text/css" href="formvalidation/vendor/formvalidation/css/formValidation.min.css">
<link rel="stylesheet" href="dist/css/skins/skin-green.min.css">
<link rel="stylesheet" href="plugins/sweetalert/sweetalert2.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="http://rockindia.in/sm-admin/"><b>CBM</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" id="vielogin">
    <p class="login-box-msg">2FA QR Code</p>

    <form action="ajax/twofa/two_fa_verify.php" method="post" id="login">
    <div class="form-group">
      <p class="text-center" id="err"></p>
    </div>
    <?php if($show['two_fa_verify']!='1'){?>
      <div class="form-group has-feedback">
        
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo $show['two_fa_img'];?>"><br>
        <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>KEY: <?php echo $show['two_fa_key'];?></strong> -->
      </div>
    <?php }?>
      <div class="form-group has-feedback align-center">
        <input type="text" class="form-control" name="two_fa_code" placeholder="Enter 2FA Code">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        
        <div class="col-xs-12">
          
          <button type="submit" class="btn btn-primary btn-block btn-flat">Verify</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br />
    

  </div>

 

  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="formvalidation/vendor/formvalidation/js/formValidation.min.js"></script>
<script src="formvalidation/vendor/formvalidation/js/framework/bootstrap.min.js"></script>
<script src="plugins/sweetalert/sweetalert2.min.js"></script>
<script src="dist/js/shortcut.js"></script>

<script>
      $(document).ready(function() {
        $('#login').formValidation({
          framework: 'bootstrap',
          icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
          },
          fields: {
            two_fa_code: {
              validators: {
                notEmpty: {
                  message: 'The 2FA code is required'
                },
              }
            }
            
          }
        }).on('success.form.fv', function(e) {
          // Prevent form submission
          e.preventDefault();
    
          var $form = $(e.target),
            fv    = $form.data('formValidation');
    
          // Use Ajax to submit form data
          $.ajax({
            url: $form.attr('action'),
            type: 'POST',
            data: $form.serialize(),
            success: function(result) {
              
              if(result.trim() == 'SUCCESS') {
                $('#vielogin').html('<div align="center" style="padding-top:50px;padding-bottom:50px;"><img src="default.gif"></div>');
                setTimeout(function () {
                  window.location.href = "dashboard";
                   }, 1000);
              } else {
                swal({ 
                  type: "error",
                  title: "error",
                  text: 'Invalid 2fa code',
                  //timer: 800,
                  showConfirmButton: true
                });
              }
            }
          });
        });
      });
      </script>
</body>
</html>

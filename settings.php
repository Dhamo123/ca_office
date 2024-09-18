<?php include 'core/int.php'; protect_page(); 

$get = mysqli_query($con, "select * from customer where customer_id = '".$_SESSION['customer_id']."'");
$show = mysqli_fetch_array($get);
//echo $_SESSION['two_fa_verify_flag'];
if($show['two_fa_flag']=='1' && !isset($_SESSION['two_fa_verify_flag'])){
  header('Location: two_fa');exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CBM</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
   <link rel="stylesheet" href="public/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="public/plugins/jqvmap/jqvmap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/sweetalert/sweetalert2.min.css">
  <link rel="stylesheet" href="public/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="public/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="public/plugins/summernote/summernote-bs4.min.css">
  <link rel="shortcut icon" href="public/favicon-32x32.png">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="public/safari-pinned-tab.svg" alt="CBM" height="60" width="60">
  </div>

  <!-- Navbar -->
  
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link ">
      
      <span class="brand-text font-weight-light">CBM</span>
    </a>

    <!-- Sidebar -->
    
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
      
<?php include 'include/sidebar.php'; ?>
      
          
    
<style >
  .toolbar {
    float:left;
}
.help-block {
  color: red;
}
</style>
<div class="content-header">

      <!-- /.container-fluid -->
      <div class="row ">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Profile Setting</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php 
          $get = mysqli_query($con, "select * from customer where customer_id = '".$_SESSION['customer_id']."'");
          $show = mysqli_fetch_array($get); ?>
              <form role="form" class="form-horizontal"  id="settings_form" action="ajax/Update/Update-Settings.php"  method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                   
                            <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                                <label for="Username">Username</label>
                                    <input type="text" name="Username" value="<?php echo $show['Username']; ?>" class="form-control" placeholder="Username" />
                                     <input type="hidden" name="id" value="<?php echo $show['customer_id']; ?>"  />
                              </div>
                              
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                   
                            
                              <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                                <label for="email">Email</label>
                                    <input type="email" name="email" value="<?php echo $show['email']; ?>" class="form-control" placeholder="Email" />
                              </div>
                              
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                   
                            
                              <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                                <label for="two_fa_flag">2FA</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <input type="checkbox" name="two_fa_flag" value="<?php echo $show['two_fa_flag']; ?>" id="two_fa_flag" <?php echo ($show['two_fa_flag']=='1')?'checked':''; ?> class="form-check-input"  />
                                        <img id="two_faimg" src="<?php echo $show['two_fa_img']; ?>">
                              </div>
                              
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary pull-right btn-flat">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            
            <!-- /.card -->

          </div>

          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      
      
    </section>

   
    
    
    
    <script src="public/vendor/jquery/dist/jquery.min.js"></script>
  <script  src="public/vendor/validation/jquery.validate.min.js"></script>
  
     <script src="public/vendor/validation/profile.js"></script>

    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include 'include/footer.php'; ?>
<!-- jQuery -->
<?php include 'include/js.php'; ?>

</body>

<script>
$(document).ready(function() {

    /*shortcut.add("Ctrl+S",function() {
      $('#settings_form button').trigger('click');
    });*/
    $("#two_fa_flag").on("change",function(){
       // alert($(this).is(":checked"));
        //if($(this).is(":checked")){
            $.ajax({
                url: 'ajax/twofa/twofa.php',
                type: 'POST',
                data: {"two_fa_flag":$(this).is(":checked"),"customer_id":"<?php echo $_SESSION['customer_id'];?>"},
                beforeSend: function() {
                  $('#settings_form button').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(result) {
                    result = JSON.parse(result);
                  $('#settings_form button').html('Update');
                  console.log(result.two_fa_img)
                  $("#two_faimg").attr("src",result.two_fa_img);
                  swal('Success', '2FA Updated Successfully !','success');
                  /*setTimeout(function() {
                    location.reload();
                  },1000);*/
                }
            });
        //}
    })
    $('#settings_form')
        .formValidation({
            framework: 'bootstrap',
             excluded: [':disabled'],
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                Username: {
                    validators: {
                        notEmpty: {
                            message: 'Username is required'
                        }
                    }
                },
                 email: {
                    validators: {
                        notEmpty: {
                            message: 'Email is required'
                        }
                    }
                }
            },
            
        })
        .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form = $(e.target),
                fv    = $form.data('formValidation');

            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                beforeSend: function() {
                  $('#settings_form button').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(result) {
                  $('#settings_form button').html('Update');
                  swal('Success', 'Settings Successfully Updated !','success');
                  setTimeout(function() {
                    location.reload();
                  },1000);
                },
                error: function(err){
                 console.log(err);
                 console.log(err.responseText);
                 swal({ 
                  type: "error",
                  title: "error",
                  text: err.responseText,
                  //timer: 800,
                  showConfirmButton: true
                });
                 $('#settings_form button').html('Update');
                 $('#settings_form button').attr('disabled',false);
                 $('#settings_form button').removeClass('disabled');
                 
                }
            });
          });

});
</script>
</html>

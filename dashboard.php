<?php include 'core/int.php'; protect_page();
$get = mysqli_query($con, "select * from customer where customer_id = '".$_SESSION['customer_id']."'");
$show = mysqli_fetch_array($get);
//echo $_SESSION['two_fa_verify_flag'];
if($show['two_fa_flag']=='1' && !isset($_SESSION['two_fa_verify_flag'])){
  header('Location: two_fa');exit();
}

//echo '<pre>';print_r($country_res);exit;
$getcu = mysqli_query($con, "select customer_id from customer");
$user= mysqli_num_rows($getcu);

$getcu = mysqli_query($con, "select id from inward");
$inward= mysqli_num_rows($getcu);
mysqli_close($con);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Inward </title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
  <link rel="stylesheet" href="plugins/datatables/extensions/KeyTable/css/keyTable.bootstrap.min.css">
<link rel="stylesheet" href="plugins/datatables/extensions/Select/css/select.bootstrap.min.css">
  <link rel="stylesheet" href="public/plugins/jqvmap/jqvmap.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Theme style -->

  <link rel="stylesheet" href="plugins/sweetalert/sweetalert2.min.css">
<link rel="stylesheet" href="dist/css/jquery-ui.min.css">

  <link rel="stylesheet" href="public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <link rel="stylesheet" href="public/dist/css/adminlte.min.css">

  <!-- overlayScrollbars -->
  <!-- <link rel="stylesheet" href="public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
  <!-- Daterange picker -->
  <link rel="stylesheet" href="public/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="public/plugins/summernote/summernote-bs4.min.css">
  <link rel="shortcut icon" href="public/favicon-32x32.png">
</head>
<style type="text/css">
.table tr td:nth-child(1) { text-align: center; }
.table tr td:nth-child(6) { text-align: center; }
.selected { background-color: red; }
table.dataTable th.focus,
table.dataTable td.focus {
  outline: none;
}
.help-block {
  color: red;
}
</style>
<body class="skin-green sidebar-mini">
<div class="wrapper">

<?php include 'include/sidebar.php'; ?>
<?php //include 'include/menu.php'; ?>


<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
        
        </div>
      </div>
    </div>
  </section>
   <section class="content">
    <div class="container-fluid">
      <div class="row">
        <?php if($_SESSION['role']=='superadmin'){?>
    <div class="col-lg-3 col-6">

        <div class="small-box bg-info">
            <div class="inner">
              
                <h3><?php
                
                echo $user;
              ?></h3>
                <p>User</p>
            </div>
            <div class="icon">
                <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo $base_url; ?>/manage-user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
  <?php }?>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php
                
                echo $inward;
              ?></h3>
                <p>Inward</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo $base_url; ?>/inward" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    

</div>
    </div>
   </section>
</div>
<!--- Add Customer Model -->

<!--- End Update Customer Model -->
<!--- View Customer Details Model -->
<!--- End View Customer Details Model -->
<!--- Help Model -->
<!--- End Help Model --> 
<?php include 'include/footer.php'; ?>
 </div>
<?php include 'include/js.php'; ?>

<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<?php include 'include/inward_js.php'; ?>

</body>
</html>

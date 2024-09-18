<?php include 'core/int.php'; protect_page();
$get = mysqli_query($con, "select * from customer where customer_id = '".$_SESSION['customer_id']."'");
$show = mysqli_fetch_array($get);
//echo $_SESSION['two_fa_verify_flag'];
if($show['two_fa_flag']=='1' && !isset($_SESSION['two_fa_verify_flag'])){
  header('Location: two_fa');exit();
}
if($_SESSION['role']!='superadmin'){
 header('Location: dashboard');exit();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Manage User </title>
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
    .table tr td:nth-child(1) {
      text-align: center;
    }

    .table tr td:nth-child(6) {
      text-align: center;
    }

    .selected {
      background-color: red;
    }

    table.dataTable th.focus,
    table.dataTable td.focus {
      outline: none;
    }

    .help-block {
      color: red;
    }
  </style>
  <body class="skin-green sidebar-mini">
    <div class="wrapper"> <?php include 'include/sidebar.php'; ?> <?php //include 'include/menu.php'; ?> <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">User Master
                    <!-- - <small><a style="cursor: pointer;" data-toggle="modal" data-target="#help_modal">Keyboard Shortcuts</small></a> -->
                  </h3>
                </div>

                <div class="box-body">
                  
                    <div class="row" style="margin-top:10px;margin-bottom: 10px; background-color: #dde4e7; height: 60px;">
                    <?php if($_SESSION['permission_add']=='Yes'){?>
                    <div style="margin-left: 10px;">
                      <button type="button" class="btn btn-primary" id="add" style="margin-top:10px;margin-bottom:10px"> ADD </button>
                    </div>
                  <?php }?>
                  <?php if($_SESSION['permission_edit']=='Yes'){?>
                    <div style="margin-left: 10px;">
                      <button type="button" class="btn btn-primary" id="edit" style="margin-top:10px;margin-bottom:10px"> EDIT </button>
                    </div>
                    <?php }?>
                    <?php if($_SESSION['permission_delete']=='Yes'){?>
                    <div style="margin-left: 10px;">
                      <button type="button" class="btn btn-primary" id="delete" style="margin-top:10px;margin-bottom:10px"> DELETE </button>
                    </div>
                  <?php }?>
                  </div>
                  
                  
                  <table class="table table-bordered table-striped" id="table">
                    <thead>
                      <tr>
                        <th class="text-center">ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Code#</th>
                       
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <!--- Add Customer Model -->
      <div class="modal fade" id="add_customer_modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-center" id="add_customer_modal">Add User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="ajax/Add/Add-Customer.php" method="post" id="add_customer_form" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label class="control-label col-md-2">Username</label>
                  <div class="col-md-12">
                    <input type="text" name="Username" class="form-control" placeholder="Enter Username">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Email</label>
                  <div class="col-md-12">
                    <input type="email" name="email" class="form-control" placeholder="Enter Email Address">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-4">Mobile Number</label>
                  <div class="col-md-12">
                    <input type="number" name="telephone" class="form-control" placeholder="telephone">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Code#</label>
                  <div class="col-md-12">
                    <input type="text" name="code" class="form-control" placeholder="code">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Password</label>
                  <div class="col-md-12">
                    <input type="password" name="password" maxlength="10" minlength="6" placeholder="Enter password" class="form-control">
                  </div>
                </div>
                <div class="row">   
                  <label class="col-md-12 control-label" for="checkboxes">Permission</label>
                  </div>
                  <div class="row">
                  <div class="form-group">
                  <label class="col-md-3 checkbox-inline" for="checkboxes-0">
                    <input type="checkbox" name="permission_add" id="checkboxes-0"   value="Yes">
                    Add
                  </label>
                  <label class="col-md-3 checkbox-inline" for="checkboxes-1">
                    <input type="checkbox" name="permission_edit"   id="checkboxes-1"  value="Yes">
                    Edit
                  </label>
                  <label class="col-md-3 checkbox-inline" for="checkboxes-2">
                    <input type="checkbox" name="permission_delete" id="checkboxes-3"  value="Yes">
                    Delete
                  </label>

                  </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat" id="addsave">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--- End Add Customer Model -->
      <!--- Update Customer Model -->
      <div class="modal fade" id="update_customer_modal" tabindex="-1" role="dialog" aria-labelledby="update_customer_modal">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-center" id="">Update User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="ajax/Update/Update-Customer.php" method="post" id="update_customer_form" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-2">Username</label>
                      <div class="">
                        <input type="text" name="Username" class="form-control" placeholder="Enter Username">
                        <input type="hidden" name="id">
                        <input type="hidden" name="umobile">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-1">Email</label>
                      <div class="">
                        <input type="email" name="email" class="form-control" placeholder="Enter Email Address">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-4">Mobile Number</label>
                      <div class="col-md-9">
                        <input type="number" name="telephone" class="form-control" placeholder="Mobile Number">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-2">Code#</label>
                      <div class="col-md-9">
                        <input type="text" name="code" class="form-control" placeholder="code">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-2">Password</label>
                      <div class="col-md-9">
                        <input type="password" name="password" maxlength="10" minlength="6" placeholder="Enter password" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-2">Permission</label>
                      <div class="row">
                  <div class="form-group">
                  <label class="col-md-3 checkbox-inline" for="checkboxes-0e">
                    <input type="checkbox" name="permission_add" id="checkboxes-0e"   value="Yes">
                    Add
                  </label>
                  <label class="col-md-3 checkbox-inline" for="checkboxes-1e">
                    <input type="checkbox" name="permission_edit"   id="checkboxes-1e"  value="Yes">
                    Edit
                  </label>
                  <label class="col-md-3 checkbox-inline" for="checkboxes-2e">
                    <input type="checkbox" name="permission_delete" id="checkboxes-3e"  value="Yes">
                    Delete
                  </label>

                  </div>
                  </div>
                    </div>
                  </div>
                  
                  
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat" id="updatesave">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!--- End Update Customer Model -->
      <!--- View Customer Details Model -->
      <!--- End View Customer Details Model -->
      <!--- Help Model -->
      <!--- End Help Model --> <?php include 'include/footer.php'; ?>
    </div> <?php include 'include/js.php'; ?> <?php include 'include/user_js.php'; ?>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="dist/js/demo.js"></script> -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  </body>
</html>
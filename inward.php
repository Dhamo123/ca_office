<?php include 'core/int.php'; protect_page();
$get = mysqli_query($con, "select * from customer where customer_id = '".$_SESSION['customer_id']."'");
$show = mysqli_fetch_array($get);
//echo $_SESSION['two_fa_verify_flag'];
if($show['two_fa_flag']=='1' && !isset($_SESSION['two_fa_verify_flag'])){
  header('Location: two_fa');exit();
}


$select_returnType = "SELECT * FROM returnType";
$returnType = mysqli_query($con, $select_returnType);

//mysqli_close($con);

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
<script>
    CKEDITOR.replace('editor1', {
      height: 260,
      width: 700,
      removeButtons: 'PasteFromWord'
    });
  </script>
<body class="skin-green sidebar-mini">
<div class="wrapper">

<?php include 'include/sidebar.php'; ?>
<?php //include 'include/menu.php'; ?>


<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Inward
              <!-- - <small><a style="cursor: pointer;" data-toggle="modal" data-target="#help_modal">Keyboard Shortcuts</small></a> -->
            </h3>
            <div class="text-center" style="margin-top: -25px;"></div>
          </div>
          <br>
          <!-- <div class="row">
            <div class="col-md-2">
              <label>Company</label>
              <select name="company_id" id="list_company_id" class="form-control">
                <option value="">All</option> 
				<?php  foreach ($company_res as $key => $value) {?> 
				<option value="<?php echo $value['company_id'];  ?>"> <?php echo $value['name'];  ?> </option> <?php }?>
              </select>
            </div>
            <div class="col-md-2">
              <label>Branch/site</label>
              <select name="branch" id="list_branch_id" class="form-control">
                <option value="">All</option> 
				<?php  foreach ($branch_res as $key => $value) {?> 
				<option value="<?php echo $value['id'];  ?>"> <?php echo $value['name'];  ?> </option> <?php }?>
              </select>
            </div>
          </div> -->
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
              <?php if($_SESSION['permission_add']=='Yes'){?>
              <div style="margin-left: 10px;">
                <button type="button" class="btn btn-primary" id="notes" style="margin-top:10px;margin-bottom:10px"> Note </button>
              </div>
              <?php }?>
            </div>
            <table class="table table-bordered table-striped" id="table">
              <thead>
                <tr>
                  <th class="text-center">ID</th>
                  <th>Name</th>
                  <th>PAN</th>
                  <th>Adhar</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>File No</th>
                  <th>Type</th>
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
<div class="modal fade " id="add_note_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center" id="add_note_modal">Add Note <span id="note_inward"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="ajax/Add/Add-Note.php" name="note" id="note" enctype="multipart/form-data">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              
             
              <div class="row">
                
                <div class="col-md-12">
                  <label for="address1">Note</label>
                  <textarea rows="3"  name="note"  class="form-control"  id="notes_inward"  ></textarea>
                  
                </div>
                <input type="hidden" name="inward_note" id="inward_note">
              </div>
              
              
                
            </div>
            
          </div>
        </div>
        <!-- /.card-body -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="notesave">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--- Add Customer Model -->
<div class="modal fade " id="add_company_modal">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center" id="add_company_modal">Add Inward</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="ajax/Add/Add-inward.php" name="employee" id="employee" enctype="multipart/form-data">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                  <label for="username">Full Name</label>
                  <input class="form-control" type="text" name="username" id="username" placeholder="Name">
                </div>
                <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                  <label for="surname">Email</label>
                  <input class="form-control" type="email" name="email" id="email" placeholder="email">
                </div>
                <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                  <label for="username">Contact No</label>
                  <input class="form-control" type="number" name="mobile" id="mobile" placeholder="Contact No">
                </div>
              </div>
              
              <div class="row">
                <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                  <label for="username">PAN NO</label>
                  <input class="form-control" type="text" name="pan" id="pan" placeholder="PAN NO">
                </div>
                <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                  <label for="username">Adhar Number</label>
                  <input class="form-control" type="text" name="adhar" id="adhar" placeholder="Adhar Number">
                </div>
                <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                  <label for="address1">File No</label>
                  <input class="form-control" type="text" maxlength="4" pattern="^[A-Z][1-9][0-9]*$"  name="fileno" id="fileno" placeholder="File No">
                </div>
                
              </div>
              <div class="row">
                
                <div class="col-md-6">
                  <label for="address1">Address</label>
                  <textarea rows="3" name="address" class="form-control" ></textarea>
                </div>
                <div class="col-md-6">
                  <label for="return_type">Return Type</label>
                  <select class="form-control" name="return_type">
                    <?php  while($row = mysqli_fetch_assoc($returnType)){?>
                        <option value="<?php echo $row['type'] ;?>"><?php echo $row['type'] ?></option>
                   
                    <?php }?>
                  </select>
                </div>
              </div>
              
              <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                        <label for="">Bank Name</label>
                        <input type="text" name="bankname[]" class="form-control" placeholder="Enter Bank Name">
                      </div>
                      <div class="col-md-3">
                        <label for="">IFSC</label>
                        <input type="text" name="ifsc[]" class="form-control" placeholder="Enter IFSC">
                      </div>
                      <div class="col-md-3">
                        <label for="">Account No</label>
                        <input type="text" name="accountno[]" class="form-control" placeholder="Enter Account No">
                      </div>
                      <div class="col-md-1" style="margin-top:30px;">
                        <label for=""></label>
                        <button id="add-more" name="add-more" class="btn btn-primary">
                          <i class="fa fa-plus"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="add-more-branch"></div>
            </div>
            
          </div>
        </div>
        <!-- /.card-body -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="addsave">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>



<!--- Update Customer Model -->
<div class="modal fade" id="update_company_modal" tabindex="-1" role="dialog" aria-labelledby="update_company_modal">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center" id="edit_title">Update Inward </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="ajax/Update/Update-Inward.php" method="post" name="edit_employee" id="edit_employee" enctype="multipart/form-data">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                  <label for="username">Full Name</label>
                  <input class="form-control" type="text" name="username" id="edit_username" placeholder="Name">
                </div>
                <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                  <label for="surname">Email</label>
                  <input class="form-control" type="email" name="email" id="edit_email" placeholder="email">
                </div>
                <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                  <label for="username">Contact No</label>
                  <input class="form-control" type="number" name="mobile" id="edit_mobile" placeholder="Contact No">
                </div>
              </div>
              
              <div class="row">
                <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                  <label for="username">PAN NO</label>
                  <input class="form-control" type="text" name="pan" id="edit_pan" placeholder="PAN NO">
                </div>
                <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                  <label for="username">Adhar Number</label>
                  <input class="form-control" type="text" name="adhar" id="edit_adhar" placeholder="Adhar Number">
                </div>
                <div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
                  <label for="address1">File No</label>
                  <input class="form-control" type="text" maxlength="4" pattern="^[A-Z][1-9][0-9]*$" name="fileno" id="edit_fileno" placeholder="File No">
                </div>
                
              </div>
              <div class="row">
                
                <div class="col-md-6">
                  <label for="address1">Address</label>
                  <textarea rows="3" name="address" class="form-control" ></textarea>
                </div>
                <div class="col-md-6">
                  <label for="return_type">Return Type</label>
                  <select class="form-control" name="return_type">
                    <?php  $select_returnType = "SELECT * FROM returnType";
$returnType = mysqli_query($con, $select_returnType);
while($row = mysqli_fetch_assoc($returnType)){?>
                        <option value="<?php echo $row['type'] ;?>"><?php echo $row['type'] ?></option>
                   
                    <?php }?>
                  </select>
                </div>
                <input type="hidden" name="inwardid" id="inwardid">
              </div>
              
              <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-4">
                        <label for="">Bank Name</label>
                        <input type="text" name="bankname[]" class="form-control" placeholder="Enter Bank Name">
                      </div>
                      <div class="col-md-3">
                        <label for="">IFSC</label>
                        <input type="text" name="ifsc[]" class="form-control" placeholder="Enter IFSC">
                      </div>
                      <div class="col-md-3">
                        <label for="">Account No</label>
                        <input type="text" name="accountno[]" class="form-control" placeholder="Enter Account No">
                      </div>
                      <div class="col-md-1" style="margin-top:30px;">
                        <label for=""></label>
                        <button id="add-more-edit" name="add-more" class="btn btn-primary">
                          <i class="fa fa-plus"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="add-more-branch-edit"></div>
            </div>
            
          </div>
        </div>

        <!-- /.card-body -->
        <div class="modal-footer">
          
          <button type="submit" class="btn btn-primary pull-right" id="save_employee">Save</button>
          <button type="button" class="btn btn-default btn-flat pull-right" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--- End Update Customer Model -->
<!--- View Customer Details Model -->
<!--- End View Customer Details Model -->
<!--- Help Model -->
<!--- End Help Model --> 
<?php include 'include/footer.php'; ?>
 </div>
<?php include 'include/js.php'; ?>

<!-- AdminLTE for demo purposes -->
<!-- <script src="plugins/ckeditor/ckeditor.js"></script> -->
<script type="text/javascript" src="plugins//ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="plugins//ckeditor/adapters/jquery.js"></script>
<!-- <script src="https://cdn.ckeditor.com/4.25.0-lts/standard-all/ckeditor.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<?php include 'include/inward_js.php'; mysqli_close($con);?>
<script>
    $( '#notes_inward' ).ckeditor();
    
</script>

</body>
</html>

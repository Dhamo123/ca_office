<?php 
$url = $_SERVER['HTTP_HOST'].parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$main = explode('/', $url)[2];
//echo '=='.print_r($main);
?>

<aside class="main-sidebar">
  <section class="sidebar">

    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo $base_url; ?>/dist/img/avatar5.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <a href="<?php echo $base_url; ?>/settings">
        <strong><?php echo $user_data['Username']; ?></strong></a>
        <div class="digital-date" style="display: table-cell; padding-right: 10px;"></div>
      <div class="digital-clock" style="display: table-cell;"></div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="nav nav-sidebar sidebar-menu" data-widget="treeview" role="menu" data-accordion="false">
     <!--  <li class="header">HEADER</li> -->

      <li class="nav-item <?php echo ($main == 'dashboard' ? 'active' : '') ?>"><a class="nav-link <?php echo ($main == 'dashboard' ? 'active' : '') ?>" href="<?php echo $base_url; ?>/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard </span></a></li>
      
      <li class="nav-item <?php echo ($main == 'manage-user' ? 'active' : '') ?>">
          <a class="nav-link <?php echo ($main == 'manage-user' ? 'active' : '') ?>" href="#"><i class="fa fa-cog"></i>&nbsp;<span>Setting</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="nav nav-treeview"  >
              <li class="nav-item <?php echo ($main == 'manage-user' ? 'active' : '') ?>" style="display: none;"> 
                <a class="nav-item setting <?php echo ($main == 'manage-user' ? 'active' : '') ?>" href="<?php echo $base_url; ?>/manage-user"><i class="fa fa-user nav-icon"></i>&nbsp;&nbsp;<span>User</span></a>
              </li>
              <li class="nav-item <?php echo ($main == 'employee' ? 'active' : '') ?>" style="display: none;"> 
                <a class="nav-item setting <?php echo ($main == 'employee' ? 'active' : '') ?>" href="<?php echo $base_url; ?>/employee"><i class="fa fa-user nav-icon"></i>&nbsp;&nbsp;<span>Employee</span></a>
              </li>
            </ul>
     </li>
     <!--  <li class=" nav-item<?php echo ($main == 'manage-user' ? 'active' : '') ?>"><a href="<?php echo $base_url; ?>/manage-user"><i class="fa fa-users"></i> <span>Manage User</span></a></li> -->
      <!-- <li class="<?php echo ($main == 'settings' ? 'active' : '') ?>"><a href="<?php echo $base_url; ?>/settings"><i class="fa fa-cog"></i> <span>Settings</span></a></li> -->
      
      
      <li class="nav-item"><a href="<?php echo $base_url; ?>/logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
      
    </ul>
  </section>
</aside>

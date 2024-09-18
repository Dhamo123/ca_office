<?php 
$url = $_SERVER['HTTP_HOST'].parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$main = explode('/', $url)[2];
//echo '=='.print_r($main);
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        
    </ul>

    
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    
    <div class="user-panel">
      
      <a href="<?php echo $base_url; ?>" class="brand-link">
<img src="<?php echo $base_url; ?>/dist/img/avatar5.png" alt="<?php echo $user_data['Username']; ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
<span class="brand-text font-weight-light"><?php echo $user_data['Username']; ?></span>
</a>
    </div>


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item ">
            <a href="<?php echo $base_url; ?>/dashboard" class="nav-link <?php echo ($main == 'dashboard' ? 'active' : '') ?>">
              <i class="nav-icon fa fa-home text-warning"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <?php if($_SESSION['role']=='superadmin'){?>
          <li class="nav-item <?php echo ($main == 'manage-user' ? 'active' : '') ?>">
                <a href="<?php echo $base_url; ?>/manage-user" class="nav-link <?php echo ($main == 'manage-user' ? 'active' : '') ?>">
                  <i class="fa fa-users nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            <?php }?>
            <li class="nav-item <?php echo ($main == 'inward' ? 'active' : '') ?>">
                <a href="<?php echo $base_url; ?>/inward" class="nav-link <?php echo ($main == 'inward' ? 'active' : '') ?>">
                  <i class="fa fa-users nav-icon"></i>
                  <p>Inward</p>
                </a>
              </li>
          <li class="nav-item <?php echo ($main == 'notes' ? 'active' : '') ?>">
                <a href="<?php echo $base_url; ?>/notes" class="nav-link <?php echo ($main == 'notes' ? 'active' : '') ?>">
                  <i class="fa fa-users nav-icon"></i>
                  <p>Notes</p>
                </a>
              </li>
          
          
          <li class="nav-item">
            <a href="<?php echo $base_url; ?>/logout.php" class="nav-link">
              <i class="nav-icon fa fa-sign-out text-warning"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
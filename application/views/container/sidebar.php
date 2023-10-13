  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url('uploads/profile/image.png'); ?>" alt="User Image" style="width: 30px;height: 30px;">
        </div>
        <div class="pull-left info">
          <p><?= ucfirst($this->session->userdata('user_name')); ?></p>
        </div> 
      </div>
      <!-- search form -->
      <!--form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form--->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
     
         
         <li><a href="<?= base_url('RegisterUsers');?>"><i class="fa fa-dashboard"></i> Registerd Users</a></li>
 
          </ul>
        </li>
        
    </section>
    <!-- /.sidebar -->
  </aside>
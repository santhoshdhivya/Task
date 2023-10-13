<?php include_once('container/header2.php'); ?>
<?php include_once('container/sidebar1.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <!-- <small>new</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <?php if(($this->session->flashdata('msg'))){ ?>
    <div class="alert <?= $this->session->flashdata('class'); ?> alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa <?= $this->session->flashdata('icon'); ?>"></i> Alert!</h4>
      <?= $this->session->flashdata('msg'); ?>
    </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Dashboard</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" >
              <div class="box-body" style="width: 100%;">
                <div class="form-group">
                  
                </div>
                <div class="form-group">
                  
                  <div class="col-md-12 col-md-12">
                    <a>welcome <?php echo ucfirst($this->session->userdata('user_name'));?></a>
                   
                  </div>
                </div>
                

               

                
              </div>
              <!-- /.box-body -->
            </form>
          </div>
      </div>
    </div>
     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once('container/right-sidebar.php'); ?>
<?php include_once('container/footer.php'); ?>
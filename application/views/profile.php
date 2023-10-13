<?php include_once('container/header.php'); ?>
<?php include_once('container/sidebar1.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if(!empty($this->session->flashdata('msg'))){ ?> 
        <div class="alert <?= $this->session->flashdata('class'); ?> alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa <?= $this->session->flashdata('icon'); ?>"></i> Alert!</h4>
          <?= $this->session->flashdata('msg'); ?>
        </div>
        <?php } ?>
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img src="<?= base_url('uploads/profile/image.png'); ?>" alt="User Image" style="width: 50px;height: 50px;">

              <h3 class="profile-username text-center"><?= ucfirst($Edit_Result['username']); ?></h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email Id</b> <a class="pull-right"><?= @$Edit_Result['email']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Since</b> <a class="pull-right"><?= @$Edit_Result['created']; ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#settings" data-toggle="tab">Personal Info</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="settings">
                <form class="form-horizontal" method="POST" action="<?= base_url('profile'); ?>" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name" name="username" value="<?= set_value('username',@$Edit_Result['username']); ?>">
                      <?= form_error('username'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email" value="<?= set_value('email',@$Edit_Result['email']); ?>">
                      <?= form_error('email'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
                      <?= form_error('password'); ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
           
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once('container/right-sidebar.php'); ?>
<?php include_once('container/footer.php'); ?>
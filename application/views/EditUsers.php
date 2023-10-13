<?php include_once('container/header.php'); ?>
<?php include_once('container/sidebar.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blog
        <!-- <small>new</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit</li>
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
              <h3 class="box-title">Edit Users</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?= base_url('edit_users'); ?>" enctype="multipart/form-data">
              <input type="hidden" name="hidden_id" value="<?php echo set_value('hidden_id',$edit_id); ?>" />
				        <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">UserName</label>
                  <div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control" id="inputTitle" name="username" value="<?= set_value('username',$Edit_Result['username']); ?>">
                    <?= form_error('username'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Email</label>
                  <div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" placeholder="Email" name="email" value="<?= set_value('email',@$Edit_Result['email']); ?>">
                      <?= form_error('email'); ?>
                    
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Password</label>
                  <div class="col-md-6 col-sm-10">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
                      <?= form_error('password'); ?>
                    
                  </div>
                </div>
				       <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Contact Number</label>
                  <div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control" id="inputcontact" placeholder="Contact Number" name="contact_no" value="<?= set_value('contact_no',@$Edit_Result['contact_no']); ?>" onkeypress="return isNumber(event)" minlength="10" maxlength="10">
                      <?= form_error('contact_no'); ?>
                    
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Address</label>
                  <div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control" id="inputAddress" placeholder="Address" name="address" value="<?= set_value('address',@$Edit_Result['address']); ?>">
                      <?= form_error('address'); ?>
                    
                  </div>
                </div>
               
                

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"></label>
                  <div class="col-md-6 col-sm-10">
                     <button type="submit" class="btn btn-info col-sm-3">Update</button>
                  </div>
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


<script type="text/javascript">
 
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

</script>

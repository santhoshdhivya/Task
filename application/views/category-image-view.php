<?php include_once('container/header2.php'); ?>
<?php include_once('container/sidebar1.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category Gallery
        <!-- <small>new</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= base_url('category'); ?>"> category</a></li>
        <li><a href="javascript:void(0);">Category Gallery</a></li>
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
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">View Category Gallery - <?= $name; ?></h3>
              <a href="<?= base_url('category/add_image/'.$id); ?>" class="btn btn-primary pull-right">Add</a>

			  </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th>Order No.</th>
                  <th>Status</th>
                  <th>Created</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($DataResult)){
                  $x=1;
                  foreach ($DataResult as $info) { ?>
                <tr>
                  <td class="col-xs-1"><?= $x; ?></td>
                  <td><?= $info['name']; ?></td>
                  <td><img src="<?= base_url('uploads/images/'.$info['image']); ?>" width="50px" height="50px" class="img-responsive img_view" data-url="<?= base_url('uploads/images/'.$info['image']); ?>"></td>
                  <td><?= $info['order_no']; ?></td>
                  <td><?php if($info['status']==1){ ?>
                     <span class="label label-success status-span">Active</span>
                     <?php }elseif($info['status']==2){ ?>
                     <span class="label label-warning status-span">Inactive</span>
                  <?php } ?></td>
                  <td><?= $info['created']; ?></td>
                  <td>
                   
                    <?php if($info['status']==1){ ?>
                    <a href="<?php echo base_url('category/image_status/'.$info['id'].'/2'); ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top"  data-original-title="Inactive"><span class="fa fa-lock"></span></a>                     
                    <?php }elseif($info['status']==2) { ?>
                    <a href="<?php echo base_url('category/image_status/'.$info['id'].'/1'); ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top"  data-original-title="Active"><span class="fa fa-unlock"></span></a> 
                    <?php } ?>
                                   
                    <a href="javascript:void(0);" class="btn btn-danger delete_trigger" data-toggle="tooltip" data-placement="right"  data-original-title="Delete" data-url="<?php echo base_url('category/image_delete/'.$info['id']); ?>">
                    <span class="fa fa-trash"></span></a>
                  </td>
                </tr>
                <?php  $x++; }
                }else { ?>
                <tr>
                  <td colspan="10"><center>No Data Available...</center>/</td>
                </tr>
                <?php } ?>
                </tbody>
               
              </table>
            </div>
              <!-- /.box-body -->
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
  $(document).on('click','.delete_trigger',function(){
     var data_url=$(this).attr('data-url');
     swal({
        title: "Are you sure want to delete?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((Logout) => {
        if (Logout) {
          swal("Your File Will be Delete..", {
            icon: "success",
          }).then(() => {
            window.location.href = data_url;});
        }
      });
  });
</script>
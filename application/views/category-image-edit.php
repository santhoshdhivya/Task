<?php include_once('container/header2.php'); ?>
<?php include_once('container/sidebar1.php'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category
        <!-- <small>new</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= base_url('category'); ?>">Category</a></li>
        <li><a href="<?= base_url('category/image/'.$id); ?>">Category Gallery</a></li>
        <li class="active">Edit</li>
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
              <h3 class="box-title">Edit Category Gallery - <?= $name; ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="<?= base_url('category/image_edit'); ?>" enctype="multipart/form-data">
              <div class="box-body">
               <input type="hidden" name="hidden_id" value="<?php echo set_value('hidden_id',$edit_id); ?>" />
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Name</label>
                  <div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control" id="inputName" name="name" value="<?= set_value('name',$Edit_Result['name']); ?>">
                    <?= form_error('name'); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputImage" class="col-sm-2 control-label">Image</label>
                  <div class="col-sm-6">
                      <input type="file" class="form-control imgUpload" id="inputImage" name="image">
                      <?= form_error('image'); ?>
                    </div>
                    <div class="col-sm-4">
                      <img src="<?= base_url('uploads/images/'.$Edit_Result['image']); ?>" width="100px" height="100px" class="UploadImgPreview img-responsive">
                    </div>
                </div>
              
                <div class="form-group">
                  <label for="inputOrderNo" class="col-sm-2 control-label">Order No.</label>
                   <div class="col-md-6 col-sm-10">
                    <input type="text" class="form-control" id="inputOrderNo" name="order_no" value="<?= set_value('order_no',$Edit_Result['order_no']); ?>">
                    <?= form_error('order_no'); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"></label>
                  <div class="col-md-6 col-sm-10">
                     <button type="submit" class="btn btn-info col-sm-3">Update</button>
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
  // Image Upload Preview
  $(".imgUpload").on("change", function()
  {
    var x=$(this).parent().parent().find(".UploadImgPreview");
    var files = !!this.files ? this.files : [];
    if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
    if (/^image/.test( files[0].type)){ // only image file
      var reader = new FileReader(); // instance of the FileReader
      reader.readAsDataURL(files[0]); // read the local file
      reader.onloadend = function(){ // set image data as background of div
        x.attr("src",this.result);
      }
    }
  });

  // Image Viewer
  $(document).on('click','.img_view',function() {
    var data_url=$(this).attr('data-url');
    $('.modal-title-view').html('Image View');
    $('.modal-content-view').html("<img src='"+data_url+"' class='img-responsive' style='margin:0 auto;'>");
    $('#info-modal').modal('show');
  });

</script>
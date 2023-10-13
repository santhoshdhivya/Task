<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->helper(array('url', 'form'));
        $this->load->library('form_validation', 'session', 'upload');
        $this->load->model(array('FunctionModel'));
        $this->load->library('slug');
        $this->load->library('dbvars',NULL,'Info');
        $this->load->library('pagination');
        
    }

	 public function index() {
		$data['DataResult']=$this->FunctionModel->Select('category');
		$this->load->view('category-view',$data);
    }

	public function add() {
		$this->form_validation->set_rules('name','Category Name','required');
		$this->form_validation->set_rules('image','Image','callback_image_upload');
		$this->form_validation->set_rules('order_no','Order No','required|integer|max_length[3]');
		 if (!$this->form_validation->run() == FALSE) {
		   $InsertData=array(
		   	    'parent_id'        => $this->input->post('parent_category'),
				'slug'             => $this->slug->create_unique_slug($this->input->post('name'), 'category'),
				'name'             => $this->input->post('name'),
				'image'            => $this->upload_data['file']['file_name'],
				'description'      => $this->input->post('description'),
				'order_no'         => $this->input->post('order_no'),
				'status'           => '1',
				'created'          => date('Y-m-d H:i:s')
			);
	         $result=$this->FunctionModel->Insert($InsertData,'category');
			if($result >= 1){
				$this->session->set_flashdata('class', "alert-success");
				$this->session->set_flashdata('icon', "fa-check");
				$this->session->set_flashdata('msg', "Product Category Added Successfully.");
				redirect('category','refresh');
			}
			else{
				$this->session->set_flashdata('class', "alert-danger");
				$this->session->set_flashdata('icon', "fa-warning");
				$this->session->set_flashdata('msg', "Something Went Wrong.");
				redirect('category/add', 'refresh');
			}
		}
		 $data['category']=$this->FunctionModel->Select('category',array('status'=>1,'parent_id'=>0));
	   $this->load->view('category-add',@$data);
    }

	function image_upload(){
		  if($_FILES['image']['size'] != 0){
			$upload_dir = './uploads/images';
			if (!is_dir($upload_dir)) {
			     mkdir($upload_dir);
			}

			if(file_exists($upload_dir.'/'.$_FILES['image']['name'])){
				list($file_name)=explode('.',$_FILES['image']['name']);
				$file_name=$file_name.'_'.substr(md5(rand()),0,5);
			}else{
				list($file_name)=explode('.',$_FILES['image']['name']);
			}
			
			$config['upload_path']   = $upload_dir;
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['file_name']     = $file_name;
			$config['overwrite']     = false;
			$config['max_size']	     = '5120';

			$this->upload->initialize($config);
			if (!$this->upload->do_upload('image')){
				$this->form_validation->set_message('image_upload', $this->upload->display_errors('<p class=error>','</p>'));
				return false;
			}
			else{
				$this->upload_data['file'] =  $this->upload->data();
				return true;
			}
		}
		else{
			$this->form_validation->set_message('image_upload', "No file selected");
			return false;
		}
   }

   

	public function edit($id = NULL) {
		$edit_id=!empty($id)?$id:$this->input->post('hidden_id'); $data['edit_id']=$edit_id;
		if(empty($edit_id)){
			$this->session->set_flashdata('class', "alert-danger");
			$this->session->set_flashdata('icon', "fa-warning");
			$this->session->set_flashdata('msg', "Something Went Wrong.");
			redirect('category', 'refresh');
		}
		$this->form_validation->set_rules('name','Category Name','required');
		$this->form_validation->set_rules('image','Image','callback_edit_image_upload');
		$this->form_validation->set_rules('order_no','Order No','required|integer|max_length[3]');
		  if (!$this->form_validation->run() == FALSE) {
			   $UpdateData=array(
				'slug'             => $this->slug->create_unique_slug($this->input->post('name'), 'category'),
				'name'             => $this->input->post('name'),
				'image'            => $this->upload_data['file']['file_name'],
				'description'      => $this->input->post('description'),
				
				'order_no'         => $this->input->post('order_no')
				);
		  $result=$this->FunctionModel->Update($UpdateData,'category',array('id'=>$edit_id));

			if ($result == 1) :
				$this->session->set_flashdata('class', "alert-success");
				$this->session->set_flashdata('icon', "fa-check");
				$this->session->set_flashdata('msg', "Webinar Updated Successfully.");
				redirect('category','refresh');
			else :
          		$this->session->set_flashdata('class', "alert-danger");
				$this->session->set_flashdata('icon', "fa-warning");
				$this->session->set_flashdata('msg', "Something Went Wrong.");
          		redirect('category/edit/'.$edit_id, 'refresh');
        	endif;
			}
			$data['Edit_Result']=$this->FunctionModel->Select_Row('category',array('id'=>$edit_id));
		   $this->load->view('category-edit',$data);
    }

	function edit_image_upload(){
	 if($_FILES['image']['size'] != 0){
			$upload_dir = './uploads/images';
			if (!is_dir($upload_dir)) {
			     mkdir($upload_dir);
			}

			if(file_exists($upload_dir.'/'.$_FILES['image']['name'])){
				list($file_name)=explode('.',$_FILES['image']['name']);
				$file_name=$file_name.'_'.substr(md5(rand()),0,5);
			}else{
				list($file_name)=explode('.',$_FILES['image']['name']);
			}
			
			$config['upload_path']   = $upload_dir;
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['file_name']     = $file_name;
			$config['overwrite']     = false;
			$config['max_size']	     = '5120';

		$this->upload->initialize($config);
		if (!$this->upload->do_upload('image')){
			$this->form_validation->set_message('edit_image_upload', $this->upload->display_errors('<p class=error>','</p>'));
			return false;
		}
		else{
			$this->upload_data['file'] =  $this->upload->data();
			return true;
		}
	}
	else{
		$id=$this->input->post('hidden_id');
		$file_name=$this->FunctionModel->Select_Field('image','category',array('id'=>$id));
		$this->upload_data['file']['file_name']=$file_name;
		return true;
	}
   }



	public function status($id = NULL,$status = NULL) {
		if(empty($id) || empty($status)){
			$this->session->set_flashdata('class', "alert-danger");
			$this->session->set_flashdata('icon', "fa-warning");
			$this->session->set_flashdata('msg', "Something Went Wrong.");
			redirect('category', 'refresh');
		}
		$UpdateData=array(
			'status' =>$status
			);
		$result = $this->FunctionModel->Update($UpdateData,'category',array('id'=>$id));
		if ($result == 1) :
			$this->session->set_flashdata('class', "alert-success");
			$this->session->set_flashdata('icon', "fa-check");
			$this->session->set_flashdata('msg', "Status Successfully Updated.");
			redirect('category','refresh');
        else :
			$this->session->set_flashdata('class', "alert-danger");
			$this->session->set_flashdata('icon', "fa-warning");
			$this->session->set_flashdata('msg', "Something Went Wrong.");
        	redirect('category', 'refresh');
        endif;
    }

	public function delete($id = NULL) {
		if(empty($id)){
			$this->session->set_flashdata('class', "alert-danger");
			$this->session->set_flashdata('icon', "fa-warning");
			$this->session->set_flashdata('msg', "Something Went Wrong.");
			redirect('category', 'refresh');
		}
        $result = $this->FunctionModel->Delete('category',array('id'=>$id));
		if ($result == 1) :
			$this->session->set_flashdata('class', "alert-success");
			$this->session->set_flashdata('icon', "fa-check");
			$this->session->set_flashdata('msg', "Successfully Deleted.");
			redirect('category','refresh');
        else :
        	$this->session->set_flashdata('class', "alert-danger");
			$this->session->set_flashdata('icon', "fa-warning");
			$this->session->set_flashdata('msg', "Something Went Wrong.");
        	redirect('category', 'refresh');
        endif;
    }

    public function AjaxSingleView(){
    	$id=$this->input->post('id');
    	//print_r($id);exit;
    	if(empty($id)){
    		$this->session->set_flashdata('class', "alert-danger");
			$this->session->set_flashdata('icon', "fa-warning");
			$this->session->set_flashdata('msg', "Something Went Wrong.");
    		redirect('category');
    	}
    	$info=$this->FunctionModel->Select_Row('category',array('id'=>$id));
    	//print_r($info);exit;
    	$return['modal_title']='View Category';
    	$return['modal_content']='';
    	if($info['parent_id']!=0){
    		$parent_category=$this->FunctionModel->Select_Field('name','category',array('id'=>$info['parent_id']));
    		$return['modal_content'].='<div class="row">
    			<div class="form-group">
                  <label class="col-sm-3 control-label">Parent Category</label>
                  <div class="col-sm-8">
                    <label class="control-label">'.@$parent_category.'</label>
                  </div>
                </div>
            </div>';
    	}
    	$return['modal_content'].='
				        <div class="row">
    			<div class="form-group">
                  <label class="col-sm-3 control-label">Name</label>
                  <div class="col-sm-8">
                    <label class="control-label">'.@$info['name'].'</label>
                  </div>
                </div>
            </div>
             <div class="row">    
                <div class="form-group">
                  <label class="col-sm-3 control-label">Image</label>
                  <div class="col-sm-8">
                    <label class="control-label"><img src="'.base_url('uploads/images/'.$info['image']).'" width="250px" height="250px" class="img-responsive"></label>
                  </div>
                </div>
                 </div>
             <div class="row">    
                <div class="form-group">
                  <label class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-8">
                    <label class="control-label">'.@$info['description'].'</label>
                  </div>
                </div>
                 </div>
             
             <div class="row">    
				<div class="form-group">
                  <label class="col-sm-3 control-label">Order No.</label>
                  <div class="col-sm-8">
                    <label class="control-label">'.@$info['order_no'].'</label>
                  </div>
                </div>
                 </div>
              

             <div class="row">    
				<div class="form-group">
                  <label class="col-sm-3 control-label">Status</label>
                  <div class="col-sm-8">
                    <label class="control-label"><span class="label label-'.($info['status']==1?'success':'warning').' status-span">'.($info['status']==1?'Active':'InActive').'</span></label>
                  </div>
                </div>
                 </div>
             <div class="row">    
                <div class="form-group">
                  <label class="col-sm-3 control-label">Created</label>
                  <div class="col-sm-8">
                    <label class="control-label">'.@$info['created'].'</label>
                  </div>
                </div>
                 </div>
             <div class="row">    
                <div class="form-group">
                  <label class="col-sm-3 control-label"></label>
                  <div class="col-sm-8">
                    <label class="control-label"><a href="'.base_url('category/edit/'.$info['id']).'" class="btn btn-primary" data-toggle="tooltip" data-placement="left"  data-original-title="Edit"><span class="fa fa-edit"> &nbsp;Edit</span></a></label>
                  </div>
                </div>
                </div>
                ';
    	echo json_encode($return);
    	exit;
    }

    // Category Feauture Functionality

    public function AjaxFeautres(){
    	$id=$this->input->post('id');
    	$features=$this->FunctionModel->Select_Fields('id,name,order_no','vidiem_features',array('parent_id'=>$id));
    	echo '<form class="form-horizontal feautre_form"><table class="table">
    			<input type="hidden" name="id" value="'.$id.'">
    		   <thead><tr><th>S.No.</th><th>Name</th><th class="col-xs-3">Order No.</th><th>Option</th></tr></thead><tbody class="feature_body">';
    	if(!empty($features)){ $x=1;
    		foreach ($features as $info) {
    			echo '<tr><td>'.$x.'<input type="hidden" name="hidden_id[]" value="'.$info['id'].'"></td>
						<td><input type="text" name="name[]" class="form-control" value="'.$info['name'].'"></td>
						<td><input type="text" name="order_no[]" class="form-control" value="'.$info['order_no'].'"></td>
						<td><a href="javascript:void(0);" data-id="'.$info['id'].'" class="btn btn-danger remove_feautre"><i class="fa fa-times"></i></a></td>';
    		$x++;} }
    	echo '<tr><td><input type="hidden" name="hidden_id[]" value="0"></td>
						<td><input type="text" name="name[]" class="form-control" value=""></td>
						<td><input type="text" name="order_no[]" class="form-control" value=""></td>
						<td><a href="javascript:void(0);" class="btn btn-danger remove_feautre_empty"><i class="fa fa-times"></i></a></td>';	   
    	echo '</tbody>
				<tfoot><tr><td></td><td><button type="submit" class="btn btn-info col-sm-6 feautre_submit">Update</button></td><td></td><td><a href="javascript:void(0);" class="btn btn-primary add_feautre_trigger">Add <i class="fa fa-plus"></i></a></td></tfoot>
    	      </table></form>';	    
    	exit;
    }

    

    
    public function image($id=NULL){
    	if(empty($id)){
    		$this->session->set_flashdata('class', "alert-danger");
			$this->session->set_flashdata('icon', "fa-warning");
			$this->session->set_flashdata('msg', "Something Went Wrong.");
    		redirect('category');
    	}
    	$data['id']=$id;
    	$data['name']=$this->FunctionModel->Select_Field('name','category',array('id'=>$id));
    	$data['DataResult']=$this->FunctionModel->Select('category_images',array('parent_id'=>$id));
			   //$data['DataResult']=$this->FunctionModel->Select('vidiem_category',array('status'=>1,'parent_id'=>0));

		$this->load->view('category-image-view',$data);
    }
	    public function add_image($id=NULL){
    	if(empty($id)){
    		$this->session->set_flashdata('class', "alert-danger");
			$this->session->set_flashdata('icon', "fa-warning");
			$this->session->set_flashdata('msg', "Something Went Wrong.");
    		redirect('category');
    	}
    	$data['id']=$id;
    	$data['name']=$this->FunctionModel->Select_Field('name','category',array('id'=>$id));
    	$this->form_validation->set_rules('name','Name','required');
    	$this->form_validation->set_rules('image','Image','callback_image_upload');
    	//$this->form_validation->set_rules('banner_url','Banner_url','required');
    	$this->form_validation->set_rules('order_no','Order No','required');
			 if (!$this->form_validation->run() == FALSE) {
			   $InsertData=array(
					'parent_id'=>$id,
					'name'=>$this->input->post('name'),
					'image'=>$this->upload_data['file']['file_name'],
					'order_no'=>$this->input->post('order_no'),
					'status' =>'1',
					'created'=>date('Y-m-d H:i:s')
				);
		         $result=$this->FunctionModel->Insert($InsertData,'category_images');
				if($result >= 1){
					$this->session->set_flashdata('class', "alert-success");
				$this->session->set_flashdata('icon', "fa-check");
				$this->session->set_flashdata('msg', "Category Images Added Successfully.");
				    redirect('category/image/'.$id,'refresh');
				}
				else{
					$this->session->set_flashdata('class', "alert-danger");
					$this->session->set_flashdata('icon', "fa-warning");
					$this->session->set_flashdata('msg', "Something Went Wrong.");
	                redirect('category/add_image/'.$id, 'refresh');	
				}
				}
		   $this->load->view('category-image-add',@$data);	
    }
	public function image_edit($id = NULL) {
		$edit_id=!empty($id)?$id:$this->input->post('hidden_id'); $data['edit_id']=$edit_id;
		if(empty($edit_id)){
    		$this->session->set_flashdata('class', "alert-danger");
			$this->session->set_flashdata('icon', "fa-warning");
			$this->session->set_flashdata('msg', "Something Went Wrong.");
    		redirect('category');
		}
         $data['id']=$this->FunctionModel->Select_Field('parent_id','category_images',array('id'=>$edit_id));
         $data['name']=$this->FunctionModel->Select_Field('name','category',array('id'=>$id));
		$this->form_validation->set_rules('hidden_id', 'ID', 'required');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('image','Image','callback_edit_content_image_upload');
    	$this->form_validation->set_rules('order_no','Order No','required');
		  if (!$this->form_validation->run() == FALSE) {
			   $UpdateData=array(
					'name'=>$this->input->post('name'),
					'image'=>$this->upload_data['file']['file_name'],
					'order_no'=>$this->input->post('order_no')
				);
		  $result=$this->FunctionModel->Update($UpdateData,'category_images',array('id'=>$edit_id));
			if ($result == 1) :
            	$this->session->set_flashdata('class', "alert-success");
				$this->session->set_flashdata('icon', "fa-check");
				$this->session->set_flashdata('msg', "Category Image Updated Successfully.");
		    	redirect('category/image/'.$parent_id,'refresh');
            else :
          		$this->session->set_flashdata('class', "alert-danger");
			    $this->session->set_flashdata('icon', "fa-warning");
			    $this->session->set_flashdata('msg', "Something Went Wrong.");
          		redirect('category/image_edit/'.$edit_id, 'refresh');	
        	endif;
			}
			$data['Edit_Result']=$this->FunctionModel->Select_Row('category_images',array('id'=>$edit_id));	
		   $this->load->view('category-image-edit',$data);	
    }
	function edit_content_image_upload(){
	  if($_FILES['image']['size'] != 0){
		$upload_dir = './uploads/images';
		if (!is_dir($upload_dir)) {
		     mkdir($upload_dir);
		}	
		$config['upload_path']   = $upload_dir;
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['file_name']     = 'image_'.substr(md5(rand()),0,10);
		$config['overwrite']     = false;
		$config['max_size']	 = '5120';

		$this->upload->initialize($config);
		if (!$this->upload->do_upload('image')){
			$this->form_validation->set_message('edit_content_image_upload', $this->upload->display_errors('<p class=error>','</p>'));
			return false;
		}	
		else{
			$this->upload_data['file'] =  $this->upload->data();
			return true;
		}	
	}	
	else{
		$id=$this->input->post('hidden_id');
		$file_name=$this->FunctionModel->Select_Field('image','category_images',array('id'=>$id));
		$this->upload_data['file']['file_name']=$file_name;
		return true;
	}
   }
      public function image_status($id = NULL,$status = NULL) {
		if(empty($id) || empty($status)){
			$this->session->set_flashdata('class', "alert-warning");	 
	    	$this->session->set_flashdata('error', "<span class='entypo-attention'></span> Something Wrong.");	
			redirect('category', 'refresh');
		}
		$UpdateData=array(
			'status' =>$status
			);
		$parent_id=$this->FunctionModel->Select_Field('parent_id','category_images',array('id'=>$id));
		$result = $this->FunctionModel->Update($UpdateData,'category_images',array('id'=>$id));
		if ($result == 1) :
        	$this->session->set_flashdata('class', "alert-success");
			$this->session->set_flashdata('icon', "fa-check");
			$this->session->set_flashdata('msg', "Status Successfully Updated.");
			redirect('category/image/'.$parent_id,'refresh');
        else :
        	$this->session->set_flashdata('class', "alert-danger");
			$this->session->set_flashdata('icon', "fa-warning");
			$this->session->set_flashdata('msg', "Something Went Wrong.");
        	redirect('category/image/'.$parent_id, 'refresh');	
        endif;
    }
	
	public function image_delete($id = NULL) {
		if(empty($id)){
			$this->session->set_flashdata('class', "alert-warning");	 
	    	$this->session->set_flashdata('error', "<span class='entypo-attention'></span> Something Wrong.");	
			redirect('category', 'refresh');
		}
        $parent_id=$this->FunctionModel->Select_Field('parent_id','category_images',array('id'=>$id));
        $result = $this->FunctionModel->Delete('category_images',array('id'=>$id));
		if ($result == 1) :
        	$this->session->set_flashdata('class', "alert-success");
			$this->session->set_flashdata('icon', "fa-check");
			$this->session->set_flashdata('msg', "Successfully Deleted.");
			redirect('category/image/'.$parent_id,'refresh');
        else :
        	$this->session->set_flashdata('class', "alert-danger");
			$this->session->set_flashdata('icon', "fa-warning");
			$this->session->set_flashdata('msg', "Something Went Wrong.");
        	redirect('category/image/'.$parent_id, 'refresh');	
        endif;
    }

   
    
}
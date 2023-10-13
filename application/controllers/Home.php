<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation', 'session', 'upload');
        $this->load->model(array('FunctionModel'));
        $this->load->library('dbvars',NULL,'Info');
         $this->load->library('pagination');
         $this->load->library('slug');
         
        
    }

     public function index($start=0) {
     if($this->session->userdata('user_logged_in')){redirect('dashboard');}            
         $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
         $this->form_validation->set_rules('password','Password','required|callback_password_check');
            if (!$this->form_validation->run() == FALSE) {
                $email=$this->input->post('email');
                $password=$this->input->post('password');
                $login=$this->FunctionModel->Login($email,$password);
                if($login['status']==0){
                    $this->session->set_flashdata('class', "alert-warning");     
                    $this->session->set_flashdata('icon', "fa-warning");     
                    $this->session->set_flashdata('msg', "Invalid Email / Password.");
                    redirect('login','refresh');    
                }else if($login['status']==2){
                    $this->session->set_flashdata('class', "alert-danger");  
                    $this->session->set_flashdata('icon', "fa-warning");     
                    $this->session->set_flashdata('msg', "Account Inactive.");
                    redirect('login','refresh');    
                }else{
                    $this->session->set_flashdata('class', "alert-success");     
                    $this->session->set_flashdata('icon', "fa-check");   
                    $this->session->set_flashdata('msg', "Login Successfully.");
                    redirect('dashboard','refresh');
                }
              }
        $this->load->view('login');
    }
     public function RegisterdUsres($start=0) {
      $config['base_url'] = base_url('Home/search');
      //print_r($config['base_url']);exit;
      $data['tmp_url']=$config['base_url'];
      $data['tmp_title']='users List';
      $config['per_page'] = 15; 
      $search=$this->input->get('search'); 
      $data['search']=$search;
        if(!empty($search)){
        $data['scroll']=1;
    } 
      $config['total_rows'] = $this->FunctionModel->SearchDataCount(array('status !='=>0),$search);
      $data['DataResult']=$this->FunctionModel->SearchData(array('status'=>1),$config['per_page'],$start,$search);
      //print_r($data['DataResult']);exit;
      $data['x']=$start; 
      $data['DataResult'] = $this->FunctionModel->Select('users',array('admin_role'=>1),'id','DESC');
      $this->load->view('registerd_users',@$data);
    }
    public function register()
    {
        $this->form_validation->set_rules('username','UserName','required');
        $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password','Password','required|min_length[6]');
        $this->form_validation->set_message('is_unique','%s Already Exist');
        
         if($this->form_validation->run()==true){
            $InsertData=array(
                'username'       => $this->input->post('username'),
                'email'      => $this->input->post('email'),
                'password'   => md5($this->input->post('password')),
                
                'status'     => 1,
                'admin_role' =>1,
                'created'    =>date('Y-m-d H:i:s')
            );
            $userid=$this->FunctionModel->Insert($InsertData,'users');
            $this->session->set_userdata('userid',$userid);
            redirect('login');
        }
        $this->load->view('register');
    }

    public function login()
    {
        if($this->session->userdata('user_logged_in')){redirect('dashboard');}            
         $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
         $this->form_validation->set_rules('password','Password','required|callback_password_check');
            if (!$this->form_validation->run() == FALSE) {
                $email=$this->input->post('email');
                $password=$this->input->post('password');
                $login=$this->FunctionModel->Login($email,$password);
                if($login['status']==0){
                    $this->session->set_flashdata('class', "alert-warning");     
                    $this->session->set_flashdata('icon', "fa-warning");     
                    $this->session->set_flashdata('msg', "Invalid Email / Password.");
                    redirect('login','refresh');    
                }else if($login['status']==2){
                    $this->session->set_flashdata('class', "alert-danger");  
                    $this->session->set_flashdata('icon', "fa-warning");     
                    $this->session->set_flashdata('msg', "Account Inactive.");
                    redirect('login','refresh');    
                }else{
                    $this->session->set_flashdata('class', "alert-success");     
                    $this->session->set_flashdata('icon', "fa-check");   
                    $this->session->set_flashdata('msg', "Login Successfully.");
                    redirect('dashboard','refresh');
                }
              }
        $this->load->view('login');
    }
    public function password_check(){
        $email=$this->input->post('email');
        $password=$this->input->post('password');
        if(empty($password)){
            $this->form_validation->set_message('password_check','Password field required');
            return false;
        }
        $count=$this->FunctionModel->LoginCheck($email,$password);
        if($count==1){ return true;}
        else{ $this->form_validation->set_message('password_check','Invalid Email or Password'); 
            return false;
        }
    }

   public function dashboard(){
         $username = $this->session->userdata('user_name');
         $DataResult = $this->FunctionModel->Select('users',array('status'=>1 ,'username'=>$username));
        if(!empty($DataResult)){ 
            foreach ($DataResult as $info) { 
                if($info['admin_role']=='1'){
                    $this->load->view('welcome_users');
                }else{

                  $config['base_url'] = base_url('Home/search');
                  $start = 1;
      //print_r($config['base_url']);exit;
      $data['tmp_url']=$config['base_url'];
      $data['tmp_title']='users List';
      $config['per_page'] = 15; 
      $search=$this->input->get('search'); 
      $data['search']=$search;
        if(!empty($search)){
        $data['scroll']=1;
    } 
      $config['total_rows'] = $this->FunctionModel->SearchDataCount(array('status !='=>0),$search);
      $data['DataResult']=$this->FunctionModel->SearchData(array('status'=>1),$config['per_page'],$start,$search);
      //print_r($data['DataResult']);exit;
      $data['x']=$start; 
      $data['DataResult'] = $this->FunctionModel->Select('users',array('admin_role'=>1),'id','DESC');
      $this->load->view('registerd_users',@$data);

                }
            }
        }
       
    }
    
    public function EditUsers($id = NULL) {
        $edit_id=!empty($id)?$id:$this->input->post('hidden_id'); $data['edit_id']=$edit_id;
        if(empty($edit_id)){
            $this->session->set_flashdata('class', "alert-danger");
            $this->session->set_flashdata('icon', "fa-warning");
            $this->session->set_flashdata('msg', "Something Went Wrong.");
            redirect('Home/EditUsers', 'refresh');
        }
        $this->form_validation->set_rules('hidden_id', 'ID', 'required');
        $this->form_validation->set_rules('username','UserName','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','min_length[6]|max_length[20]');
        
          if (!$this->form_validation->run() == FALSE) {
               $UpdateData=array(
                    'username'      => $this->input->post('username'),
                    'email'    => $this->input->post('email'),
                   
                    'modified' => date('Y-m-d H:i:s')
                );
               $password=$this->input->post('password');
            if(!empty($password)){$UpdateData['password']=md5($password);}
          $result=$this->FunctionModel->Update($UpdateData,'users',array('id'=>$edit_id));

            if ($result == 1) :
                $this->session->set_flashdata('class', "alert-success");
                $this->session->set_flashdata('icon', "fa-check");
                $this->session->set_flashdata('msg', "Blog Updated Successfully.");
                redirect('Home/RegisterdUsres','refresh');
            else :
                $this->session->set_flashdata('class', "alert-danger");
                $this->session->set_flashdata('icon', "fa-warning");
                $this->session->set_flashdata('msg', "Something Went Wrong.");
                redirect('Home/EditUsers/edit/'.$edit_id, 'refresh');
            endif;
            }
           $data['Edit_Result']=$this->FunctionModel->Select_Row('users',array('id'=>$edit_id));
           $this->load->view('EditUsers',$data);
    }

    public function status($id = NULL,$status = NULL) {
        if(empty($id) || empty($status)){
            $this->session->set_flashdata('class', "alert-danger");
            $this->session->set_flashdata('icon', "fa-warning");
            $this->session->set_flashdata('msg', "Something Went Wrong.");
            redirect('RegisterdUsres', 'refresh');
        }
        $UpdateData=array(
            'status' =>$status
            );
        $result = $this->FunctionModel->Update($UpdateData,'users',array('id'=>$id));
        if ($result == 1) :
            $this->session->set_flashdata('class', "alert-success");
            $this->session->set_flashdata('icon', "fa-check");
            $this->session->set_flashdata('msg', "Status Successfully Updated.");
            redirect('Home/RegisterdUsres','refresh');
        else :
            $this->session->set_flashdata('class', "alert-danger");
            $this->session->set_flashdata('icon', "fa-warning");
            $this->session->set_flashdata('msg', "Something Went Wrong.");
            redirect('Home/RegisterdUsres', 'refresh');
        endif;
    }

    public function delete($id = NULL) {
        if(empty($id)){
            $this->session->set_flashdata('class', "alert-danger");
            $this->session->set_flashdata('icon', "fa-warning");
            $this->session->set_flashdata('msg', "Something Went Wrong.");
            redirect('RegisterdUsres', 'refresh');
        }
        $result = $this->FunctionModel->Delete('users',array('id'=>$id));
        if ($result == 1) :
            $this->session->set_flashdata('class', "alert-success");
            $this->session->set_flashdata('icon', "fa-check");
            $this->session->set_flashdata('msg', "Successfully Deleted.");
            redirect('Home/RegisterdUsres','refresh');
        else :
            $this->session->set_flashdata('class', "alert-danger");
            $this->session->set_flashdata('icon', "fa-warning");
            $this->session->set_flashdata('msg', "Something Went Wrong.");
            redirect('Home/RegisterdUsres', 'refresh');
        endif;
    }
    
    public function logout() {
        if(!$this->session->userdata('user_logged_in')){
            $this->session->set_flashdata('class', "alert-danger");  
            $this->session->set_flashdata('icon', "fa-warning");     
            $this->session->set_flashdata('msg', "Access Denied.");
            redirect('Home', 'refresh');
        }   
        $this->FunctionModel->UserLogout();   
        $this->session->set_flashdata('class', "alert-success");     
        $this->session->set_flashdata('icon', "fa-check");   
        $this->session->set_flashdata('msg', "Logout Successfully !..");
        redirect('Home','refresh');
    }
    public function destroy(){
        $this->session->sess_destroy();
        redirect('login');  
    }
    public function profile(){
        $this->form_validation->set_rules('username','UserName','required');
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','min_length[6]|max_length[20]');
        if (!$this->form_validation->run() == FALSE) {
            $UpdateData=array(
                'username'    => $this->input->post('username'),
                'email'   => $this->input->post('email'),
                'modified'=> date('Y-m-d h:i:s')
            );
            $password=$this->input->post('password');
            if(!empty($password)){$UpdateData['password']=md5($password);}
            $this->session->set_userdata('user_name',$this->input->post('username'));
            $id=$this->session->userdata('user_id');
            $result=$this->FunctionModel->Update($UpdateData,'users',array('id'=>$id));
            
            if($result >= 1){   
                $this->session->set_flashdata('class', "alert-success");     
                $this->session->set_flashdata('icon', "fa-check");   
                $this->session->set_flashdata('msg', "Profile Updated Successfully.");
                redirect('Home/profile','refresh');
            }
            else{
                $this->session->set_flashdata('class', "alert-danger");  
                $this->session->set_flashdata('icon', "fa-warning");     
                $this->session->set_flashdata('msg', "Something went Wrong.");
                redirect('Home/profile', 'refresh');   
            }
        }
        $user_id=$this->session->userdata('user_id');
        $data['Edit_Result']=$this->FunctionModel->Select_Row('users',array('id'=>$user_id));
        $this->load->view('profile',@$data); 
    }
    public function search($start=0){
      $config['base_url'] = base_url('Home/search');
      //print_r($config['base_url']);exit;
      $data['tmp_url']=$config['base_url'];
      $data['tmp_title']='Users List';
      $config['per_page'] = 15; 
      $search=$this->input->get('search'); 
      $data['search']=$search;
        if(!empty($search)){
        $data['scroll']=1;
    } 
      $config['total_rows'] = $this->FunctionModel->SearchDataCount(array('status !='=>0),$search);
      $data['DataResult']=$this->FunctionModel->SearchData(array('status'=>1),$config['per_page'],$start,$search);
      //print_r($data['DataResult']);exit;
      $data['x']=$start; 
      $data['DataResult'] = $this->FunctionModel->Select('users',array('status'=>1 , 'admin_role'=>1),'id','DESC');
      $this->load->view('registerd_users',@$data);
    }
    

  
}
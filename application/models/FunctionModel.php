<?php
class FunctionModel extends CI_Model {
     function __construct()
    {
        parent::__construct();
		$this->load->helper(array('url', 'form'));
		$this->load->library('session');
		$this->load->database();
    }
	
	/*================ Insert ==================*/
	public function Insert($data,$table){
		$data = $this->security->xss_clean($data);
		$this->db->insert($table,$data); 
		$insert_id = $this->db->insert_id(); 
		return $insert_id;
	}
	
	/*================ Update ==================*/
	public function Update($data,$table,$where){
		$data = $this->security->xss_clean($data);
		$this->db->where($where);
		$this->db->update($table, $data);
	 	return $this->db->affected_rows();
	}
	
	/*================ Delete ==================*/
	public function Delete($table,$where){
		$query = $this->db->delete($table,$where);
		return $this->db->affected_rows();
	}
	
	/*================ Select ==================*/
	public function Select($table,$where=array(),$order_by='',$order_type='',$limit='',$offset=''){
		$query = $this->db->order_by($order_by,$order_type)->get_where($table,$where, $limit, $offset);
	    return $query->result_array();
	}
	
	/*================ Select Row ==================*/
	public function Select_Row($table,$where=array(),$order_by='',$order_type='',$limit='',$offset=''){
		$query = $this->db->order_by($order_by,$order_type)->get_where($table,$where, $limit, $offset);
	    return $query->row_array();
	}
	
	/*================ Select Field ==================*/
	public function Select_Field($field,$table,$where=array(),$order_by='',$order_type='',$limit='',$offset=''){
		$query = $this->db->select($field)->order_by($order_by,$order_type)->get_where($table,$where,$limit,$offset);
		$data=$query->row_array();
	    return $data[$field];
	}
	
	public function Login($email,$password){
		$query =$this->db->get_where('users',array('email' => $email, 'password' => md5($password)));
		if ($query->num_rows() == 1)
		{
			$data=$query->row_array();
			if($data['status']==1){
				$SessionData = array(
					'user_id'         => $data['id'],
					'user_name'       => $data['username'],
					'user_logged_in'  =>  TRUE
				);
				$this->session->set_userdata($SessionData);
				$login['status']=1;
				$this->login_time_update();
			}
			else{
				$login['status']=2;
			}
			return $login;
        }
        	$login['status']=0;
			return $login;	
	}
	public function login_time_update(){
		$id=$this->session->userdata('user_id');
		$row=$this->FunctionModel->Select_Row('users',array('id'=>$id));
		$UpdateData=array(
			'modified'        => date('Y-m-d h:i:s')
		);
		$this->FunctionModel->Update($UpdateData,'users',array('id'=>$id));
		return true;
	}
	public function LoginCheck($email,$password){
        $this->db->select();
        $this->db->or_group_start();
        $this->db->or_where('email',$email);
        $this->db->group_end();
        $this->db->where('password',md5($password));
        $query=$this->db->get_where('users');
        return $query->num_rows(); 
    }
    public function UserLogout(){
		$id=$this->session->userdata('user_id');
		$UpdateData=array(
			'modified'   =>date('Y-m-d h:i:s')
		);
		$this->FunctionModel->Update($UpdateData,'users',array('id'=>$id));
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id') {
				$this->session->unset_userdata($key);
			}
		}
		return 1;
	}
	public function SearchDataCount($array=array(),$search_term=null){
        $this->db->select('id,username,email,contact_no,address,status,created');
        if(!empty($search_term)){
            $this->db->or_group_start();
            $this->db->or_like('username',$search_term);
            $this->db->or_like('email',$search_term);
            $this->db->group_end();
        }
        $query=$this->db->get_where('users',$array);
        return $query->num_rows();
    }

    public function SearchData($array=array(),$per_page=100,$start=0,$search_term=null){
       $this->db->select('id,username,email,contact_no,address,status,created');
        if(!empty($search_term)){
            $this->db->or_group_start();
            $this->db->or_like('username',$search_term);
            $this->db->or_like('email',$search_term);
            $this->db->group_end();
        }
        $query=$this->db->get_where('users',$array,$per_page,$start);
        return $query->result_array();
    }
	
public function fetch_data() {
		 $this->db->order_by("id", "DESC");
  $query = $this->db->get("users");
  return $query->result();
	}
}
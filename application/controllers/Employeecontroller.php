<?php
class Employeecontroller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->load->library("session");
        //$this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function employeeregister()
    {
        $this->load->view('employeeregistration');
    }
    public function addemployeedetails()
    {
        $this->load->library('encryption');
        $this->load->model('Employeemodel');
        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('dob', 'dob', 'required');
        $this->form_validation->set_rules('designation', 'designation', 'required');
        $this->form_validation->set_rules('degree', 'name of degree', 'required');
        $this->form_validation->set_rules('joindate', 'joindate', 'required');
        $this->form_validation->set_rules('experience', 'experience', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('employeeregistration');
        }
        $data["firstname"] = trim(htmlentities($this->input->post('firstname')));
        $data["lastname"] = trim(htmlentities($this->input->post('lastname')));
        $data["username"] = trim(htmlentities($this->input->post('username')));
        $password = md5(trim(htmlentities($this->input->post('password'))));
        $data["password"] = $password;
        $data["email"] = trim(htmlentities($this->input->post('email')));
        $data["dob"] = trim(htmlentities($this->input->post('dob')));
        $data["degree"] = trim(htmlentities($this->input->post('degree')));
        $data["designation"] = trim(htmlentities($this->input->post('designation')));
        $data["joindate"] = trim(htmlentities($this->input->post('joindate')));
        $data["experience"] = trim(htmlentities($this->input->post('experience')));
        $employeedata = $this->Employeemodel->addemployeedata($data);
        if($employeedata)
        {
            echo "inserted successfully";
        }
        else
        {
            echo "failed to insert";
        }
 

    }

    public function employeelogin()
    {
        $this->load->library('session');
		$this->load->helper('url');
        $this->load->model('Employeemodel');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('login');
        }
        $logindata["username"] = trim(htmlentities($this->input->post('username')));
        $logindata["password"] = md5(trim(htmlentities($this->input->post('password'))));
        $loginid = $this->Employeemodel->getemployeedata($logindata);
        if($loginid>0)
        {

			/*$logindata["data"] = $this->Employeemodel->getemployeedetails($loginid);
            $val = array('id'=>$loginid);
			$this->load->view('viewemployeedata',$logindata);*/
		$employeelogdata = array('id'=>$loginid,'is_logged_in'=>TRUE);
        $this->session->set_userdata('ci_session',$employeelogdata);
        $employeelogindata["data"] = $this->Employeemodel->getemployeedetails($loginid);
        $this->load->view('viewemployeedata',$employeelogindata);
			
        }
        else
        {
            echo "Invalid Login Details";
        }
        
    }
	
	public function editemployeedata()
	{
		$this->load->helper('url');
        $this->load->model('Employeemodel');
		$empid =  trim(htmlentities($this->input->get('id')));
		if(is_numeric($empid))
		{
		$empdata["editemployeedata"] = $this->Employeemodel->editemployeedata($empid);
		if(!empty($empdata))
		{
		$this->load->view('updateemployeedata',$empdata);
		}
		else
		{
			echo "Invalid request";
		}
		}
		else
		{
			echo "Id should be numeric";
		}
		
	}
	public function updateemployeedetails()
	{
		$this->load->model('Employeemodel');
		$this->load->library('upload');
        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('dob', 'dob', 'required');
        $this->form_validation->set_rules('designation', 'designation', 'required');
        $this->form_validation->set_rules('degree', 'name of degree', 'required');
        $this->form_validation->set_rules('joindate', 'joindate', 'required');
        $this->form_validation->set_rules('experience', 'experience', 'required');
		// $this->form_validation->set_rules('userfile', 'image', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('employeeregistration');
        }
        else
        {
		$updatedata["id"] = trim(htmlentities($this->input->post('updateid')));
        $updatedata["firstname"] = trim(htmlentities($this->input->post('firstname')));
        $updatedata["lastname"] = trim(htmlentities($this->input->post('lastname')));
        $updatedata["username"] = trim(htmlentities($this->input->post('username')));
        $updatedata["password"] = md5(trim(htmlentities($this->input->post('password'))));
        $updatedata["email"] = trim(htmlentities($this->input->post('email')));
        $updatedata["dob"] = trim(htmlentities($this->input->post('dob')));
        $updatedata["degree"] = trim(htmlentities($this->input->post('degree')));
        $updatedata["designation"] = trim(htmlentities($this->input->post('designation')));
        $updatedata["joindate"] = trim(htmlentities($this->input->post('joindate')));
        $updatedata["experience"] = trim(htmlentities($this->input->post('experience')));
		$this->upload->initialize($this->set_upload_options());
		$this->upload->do_upload('userfile');
        $updatedata["image"] = $_FILES["userfile"]["name"];		
        $employeedata = $this->Employeemodel->updateemployeedata($updatedata);
        if($employeedata)
        {
            echo "updated successfully";
            $this->getemployeedetails();
        }
        else
        {
            echo "failed to update";
        }
        }
	}
	
	private function set_upload_options()
	{
		$config=array();
		$config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['height'] = '768';
		$config['width'] = '568';
		$config["over_write"]=FALSE;
		return $config;
	}
	
	public function admin()
	{
		$this->load->view('admin/admin');
	}
	
	public function adminlogin()
    {
		$this->load->helper('url');
        $this->load->model('Employeemodel');
        $this->load->library('session');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('admin/admin');
        }
        else
        {
        $adminlogindata["username"] = trim(htmlentities($this->input->post('username')));
        $adminlogindata["password"] = md5(trim(htmlentities($this->input->post('password'))));
        $adminloginid = $this->Employeemodel->getadmindata($adminlogindata);
        if($adminloginid>0)
        {
           $adminlogdata = array('id'=>$adminloginid,'is_logged_in'=>TRUE);
           $this->session->set_userdata('ci_session',$adminlogdata);
           $adminlogin["admindata"] = $this->Employeemodel->getadmindetails($adminloginid);
           $this->load->view('admin/viewadmindata',$adminlogin);
        }
        else
        {
            $this->load->view('admin/admin');
        }
       }
        
    }
	
	public function editadmindata()
	{
		if($this->session->userdata('ci_session'))
        {
		$this->load->helper('url');
        $this->load->model('Employeemodel');
		$empid =  trim(htmlentities($this->input->get('empid')));
		if(is_numeric($empid))
		{
		$empdata["editemployeedata"] = $this->Employeemodel->editadmindata($empid);
		$this->load->view('admin/updateadmindata',$empdata);
		}
		else
		{
			echo "id should be numeric";
		}
		}
		
	}
	
		public function updateadmindetails()
	{
		$this->load->model('Employeemodel');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
       
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('employeeregistration');
        }
		$updateadmindata["id"] = trim(htmlentities($this->input->post('updateid')));
        $updateadmindata["username"] = trim(htmlentities($this->input->post('username')));
        $updateadmindata["password"] = md5(trim(htmlentities($this->input->post('password'))));
        $employeedata = $this->Employeemodel->updateadmindata($updateadmindata);
        if($employeedata)
        {
            echo "updated successfully";
        }
        else
        {
            echo "failed to update";
        }
	}
	
    public function getemployeedetails()
    {
        if($this->session->userdata('ci_session'))
        {
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
        $this->load->model('Employeemodel');
        //pagination design
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
        // $config['next_tag_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close']  = '</span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']  = '</span></li>';
        //pagination design ends
        
        
        $config['total_rows'] = $this->Employeemodel->getemployeerows();
        $config['base_url'] = base_url()."index.php/Employeecontroller/getemployeedetails";
        $config['per_page'] = 10;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
       

        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
        $employeeresult["empresult"] = $this->Employeemodel->getemployeesdata($config['per_page'],$page);
        if($employeeresult){
           
        $employeeresult["links"] = $this->pagination->create_links();
        $this->load->view('admin/viewemployeedata', $employeeresult);
        }
     }//session if ends
    }//function ends

    public function selectemployeedata()
    {
        if($this->session->userdata('ci_session'))
        {
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
        $this->load->model('Employeemodel');
        $employeeid = trim(htmlentities($this->input->get('id')));
        //pagination design
        $employeeresult["empresult"] = $this->Employeemodel->editemployeedata($employeeid);
        if($employeeresult)
        {
        $this->load->view('admin/viewindivudalemployee', $employeeresult);
        }
        }

        else
        {
            redirect('Employeecontroller/admin','refresh');
        }
    } //function ends

    public function deleteemployeedata()
	 {
		if($this->session->userdata('ci_session'))
        {
        $this->load->model('Employeemodel');
        $deleteid = trim(htmlentities($this->input->get('id')));
        $deletearray = array("id"=>$deleteid);
        $deleteresult = $this->Employeemodel->deleteemployeedata($deletearray);
        if($deleteresult)
        {
        $this->getemployeedetails();
        }
        else
        {
            echo "delete was un successfull";
        }
		}

     }

     public function employeelogout()
     {
         $this->session->unset_userdata('ci_session');
         redirect('Employeecontroller','refresh');
     }
	 
	 public function adminlogout()
     {
         $this->session->unset_userdata('ci_session');
         redirect('Employeecontroller/admin','refresh');
     }



}
?>
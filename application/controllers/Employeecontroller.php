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
            echo json_encode($employeedata);
            //echo "inserted successfully";
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
        if($this->session->userdata('ci_session'))
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
        }//session if ends
        else
        {
            redirect('Employeecontroller/index');
        }
		
	}
	public function updateemployeedetails()
	{
        if($this->session->userdata('ci_session'))
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
            redirect('/employeeregister');
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
           
        }
        else
        {
            echo "failed to update";
        }
        }
        }//session if ends
        else
        {
            redirect('Employeecontroller/index');
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
    
    public function checkUsername()
   {
        $this->load->model('Employeemodel');
        $username = trim(htmlentities($this->input->post('username')));
        $employeedata = $this->Employeemodel->getUsername($username);
        echo $employeedata;
        if($employeedata == "1")
        {
            return json_encode($employeedata);
        //echo json_encode($employeedata);
        }
        // if($this->Employeemodel->getUsername($_POST['username']))
        // {
        // echo '<label class="text-danger"><span><i class="fa fa-times" aria-hidden="true">
        // </i> This user is already registered</span></label>';
        // }
        // else
        // {
        // echo '<label class="text-success"><span><i class="fa fa-check-circle-o" aria-hidden="true"></i> Username is available</span></label>';
        // }
    }


	
   

     public function employeelogout()
     {
         $this->session->unset_userdata('ci_session');
         redirect('Employeecontroller','refresh');
     }
	 
	 



}
?>
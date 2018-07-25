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
        $this->load->helper('enc_dec');
        // $this->load->helper('custom');
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
        
        //$data["password"] = encrypt_data(trim(htmlentities($this->input->post('password'))));
        // echo $data["password"];
        // echo "<br>";
        // $decryptpassword = decrypt_data($data["password"]);
        // echo $decryptpassword;
        // exit();
       
        $data["password"] = encrypt_data(trim(htmlentities($this->input->post('password'))));
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
            return true;
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
        
        
        $logindata["password"] = encrypt_data(trim(htmlentities($this->input->post('password'))));
        
        
        $userdata = $this->Employeemodel->getemployeedata($logindata);
        $dbpassword = $userdata[0]['password'];
        $decryptedpassword = decrypt_data($dbpassword);
        $loginpassword = decrypt_data($logindata["password"]);
        
        if($decryptedpassword == $loginpassword)
        {
            $loginid = $userdata[0]["id"];

            if(strlen($loginid)>0)
            {
                $employeelogdata = array('id'=>$loginid,'is_logged_in'=>TRUE);
                $this->session->set_userdata('ci_session',$employeelogdata);
               // $employeelogindata["data"] = $this->Employeemodel->getemployeedetails($loginid);
                echo json_encode($employeelogdata);
                return true;
            //  return json_encode(array("success" => "User Login"));
            }
           
        }
        else
        {
           echo  json_encode(array("error" => "User credentials not matching"));
           return false;
        }
 
    }
	
	public function editemployeedata()
	{
        if($this->session->userdata('ci_session'))
        {
            $data[] = $this->session->userdata('ci_session');
            $empid = $data[0]["id"];
            $this->load->helper('url');
            $this->load->model('Employeemodel');
            //$empid =  trim(htmlentities($this->input->get('id')));
        
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
		}// is numeric ends
		else
		{
			echo "Id should be numeric";
        }
        }//session if ends
        else
        {
            redirect('Employeecontroller');
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
            //$this->form_validation->set_rules('password', 'Password', 'required');
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
            echo "<script>window.history.back();</script>";
        }
        else
        {
            echo "failed to update";
        }
        }//else ends
        }//session if ends
        else
        {
            redirect('Employeecontroller');
        }
	}//function ends
	
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
        else
        {
            return $employeedata;
        }
    }

    public function viewemployeedata()
    {
        if($this->session->userdata('ci_session'))
        {
            $data[] = $this->session->userdata('ci_session');
            $id = $data[0]["id"];
            $this->load->model('Employeemodel');
            //$id = trim(htmlentities($this->input->get('id')));
            $employeelogindata["data"] = $this->Employeemodel->getemployeedetails($id);
            $this->load->view('viewemployeedata',$employeelogindata);
        }
        else
        {
            redirect('Employeecontroller');
        }
        
    }

     public function employeelogout()
     {
         $this->session->unset_userdata('ci_session');
         redirect('Employeecontroller','refresh');
     }
	 
}
?>
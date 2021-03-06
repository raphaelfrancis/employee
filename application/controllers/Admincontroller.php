<?php
class Admincontroller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->load->library("session");
    }

    public function index()
    {
        $this->load->view('admin');
    }

	public function adminupdateemployeedata()
	{
        if($this->session->userdata('ci_session'))
        {
            
                $this->load->library('form_validation');
                $this->load->model('Adminmodel');
            // $this->load->library('encryption');
            // $this->load->library('upload');
               
                $this->form_validation->set_rules('firstname', 'firstname', 'required');
                $this->form_validation->set_rules('lastname', 'lastname', 'required');
                
                $this->form_validation->set_rules('username', 'username', 'required');
                $this->form_validation->set_rules('password', 'password', 'required');
                $this->form_validation->set_rules('email', 'email', 'required');
                $this->form_validation->set_rules('dob', 'dob', 'required');
                $this->form_validation->set_rules('degree', 'degree', 'required');
                $this->form_validation->set_rules('designation', 'designation', 'required');
                $this->form_validation->set_rules('joindate', 'joindate', 'required');
                $this->form_validation->set_rules('userfile', 'userfile', 'required');
                // $this->form_validation->set_rules('designation', 'designation', 'required');
                // $this->form_validation->set_rules('degree', ' degree', 'required');
                // $this->form_validation->set_rules('joindate', 'joindate', 'required');
                // $this->form_validation->set_rules('experience', 'experience', 'required');
                // $this->form_validation->set_rules('userfile', 'image', 'required');
                
                if ($this->form_validation->run() == FALSE)
                {
                    //redirect('Admincontroller/admin');
                    $errors = validation_errors();
                    echo json_encode(array("error" => "validation failed"));
                }
                else
                {
                    // $testdata = $this->input->post('lastname');
                    // $newdata =array("firstname" =>$testdata);
                    // echo json_encode($newdata);
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
                    echo json_encode($updatedata);
                    $employeedata = $this->Adminmodel->updateemployeedata($updatedata);
                    if($employeedata)
                     {
                   
                     return true;
                    $this->getemployeedetails();
                     }
                    // else
                    // {
                    //     echo "failed to update";
                    //     return false;
                    // }
                }//else ends 
            //is_ajax_request() ends
        }//session if ends
            else
            {
                redirect('Admincontroller/admin');
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
            $this->load->model('Adminmodel');
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
            $adminlogindata["password"] = trim(htmlentities($this->input->post('password')));
            $adminloginid = $this->Adminmodel->getadmindata($adminlogindata);

        if($adminloginid>0)
        {
		   echo json_encode($adminloginid);
           $adminlogdata = array('id'=>$adminloginid,'is_logged_in'=>TRUE);
           $this->session->set_userdata('ci_session',$adminlogdata);
           //$adminlogin["admindata"] = $this->Adminmodel->getadmindetails($adminloginid);
           //$this->load->view('admin/viewadmindata',$adminlogin);
		   return true;
        }
        else
        {
			return false;
            $this->load->view('admin/admin');
        }
        }//else ends
        
        
    }
	
	public function editadmindata()
	{
		if($this->session->userdata('ci_session'))
        {
            $this->load->helper('url');
            $this->load->model('Adminmodel');
            $empid =  trim(htmlentities($this->input->get('empid')));
		if(is_numeric($empid))
		{
            $empdata["editemployeedata"] = $this->Adminmodel->editadmindata($empid);
            $this->load->view('admin/updateadmindata',$empdata);
		}
		else
		{
			echo "id should be numeric";
		}
        }//session if ends
        else
        {
            // $this->load->view('admin/admin');
            redirect('Admincontroller/admin');
        }
	}
	
		public function updateadmindetails()
	{
        if($this->session->userdata('ci_session'))
        {
            $this->load->model('Adminmodel');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('admin/admin');
        }

        else
        {
            $updateadmindata["id"] = trim(htmlentities($this->input->post('updateid')));
            $updateadmindata["username"] = trim(htmlentities($this->input->post('username')));
            $updateadmindata["password"] = md5(trim(htmlentities($this->input->post('password'))));
            $employeedata = $this->Adminmodel->updateadmindata($updateadmindata);
        if($employeedata)
        {
            $this->getemployeedetails();
        }
        else
        {
            echo "failed to update";
        }
        }
        }//session if ends
        else
        {
            //$this->load->view('admin/admin');
            redirect('Admincontroller/admin');
        }
	}
	
    public function getemployeedetails()
    {
        if($this->session->userdata('ci_session'))
        {
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
        $this->load->model('Adminmodel');
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
        
        
        $config['total_rows'] = $this->Adminmodel->getemployeerows();
        $config['base_url'] = base_url()."index.php/Employeecontroller/getemployeedetails";
        $config['per_page'] = 10;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
       

        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
        $employeeresult["empresult"] = $this->Adminmodel->getemployeesdata($config['per_page'],$page);
        if($employeeresult){
           
        $employeeresult["links"] = $this->pagination->create_links();
        $this->load->view('admin/viewemployeedata', $employeeresult);
        }
     }//session if ends
     else
        {
            redirect('Admincontroller/admin');
        }
    }//function ends

    public function selectemployeedata()
    {
        if($this->session->userdata('ci_session'))
        {
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
        $this->load->model('Adminmodel');
        $employeeid = trim(htmlentities($this->input->get('id')));
        //pagination design
        $employeeresult["empresult"] = $this->Adminmodel->editemployeedata($employeeid);
        if($employeeresult)
        {
        $this->load->view('admin/viewindivudalemployee', $employeeresult);
        }
        else
        {
            redirect('Admincontroller/admin');
        }
        }//session if ends
        else
        {
            redirect('Admincontroller/admin');
        }
    } //function ends

    public function deleteemployeedata()
	 {
		if($this->session->userdata('ci_session'))
        {
        $this->load->model('Adminmodel');
        $deleteid = trim(htmlentities($this->input->get('id')));
        $deletearray = array("id"=>$deleteid);
        $deleteresult = $this->Adminmodel->deleteemployeedata($deletearray);
        if($deleteresult)
        {
        $this->getemployeedetails();
        }
        else
        {
            echo "delete was un successfull";
        }
        }//session if ends
        else
        {
            redirect('Admincontroller/admin');
        }

     }

     public function editemployeedata()
	{
        if($this->session->userdata('ci_session'))
        {
		$this->load->helper('url');
        $this->load->model('Adminmodel');
		$empid =  trim(htmlentities($this->input->get('id')));
		if(is_numeric($empid))
		{
		$empdata["editemployeedata"] = $this->Adminmodel->editemployeedata($empid);
		if(!empty($empdata))
		{
		$this->load->view('admin/updateadminemployeedata',$empdata);
		}
		else
		{
			echo "Invalid request";
		}
		} //is_numeric id ends
		else
		{
			echo "Id should be numeric";
        }
        }//session if ends
        else
        {
            redirect('Admincontroller/admin');
        }
		
	}
	
	public function viewadmindata()
    {
        if($this->session->userdata('ci_session'))
        {
            $this->load->model('Adminmodel');
            $id = trim(htmlentities($this->input->get('id')));
            $adminlogindata["data"] = $this->Adminmodel->getadmindetails($id);
            $this->load->view('admin/viewadmindata',$adminlogindata);
        }
        else
        {
            redirect('Admincontroller/index');
        }
        
    }
    public function testupdate()
    {
		$this->load->library('upload');
        $this->load->model('Adminmodel');
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
		$updatedata["image"] = trim(htmlentities($this->input->post('userfile')));
        $this->upload->initialize($this->set_upload_options());
		$this->upload->do_upload('userfile');
        $employeedata = $this->Adminmodel->updateemployeedata($updatedata);
        if($employeedata)
        {
            echo json_encode( $updatedata);
            return true;
        }
        else
        {
            echo json_encode( $updatedata);
            return false;
        }
    }
    

     
	 
	 public function adminlogout()
     {
         $this->session->unset_userdata('ci_session');
         redirect('Admincontroller/admin','refresh');
     }



}
?>
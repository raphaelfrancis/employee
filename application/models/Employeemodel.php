<?php
class Employeemodel extends CI_Model
{
    public function addemployeedata($data)
    {
        $this->load->database();
        date_default_timezone_set('Asia/Kolkata');
        $date = date("Y-m-d H:i:s");
        $data["createddate"] = $date;
        $data["status"] = '1';
        $insertdata = $this->db->insert('employeedata',$data);
        if($insertdata)
        {
            return $insertdata;
        }

    }

    public function getemployeedata($logindata)
    {
        $this->load->database();
        $username = $logindata["username"];
        $password = $logindata["password"];
        $this->db->where('username', $username);  
        $this->db->where('password', $password);  
        $query = $this->db->get('employeedata');  
        //SELECT * FROM users WHERE username = '$username' AND password = '$password'  
        if($query->num_rows() > 0)  
        {  
            $qu = $query->row();
            return $qu->id;  
        }  
        else  
        {  
            return false;       
        }  
    }
	
	public function getemployeedetails($loginid)
	{
		
		$this->load->database();
        $this->db->select('*');  
        $this->db->from('employeedata');
        $this->db->where('id',$loginid);  		
        $query = $this->db->get(); 
		return $query->result();
	}
	
	public function editemployeedata($empid)
	{
		$this->load->database();
        $this->db->select('*');  
        $this->db->from('employeedata');
        $this->db->where('id',$empid);  		
        $editdata = $this->db->get(); 
		return $editdata->result();
	}
	
	public function updateemployeedata($updatedata)
	{
		$this->load->database();
        date_default_timezone_set('Asia/Kolkata');
        $updatedate = date("Y-m-d H:i:s");
        $updatedata["updateddate"] = $updatedate;
		$updateid = $updatedata["id"];
        $updatedata["status"] = '1';
        $this->db->where('id',$updateid);
        $updatedate = $this->db->update('employeedata',$updatedata);
		return $updatedata;
	}
	
	public function getadmindata($logindata)
    {
        $this->load->database();
        $username = $logindata["username"];
        $password = $logindata["password"];
        $this->db->where('username', $username);  
        $this->db->where('password', $password);  
        $query = $this->db->get('admin');  
        //SELECT * FROM users WHERE username = '$username' AND password = '$password'  
        if($query->num_rows() > 0)  
        {  
            $qu = $query->row();
            return $qu->id;  
        }  
        else  
        {  
            return false;       
        }  
    }
	
	public function getadmindetails($adminloginid)
	{
		$this->load->database();
        $this->db->select('*');  
        $this->db->from('admin');
        $this->db->where('id',$adminloginid);  		
        $editdata = $this->db->get(); 
		return $editdata->result();
		
	}
	
	public function editadmindata($adminid)
	{
		$this->load->database();
        $this->db->select('*');  
        $this->db->from('admin');
        $this->db->where('id',$adminid);  		
        $editdata = $this->db->get(); 
		return $editdata->result();
	}
	public function updateadmindata($updateadmindata)
	{
		$this->load->database();
        $updateadminid = $updateadmindata["id"];
        $this->db->where('id',$updateadminid );
        $updatedata = $this->db->update('admin',$updateadmindata);
		return $updatedata;
    }
    
    public function getemployeesdata($limit,$offset)
    {
         $this->load->database();
         $status = "1";
         $this->db->SELECT("*");
         $this->db->FROM('employeedata');
         $this->db->where('status',$status);
         $this->db->LIMIT($limit,$offset);
         $query = $this->db->get();    
         return $query->result_array();
    }

    public function getemployeerows()
    {
        $this->load->database();
        $status = "1";
        $numberofrows = $this->db->where(['status'=>$status])->from("employeedata")->count_all_results();
        //$numberofrows = $this->db->count_all_results('employeedata');
        return $numberofrows;
    }

    public function deleteemployeedata($deletearray)
	{
        $this->load->database();
        $deleteid = $deletearray["id"];
        echo $deleteid;
        $status = "0";
        $this->db->set('status',$status); //value that used to update column  
        $this->db->where('id', $deleteid); //which row want to upgrade  
        $deleteemployeedata = $this->db->update('employeedata'); 
        echo $deleteemployeedata;
        return $deleteemployeedata;
	}
}
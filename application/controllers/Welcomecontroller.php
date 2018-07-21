<?php defined('BASEPATH') or exit('No direct script access allowed');
class Welcomecontroller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');     
    }
    public function index()
    {
        $this->load->view('imageupload');
    }
    // public function view($id)
    // {
    // 	$this->load->model('image_model');
    // 	$data['image'] = $this->image_model->get($id);
    // 	$this->load->view('welcome_result', $data);
    // }
    public function do_upload()
    {
        $config['upload_path']   = './images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 1000;
        $config['max_width']     = 1024;
        $config['max_height']    = 768;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('userfile')) {
            $error = $this->upload->display_errors();
            echo json_encode(array('status' => false, 'error' => $error));
        } else
           {
            $email =  trim(htmlentities($this->input->post('email')));
            //$this->load->model('image_model');
            $upload = $this->upload->data();
            $data = array(
                'filename'   => $upload['file_name'],
                'created_at' => date("Y-m-d"),
                'email'=>$email
            );
            echo json_encode($data);
            return true;
            // $id = $this->image_model->insert($data);
            // if ($id) {
            //     echo json_encode(array('status' => true, 'id' => $id));
            // } else {
            //     echo json_encode(array('status' => false, 'error' => 'Failed insert image'));
            //     unlink('./uploads/'.$data['filename']);
            // }
        }
    }
}

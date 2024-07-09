<?php

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('EmployeeModel');
        $this->load->model('DepartementModel'); // Pastikan model ini ada
        $this->load->library('form_validation');
    }

    public function index($nama = '')
    {
        $data['judul'] = 'Halaman Home';
        $data['nama'] = $nama;
        $data['departments'] = $this->DepartementModel->getAllDepartements();


        $this->form_validation->set_rules('first_name', 'Frist Nama', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');
        $this->form_validation->set_rules('hire_date', 'Hire Date', 'required');
        $this->form_validation->set_rules('job_title', 'Job Title', 'required');
        $this->form_validation->set_rules('department_id', 'Department', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('content/header', $data);
            $this->load->view('home/index');
            $this->load->view('content/footer');
        } else {
            $this->EmployeeModel->addEmployee();
            $this->session->set_flashdata('flash', 'Employee added successfully');
            redirect('home');
        }
    }
}

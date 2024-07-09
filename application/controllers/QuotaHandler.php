<?php

class QuotaHandler extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model(['EmployeeModel', 'QuotaModel']);
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $data['judul'] = 'Add Quota Feature';
        $data['quotas'] = $this->QuotaModel->getQuotaEmployees();
        $data['employees'] = $this->EmployeeModel->getAllEmployees();
        $data['employees'] = $this->EmployeeModel->getEmployeesWithoutQuota();

        $this->form_validation->set_rules('employee_id', 'Employee', 'required');
        $this->form_validation->set_rules('year', 'Year', 'required|numeric');
        $this->form_validation->set_rules('total_days', 'Total Days', 'required|numeric');
        $this->form_validation->set_rules('used_days', 'Used Days', 'required|numeric');


        if ($this->form_validation->run() == false) {
            $this->load->view('content/header', $data);
            $this->load->view('quota/index', $data);
            $this->load->view('content/footer');
        } else {
            $this->QuotaModel->addQuota();
            $this->session->set_flashdata('flash', 'Quota added successfully');
            redirect('QuotaHandler');
        }
    }
}

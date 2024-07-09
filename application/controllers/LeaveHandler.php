<?php

class LeaveHandler extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model(['LeaveModel', 'EmployeeModel', 'QuotaModel']);
    }

    public function index()
    {
        $data['judul'] = 'Leave Feature';
        $data['employees'] = $this->EmployeeModel->getEmployeesWithLeaveQuota();
        $data['quotas'] = $this->QuotaModel->getQuotaEmployees();

        $this->form_validation->set_rules('employee_id', 'Employee', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required|callback_validate_start_date');
        $this->form_validation->set_rules('end_date', 'End Date', 'required|callback_validate_date_order');
        $this->form_validation->set_rules('location', 'Location');

        if ($this->form_validation->run() == false) {
            $this->load->view('content/header', $data);
            $this->load->view('leave/index', $data);
            $this->load->view('content/footer');
        } else {
            // Mengambil employee_id, start_date, dan end_date dari pengiriman formulir
            $employee_id = $this->input->post('employee_id');
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');

            // Dapatkan tahun dari start_date untuk digunakan dalam pengecekan Leave Quota
            $year = date('Y', strtotime($start_date));
            // Mengambil Leave Quota untuk karyawan pada tahun tertentu
            $quota = $this->LeaveModel->getLeaveQuota($employee_id, $year);
            // Hitung jumlah hari cuti antara start_date dan end_date
            $leave_days = $this->LeaveModel->calculateLeaveDays($start_date, $end_date);
            // Periksa apakah Leave Quota tersedia dan apakah total_days dalam Leave Quota mencukupi untuk cuti yang diminta
            if ($quota && ($quota['total_days']) >= $leave_days) {
                $this->LeaveModel->addLeave();
                $this->session->set_flashdata('flash', 'Successfully added');
                redirect('leaveHandler/getAllLeaves');
            } else {
                // Quota Leave tidak mencukupi
                $this->session->set_flashdata('error', 'Not enough leave quota available.');
                redirect('leaveHandler');
            }

            // Check Quota sebelum menambahkan quota cuti
            if ($this->LeaveModel->checkLeaveQuota($employee_id, $start_date, $end_date)) {
                $this->LeaveModel->addLeave();
                // update quota cuti
                $this->LeaveModel->updateLeaveQuota($employee_id, $start_date, $end_date);

                $this->session->set_flashdata('flash', 'Successfully added');
                redirect('leaveHandler/index');
            } else {
                $this->session->set_flashdata('error', 'Not enough leave quota available.');
                redirect('leaveHandler/index');
            }
        }
    }


    // Validasi end_date
    public function validate_date_order($date)
    {
        $start_date = $this->input->post('start_date');
        // Fungsi strtotime digunakan untuk mengubah format tanggal menjadi timestamp 
        if (strtotime($date) < strtotime($start_date)) {
            $this->form_validation->set_message('validate_date_order', 'The End Date must be after the Start Date');
            return FALSE;
        }
        return TRUE;
    }

    // Validasi start_date
    public function validate_start_date($start_date)
    {
        $current_date = date('Y-m-d');

        if ($start_date >= $current_date) {
            return true;
        } else {
            $this->form_validation->set_message('validate_start_date', 'The {field} must be today or a future date.');
            return false;
        }
    }

    public function getAllLeaves()
    {
        $data['judul'] = 'Daftar Leaves';
        $data['leaves'] = $this->LeaveModel->getLeaves();
        $this->load->view('content/header', $data);
        $this->load->view('leave/get_leave', $data);
        $this->load->view('content/footer');
    }
}

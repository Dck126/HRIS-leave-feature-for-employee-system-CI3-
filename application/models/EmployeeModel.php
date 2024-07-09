<?php

class EmployeeModel extends CI_model
{

    public function addEmployee()
    {

        $data = [
            "first_name" => $this->input->post('first_name', true),
            "last_name" => $this->input->post('last_name', true),
            "email" => $this->input->post('email', true),
            "phone" => $this->input->post('phone', true),
            "hire_date" => $this->input->post('hire_date', true),
            "job_title" => $this->input->post("job_title", true),
            "department_id" => $this->input->post("department_id", true)
        ];

        $this->db->insert('Employees', $data);
    }

    public function getAllEmployees()
    {
        return $this->db->get('Employees')->result_array();
    }

    // Fungsi untuk memvalidasi, hanya karyawan yang memiliki quota yang bisa mengajukan permintaan cuti
    public function getEmployeesWithLeaveQuota()
    {
        $this->db->select('Employees.*');
        $this->db->from('Employees');
        $this->db->join('LeaveQuotas', 'Employees.id = LeaveQuotas.employee_id');
        $this->db->group_by('Employees.id');
        return $this->db->get()->result_array();
    }

    // Fungsi untuk memvalidasi, karyawan yang sudah memiliki Quota
    public function getEmployeesWithoutQuota()
    {
        $this->db->select('Employees.*');
        $this->db->from('Employees');
        // LEFT JOIN mengembalikan semua rekaman dari Employees tabel dan rekaman yang cocok dari tabel LeaveQuotas.
        $this->db->join('LeaveQuotas', 'Employees.id = LeaveQuotas.employee_id', 'left');
        // Hanya menampilkan rekaman dari Employees tabel yang tidak ada rekaman terkaitnya di tabel LeaveQuotas.
        $this->db->where('LeaveQuotas.employee_id IS NULL');
        return $this->db->get()->result_array();
    }
}

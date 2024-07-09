<?php

class QuotaModel extends CI_model
{

    public function addQuota()
    {

        $data = [
            "employee_id" => $this->input->post("employee_id", true),
            "year" => $this->input->post('year', true),
            "total_days" => $this->input->post('total_days', true),
            "used_days" => $this->input->post("used_days", true),
        ];

        $this->db->insert('LeaveQuotas', $data);
    }

    public function getQuotaEmployees()
    {

        $this->db->select('LeaveQuotas.*, Employees.email as employee_email');
        $this->db->from('LeaveQuotas');
        $this->db->join('Employees', 'LeaveQuotas.employee_id = Employees.id');
        return $this->db->get()->result_array();
        // return $this->db->get('LeaveQuotas')->result_array();
    }
}

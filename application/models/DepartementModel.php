<?php
class DepartementModel extends CI_Model
{
    public function getAllDepartements()
    {
        return $this->db->get('Departments')->result_array();
    }
}

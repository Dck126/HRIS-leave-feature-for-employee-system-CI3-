<?php

class LeaveModel extends CI_model
{

    public function addLeave()
    {
        $employee_id = $this->input->post("employee_id", true);
        $start_date = $this->input->post('start_date', true);
        $end_date = $this->input->post('end_date', true);
        $location = $this->input->post("location", true);
        $status = "Pending"; // default status,

        // Calculate leave days
        $leave_days = $this->calculateLeaveDays($start_date, $end_date);

        // Update LeaveQuotas
        $year = date('Y', strtotime($start_date));
        $this->updateLeaveQuotas($employee_id, $year, $leave_days);

        // Insert into Leaves table
        $data = [
            "employee_id" => $employee_id,
            "start_date" => $start_date,
            "end_date" => $end_date,
            "location" => $location,
            "status" => $status
        ];

        $this->db->insert('Leaves', $data);
    }

    public function getLeaves()
    {
        $this->db->select('Leaves.*, Employees.email as employee_email');
        $this->db->from('Leaves');
        $this->db->join('Employees', 'Leaves.employee_id = Employees.id');
        return $this->db->get()->result_array();
    }

    public function getLeaveQuota($employee_id, $year)
    {
        $this->db->where('employee_id', $employee_id);
        $this->db->where('year', $year);
        return $this->db->get('LeaveQuotas')->row_array();
    }

    // Menghitung jumlah hari antara dua tanggal, $start_date & $end_date
    public function calculateLeaveDays($start_date, $end_date)
    {
        // Fungsi DateTime digunakan untuk mengonversi string tanggal ($start_date dan $end_date) menjadi objek DateTime
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);
        // Memodifikasi tanggal akhir ($end_date) dengan menambahkan +n hari
        $end->modify('+1 day'); // Include the end date

        $leave_days = 0;

        // Membuat Waktu Periode yang merupakan objek berulang yang memuat setiap hari dari $start hingga $end
        // P1D menentukan bahwa setiap langkah dalam periode adalah satu hari.
        $period = new DatePeriod($start, new DateInterval('P1D'), $end);
        foreach ($period as $date) {
            // $date->format('N')mengembalikan hari dalam seminggu
            // Memeriksa apakah hari bukan Sabtu (6) atau Minggu (7)
            if ($date->format('N') < 6) {
                $leave_days++;
            }
        }

        return $leave_days;
    }


    // Mengecek apakah seorang karyawan memiliki $total_days yang cukup untuk mengajukan cuti.
    public function checkLeaveQuota($employee_id, $start_date, $end_date)
    {
        // Hitung hari cuti dengan params $start_date & $end_date
        $leave_days = $this->calculateLeaveDays($start_date, $end_date);

        // Dapatkan kuota cuti untuk tahun saat ini
        $year = date('Y', strtotime($start_date));
        $quota = $this->getLeaveQuota($employee_id, $year);

        // Apakah selisih antara total_days dan used_days, 
        // pada $quota lebih besar atau sama dengan $leave_days (jumlah hari cuti yang diminta)
        return $quota && ($quota['total_days']) >= $leave_days ? true : false;
    }


    public function updateLeaveQuotas($employee_id, $year, $leave_days)
    {
        $quota = $this->getLeaveQuota($employee_id, $year);

        if ($quota) {
            $new_used_days = $quota['used_days'] + $leave_days;
            $new_total_days = $quota['total_days'] - $leave_days;
            // Update LeaveQuotas
            $this->db->where('employee_id', $employee_id);
            $this->db->where('year', $year);
            $this->db->set('total_days', $new_total_days);
            $this->db->set('used_days', $new_used_days);
            $this->db->update('LeaveQuotas');
        }
    }
}

<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Absensi_apel extends CI_Model
{
    public function getDataToday($today, $id)
    {
        $this->db->where('tgl_apel', $today);
        $this->db->where('user_id', $id);
        return $this->db->get('absen_apel')->row_array();
    }

    public function insertApel($id)
    {
        $data = [
            'user_id' => $id,
            'tgl_apel' => date('Y-m-d')
        ];
        $this->db->insert('absen_apel', $data);
    }

    public function getApelById($id_user, $bulan, $tahun)
    {
        $this->db->join('user', 'a.user_id = user.id');
        $this->db->where('user_id', $id_user);
        $this->db->where("DATE_FORMAT(tgl_apel, '%m') = ", $bulan);
        $this->db->where("DATE_FORMAT(tgl_apel, '%Y') = ", $tahun);
        $result = $this->db->get('absen_apel a');
        return $result->result_array();
    }
}

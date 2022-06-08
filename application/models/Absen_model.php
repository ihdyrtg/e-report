<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Absen_model extends CI_Model
{
    public function getAbsen($id_user, $bulan, $tahun)
    {
        $this->db->select("DATE_FORMAT(a.tgl, '%d-%m-%Y') AS tgl, a.waktu AS jam_masuk, (SELECT waktu FROM attendance al WHERE al.tgl = a.tgl AND user_id = '$id_user' AND al.keterangan != a.keterangan) AS jam_pulang");
        $this->db->where('user_id', $id_user);
        $this->db->where("DATE_FORMAT(tgl, '%m') = ", $bulan);
        $this->db->where("DATE_FORMAT(tgl, '%Y') = ", $tahun);
        $this->db->group_by("tgl");
        $result = $this->db->get('attendance a');
        return $result->result_array();
    }

    public function absen_harian_user($id)
    {
        $today = date('Y-m-d');
        $this->db->where('tgl', $today);
        $this->db->where('user_id', $id);
        $data = $this->db->get('attendance');
        return $data;
    }

    public function absenUser($id_user)
    {
        $today = date('Y-m-d');
        $this->db->where('tgl', $today);
        $this->db->where('user_id', $id_user);
        $data = $this->db->get('attendance');
        return $data;
    }
}

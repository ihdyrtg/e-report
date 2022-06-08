<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jam_model extends CI_Model
{
    public function getJam()
    {
        return $this->db->get('clock')->result_array();
    }

    public function getJamMasuk()
    {
        $this->db->where('id', 1);
        return $this->db->get('clock')->row_array();
    }

    public function getJamPulang()
    {
        $this->db->where('id', 2);
        return $this->db->get('clock')->row_array();
    }

    public function edit()
    {
        $data = [
            'start' => $this->input->post('start'),
            'finish' => $this->input->post('finish')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('clock', $data);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff_model extends CI_Model
{
    public function getPublisher()
    {
        $query = "SELECT * FROM `publisher` WHERE `is_active` = 1";
        return $this->db->query($query)->result_array();
    }

    public function get_publisher()
    {
        $query = "SELECT * FROM `publisher`";
        return $this->db->query($query)->result_array();
    }

    public function getNewspaper()
    {
        $query = "SELECT `newspaper`.*, `publisher`.`name`
                    FROM `newspaper` JOIN `publisher`
                    ON `newspaper`.`publisher_id` = `publisher`.`id`
                    ORDER BY `tgl_edisi` DESC
                    ";
        return $this->db->query($query)->result_array();
    }

    public function insertpublisher()
    {
        $data = [
            'name' => $this->input->post('publisher'),
            'is_active' => $this->input->post('is_active')
        ];
        $this->db->insert('publisher', $data);
    }

    public function insertnewspaper()
    {
        $data = [
            'publisher_id' => $this->input->post('penerbit'),
            'tgl_masuk' => $this->input->post('tgl_masuk'),
            'tgl_edisi' => $this->input->post('tgl_edisi'),
            'page' => $this->input->post('page'),
            'keterangan' => $this->input->post('keterangan')
        ];
        $this->db->insert('newspaper', $data);
    }

    public function editPublisher()
    {
        $data = [
            'name' => $this->input->post('publisher'),
            'is_active' => $this->input->post('is_active')
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('publisher', $data);
    }

    public function editNewspaper()
    {
        $data = [
            'publisher_id' => $this->input->post('publisher_id'),
            'tgl_masuk' => $this->input->post('tgl_masuk'),
            'tgl_edisi' => $this->input->post('tgl_edisi'),
            'page' => $this->input->post('page'),
            'keterangan' => $this->input->post('keterangan')
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('newspaper', $data);
    }
}

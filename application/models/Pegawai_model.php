<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{
    public function getPegawai()
    {
        $query = "SELECT * FROM `user` WHERE `user`.`role_id` = 3";
        return $this->db->query($query)->result_array();
    }

    public function findPegawai($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }

    public function getUser()
    {
        $query = "SELECT `user`.*, `user_role`.`role`
                    FROM `user` JOIN `user_role`
                    ON `user`.`role_id` = `user_role`.`id`
                    WHERE `user`.`role_id` != 1
                    ";
        return $this->db->query($query)->result_array();
    }
}

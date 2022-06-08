<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getRole()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function getRoleById($role_id)
    {
        return $this->db->get_where('user_role', ['id' => $role_id])->row_array();
    }

    public function getUser()
    {
        $query = "SELECT `user`.*, `user_role`.`role`
                    FROM `user` JOIN `user_role`
                    ON `user`.`role_id` = `user_role`.`id`
                    ";
        return $this->db->query($query)->result_array();
    }

    public function edit()
    {
        $data = [
            'role' => $this->input->post('role')
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_role', $data);
    }



    public function deleteRole($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
    }
}

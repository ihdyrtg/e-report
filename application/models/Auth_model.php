<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function insertData()
    {
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'image' => 'default.jpg',
            'role_id' => '3',
            'is_active' => '0',
            'date_created' => time()
        ];

        $this->db->insert('user', $data);
    }

    public function getByEmail($email)
    {
        return $this->db->get_where('user', ['email' => $email])->row_array();
    }
}

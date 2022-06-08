<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Menu_model', 'menu');
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->menu->getMenu();

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');
        $this->form_validation->set_rules('order', 'Order', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->menu->insertMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }

    public function editMenu($id)
    {
        $this->menu->edit($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The menu has been updated!</div>');
        redirect('menu');
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->menu->getMenu();
        $data['subMenu'] = $this->menu->getSubmenu();

        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('url', 'Url', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->menu->insertSubMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu added!</div>');
            redirect('menu/submenu');
        }
    }

    public function editSubmenu($id)
    {
        $this->menu->editSm($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The submenu has been updated!</div>');
        redirect('menu/submenu');
    }
}

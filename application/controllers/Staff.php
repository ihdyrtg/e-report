<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Staff_model', 'staff');
        $this->load->helper('tanggal');
    }

    public function index()
    {
        $data['title'] = 'Surat Kabar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['newspaper'] = $this->staff->getNewspaper();
        $data['publisher'] = $this->staff->getPublisher();

        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
        $this->form_validation->set_rules('tgl_edisi', 'Tanggal Edisi', 'required');
        $this->form_validation->set_rules('tgl_edisi', 'Tanggal Edisi', 'required');
        $this->form_validation->set_rules('page', 'Halaman', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('staff/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->staff->insertnewspaper();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Newspaper added!</div>');
            redirect('staff');
        }
    }

    public function editNewspaper($id)
    {
        $this->staff->editNewspaper($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The newspaper has been updated!</div>');
        redirect('staff');
    }

    public function publisher()
    {
        $data['title'] = 'Penerbit';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['publisher'] = $this->staff->get_publisher();

        $this->form_validation->set_rules('publisher', 'Penerbit', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('staff/publisher', $data);
            $this->load->view('templates/footer');
        } else {
            $this->staff->insertpublisher();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Publisher added!</div>');
            redirect('staff/publisher');
        }
    }

    public function editPublisher($id)
    {
        $this->staff->editPublisher($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The publisher has been updated!</div>');
        redirect('staff/publisher');
    }
}

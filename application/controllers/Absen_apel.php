<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen_apel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }

        $this->load->helper('tanggal');

        $this->load->model('Absensi_apel', 'absen_apel');
        $this->load->model('Pegawai_model', 'pegawai');
    }

    public function index()
    {
        $data['title'] = 'Absen Apel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('absen_apel/index', $data);
        $this->load->view('templates/footer');
    }

    public function absen($id)
    {
        $today = date('Y-m-d');
        $hadir = $this->absen_apel->getDataToday($today, $id);

        // cek absen apakah sudah ada
        if ($hadir) {
            $this->session->set_flashdata('message', 'Anda sudah absen');
            redirect('absen_apel');
        } else {
            // insert data
            $this->absen_apel->insertApel($id);
            $this->session->set_flashdata('message', 'Thank you!');
            redirect('absen_apel/riwatay_absen');
        }
    }

    public function riwayat_apel()
    {
        $data = $this->_detail_dataAbsensi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('absen_apel/riwayat_apel', $data);
        $this->load->view('templates/footer');
    }

    private function _detail_dataAbsensi()
    {
        $id_user = $this->session->userdata('id');
        $bulan = @$this->input->get('bulan') ? $this->input->get('bulan') : date('m');
        $tahun = @$this->input->get('tahun') ? $this->input->get('tahun') : date('Y');

        $data['title'] = 'Riwayat Absensi Apel';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['absen'] = $this->absen_apel->getApelById($id_user, $bulan, $tahun);
        $data['pegawai'] = $this->pegawai->findPegawai($id_user);
        $data['all_bulan'] = bulan();
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['hari'] = hari_bulan($bulan, $tahun);

        return $data;
    }
}

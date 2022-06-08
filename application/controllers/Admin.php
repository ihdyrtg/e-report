<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Admin_model', 'administrator');
        $this->load->model('Jam_model', 'jam');
        $this->load->model('Pegawai_model', 'pegawai');
        $this->load->model('Absen_model', 'absen');
        $this->load->helper('tanggal');
    }

    public function index()
    {
        $data['title'] = 'Jam Kerja';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jam'] = $this->jam->getJam();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('head-office/index', $data);
        $this->load->view('templates/footer');
    }

    public function editJam($id)
    {
        $this->jam->edit($id);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Waktu jam kerja telah diperbaharui!</div>');
        redirect('admin');
    }

    public function absensi()
    {
        $data['title'] = 'Absen Pegawai';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['pegawai'] = $this->pegawai->getPegawai();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('head-office/absensi', $data);
        $this->load->view('templates/footer');
    }

    public function detailAbsen()
    {
        $data = $this->_detail_dataAbsensi();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('head-office/detail-absensi', $data);
        $this->load->view('templates/footer');
    }

    public function exportPDF()
    {
        $this->load->library('pdf');
        $data = $this->_detail_dataAbsensi();
        $html_content = $this->load->view('head-office/print-pdf', $data, true);
        $filename = 'Absensi ' . $data['pegawai']['name'] . ' - ' . bulan($data['bulan']) . ' ' . $data['tahun'] . '.pdf';

        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        $this->pdf->stream($filename, ['Attachment' => 1]);
    }

    public function exportExcel()
    {
        include_once APPPATH . 'third_party/PHPExcel.php';
        $data = $this->_detail_dataAbsensi();
        $hari = $data['hari'];
        $absen = $data['absen'];
        $excel = new PHPExcel();

        $excel->getProperties()
            ->setCreator('Rizqi Nusabbih')
            ->setLastModifiedBy('Rizqi Nusabih')
            ->setTitle('Data Absensi')
            ->setSubject('Absensi')
            ->setDescription('Absensi ' . $data['pegawai']['name'] . ' bulan ' . bulan($data['bulan']) . ', ' . $data['tahun'])
            ->setKeyWords('data absen');

        $style_head = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
            ]
        ];

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
            ]
        ];

        $style_row = [
            'alignment' => [
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
            ]
        ];

        $style_row_libur = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => '343A40']
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF']
            ],
            'alignment' => [
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
            ]
        ];

        $style_row_tidak_masuk = [
            'fill' => [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => 'DC3545']
            ],
            'font' => [
                'color' => ['rgb' => 'FFFFFF']
            ],
            'alignment' => [
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'right' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                'left' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
            ]
        ];

        $style_telat = [
            'font' => [
                'color' => ['rgb' => 'DC3545']
            ]
        ];

        $style_lembur = [
            'font' => [
                'color' => ['rgb' => '28A745']
            ]
        ];

        $excel->setActiveSheetIndex(0)->setCellValue('A1', 'Data Absensi Bulan ' . bulan($data['bulan']) . ' ' . $data['tahun'] . ' - ' . $data['pegawai']['name']);
        $excel->getActiveSheet()->mergeCells('A1:D2');
        $excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_head);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', 'NO');
        $excel->setActiveSheetIndex(0)->setCellValue('B3', 'Tanggal');
        $excel->setActiveSheetIndex(0)->setCellValue('C3', 'Jam Masuk');
        $excel->setActiveSheetIndex(0)->setCellValue('D3', 'Jam Keluar');

        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);

        $numrow = 4;
        foreach ($hari as $i => $h) {
            $absen_harian = array_search($h['tgl'], array_column($absen, 'tgl')) !== false ? $absen[array_search($h['tgl'], array_column($absen, 'tgl'))] : '';

            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, ($i + 1));
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $h['hari'] . ', ' . $h['tgl']);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, is_weekend($h['tgl']) ? 'Libur Akhir Pekan' : check_jam(@$absen_harian['jam_masuk'], 'masuk', true)['text']);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, is_weekend($h['tgl']) ? 'Libur Akhir Pekan' : check_jam(@$absen_harian['jam_pulang'], 'pulang', true)['text']);

            if (check_jam(@$absen_harian['jam_masuk'], 'masuk', true)['status'] == 'telat') {
                $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_telat);
            }

            if (check_jam(@$absen_harian['jam_pulang'], 'pulang', true)['status'] == 'lembur') {
                $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_lembur);
            }

            if (is_weekend($h['tgl'])) {
                $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row_libur);
                $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row_libur);
                $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row_libur);
                $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row_libur);
            } elseif ($absen_harian == '') {
                $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row_tidak_masuk);
                $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row_tidak_masuk);
                $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row_tidak_masuk);
                $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row_tidak_masuk);
            } else {
                $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            }
            $numrow++;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Absensi ' . $data['pegawai']['name'] . ' - ' . bulan($data['bulan']) . ' ' . $data['tahun'] . '.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');

        exit;
    }

    private function _detail_dataAbsensi()
    {
        $id_user = @$this->uri->segment(3) ? $this->uri->segment(3) : $this->session->userdata('id');
        $bulan = @$this->input->get('bulan') ? $this->input->get('bulan') : date('m');
        $tahun = @$this->input->get('tahun') ? $this->input->get('tahun') : date('Y');

        $data['title'] = 'Detail Absen';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['absen'] = $this->absen->getAbsen($id_user, $bulan, $tahun);
        $data['pegawai'] = $this->pegawai->findPegawai($id_user);
        $data['all_bulan'] = bulan();
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['hari'] = hari_bulan($bulan, $tahun);

        return $data;
    }

    public function pegawai()
    {
        $data['title'] = 'Daftar Pegawai';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['User'] = $this->pegawai->getUser();
        $data['role'] = $this->administrator->getRole();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('head-office/pegawai', $data);
        $this->load->view('templates/footer');
    }
}

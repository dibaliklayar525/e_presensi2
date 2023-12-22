<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ModelAbsensi;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminController extends BaseController
{
    protected $UserModel;
    protected $ModelAbsensi;

    public function __construct()
    {
        if (session()->get('role') != "1") {
            echo 'Access denied';
            exit;
        }
        helper('form', 'url', 'file');
        $this->UserModel = new UserModel();
        $this->ModelAbsensi = new ModelAbsensi();
    }
    public function index()
    {
        $data = [
            'menu' => 'dashboard',
            'submenu' => '',
            'title' => 'Dashboard'
        ];
        return view("admin/dashboard", $data);
    }

    /*
    * --------------------------------------------------------------------
    * Admin (Kinerja Pegawai)
    * --------------------------------------------------------------------
    */

    public function kinerja()
    {
        $data = [
            'menu' => m1(),
            'submenu' => 'kinerja-pegawai',
            'title' => 'Kinerja Pegawai',
        ];
        return view("absensi/v_kinerja", $data);
    }

     /*
    * --------------------------------------------------------------------
    * Admin (Laporan Pegawai)
    * --------------------------------------------------------------------
    */

    # Laporan pegawai perbulan untuk admin 
    public function laporanPegawai()
    {
        $data = [
            'menu' => m1(),
            'submenu' => 'laporan-pegawai',
            'title' => 'Laporan Pegawai',
        ];
        return view("absensi/v_laporan_admin", $data);
    }

    # data laporan pegawai perbulan untuk admin
    public function dataLapPegawai()
    {
        if ($this->request->isAJAX() == true) {

            $awal_cuti = $this->request->getPost('tgl_awal');
            $akhir_cuti = $this->request->getPost('tgl_akhir');

            $awal_cuti = date_create_from_format('d-m-Y', $awal_cuti);
            $awal_cuti = date_format($awal_cuti, 'Y-m-d');
             $awal_cuti = strtotime($awal_cuti);
             
             $akhir_cuti = date_create_from_format('d-m-Y', $akhir_cuti);
             $akhir_cuti = date_format($akhir_cuti, 'Y-m-d');
             $akhir_cuti = strtotime($akhir_cuti);

            $haricuti = array();
            $sabtuminggu = array();

            $haricuti = array();
            $sabtuminggu = array();

             for ($i=$awal_cuti; $i <= $akhir_cuti; $i += (60 * 60 * 24)) {
                 if (date('w', $i) !== '0' && date('w', $i) !== '6') {
                     $haricuti[] = $i;
                 } else {
                     $sabtuminggu[] = $i;
                 }
             }

             $jumlah_cuti = count($haricuti);
             $jumlah_sabtuminggu = count($sabtuminggu);
             $abtotal = $jumlah_cuti + $jumlah_sabtuminggu;
             
            $data = [
                'databulanan' => $this->ModelAbsensi->laporan_absensi_kehadiran(date("Y-m-d",$awal_cuti), date("Y-m-d",$akhir_cuti)),
                'tgl_awal' => $awal_cuti,
                'tgl_akhir'=> $akhir_cuti,
                'jumlah_cuti'=> $jumlah_cuti,
                'jumlah_sabtuminggu'=> $jumlah_sabtuminggu,
                'abtotal'=> $abtotal
            ];
            $response = [
                'data' => view("absensi/v_laporan_admin_data", $data),
            ];
            echo json_encode($response);
        } else {
            $this->ajaxNotFound();
        }
    }

     # pdf data laporan pegawai perbulan untuk admin (versi php 7.4 ke atas) mpdf
     public function printbyId()
     {
        require '../vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();

        // Landscape orientation
        // $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
            $awal_cuti = $this->request->getPost('tgl_awal');
            $akhir_cuti = $this->request->getPost('tgl_akhir');

            $awal_cuti = date_create_from_format('d-m-Y', $awal_cuti);
            $awal_cuti = date_format($awal_cuti, 'Y-m-d');
             $awal_cuti = strtotime($awal_cuti);
             
             $akhir_cuti = date_create_from_format('d-m-Y', $akhir_cuti);
             $akhir_cuti = date_format($akhir_cuti, 'Y-m-d');
             $akhir_cuti = strtotime($akhir_cuti);

            $haricuti = array();
            $sabtuminggu = array();

            $haricuti = array();
            $sabtuminggu = array();

             for ($i=$awal_cuti; $i <= $akhir_cuti; $i += (60 * 60 * 24)) {
                 if (date('w', $i) !== '0' && date('w', $i) !== '6') {
                     $haricuti[] = $i;
                 } else {
                     $sabtuminggu[] = $i;
                 }
             }

             $jumlah_cuti = count($haricuti);
             $jumlah_sabtuminggu = count($sabtuminggu);
             $abtotal = $jumlah_cuti + $jumlah_sabtuminggu;

        $data = $this->ModelAbsensi->laporan_absensi_kehadiran(date("Y-m-d",$awal_cuti), date("Y-m-d",$akhir_cuti));
        $html = view('absensi/v_laporan_admin_pdf', 
        [
            'data' => $data, 
            'tgl_awal' => $awal_cuti,
            'tgl_akhir'=> $akhir_cuti,
            'jumlah_cuti'=> $jumlah_cuti,
            'jumlah_sabtuminggu'=> $jumlah_sabtuminggu,
            'abtotal'=> $abtotal
        ]);
        $mpdf->WriteHTML($html);
        # INLINE PREVIEW
        $mpdf->Output('laporan-absensi-pegawai' . '.pdf', \Mpdf\Output\Destination::DOWNLOAD);
        
     }

     # Excel data laporan (versi php 7.4 ke atas) PhpSpreadsheet
     public function exportExcel()
     {
        require '../vendor/autoload.php';
        $btnExport = $this->request->getPost('btnExport');

       if(isset($btnExport)) {
        $awal_cuti = $this->request->getVar('tgl_awal_ex');
        $akhir_cuti = $this->request->getVar('tgl_akhir_ex');

        $awal_cuti = date_create_from_format('d-m-Y', $awal_cuti);
        $awal_cuti = date_format($awal_cuti, 'Y-m-d');
        $awal_cuti = strtotime($awal_cuti);
             
        $akhir_cuti = date_create_from_format('d-m-Y', $akhir_cuti);
        $akhir_cuti = date_format($akhir_cuti, 'Y-m-d');
        $akhir_cuti = strtotime($akhir_cuti);

        $haricuti = array();
        $sabtuminggu = array();

        $haricuti = array();
        $sabtuminggu = array();

             for ($i=$awal_cuti; $i <= $akhir_cuti; $i += (60 * 60 * 24)) {
                 if (date('w', $i) !== '0' && date('w', $i) !== '6') {
                     $haricuti[] = $i;
                 } else {
                     $sabtuminggu[] = $i;
                 }
             }

        $jumlah_cuti = count($haricuti);
        $jumlah_sabtuminggu = count($sabtuminggu);
        $abtotal = $jumlah_cuti + $jumlah_sabtuminggu;

            $spreadsheet = new Spreadsheet();
            $activeWorksheet = $spreadsheet->getActiveSheet();
            $activeWorksheet->setCellValue('A1', 'Laporan Absensi Bulan '.date("d-m-Y", $awal_cuti).' s.d '.date("d-m-Y", $akhir_cuti).'');
            $activeWorksheet->mergeCells('A1:H1');
            $activeWorksheet->getStyle('A1')->getFont()->setBold(true);

        $data = $this->ModelAbsensi->laporan_absensi_kehadiran(date("Y-m-d",$awal_cuti), date("Y-m-d",$akhir_cuti));

        $no=1;
        $numRow=7;

            $activeWorksheet->setCellValue('A3', 'No');
            $activeWorksheet->setCellValue('B3', 'Nama');
            $activeWorksheet->setCellValue('C3', 'Jabatan');
            $activeWorksheet->setCellValue('D3', 'Kehadiran');
            $activeWorksheet->setCellValue('E3', 'Izin');
            $activeWorksheet->setCellValue('F3', 'Tidak Hadir');
            $activeWorksheet->setCellValue('G3', 'Absen Pagi');
            $activeWorksheet->setCellValue('H3', 'Absen Sore');
        
        foreach($data as $row):
            $activeWorksheet->setCellValue('A'. $numRow, $no);
            $activeWorksheet->setCellValue('B'. $numRow, $row['nama_user']);
            $activeWorksheet->setCellValue('C'. $numRow, $row['jabatan']);
            $activeWorksheet->setCellValue('D'. $numRow, $row['absen_sore']);
            $activeWorksheet->setCellValue('E'. $numRow, $row['izin']);
            $activeWorksheet->setCellValue('F'. $numRow, $row['sisa_tdk_hdr'] - $jumlah_sabtuminggu <=0 ? "0 (".$row['sisa_tdk_hdr'] - $jumlah_sabtuminggu.")" : $row['sisa_tdk_hdr'] - $jumlah_sabtuminggu);
            $activeWorksheet->setCellValue('G'. $numRow, $row['absen_user']);
            $activeWorksheet->setCellValue('H'. $numRow, $row['absen_sore']);
            $no++;
            $numRow++;
        endforeach;

            $activeWorksheet->getDefaultRowDimension()->setRowHeight(-1);
            $activeWorksheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            $activeWorksheet->setTitle(''.date("d-m-Y", $awal_cuti).' s.d '.date("d-m-Y", $akhir_cuti).'');

        header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition:attachment;filename="LaporanAbsensiBulanan.xlsx"');
        header('Cache-Control:max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
       }
        
     }

}
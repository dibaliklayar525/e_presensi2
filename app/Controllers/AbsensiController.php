<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Config\Services;
use App\Models\UserModel;
use App\Models\ModelAbsensi;

class AbsensiController extends BaseController
{
    protected $UserModel;
    protected $ModelAbsensi;

    public function __construct()
    {
        if (
            session()->get('role') != "2"  && session()->get('id_jabatan') != "27"
            && session()->get('id_jabatan') != "28"
        ) {
            echo 'Access denied';
            exit;
        }
        helper('form', 'url', 'file');
        $this->UserModel = new UserModel();
        $this->ModelAbsensi = new ModelAbsensi();
    }

    /*
    * --------------------------------------------------------------------
    * Control Absen
    * --------------------------------------------------------------------
    */

    // halaman presensi (absen)
    public function index()
    {
        # absen
        $presensi = $this->ModelAbsensi->check();
        $dcount = $this->ModelAbsensi->month()->get()->getNumRows();
        $dcount_izin = $this->ModelAbsensi->month_izin()->get()->getNumRows();
        # izin
        $check_izin = $this->ModelAbsensi->check_1();

        #tombol absen dan izin
        $btn = [
            'btn_absen' => '<a class="btn btn-outline btn-default" href="' . base_url("pegawai/absensi/absen") . '"><i class="fas fa-camera"></i> Absen </a>',
            'btn_izin' => '<a class="btn btn-outline btn-dark" data-toggle="modal" data-target="#izin"><i class="fas fa-clock-o"></i> Izin </a>',
            # btn jika sudah selesai izin (pegawai boleh absen kembali)
            'btn_izin_masuk' => '
            <div class="alert alert-info">
            <p>' . session()->get('nama_user') . ' Status izin akan di verifikasi oleh administrator. Konfirmasi masuk kembali dengan menekan tombol dibawah ini.</p>
            <a class="btn btn-outline btn-dark" id="upd"><i class="fas fa-edit"></i> Masuk kembali </a>
            </div>'
        ];

        // (a ? b : c) ? d : e` or `a ? b : (c ? d : e)

        $data = [
            # absen
            'title' => 'Absensi',
            'masuk' => !empty($presensi['absen_in']) ? $presensi['absen_in'] : '--:--',
            'pulang' => !empty($presensi['absen_out']) ? $presensi['absen_out'] : '--:--',
            'dcount' => !empty($dcount) ? $dcount : '0',
            'karyawan' => $this->ModelAbsensi->rank(),
            'history' => $this->ModelAbsensi->month()->get()->getResultArray(),

            # izin dan absen
            'dcount_izin' =>  !empty($dcount_izin) ? $dcount_izin : '0',
            'btn_izin' =>  empty($presensi) ? $btn['btn_izin'] : '',
            'btn_absen_and_izin' => @empty($check_izin) ? $btn['btn_absen'] : ($check_izin['keterangan'] == 0 ? $btn['btn_absen'] : $btn['btn_izin_masuk']),
            'izin' =>  $this->ModelAbsensi->all_data_1(),
            'status_izin' =>  $this->ModelAbsensi->status_1(),
        ];
        return view('absensi/v_index', $data);
    }

    public function absen()
    {
        $presensi = $this->ModelAbsensi->check();
        if ($presensi == null) {
            // absen in
            $data = [
                'title' => 'Absen Masuk',
                'maps_office' => $this->ModelAbsensi->maps_office(),
            ];
            return view('absensi/v_absen_in', $data);
        } else {
            // absen out
            if ($presensi['absen_out'] == null || $presensi['foto_out'] == null) {
                $data = [
                    'title' => 'Absen Pulang',
                    'maps_office' => $this->ModelAbsensi->maps_office(),

                ];
                return view('absensi/v_absen_out', $data);
            } else {
                // sudah absen
                if (isset($presensi)) {
                    $data = [
                        'title' => 'Sudah Absen',
                        'tanggal' => $presensi['tgl_absensi'],
                        'masuk' => $presensi['absen_in'],
                        'pulang' => $presensi['absen_out'],
                    ];
                    return view('absensi/v_absen_confirm', $data);
                }
            }
        }
    }

    // insert absen masuk
    public function insertIn()
    {
        if ($this->request->isAJAX()) {

            $validation = \config\Services::validation();
            $valid = $this->validate([
                'lokasi' => [
                    'label' => 'Lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak ditemukan, silahkan aktifkan lokasi perangkat untuk absen'
                    ],
                ],
                // 'file_arsip' => [
                //     'label' => 'Unggah file',
                //     'rules' => [
                //         'uploaded[file_arsip]',
                //         'mime_in[file_arsip,image/jpg,image/jpeg,image/png,application/pdf]',
                //         'max_size[file_arsip,6024]',
                //     ],
                //     'errors' => [
                //         'uploaded' => '{field} wajib diisi',
                //         'max_size' => '{field} maksimal 6024kb',
                //         'mime_in' => '{field} format png/jpg/pdf',
                //     ],
                // ],
            ]);

            if (!$valid) {
                $data = [
                    'error'  => [
                        'lokasi' => $validation->getErrors('lokasi'),
                        // 'file_arsip' => $validation->getErrors('file_arsip'),
                    ],
                ];
            } else {

                date_default_timezone_set('Asia/Jakarta');
                $image = $this->request->getVar('image');
                $lokasi = $this->request->getPost('lokasi');

                $folder_path = 'img/absen/in/';
                $filename = base64_encode(session()->get('id_user')) . session()->get('id_user') . date('Y-m-d') . date('His');
                $img_part = explode(';base64', $image);
                $img_base64 = base64_decode($img_part[1]);
                $nama_file = $filename . ".jpeg";
                $file = $folder_path . $nama_file;

                $data = [
                    'id_user' => session()->get('id_user'),
                    'tgl_absensi' => date('Y-m-d'),
                    'absen_in' => date('H:i:s'),
                    'lokasi_in' => $lokasi,
                    'foto_in' => $nama_file,
                    'keterangan' => 4,
                ];

                file_put_contents($file, $img_base64);
                if ($this->ModelAbsensi->insert_in($data)) {
                    $data = array(
                        'responsez'  => 'success',
                        'message'   => 'berhasil disimpan.'
                    );
                } else {
                    $data = array(
                        'responsez'  => 'error',
                        'message'   => 'gagal menghapus data'
                    );
                }
            }
            echo json_encode($data);
        } else {
            $this->ajaxNotFound();
        }
    }

    // insert absen pulang
    public function insertOut()
    {
        $presensi = $this->ModelAbsensi->check();
        if (isset($presensi)) {
            $id_presensi = $presensi['id_absensi'];
        }
        if ($this->request->isAJAX()) {

            $validation = \config\Services::validation();
            $valid = $this->validate([
                'lokasi' => [
                    'label' => 'Lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak ditemukan, silahkan aktifkan lokasi perangkat untuk absen'
                    ],
                ],
                // 'file_arsip' => [
                //     'label' => 'Unggah file',
                //     'rules' => [
                //         'uploaded[file_arsip]',
                //         'mime_in[file_arsip,image/jpg,image/jpeg,image/png,application/pdf]',
                //         'max_size[file_arsip,6024]',
                //     ],
                //     'errors' => [
                //         'uploaded' => '{field} wajib diisi',
                //         'max_size' => '{field} maksimal 6024kb',
                //         'mime_in' => '{field} format png/jpg/pdf',
                //     ],
                // ],
            ]);

            if (!$valid) {
                $data = [
                    'error'  => [
                        'lokasi' => $validation->getErrors('lokasi'),
                        // 'file_arsip' => $validation->getErrors('file_arsip'),
                    ],
                ];
            } else {
                // upload
                $image = $this->request->getVar('image');
                $lokasi = $this->request->getPost('lokasi');

                $folder_path = 'img/absen/out/';
                $filename = session()->get('id_user') . "-" . date('Y-m-d') . "-" . date('His');
                $img_part = explode(';base64', $image);
                $img_base64 = base64_decode($img_part[1]);
                $nama_file = $filename . ".jpeg";
                $file = $folder_path . $nama_file;

                $data = [
                    'id_absensi' => $id_presensi,
                    'absen_out' => date('H:i:s'),
                    'lokasi_out' => $lokasi,
                    'foto_out' => $nama_file,
                    'keterangan' => 5,
                ];

                file_put_contents($file, $img_base64);
                if ($this->ModelAbsensi->insert_out($data)) {
                    $data = array(
                        'responsez'  => 'success',
                        'message'   => 'berhasil disimpan.'
                    );
                } else {
                    $data = array(
                        'responsez'  => 'error',
                        'message'   => 'gagal menghapus data'
                    );
                }
            }

            echo json_encode($data);
        } else {
            $this->ajaxNotFound();
        }
    }

    /*
    * --------------------------------------------------------------------
    * Control Izin
    * --------------------------------------------------------------------
    */

    # izin
    public function add()
    {
        if ($this->request->isAJAX()) {

            $validation = \config\Services::validation();
            $valid = $this->validate([
                'tgl_izin' => [
                    'label' => 'Anda sudah meminta izin tanggal ' . date('Y-m-d') . '',
                    'rules' => [
                        'required',
                        'is_unique[a_tbl_izin.tgl_izin,tgl_izin]',
                    ],
                    'errors' => [
                        'required' => '{field} wajib diisi',
                        'is_unique' => '{field}, permintaan anda saat ini tidak dapat diproses.',
                    ],
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error'  => [
                        'tgl_izin' => $validation->getErrors('tgl_izin'),
                    ],
                ];
            } else {
                $data_upd = [
                    'id_user' => session()->get('id_user'),
                    'tgl_izin' => $this->request->getPost('tgl_izin'),
                    'deskripsi' => $this->request->getPost('deskripsi'),
                    'keterangan' => $this->request->getPost('status_izin'),
                    'status_acc' => 1, // dikir
                    'sd_tgl_izin' => $this->request->getPost('sd_tgl_izin'),
                ];

                if ($this->ModelAbsensi->add_1($data_upd)) {
                    $data = array(
                        'response'  => 'success',
                        'message'   => 'Berhasil.'
                    );
                } else {
                    $data = array(
                        'response'  => 'error',
                        'message'   => 'Gagal'
                    );
                }
            }

            echo json_encode($data);
        } else {
            $this->ajaxNotFound();
        }
    }

    # masuk kembali (setelah izin)
    public function upd()
    {
        if ($this->request->isAJAX() == true) {
            $data_upd = [
                'keterangan' => 0,
                'tgl_masuk' => date('Y:m:d'),
            ];
            if ($this->ModelAbsensi->update_1($data_upd)) {
                $data = array(
                    'response'  => 'success',
                    'message'   => 'Berhasil.'
                );
            } else {
                $data = array(
                    'response'  => 'error',
                    'message'   => 'Gagal'
                );
            }
            return $this->response->setJSON($data);
        } else {
            $this->ajaxNotFound();
        }
    }


    /*
    * --------------------------------------------------------------------
    * Lembar Absensi
    * --------------------------------------------------------------------
    */

    #lembar absensi per-pegawai
    public function lembarAbsensi()
    {
        $dd = $this->ModelAbsensi->lembar_absensi();

        $data = [
            'menu' => m1(),
            'submenu' => 'lembar-absensi',
            'title' => 'Lembaran Absensi',
            'lembar_absensi' => $dd,
            'month' => $this->ModelAbsensi->monthc(),
            'years' => $this->ModelAbsensi->years(),
        ];
        return view("absensi/v_lembar_absensi", $data);
    }

    #lembar absensi per-pegawai
    public function hariKerja()
    {
        $data = [
            'menu' => m1(),
            'submenu' => 'hari-kerja',
            'title' => 'Hari Kerja',
        ];
        return view("absensi/v_hari_kerja", $data);
    }
    # data laporan
    public function dataHariKerja()
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

            for ($i = $awal_cuti; $i <= $akhir_cuti; $i += (60 * 60 * 24)) {
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
                //    'dataHariKerja' => $this->ModelAbsensi->laporan($awal_cuti, $akhir_cuti),
                'haricuti' => $haricuti,
                'awal_cuti' => $awal_cuti,
                'akhir_cuti' => $akhir_cuti,
                'jumlah_cuti' => $jumlah_cuti, // jumlah hari kerja
                'jumlah_sabtuminggu' => $jumlah_sabtuminggu,
                'abtotal' => $abtotal,

            ];
            $response = [
                'data' => view("absensi/v_hari_kerja_data", $data),
            ];
            echo json_encode($response);
        } else {
            $this->ajaxNotFound();
        }
    }

    # data tables lembaran absensi
    public function dataTables()
    {
        $tahun = $this->request->getPost('tahun');
        $bulan = $this->request->getPost('bulan');
        // $sess = session()->get('id_user');
        $model = $this->ModelAbsensi->getDataTables($tahun, $bulan);
        $data = array();
        $no   = @$_POST['start'];
        foreach ($model as $n) {
            $no++;
            $row    = array();
            $row[]  = $no;
            $row[]  = tglIndo($n->tgl_absensi);
            $row[]  = '<span class="badge badge-success">' . $n->absen_in . '</span>';
            $row[]  = $n->absen_out !== null ? '<span class="badge badge-danger">' . $n->absen_out . '</span>' : '<span class="badge badge-danger">Belum</span>';
            // $row[]  = $n->tgl_izin;
            $row[]  = '<a id="btn-detail" data-toggle="modal" data-target="#showDetailAbsensi" id1="' . $n->id_absensi . '" tgl="' . tglIndo($n->tgl_absensi) . '" inn="' . $n->absen_in . '" out="' . $n->absen_out . '" data-foto="'  . base_url('img/absen/in') . '/' . $n->foto_in . '" data-fotoout="'  . base_url('img/absen/out') . '/' . $n->foto_out . '" class="btn btn-sm btn-outline-primary bg-indigo"><i class="fa fa-image"></i> </a>

            <a href="' . base_url('pegawai/absensi/lembar-absensi/viewDetailAbsensi') . '/' . encrypt_url($n->id_absensi) . '" class="btn btn-sm btn-outline-green bg-indigo"><i class="fa fa-map"></i> Detail </a>
            
            ';
            $data[] = $row;
        }
        $output = array(
            "draw"              => $_POST['draw'],
            "recordsTotal"      => $this->ModelAbsensi->count_all(),
            "recordsFiltered"   => $this->ModelAbsensi->count_filtered($tahun, $bulan),
            "data"              => $data,
        );
        echo json_encode($output);
    }

    # view lokasi dan detail lengkap absen per user
    public function viewDetailAbsensi($id_absensi)
    {
        if ($id_absensi) {
            $data_absensi = $this->ModelAbsensi->getDetailAbsensi(decrypt_url($id_absensi));
            if (!empty($data_absensi['id_absensi'])) {

                $data = [
                    'menu' => m1(),
                    'submenu' => 'lembar-absensi',
                    'title' => 'Detail Absensi',
                    'dataa' => $data_absensi
                ];

                if (!empty($data['dataa']['id_absensi'])) {
                    return view("absensi/v_lembar_absensi_detail", $data);
                } else {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }


    /*
    * --------------------------------------------------------------------
    * Laporan Absensi
    * --------------------------------------------------------------------
    */
    public function lap()
    {
        $data = [
            'menu' => m1(),
            'submenu' => 'laporan',
            'title' => 'Laporan',
            'month' => $this->ModelAbsensi->monthc(),
            'years' => $this->ModelAbsensi->years(),
        ];
        return view("absensi/v_laporan", $data);
    }

    # data laporan

    public function dataLap()
    {
        if ($this->request->isAJAX() == true) {

            /** @var string $awal_cuti */

            $awal_cuti = $this->request->getPost('tgl_awal');
            $akhir_cuti = $this->request->getPost('tgl_akhir');

            $awal_cuti = date_create_from_format('d-m-Y', $awal_cuti);
            $awal_cuti = date_format($awal_cuti, 'Y-m-d');
            $awal_cuti = strtotime($awal_cuti);

            /** @var string $akhir_cuti */

            $akhir_cuti = date_create_from_format('d-m-Y', $akhir_cuti);
            $akhir_cuti = date_format($akhir_cuti, 'Y-m-d');
            $akhir_cuti = strtotime($akhir_cuti);

            $haricuti = array();
            $sabtuminggu = array();

            for ($i = $awal_cuti; $i <= $akhir_cuti; $i += (60 * 60 * 24)) {
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
                'databulanan' => $this->ModelAbsensi->laporan(date("Y-m-d", $awal_cuti), date("Y-m-d", $akhir_cuti)),
                'check_user_absensi' => $this->ModelAbsensi->check_user_absensi(),
                'tgl_awal' => $awal_cuti,
                'tgl_akhir' => $akhir_cuti,
                'haricuti' => $haricuti,
                'jumlah_sabtuminggu' => $jumlah_sabtuminggu,
                'jumlah_cuti' => $jumlah_cuti,
                'abtotal' => $abtotal,
            ];
            $response = [
                'data' => view("absensi/v_laporan_data", $data),
            ];
            echo json_encode($response);
        } else {
            $this->ajaxNotFound();
        }
    }

    # pdf laporan (versi php 7.4 ke atas)
    public function printbyId()
    {
        require '../vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();

        $bulan = $this->request->getPost('month');
        $tahun = $this->request->getPost('years');
        $data = $this->ModelAbsensi->laporan(6, 2023);

        $html = view('absensi/v_laporan_pdf', ['data' => $data]);
        $mpdf->WriteHTML($html);

        # INLINE PREVIEW
        $mpdf->Output('sdfsdfs' . '.pdf', \Mpdf\Output\Destination::INLINE);
    }
}

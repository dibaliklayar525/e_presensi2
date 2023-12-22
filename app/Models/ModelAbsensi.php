<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAbsensi extends Model
{
    protected $table = 'a_tbl_absensi';
    protected $primaryKey = 'id_absensi';
    protected $allowedFields = ['id_user', 'tgl_absensi', 'absen_in', 'absen_out', 'lokasi_in', 'lokasi_out', 'foto_in', 'foto_out'];
    protected $column_order = array('id_absensi', 'id_user', 'tgl_absensi', 'absen_in', 'absen_out', 'lokasi_in', 'lokasi_out', 'foto_in', 'foto_out');
    protected $column_search = array('id_user', 'tgl_absensi'); //field yang diizin untuk pencarian
    protected $order = array('id_absensi' => 'desc'); // default order 

    /*
    * --------------------------------------------------------------------
    * Model Absen
    * --------------------------------------------------------------------
    */
    public function maps_office()
    {
        $query = $this->db->table('a_tbl_kantor')
            ->where('id', session()->get('id_lokasi'))->get()->getRowArray();
        return $query;
    }

    /*
    * --------------------------------------------------------------------
    * Model Absen
    * --------------------------------------------------------------------
    */

    # num rows
    public function numRows()
    {
        return $this->db->table($this->table)
            ->where('tgl_absensi', date('Y:m:d'))
            // ->where('absen_in IS NULL')
            ->get()->getNumRows();
    }
    // notif
    public function getToday()
    {
        $query = $this->db->query("SELECT tgl_absensi, absen_in,absen_out,b.name FROM a_tbl_absensi a
         LEFT JOIN tbl_users b ON a.id_user=b.id_user WHERE tgl_absensi= '" . date('Y:m:d') . "'");

        if ($query->getNumRows() > 0) {
            foreach ($query->getResultArray() as $row) {
                $output = '';
                echo $output .= '
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-check-circle mr-2 text-green"></i> ' . $row['name'] . '
                     <span class="float-right text-muted text-sm">' . time_post($row['absen_in']) . '</span>
                 </a>
                 ';
            }
        }
    }

    # cek user absensi
    public function check_user_absensi()
    {
        $query = $this->db->table('a_tbl_absensi a')
            ->join('tbl_users b', 'b.id_user=a.id_user', 'LEFT')
            ->join('tbl_jabatan c', 'c.id_jabatan=b.id_jabatan', 'LEFT')
            ->join('a_tbl_kantor d', 'd.id=b.id_lokasi', 'LEFT')
            ->where('b.id_user', session()->get('id_user'))
            ->get()->getRowArray();
        return $query;
    }

    # cek absensi
    public function check()
    {
        $query = $this->db->table($this->table)->where('id_user', session()->get('id_user'))
            ->where('tgl_absensi', date('Y:m:d'))->get()->getRowArray();
        return $query;
    }

    # absen masuk 
    public function insert_in($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    # absen keluar
    public function insert_out($data)
    {
        return $this->db->table($this->table)->where($this->primaryKey, $data['id_absensi'])->update($data);
    }

    # mengambil absen perbulan
    public function month()
    {
        $query = $this->db->table($this->table)
            ->where('id_user', session()->get('id_user'))
            ->where('month(tgl_absensi)', date('m'))
            ->where('year(tgl_absensi)', date('Y'));
        return $query;
    }
    public function month_izin()
    {
        $query = $this->db->table('a_tbl_izin')
            ->where('id_user', session()->get('id_user'))
            ->where('month(tgl_izin)', date('m'))
            ->where('year(tgl_izin)', date('Y'));
        return $query;
    }

    #peringkat absen terbaik perbulan
    public function rank()
    {
        $query = $this->db->table($this->table)
            ->join('tbl_users', 'tbl_users.id_user=a_tbl_absensi.id_user', 'LEFT')
            ->join('tbl_jabatan', 'tbl_jabatan.id_jabatan=tbl_users.id_jabatan', 'LEFT')
            ->where('month(tgl_absensi)', date('m'))
            ->where('year(tgl_absensi)', date('Y'))
            ->orderBy('day(tgl_absensi)', 'DESC')
            ->limit('10')->get()->getResultArray();
        return $query;
    }

    /*
    * --------------------------------------------------------------------
    * Model Izin
    * --------------------------------------------------------------------
    */

    # status izin
    public function status_1()
    {
        return $this->db->table('a_tbl_ket')->orderBy('id', 'asc')->limit(3)->get()->getResult();
    }

    # check izin
    public function check_1()
    {
        $query = $this->db->table('a_tbl_izin')->where('id_user', session()->get('id_user'))
            ->where('tgl_izin', date('Y:m:d'))->get()->getRowArray();
        return $query;
    }

    # data izin
    public function all_data_1()
    {
        $query = $this->db->table('a_tbl_izin')
            ->join('a_tbl_ket', 'a_tbl_ket.id=a_tbl_izin.keterangan', 'LEFT')
            ->join('a_tbl_acc_izin', 'a_tbl_acc_izin.id_acc=a_tbl_izin.status_acc', 'LEFT')
            ->where('id_user', session()->get('id_user'))
            ->get()->getResultArray();
        return $query;
    }

    # add izin 
    public function add_1($data_upd)
    {
        return $this->db->table('a_tbl_izin')->insert($data_upd);
    }

    # update status izin 0 (masuk kembali)
    public function update_1($data_upd)
    {
        return $this->db->table('a_tbl_izin')->where('id_user', session()->get('id_user'))->update($data_upd);
    }

    /*
    * --------------------------------------------------------------------
    * Model Mengambil data tanggal Absensi
    * --------------------------------------------------------------------
    */

    # mengambil tahun
    public function years()
    {
        $query = $this->db->query('SELECT DISTINCT YEAR(a.tgl_absensi) AS tahun
          FROM a_tbl_absensi a LEFT JOIN a_tbl_izin b on a.id_user=b.id_user where a.id_user= ?', array(session()->get('id_user')));
        return $query->getResult();
    }

    # mengambil bulan
    public function monthc()
    {
        $query = $this->db->query('SELECT DISTINCT MONTH(a.tgl_absensi) AS bulan
          FROM a_tbl_absensi a LEFT JOIN a_tbl_izin b on a.id_user=b.id_user where a.id_user=?', array(session()->get('id_user')));
        return $query->getResult();
    }

    /*
    * --------------------------------------------------------------------
    * Lembaran Absensi
    * --------------------------------------------------------------------
    */
    public function lembar_absensi()
    {
        $query = $this->db->query('SELECT DISTINCT YEAR(tgl_absensi), tgl_absensi, absen_in, absen_out, MONTH(tgl_absensi) AS bulan, MONTHNAME(tgl_absensi) AS bulan_name, YEAR(tgl_absensi) AS tahun, tgl_izin, status_izin, name as ket_absen
        FROM a_tbl_absensi a 
        LEFT JOIN a_tbl_izin b on a.id_user=b.id_user 
        LEFT JOIN a_tbl_ket c on a.keterangan=c.id
        where a.id_user=?', array(session()->get('id_user')));

        if ($query == null) {
            echo "Data User ID " . session()->get('id_user') . " Tidak ada/tidak ditemukan/null";
        } else {
            return $query->getResult();
        }
    }
    public function getDetailAbsensi($id_absensi)
    {
        $query = $this->db->table('a_tbl_absensi a')
            ->join('tbl_users b', 'b.id_user=a.id_user', 'LEFT')
            ->join('tbl_jabatan c', 'c.id_jabatan=b.id_jabatan', 'LEFT')
            ->join('a_tbl_kantor d', 'd.id=b.id_lokasi', 'LEFT')
            ->join('a_tbl_ket e', 'e.id=a.keterangan', 'LEFT')
            ->where('a.id_absensi', $id_absensi)
            ->get()->getRowArray();
        return $query;
    }
    function filterData($row, $isi)
    {
        $query = $this->db->query('SELECT * FROM a_tbl_absensi a 
        LEFT JOIN a_tbl_izin b on a.id_user=b.id_user
        ');
        // $this->db->table('a_tbl_absensi');
        // $this->join('a_tbl_izin', 'a_tbl_izin.id_user=a_tbl_absensi.id_user', 'LEFT');
        $this->where([$row => $isi]);
        return $query;
    }

    private function dataTables($tahun, $bulan)
    {
        $this->filterData('id_user', session()->get('id_user'));
        if ($tahun) {
            $this->filterData('YEAR(tgl_absensi)', $tahun);
        }
        if ($bulan) {
            $this->filterData('MONTH(tgl_absensi)', $bulan);
        }

        /* search */
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->groupStart();
                    $this->like($item, $_POST['search']['value']);
                } else {
                    $this->orLike($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->groupEnd();
            }
            $i++;
        }

        /* order */
        if (@isset($_POST['order'])) {
            $this->orderBy($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (@isset($this->order)) {
            $order = $this->order;
            $this->orderBy(key($order), $order[key($order)]);
        }
    }

    function getDataTables($tahun, $bulan)
    {
        $this->dataTables($tahun, $bulan);
        if (@$_POST['length'] != -1)
            $this->limit($_POST['length'], $_POST['start']);
        $query = $this->get();
        return $query->getResult(); // return JSON Response
    }
    // recordsTotal
    public function count_all()
    {
        return $this->db->table($this->table)->countAllResults();
    }
    // recordsFiltered
    function count_filtered($tahun, $bulan)
    {
        $this->dataTables($tahun, $bulan);
        return  $this->countAllResults();
    }

    /*
    * --------------------------------------------------------------------
    * Laporan Absensi
    * --------------------------------------------------------------------
    */

    public function laporan($tgl_awal, $tgl_akhir)
    {
        $query = $this->db->query("SELECT a.id_user AS getId, tgl_absensi, absen_in, absen_out, d.name AS nama_user, g.kd_ket AS kode_ket, g.name AS name_ket, tgl_izin, c.name AS name_ket_izin, f.name_acc as approve
        FROM a_tbl_absensi a 
        LEFT JOIN a_tbl_izin b ON a.id_user = b.id_user 
        LEFT JOIN a_tbl_status_izin c ON c.id=b.keterangan
        LEFT JOIN a_tbl_ket g ON g.id=a.keterangan
        LEFT JOIN a_tbl_acc_izin f ON f.id_acc=b.status_acc
        LEFT JOIN tbl_users d ON d.id_user = a.id_user
        LEFT JOIN tbl_jabatan e ON e.id_jabatan = d.id_jabatan
        WHERE (tgl_absensi BETWEEN '$tgl_awal' AND '$tgl_akhir') AND a.id_user=?", array(session()->get('id_user')));
        // WHERE MONTH(tgl_absensi)= ? AND YEAR (tgl_absensi)=? AND a.id_user=? ", array($month, $years, session()->get('id_user')));
        return $query->getResultArray();
    }
    // for admin
    public function laporan_absensi_kehadiran($tgl_awal, $tgl_akhir)
    {
        $query = $this->db->query("SELECT e.name as nama_user, f.nama_jabatan as jabatan, COUNT(*) AS absen_user, count(a.absen_out) AS absen_sore,
  
          -- COUNT(a.absen_in) as masuk, COUNT(a.absen_out) AS pulang, 
          
          -- menghitung tidak hadir/tidak absen
          day(LAST_DAY(NOW()))  - count(absen_out) - COUNT(b.tgl_izin) AS sisa_tdk_hdr,
          COUNT(b.tgl_izin) as izin
          FROM a_tbl_absensi a
          
          LEFT JOIN a_tbl_izin b on b.id_user=a.id_user
          LEFT JOIN tbl_users e on e.id_user=a.id_user
          LEFT JOIN tbl_jabatan f on f.id_jabatan=e.id_jabatan 
          
          WHERE (a.tgl_absensi BETWEEN '$tgl_awal' AND '$tgl_akhir') GROUP BY e.name, f.nama_jabatan
          ");
        return $query->getResultArray();
    }
}

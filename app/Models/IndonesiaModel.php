<?php

namespace App\Models;

use CodeIgniter\Model;

class IndonesiaModel extends Model
{
    protected $DBGroup = 'indonesia';

    protected $table = 'provinces';
    protected $primaryKey = 'id';

    # menampilkan Semua Provinsi
    public function provinces()
    {
        // return $this->db->table('provinces')->get()->getResultArray();
        // $query = $this->db->query('select * from city');

        // return $query->getResult();
    }

    # menampilkan Kabupaten/Kota
    public function regenciesId()
    {
        return $this->db->table('regencies')->where('province_id', '17')->orderBy('id', 'desc')->get()->getResultArray();
    }

    # menampilkan Kecamatan
    public function kecamatan()
    {
        $sql = "SELECT * from districts where regency_id ='1705'";
        $query =  $this->db->query($sql);
        return $query->getResultArray();
    }
    public function kelurahan($postData)
    {
        return $this->db->table('villages')->where('district_id', $postData)->get()->getResult();
    }
}

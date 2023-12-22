<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_jabatan';
    protected $primaryKey       = 'id_jabatan';

    public function jabatan()
    {
        return $this->db->table($this->table)->orderBy('id_jabatan', 'desc')->get()->getResultArray();
    }
}
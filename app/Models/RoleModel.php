<?php

namespace App\Models;

use CodeIgniter\Model;
// follow up use CodeIgniter\Database\Seeder;
class RoleModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_role';
    protected $primaryKey       = 'id_role';

    public function role()
    {
        return $this->db->table($this->table)->orderBy('id_role', 'desc')->get()->getResultArray();
    }
}
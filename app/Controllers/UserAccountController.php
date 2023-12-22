<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\JabatanModel;

class UserAccountController extends BaseController
{
    protected $UserModel;
    protected $RoleModel;
    protected $JabatanModel;

    public function __construct()
    {
        if (session()->get('role') != "1") {
            echo 'Access denied';
            exit;
        }

        helper('form', 'url', 'file');
        $this->UserModel = new UserModel();
        $this->RoleModel = new RoleModel();
        $this->JabatanModel = new JabatanModel();
    }
    public function index()
    {
        $data = [
            'menu' => 'pegawai',
            'submenu' => 'user',
            'title' => 'User Akun',
            'user' => $this->UserModel->all_data(),
        ];
        return view("admin/user/user", $data);
    }

    public function add()
    {
        $data = [
            'menu' => 'dashboard',
            'submenu' => '',
            'title' => 'Tambah User',
            'level' => $this->RoleModel->role()
        ];
        return view("admin/user/add", $data);
    }

    public function insert()
    {
        if ($this->validate([
            'name' => [
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required'
                ],
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|is_unique[tbl_users.email]',
                'errors' => [
                    'required' => '{field} required',
                    'is_unique' => '{field} sudah ada'
                ],
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required'
                ],
            ],
            'ulangi_password' => [
                'label' => 'Ulangi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} required',
                    'matches' => '{field} tidak sama'
                ],
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} required'
                ],
            ],
        ])) {

            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'role' => $this->request->getVar('role'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];

            if ($this->UserModel->add($data)) {
                session()->setFlashdata('pesan', 'User ' . '<b>' . $this->request->getVar('nama') . '</b>' . ' Berhasil ditambahkan');
                return redirect()->to(base_url('admin/user/add'));
            } else {
                exit;
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('admin/user/add'));
        }
    }

    public function edit($id_user)
    {
        if ($id_user) {
            $data_user = $this->UserModel->find(decrypt_url($id_user));
            if (!empty($data_user['id_user'])) {

                $data = [
                    'menu' => 'pegawai',
                    'submenu' => 'user',
                    'title' => 'User ' . $data_user['name'] . '',
                    'user' => $data_user,
                    'level' => $this->RoleModel->role(),
                    'jabatan' => $this->JabatanModel->jabatan(),
                ];

                if (!empty($data['user']['id_user'])) {
                    return view("admin/user/edit", $data);
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
}

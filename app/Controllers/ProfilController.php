<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Models\JabatanModel;

class ProfilController extends BaseController
{
    protected $UserModel;
    protected $RoleModel;
    protected $JabatanModel;

    public function __construct()
    {
        if (session()->get('role') != "1" && session()->get('role') != "2") {
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
        $id_user =  session()->get('id_user');
        $avatar = $this->UserModel->getById($id_user);
        $data = [
            'menu' => 'pegawai',
            'submenu' => 'profil',
            'title' => 'Profil ' . $avatar['name'] . '',
            'user' => $this->UserModel->all_data(),
            'level' => $this->RoleModel->role(),
            'jabatan' => $this->JabatanModel->jabatan(),
            'ava' => $avatar
        ];
        return view("pegawai/profil", $data);
    }

    # update profil picture
    public function updateImg()
    {
        if ($this->request->isAJAX()) {
            $validation = \config\Services::validation();

            $valid = $this->validate([
                'fileImg' => [
                    'label' => 'Unggah file',
                    'rules' => 'mime_in[fileImg,image/jpg,image/jpeg,image/png]' . '|max_size[fileImg,4024]',
                    'errors' => [
                        'max_size' => '{field} maksimal 4024kb',
                        'mime_in' => '{field} format png/jpg/jpeg',
                    ],
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'fileImg' => $validation->getErrors('fileImg'),
                    ],
                ];
            } else {
                # upload
                $fileImg = $this->request->getFile('fileImg');
                $file_name = $fileImg->getRandomName();

                $data = [
                    'avatar' => $file_name,
                ];

                $fileImg->move('img/avatar/', $file_name);

                // menghapus file lama
                $id_user = $this->request->getVar('id_user');
                if ($id_user) {
                    $avatar = $this->UserModel->getById($id_user);
                    if ($avatar['avatar'] !== "") {
                        unlink('img/avatar/' . $avatar['avatar']);
                    }
                }

                if ($this->UserModel->upd($data)) {
                    $data = array(
                        'responsez' => 'success',
                        'message' => 'Foto profil berhasil diperbarui'
                    );
                } else {
                    $data = array(
                        'responsez' => 'error',
                        'message' => 'Foto profil gagal diperbarui'
                    );
                }
            }
            echo json_encode($data);
        } else {
            $this->ajaxNotFound();
        }
    }

    # user update profil
    public function update()
    {
        if ($this->request->isAJAX()) {

            $validation = \config\Services::validation();

            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong wajib di isi'
                    ],
                ],
                'phone_no' => [
                    'label' => 'No Ponsel',
                    'rules' => 'required|trim',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ],
                ],
                'nik' => [
                    'label' => 'NIK',
                    'rules' => 'required|trim',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ],
                ],
                'nip' => [
                    'label' => 'NIP',
                    'rules' => 'required|trim',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ],
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error'  => [
                        'name' => $validation->getErrors('name'),
                        'phone_no' => $validation->getErrors('phone_no'),
                        'nik' => $validation->getErrors('nik'),
                        'nip' => $validation->getErrors('nip')
                    ],
                ];
            } else {
                $data = array(
                    'name' => $this->request->getVar('name'),
                    'phone_no' => $this->request->getVar('phone_no'),
                    'NIK' => $this->request->getVar('nik'),
                    'NIP' => $this->request->getVar('nip'),
                );
                if ($this->UserModel->upd($data)) {
                    $data = array(
                        'responsez'  => 'success',
                        'message'   => 'Profil erhasil diperbarui'
                    );
                } else {
                    $data = array(
                        'responsez'  => 'error',
                        'message'   => 'Gagal'
                    );
                }
            }
            echo json_encode($data);
        } else {
            $this->ajaxNotFound();
        }
    }
}

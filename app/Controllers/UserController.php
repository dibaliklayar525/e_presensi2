<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $UserModel;

    public function __construct()
    {
        helper('form', 'url', 'file');
        $this->UserModel = new UserModel();
    }

    public function login()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|max_length[255]|validateUser[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Email or Password didn't match",
                ],
            ];

            if (!$this->validate($rules, $errors)) {

                return view('login', [
                    "validation" => $this->validator,
                ]);
            } else {
                $model = new UserModel();

                $user = $model->join('tbl_jabatan', 'tbl_jabatan.id_jabatan=tbl_users.id_jabatan')
                ->where('email', $this->request->getVar('email'))
                    ->first();

                // Stroing session values
               
               if($user['is_active'] == true){
                $this->setUserSession($user);

                // Redirecting to dashboard after login
                if ($user['role'] == "1") {
                    return redirect()->to(base_url('admin'));
                } elseif ($user['role'] == "2") {
                    return redirect()->to(base_url('pegawai'));
                }
               } else {
                   echo "<p class='alert alert-danger'>Mohon maaf akun sedang tidak diaktifkan/tidak aktif.</p>";
                  
               }
            }
        }
        return view('login');
    }

    private function setUserSession($user)
    {
        $data = [
            'id_user' => $user['id_user'],
            'name' => $user['name'],
            'id_lokasi' => $user['id_lokasi'],
            'phone_no' => $user['phone_no'],
            'email' => $user['email'],
            'avatar' => $user['avatar'],
            'isLoggedIn' => true,
            "role" => $user['role'],
            "NIK" => $user['NIK'],
            "NIP" => $user['NIP'],
            "id_jabatan" => $user['id_jabatan'],
            "nama_jabatan" => $user['nama_jabatan'],
            "is_active" => $user['is_active'],
            "created_at" => $user['created_at'],
        ];
        session()->set($data);
        return true;
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('login'));
    }
}
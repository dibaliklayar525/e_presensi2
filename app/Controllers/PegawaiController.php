<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class PegawaiController extends BaseController
{
    protected $UserModel;
    public function __construct()
    {
        if (session()->get('role') != "2" && session()->get('role') != "1") {
            echo 'Access denied';
            exit;
        }
        helper('form', 'url', 'file');
        $this->UserModel = new UserModel();
    }
    public function index()
    {
        $data = [
            'menu' => 'dashboard',
            'submenu' => '',
            'title' => 'Dashboard',
            'user' => $this->UserModel->all_data()
        ];
        return view("pegawai/dashboard", $data);
    }

    public function pegawai()
    {
        $data = [
            'menu' => 'pegawai',
            'submenu' => 'daftar-pegawai',
            'title' => 'Pegawai',
            'user' => $this->UserModel->all_data()
        ];
        return view("pegawai/pegawai", $data);
    }
}
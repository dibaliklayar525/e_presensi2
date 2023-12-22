<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Config\Services;
use App\Models\UserModel;
use App\Models\ModelAbsensi;

class InfoController extends BaseController
{
    protected $UserModel;
    protected $ModelAbsensi;

    public function __construct()
    {
        if (session()->get('role') != "2" && session()->get('role') != "1") {
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
            'menu' => 'info',
            'submenu' => 'info',
            'title' => 'Info',
        ];
        return view('update', $data);
    }
}
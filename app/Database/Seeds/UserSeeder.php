<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user_object = new UserModel();
        $user_object->insertBatch([
            [
                "name" => "admin1",
                "email" => "admin@mail.com",
                "phone_no" => "7899654125",
                "role" => (int)1,
                "password" => password_hash("1234", PASSWORD_DEFAULT)
            ],
            [
                "name" => "admin2",
                "email" => "admin2@mail.com",
                "phone_no" => "8888888888",
                "role" => (int)2,
                "password" => password_hash("1234", PASSWORD_DEFAULT)
            ],
            [
                "name" => "admin3",
                "email" => "admin3@mail.com",
                "phone_no" => "8888888888",
                "role" => (int)3,
                "password" => password_hash("1234", PASSWORD_DEFAULT)
            ],
        ]);
    }
}
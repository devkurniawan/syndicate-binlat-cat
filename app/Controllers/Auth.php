<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index(): string
    {   
        return view('template/default', [
            "title" => "",
            "page"  => "",
        ]);
    }
    
    public function logout()
    {   
        $HelperModel    = new \App\Models\HelperModel();
        $session        = \Config\Services::session();
        unset($_SESSION['siswa']);
        return $HelperModel->setAlert('flashAlert', 'success', 'Berhasil logout', '/login');
    }

    public function login()
    {   
        $HelperModel    = new \App\Models\HelperModel();
        $validation     = \Config\Services::validation();
        $request        = \Config\Services::request();        
        $session        = \Config\Services::session();
        $db             = \Config\Database::connect();

        $rules = [
            'username' => 'required',
            'password' => 'required|max_length[50]|min_length[3]',
        ];
        if(
            $this->request->getMethod()=="post" && 
            $validation->withRequest($request)->setRules($rules)->run()
        ){
            extract($validation->getValidated());
            $user = $db->table('cat_siswa')->where('nik', $username)->where('status', 'Aktif')->get()->getRow();
            if($user && password_verify($password, $user->password)){
                $session->set([
                    "siswa" => [
                        "siswa_id"      => $user->siswa_id,
                        "nama"          => $user->nama,
                        "jenis_kelamin" => $user->jenis_kelamin,
                        "nomor_hp"      => $user->nomor_hp,
                        "email"         => $user->email,
                        "nik"           => $user->nik,
                        "login_at"      => time()
                    ]
                ]);
                return redirect()->to('/');
            }else if($user){
                return $HelperModel->setAlert('flashAlert', 'error', 'Password anda salah', '/login');
            }
            return $HelperModel->setAlert('flashAlert', 'error', 'Username tidak ditemukan', '/login');
        }

        return view('auth/login', [
            "title"     => "Masuk ke CAT - Syndicate Binlat",
            "errors"    => $validation->getErrors(),
        ]);
    }
}

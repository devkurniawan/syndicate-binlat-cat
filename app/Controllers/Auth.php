<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

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
            $user = $db->table('cat_siswa')->
                         groupStart()->
                            where('username', $username)->
                            orGroupStart()->
                                where('nik!=', null)->
                                where('nik', $username)->
                            groupEnd()->
                         groupEnd()->
                         where('status', 'Aktif')->
                         get()->getRow();
            if($user && password_verify($password, $user->password)){
                $session->set([
                    "siswa" => [
                        "siswa_id"      => $user->siswa_id,
                        "nama"          => $user->nama,
                        "jenis_kelamin" => $user->jenis_kelamin,
                        "nomor_hp"      => $user->nomor_hp,
                        "email"         => $user->email,
                        "nik"           => $user->nik,
                        "foto"          => $user->foto,
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

    public function profil()
    {   
        $HelperModel    = new \App\Models\HelperModel();
        $validation     = \Config\Services::validation();
        $request        = \Config\Services::request();        
        $session        = \Config\Services::session();
        $db             = \Config\Database::connect();

        $session    = session()->get('siswa');
        $user       = $db->table('cat_siswa')->where('siswa_id', $session['siswa_id'])->where('status', 'Aktif')->get()->getRow();

        $rules = [
            "nama"          => "required",
            "jenis_kelamin" => "required",
            "tempat_lahir"  => "required",
            "tanggal_lahir" => "required",
            "alamat"        => "required",
            "nomor_hp"      => "required",
            "email"         => "required",
        ];
        if(isset($_POST['nik']) && $_POST['nik']) $rules["nik"] = "max_length[16]|min_length[16]";

        if(isset($_FILES['foto']['tmp_name']) && $_FILES['foto']['tmp_name']){
            $rules["foto"] = [
                'label' => 'Foto',
                'rules' => [
                    'uploaded[foto]',
                    'is_image[foto]',
                    'mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[foto,100]',
                    'max_dims[foto,1024,768]',
                ],
            ];
        }

        if(
            $this->request->getMethod()=="post" && 
            $validation->withRequest($request)->setRules($rules)->run()
        ){
            extract($validation->getValidated());
            $data = [
                "nama"          => $nama,
                "nik"           => isset($nik) && $nik ? $nik : null,
                "jenis_kelamin" => $jenis_kelamin,
                "tempat_lahir"  => $tempat_lahir,
                "tanggal_lahir" => $tanggal_lahir,
                "alamat"        => $alamat,
                "nomor_hp"      => $nomor_hp,
                "email"         => $email
            ];
            if(isset($_FILES['foto']['tmp_name']) && $_FILES['foto']['tmp_name']){
                $file = $this->request->getFile('foto');            
                if($path = $file->store()) {
                    $filepath   = WRITEPATH.'uploads/'.$path;
                    $file       = new File($filepath);
                    $newdir     = 'siswa/' . $file->getFilename();
                    copy($filepath, resource_sysdir . '/'.$newdir);
                    unlink($filepath);
                    $data["foto"] = $newdir;        
                }
            }       
            $session        = \Config\Services::session();
            $user = $db->table('cat_siswa')->where('siswa_id', $user->siswa_id)->get()->getRow();
            $session->set([
                "siswa" => [
                    "siswa_id"      => $user->siswa_id,
                    "nama"          => $user->nama,
                    "jenis_kelamin" => $user->jenis_kelamin,
                    "nomor_hp"      => $user->nomor_hp,
                    "email"         => $user->email,
                    "nik"           => $user->nik,
                    "foto"          => $user->foto,
                    "login_at"      => time()
                ]
            ]);

            $db->table('cat_siswa')->where('siswa_id', $user->siswa_id)->update($data);
            return $HelperModel->setAlert('flashAlert', 'success', 'Profil berhasil diperbaharui', '/profilsaya');
        }

        return view('template/apps/home', [
            "title"     => "Profil Saya",
            "page"      => "auth/profil",
            "errors"    => $validation->getErrors(),
            "user"      => (array) $user
        ]);
    }
}

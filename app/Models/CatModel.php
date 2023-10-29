<?php

namespace App\Models;

use CodeIgniter\Model;

class CatModel extends Model
{
    public function queryDatatable($getTotal=false, $all=false){
        extract($_POST);
        $db             = \Config\Database::connect();
        $db             = $db->table("cat_ujian")->
                               select("
                                    cat_ujian.*,
                                    cat_ujian_siswa.ujiansiswa_id,
                                    cat_ujian_siswa.nilai
                               ")->
                               join("cat_ujian_siswa", "cat_ujian_siswa.ujian_id=cat_ujian.ujian_id AND cat_ujian_siswa.siswa_id='".session()->get('siswa')['siswa_id']."'", "left")->
                               where("cat_ujian.status", "Dibuka");

        if(isset($ujian_id) && $ujian_id) $db->where('cat_ujian.ujian_id', $ujian_id);

        if(isset($_POST['search']['value']) && $search['value']){
            $db->groupStart()->
                            like('cat_ujian.nama_ujian', $search['value'])->
                            orLike('cat_ujian.deskripsi', $search['value'])->
                        groupEnd();
        }

        if(!$all && isset($length) && $length>=1) $db->limit($length, $start);
        $db->orderBy('cat_ujian.ujian_id', 'desc');
        return  $getTotal ? $db->get()->getNumRows() : 
                            $db->get()->getResult();
    
    }

    public function getRanks($ujian_id){
        extract($_POST);
        $db             = \Config\Database::connect();
        $db             = $db->table("cat_ujian_siswa")->
                               select("
                                    cat_siswa.nama nama_siswa,
                                    cat_siswa.nik,
                                    cat_ujian_siswa.ujiansiswa_id,
                                    cat_ujian_siswa.nilai
                               ")->
                               join("cat_siswa", "cat_siswa.siswa_id=cat_ujian_siswa.siswa_id", "left");

        return $db->where('cat_ujian_siswa.ujian_id', $ujian_id)->
                    limit($length, $start)->
                    orderBy('cat_ujian_siswa.nilai', 'DESC')->
                    get()->
                    getResult();
    
    }

    public function getUjianSiswa($ujiansiswa_id){
        $db = \Config\Database::connect();
        return $db->table("cat_ujian_siswa")->
                    select("cat_ujian_siswa.*")->
                    where("ujiansiswa_id", $ujiansiswa_id)->get()->getRow();
    }

    public function getMyUjianSiswa($ujian_id, $is_selesai=false){
        $db = \Config\Database::connect();
        return $db->table("cat_ujian_siswa")->
                    select("cat_ujian_siswa.*")->
                    where("siswa_id", session()->get('siswa')['siswa_id'])->
                    where($is_selesai ? "waktu_selesai!=" : "waktu_selesai", null)->
                    where("ujian_id", $ujian_id)->
                    orderBy('ujiansiswa_id', 'DESC')->get()->getRow();
    }

    public function getUjian($ujian_id){
        $db = \Config\Database::connect();
        return $db->table("cat_ujian")->
                    select("cat_ujian.*")->
                    where("status", "Dibuka")->
                    where("ujian_id", $ujian_id)->get()->getRow();
    }

    public function getSoalUjian($ujian_id){
        $db     = \Config\Database::connect();
        $soals  = $db->table("cat_ujian_soal")->
                        select("
                            cat_ujian_soal.ujian_id,
                            banksoal_soal.soal_id,
                            banksoal_soal.soal,
                            banksoal_kategori.nama_kategori,
                            banksoal_soal.jawaban_id kuncijawaban_id
                        ")->
                        join("banksoal_soal", "banksoal_soal.soal_id=cat_ujian_soal.soal_id", "left")->
                        join("banksoal_kategori", "banksoal_kategori.kategori_id=banksoal_soal.kategori_id", "left")->
                        where("cat_ujian_soal.ujian_id", $ujian_id)->
                        get()->getResult();

        $soals_id   = array();
        foreach($soals as $soal){
            $soals_id[] = $soal->soal_id;
        }

        $_jawabans   = $soals_id ? $db->table("banksoal_soal_jawaban")->
                                        select("
                                            banksoal_soal_jawaban.jawaban_id,
                                            banksoal_soal_jawaban.soal_id,
                                            banksoal_soal_jawaban.jawaban
                                        ")->
                                        whereIn("banksoal_soal_jawaban.soal_id", $soals_id)->
                                        orderBy("banksoal_soal_jawaban.soal_id", "RANDOM")->
                                        get()->getResult() : array();
        $jawabans = array();
        foreach($_jawabans as $jawaban){
            $jawabans[$jawaban->soal_id][] = $jawaban;
        }
        
        foreach($soals as $i=>$soal){
            if(isset($jawabans[$soal->soal_id])) $soals[$i]->jawabans = $jawabans[$soal->soal_id];
        }

        return $soals;
    }
}
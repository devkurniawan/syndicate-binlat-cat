<?php

namespace App\Controllers;

class Cat extends BaseController
{
    public function index(): string
    {
        $HelperModel    = new \App\Models\HelperModel();
        $CatModel       = new \App\Models\CatModel();
        $_POST['start']     = 0;
        $_POST['length']    = 1;
        $ujianterbaru   = $CatModel->queryDatatable();
        $ujianterbaru   = isset($ujianterbaru[0]) ? $ujianterbaru[0] : array();
        $_POST['length']    = 5;
        $ranks          = isset($ujianterbaru->ujian_id) ? $CatModel->getRanks($ujianterbaru->ujian_id) : [];
        return view('template/apps/home', [
            "page"          => "cat/dashboard",
            "menu"          => "cat",
            "ujianterbaru"  => $ujianterbaru,
            "ranks"         => $ranks
        ]);
    }

    public function getDatatable(){
        $HelperModel    = new \App\Models\HelperModel();
        $CatModel       = new \App\Models\CatModel();
        extract($_POST);

        $lists      = $CatModel->queryDatatable();
        $total      = $CatModel->queryDatatable(true, true);
        $data       = array();
        foreach($lists as $no=>$l) {
            $statusColor = $l->status=="Dibuka" ? 'text-success' : ($l->status=='Ditutup' ? 'text-error' : 'text-warning');
            $l->status = $l->status ? $l->status : 'Pending';
            $d      = array();
            $d[]    = $l->nama_ujian;
            $d[]    = '<div class="miw-200 maw-300 table-pw">'.$l->deskripsi.'</div>';
            $d[]    = $l->tanggal;
            $d[]    = '<div class="badge space-x-2.5 text-xs+ '.$statusColor.'">
                            <div class="h-2 w-2 rounded-full bg-current"></div>
                            <span>'.$l->status.'</span>
                        </div>';
            $d[]    = $HelperModel->tanggalwaktu($l->created_at);
            $d[]    = ($l->nilai ? '<div class="mb-2" style="font-size: 16px; font-weight: 600">Nilai Kamu '.$l->nilai.'</div>' :  null).
                            ($l->status=="Dibuka" ? 
                                ($l->nilai ? '<a href="'.base_url('cat/mulaites/'.$l->ujian_id).'" class="btn border border-primary/30 bg-primary/10 font-medium text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25">ULANGI TES</a>' : '<a href="'.base_url('cat/mulaites/'.$l->ujian_id).'" class="btn border border-success/30 bg-success/10 font-medium text-success hover:bg-success/20 focus:bg-success/20 active:bg-success/25">MULAI TES</a>') : null);

            $data[] = $d;
        }
        
        echo json_encode([
				"draw"              => $_POST['draw'],
				"recordsTotal"      => $total,
				"recordsFiltered"   => isset($search['value']) && $search['value'] ? count($lists) : $total,
				"data"              => $data
			]);
        return;

    }

    public function mulaites($ujian_id="error"){
        $HelperModel    = new \App\Models\HelperModel();
        $CatModel       = new \App\Models\CatModel();
        $ujian          = $CatModel->getUjian($ujian_id);
        if(!$ujian) return $HelperModel->setAlert("alertUjian", "error", "Gagal mengakses tes", "cat");
        $soals          = $ujian->kategori=="Kecermatan" ? $CatModel->getSoalUjiank($ujian_id) : $CatModel->getSoalUjian($ujian_id);
        $ujiansiswa     = $CatModel->getMyUjianSiswa($ujian_id);
        $sujiansiswa    = $CatModel->getMyUjianSiswa($ujian_id, true);
        return view('template/apps/home', [
            "page"          => "cat/".($ujian->kategori=="Kecermatan" ? "mulaitesk" : "mulaites"),
            "menu"          => "cat",
            "ujian"         => $ujian,
            "soals"         => $soals,
            "ujiansiswa"    => $ujiansiswa,
            "sujiansiswa"   => $sujiansiswa
        ]);
    }


    public function domulaites($ujian_id="error"){

        $db             = \Config\Database::connect();
        $HelperModel    = new \App\Models\HelperModel();
        $CatModel       = new \App\Models\CatModel();
        $ujian          = $CatModel->getUjian($ujian_id);
        if(!$ujian) return $this->response->setJSON([
            "status"    => "gagal",
            "pesan"     => "Gagal mengakses data tes"
        ]);
        
        $waktumulai = date("Y-m-d H:i:s");
        $waktuakhir = date("Y-m-d H:i:s", strtotime($waktumulai) + ($ujian->durasi * 60));
        $db->table('cat_ujian_siswa')->where('ujian_id', $ujian_id)->where('siswa_id', session()->get('siswa')['siswa_id'])->delete();
        $db->table('cat_ujian_siswa')->insert([
            "ujian_id"          => $ujian->ujian_id,
            "nama_ujian"        => $ujian->nama_ujian,
            "siswa_id"          => session()->get('siswa')['siswa_id'],
            "durasi"            => $ujian->durasi,
            "waktu_mulai"       => $waktumulai,
            "waktu_akhir"       => $waktuakhir
        ]);
        $ujiansiswa_id = $db->insertID();
        return $this->response->setJSON([
            "status"    => "berhasil",
            "pesan"     => "Memulai quiz",
            "result"    => $CatModel->getUjianSiswa($ujiansiswa_id)
        ]);
        
    }

    public function updateujiansiswa(){
        extract($_POST);

        $db             = \Config\Database::connect();
        $HelperModel    = new \App\Models\HelperModel();
        $CatModel       = new \App\Models\CatModel();

        // $ujiansiswa     = $CatModel->getMyUjianSiswa($ujian_id);
        $ujiansiswa     = $CatModel->getUjianSiswa($ujiansiswa_id);
        if(!$ujiansiswa) return $this->response->setJSON([
            "status"    => "gagal",
            "pesan"     => "Gagal mengakses ujian siswa",
        ]);
        
        $soals          = $CatModel->getSoalUjian($ujiansiswa->ujian_id);

        if(!isset($jawaban) || !is_array($jawaban)) $jawaban = array();

        $jawabans_benar = array();
        if(isset($jawaban) && $jawaban){
            foreach($soals as $s){
                if(isset($jawaban[$s->soal_id]) && $jawaban[$s->soal_id]==$s->kuncijawaban_id) $jawabans_benar[] = $jawaban[$s->soal_id];
            }
        }
        $soals = $soals ? $soals : [];
        $data = [
            "nilai"             => (count($jawabans_benar) * 100) / count($soals),
            "jumlah_terjawab"   => count($jawaban),
            "jumlah_soal"       => count($soals),
            "cache_soal"        => @serialize($soals),
            "cache_jawaban"     => @serialize($jawaban),
            "updated_at"        => date("Y-m-d H:i:s")
        ];
        
        if(isset($is_quisdiakhiri) && $is_quisdiakhiri) $data["waktu_selesai"] = date("Y-m-d H:i:s");
        
        $db->table("cat_ujian_siswa")->
             where("ujiansiswa_id", $ujiansiswa_id)->update($data);
        
        $result = [
            "status"    => "berhasil",
            "pesan"     => isset($is_quisdiakhiri) && $is_quisdiakhiri ? "Tes Diakhiri" : "Tes Update",
        ];
        
        $data['cache_soal']     = @unserialize($data['cache_soal']);
        $data['cache_jawaban']  = @unserialize($data['cache_jawaban']);
        $data['nilai']          = is_numeric($data['nilai']) && floor($data['nilai']) != $data['nilai'] ? number_format($data['nilai'], 0) : $data['nilai'];
        
        if(isset($is_quisdiakhiri) && $is_quisdiakhiri) $result['result'] = $data;
        return $this->response->setJSON($result);
        
    }

    public function updateujiansiswak(){
        extract($_POST);

        // return $this->response->setJSON($_POST);

        $db             = \Config\Database::connect();
        $HelperModel    = new \App\Models\HelperModel();
        $CatModel       = new \App\Models\CatModel();

        $ujian          = $CatModel->getUjian($ujian_id);
        if(!$ujian) return $this->response->setJSON([
            "status"    => "gagal",
            "pesan"     => "Gagal mengakses data tes"
        ]);

        $db->table("cat_ujian_siswa")->where('ujian_id', $ujian_id)->where('siswa_id', session()->get('siswa')['siswa_id'])->delete();

        $nilai = 0;
        $total_soal = 0;
        $total_terjawab = 0;
        foreach($dataSoals as $dataSoal){
            $total_terjawab += $dataSoal['jumlah_terjawab'];
            $total_soal += $dataSoal['jumlah_soal'];
            $_nilai = ($dataSoal['jumlah_benar'] * 100) / $dataSoal['jumlah_soal'];
            $nilai += $_nilai;
        }
        $nilai = $nilai / count($dataSoals);
        $data = [
            "ujian_id"          => $ujian->ujian_id,
            "nama_ujian"        => $ujian->nama_ujian,
            "siswa_id"          => session()->get('siswa')['siswa_id'],
            "durasi"            => 0,
            "waktu_mulai"       => isset($dataSoals[0]['durasiStart']) ? $dataSoals[0]['durasiStart'] : date("Y-m-d H:i:s"),
            "waktu_selesai"     => date("Y-m-d H:i:s"),
            "waktu_akhir"       => date("Y-m-d H:i:s"),
            "nilai"             => $nilai,
            "jumlah_terjawab"   => $total_terjawab,
            "jumlah_soal"       => $total_soal,
            "cache_soal"        => @serialize($dataSoals),
            "cache_jawaban"     => null,
            "updated_at"        => date("Y-m-d H:i:s")
        ];
        
        $db->table("cat_ujian_siswa")->insert($data);
        return $this->response->setJSON([
            "status"    => "berhasil",
            "pesan"     => "Hasil Tes Berhasil Disimpan",
            "result"    => $data
        ]);
        
    }


}

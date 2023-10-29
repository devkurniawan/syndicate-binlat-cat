<?php

namespace App\Models;

use CodeIgniter\Model;

class HelperModel extends Model
{
    public $hari = ["", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
    public $bulan = ["", "Januari", "Febuari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    public function tanggalwaktu($datetime, $nocoma=false){
        $datetime   = strtotime($datetime);
        if($nocoma) return $this->hari[date("N", $datetime)]." ".date("d", $datetime)." ".$this->bulan[date("n", $datetime)]." ".date("Y H:i", $datetime);
        return date("d", $datetime)." ".$this->bulan[date("n", $datetime)]." ".date("Y, H:i", $datetime);
    }
    public function haritanggalwaktu($datetime, $nocoma=false){
        $datetime   = strtotime($datetime);
        if($nocoma) return $this->hari[date("N", $datetime)]." ".date("d", $datetime)." ".$this->bulan[date("n", $datetime)]." ".date("Y H:i", $datetime);
        return $this->hari[date("N", $datetime)].", ".date("d", $datetime)." ".$this->bulan[date("n", $datetime)]." ".date("Y, H:i", $datetime);
    }
    public function haritanggal($datetime){
        $datetime   = strtotime($datetime);
        return $this->hari[date("N", $datetime)].", ".date("d", $datetime)." ".$this->bulan[date("n", $datetime)]." ".date("Y", $datetime);
    }
    public function tanggal($datetime){
        $datetime   = strtotime($datetime);
        return date("d", $datetime)." ".$this->bulan[date("n", $datetime)]." ".date("Y", $datetime);
    }
    public function bulan($datetime){
        $datetime   = strtotime($datetime);
        return $this->bulan[date("n", $datetime)];
    }
    public function bulantahun($datetime){
        $datetime   = strtotime($datetime);
        return $this->bulan[date("n", $datetime)]." ".date("Y", $datetime);
    }

    public function changeTimezone($datetimeWIB, $timezone){
        $timezones = [
            "WIB"   => "Asia/Jakarta",
            "WITA"  => "Asia/Makassar",
            "WIT"   => "Asia/Jayapura"
        ];
        $timezone = $timezones[$timezone];

        $schedule_date = new DateTime($datetimeWIB, new DateTimeZone("Asia/Jakarta"));
        $schedule_date->setTimeZone(new DateTimeZone($timezone));      
        return $schedule_date->format('Y-m-d H:i:s');
    }
    
    public function getAlert($name){
        if(isset($_SESSION[$name]['pesan'])){
            $pesan  = $_SESSION[$name]['pesan'];
            $tipe   = $_SESSION[$name]['tipe'];
            $tipe   = in_array($tipe, ['error','info','warning','success']) ? $tipe : 'info';
            unset($_SESSION[$name]);
            return '
                <div
                    x-data="{isShow:true}"
                    :class="!isShow && \'opacity-0 transition-opacity duration-300\'"
                    class="mb-4 alert flex items-center justify-between overflow-hidden rounded-lg border border-'.$tipe.' text-'.$tipe.'"
                >
                    <div class="flex">
                        <div class="alertLogo bg-'.$tipe.' p-3 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="px-4 py-3 sm:px-5">'.$pesan.'</div>
                    </div>
                    <div class="px-2">
                        <button
                            @click="isShow = false; setTimeout(()=>$root.remove(),300)"
                            class="btn h-7 w-7 rounded-full p-0 font-medium text-'.$tipe.' hover:bg-'.$tipe.'/20 focus:bg-info/20 active:bg-'.$tipe.'/25"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                </div>';
                
        }
        return null;
    }

    public function setAlert($name, $tipe, $pesan, $redirect=false){
        $_SESSION[$name] = [
            "pesan" => $pesan,
            "tipe"  => $tipe,
        ];
        if($redirect) return redirect()->to($redirect);
        return true;
   }

    public function formatRupiah($int){
        return '<span class="mr-2">Rp</span>'.number_format($int,0,".",".");
    }

    public function formatSizeUnits($bytes){
        if ($bytes >= 1073741824){
            return number_format($bytes / 1073741824, 2) . ' GB';
        }elseif ($bytes >= 1048576){
            return number_format($bytes / 1048576, 2) . ' MB';
        }elseif ($bytes >= 1024){
            return number_format($bytes / 1024, 2) . ' KB';
        }elseif ($bytes > 1){
            return $bytes . ' bytes';
        }elseif ($bytes == 1){
            return $bytes . ' byte';
        }else{
            return '0 bytes';
        }
    }

    public function generatePassword($password){
	    $password_hashed = password_hash($password, PASSWORD_BCRYPT);
        if(password_verify($password, $password_hashed)) return $password_hashed;
        return $this->generatePassword($password);
	}

    private function penyebut($nilai) {
		$nilai = intval($nilai);
		$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->penyebut($nilai - 10). " Belas";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai/10)." Puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " Seratus" . $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai/100) . " Ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " Seribu" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai/1000) . " Ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai/1000000) . " Juta" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai/1000000000) . " Milyar" . $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai/1000000000000) . " Trilyun" . $this->penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	public function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}     		
		return $hasil;
	}

}
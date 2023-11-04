<!-- Main Content Wrapper -->
<style>
div:where(.swal2-container) div:where(.swal2-popup) {
    padding: 1.5em;
}

.bodyNav,.bodyBtnTes,.bodyBtnMulaiQuiz {
    max-width: 400px;
    margin: auto!important;
    overflow: auto;
}

.navQuiz svg {
    display: none;
    color:#fff;
    position: absolute;
    margin-top: -6px;
    margin-left: 1px;
    background: #4caf50;
    border: 1px solid#1b831f;
    border-radius: 50%;
    width: 13px;
    height: 13px;
}
.navQuiz.checked svg {
    display: block;
}
.navQuiz {
    min-width: 40px;
    padding: 8px 0;
    float: left;
    vertical-align: middle;
    text-align: center;
    border: 1px solid#aaa; 
    margin: 2px!important;
    cursor: pointer;
    font-weight: 600;
}

#containerSoal img{
    width:auto!important;
    max-width: 200px;
    max-height: 110px;
}

.bodysoal {
    display: none;
}

.bodysoal.show {
    display: block;
}

.navQuiz:hover {
    background: #e1eff1;
    /*border-color: #e1eff1;*/
}

.navQuiz.selected {
    background: #4CAF50;
    border-color: #4CAF50;
    color: #fff;
}

@media (max-width: 1366px){
    .bodyNav,.bodyBtnTes,.bodyBtnMulaiQuiz {
        max-width: 210px;
    }
}
</style>


<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
        <div class="col-span-12 lg:col-span-4 xl:col-span-3">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-1 lg:gap-6">
                <div class="rounded-lg bg-info/10 px-4 pb-5 dark:bg-navy-800 sm:px-5">
                    <div class="flex items-center justify-between py-3">
                        <div x-data="usePopper({placement:'bottom-end',offset:4})" @click.outside="if(isShowPopper) isShowPopper = false" class="inline-flex">
                        </div>
                    </div>
                    <div class="space-y-4 text-center">
                        <div class="flex" style="justify-content: center;">
                            <div class="avatar h-16 w-16">
                                <img class="rounded-full" src="<?=resource_url('assets-cat/images/avatar/user.png');?>" alt="image" />
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                                <?=session()->get('siswa')['nama'];?>
                            </h3>
                            <p class="text-xs text-slate-400 dark:text-navy-300">
                                <?=session()->get('siswa')['nik'];?>
                            </p>
                        </div>
                        <div class="space-y-3 text-xs+ mt-5">
                            <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100 mb-4">
                                <?=$ujian->nama_ujian;?>
                            </h2>

                            <?php foreach($soals as $no=>$soal):?>
                            <div class="flex justify-between">
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    Kolom <?=$no+1;?>
                                </p>
                                <p class="text-right">
                                    <?=$soal->durasi;?> Detik<br>
                                    <?=$soal->jumlah_soal;?> Soal
                                </p>
                            </div>
                            <?php endforeach;?>

                        </div>

                    </div>
                </div>

            </div>
        </div>
        <style>
            .table-pattern {
                border:1px solid#aaa;
            }
            .table-pattern td {
                width: 20%;
                text-align: center;
                border:1px solid#aaa;
            }
            .table-pattern .pattern{
                font-weight: 700;
                font-size: 80px;
            }
            .table-pattern .pattern td div{
                min-height: 120px;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .table-pattern .pattern td div img{
                margin: 10px 5px;
                width: 80px;
                height: 80px;
            }
            .table-pattern .jawaban{
                font-weight: 600;
                font-size: 32px;
            }
            .table-soal {
                max-width: 450px;
                border:1px solid#aaa;
                margin-top: 50px;
            }
            .table-soal td {
                width: 20%;
                text-align: center;
                /* border:1px solid#aaa; */
            }
            .table-soal .pattern{
                font-weight: 700;
                font-size: 64px;
                letter-spacing: 20px;
            }
            .table-soal .pattern td img{
                margin-right: 20px;
                display: inline;
                width: 60px;
                height: 60px;
            }
            .table-soal .jawaban{
                font-weight: 600;
                font-size: 42px;
            }
        </style>
        <div class="col-span-12 lg:col-span-8 xl:col-span-9">
            <div class="bodyPendingCountDown" style="display: none">
                <div class="mt-12 text-center">
                    <h3 class="textTitleBodyPending mt-3 text-xl font-semibold text-slate-600 dark:text-navy-100">
                        ...
                    </h3>
                    <div style="font-size: 86px;" id="textPendingCountDown">
                        5
                    </div>
                </div>
            </div>
            <div class="bodySaving" style="display: none">
                <div class="text-center">
                    <div class="avatar h-16 w-16">
                        <div class="is-initial rounded-full bg-gradient-to-br from-pink-500 to-rose-500 text-white">
                            <i class="fa-solid fa-shapes text-2xl"></i>
                        </div>
                    </div>
                    <h3 id="resultJudul" class="mt-3 text-xl font-semibold text-slate-600 dark:text-navy-100">
                        Sedang menyimpan hasil tes . .
                    </h3>
                    <p id="resultSubjudul" class="mt-0.5 text-base">
                        Mohon tunggu proses ini selesai agar hasil ujian kamu berhasil disimpan.
                    </p>
                    <div class="flex justify-center mt-5">
                        <div class="btnToBeranda mt-6" style="max-width: 600px;width: 100%;display:none">
                            <div class="bodyLastUjian flex justify-between mb-5">
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    Nilai Kamu
                                </p>
                                <p class="text-right" style="font-weight: 600" id="resultNilai">...</p>
                            </div>
                            <div class="bodyLastUjian flex justify-between mb-8">
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    Jumlah Soal Terjawab
                                </p>
                                <p class="text-right" id="resultTerjawab">... dari ... soal</p>
                            </div>
                            <button onclick="location.href='<?=base_url('cat');?>'" class="btn text-lg h-12 btn border border-info/30 bg-info/10 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25">Kembali ke Beranda</button>
                        </div>
                        <div class="btnSimpanUlang mt-6" style="max-width: 600px;width: 100%;display:none">
                            <button onclick="updateUjianSiswa(this)" class="btn text-lg h-12 btn border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">Simpan ulang</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bodyWelcome">
                <div class="mt-5 text-center">
                    <div class="avatar h-16 w-16">
                        <div class="is-initial rounded-full bg-gradient-to-br from-pink-500 to-rose-500 text-white">
                            <i class="fa-solid fa-shapes text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="mt-3 text-xl font-semibold text-slate-600 dark:text-navy-100">
                        Selamat Datang Di Tes Kecermatan
                    </h3>
                    <p class="mt-0.5 text-base">
                        Kerjakan dengan cepat, tepat dan cermat.<br>Klik tombol dibawah ini untuk memulai.
                    </p>
                    <div class="mt-6">
                        <button onclick="startAll()" class="btn text-xl h-14 bg-gradient-to-l from-pink-300 to-indigo-400 font-medium text-white">Mulai Sekarang</button>
                    </div>
                </div>
            </div>
            <div class="bodySoal" style="display:none">
                <div class="durasi" style="text-align: center">
                    <div>Durasi</div>
                    <div style="font-size: 42px" id="textCountDown">00:00:00</div>
                </div>
                <div class="mt-3">
                    <table class="table-pattern w-full text-left">
                        <tr style="font-size: 32px" class="nama-kolom">
                            <td colspan="5">...</td>
                        </tr>
                        <tr class="pattern">
                            <td><div></div></td>
                            <td><div></div></td>
                            <td><div></div></td>
                            <td><div></div></td>
                            <td><div></div></td>
                        </tr>
                        <tr class="jawaban">
                            <td>A</td>
                            <td>B</td>
                            <td>C</td>
                            <td>D</td>
                            <td>E</td>
                        </tr>
                    </table>
                </div>
                <div class="mt-3">
                    <table class="table-soal w-full text-left">
                        <tr>
                            <td colspan="5" class="pt-3">
                                <strong id="textNoSoal">...</strong>
                            </td>
                        </tr>
                        <tr class="pattern">
                            <td colspan="5">
                                ...
                            </td>
                        </tr>
                        <tr class="jawaban">
                            <td onclick="jawabSubSoal(0)" class="btn bg-info/10 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25" style="border-radius: 0">A</td>
                            <td onclick="jawabSubSoal(1)" class="btn bg-info/10 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25" style="border-radius: 0">B</td>
                            <td onclick="jawabSubSoal(2)" class="btn bg-info/10 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25" style="border-radius: 0">C</td>
                            <td onclick="jawabSubSoal(3)" class="btn bg-info/10 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25" style="border-radius: 0">D</td>
                            <td onclick="jawabSubSoal(4)" class="btn bg-info/10 font-medium text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25" style="border-radius: 0">E</td>
                        </tr>
                    </table>
                </div>

            </div>
            <?php 

                $dataSoals = [];
                foreach($soals as $no=>$soal){
                    $soal->pattern  = @unserialize($soal->pattern);
                    $pattern        = [];
                    foreach($soal->pattern as $k=>$p){
                        $pattern[] = [
                            "index" => $k,
                            "value" => $p
                        ];
                    }
                    $subSoals       = [];
                    for($s=1; $s<=$soal->jumlah_soal; $s++){
                        $q          = $soal->pattern;
                        $pi         = rand(0,4);
                        if(isset($q[$pi])) unset($q[$pi]);
                        shuffle($q);
                        $js         = $pattern;
                        shuffle($js);
                        $subSoals[] = [
                            "soal"              => $q,
                            "kunci_jawaban"     => $pi, 
                            "semua_pilihan"     => $js,
                        ];
                    }
                    $durasiStart    = date("Y-m-d H:i:s"); 
                    $durasiEnd      = date("Y-m-d H:i:s", (strtotime($durasiStart)+($soal->durasi*1))); 
                    $dataSoals[]    = [
                        "nama_kolom"        => "Kolom ".($no+1),
                        "durasi"            => $soal->durasi,
                        "durasiStart"       => $durasiStart,
                        "durasiEnd"         => $durasiEnd,
                        "jumlah_soal"       => $soal->jumlah_soal,
                        "jumlah_terjawab"   => 0,
                        "jumlah_benar"      => 0,
                        "orgPattern"        => $soal->pattern,
                        "subSoals"          => $subSoals,
                    ];
                }

            ?>

        </div>
    </div>
</main>

<script type="text/javascript">
    var dataSoals       = <?=json_encode($dataSoals);?>;
    var indexKolom      = 0,
        indexSubSoal    = 0,
        ivCountdown     = false,
        jumlah_benar    = 0,
        jumlah_terjawab = 0
    function runCountDown(_now, dt){
        var countDownDate = new Date(dt).getTime();
        ivCountdown = setInterval(function() {
            var el          = document.getElementById("textCountDown")
            var now         = new Date(_now).getTime();
            var distance    = countDownDate - now;
            var hours       = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes     = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds     = Math.floor((distance % (1000 * 60)) / 1000);
            hours           = hours < 10 ? hours = "0" + hours : hours
            minutes         = minutes < 10 ? minutes = "0" + minutes : minutes
            seconds         = seconds < 10 ? seconds = "0" + seconds : seconds
        
            el.innerHTML    = distance < 1 ? "00:00:00" : hours + ":" + minutes + ":" + seconds;
            _now            = now+(1000)

            if (distance < 0) {
                clearInterval(ivCountdown)
                var lSubSoal = dataSoals[indexKolom].subSoals.length,
                    lSoal = dataSoals.length
                
                if(indexKolom>=(lSoal-1)){
                    $('.bodyPendingCountDown, .bodyWelcome, .bodySoal').hide()
                    return console.log(dataSoals);
                }

                indexSubSoal = 0
                indexKolom = indexKolom+1
                return startSoal()

            }
        }, 1000);
    }


    function startAll(){
        Swal.fire({
          text: "Lanjutkan dan mulai tes ini sekarang",
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Batal',
          confirmButtonText: 'Mulai Sekarang'
        }).then((result) => {
            if (result.isConfirmed) {
                return startSoal()
            }
        })
    }

    function startSoal(){
        var dataSoal    = dataSoals[indexKolom]
        if(ivCountdown) clearInterval(ivCountdown)
        runCountDown(dataSoal.durasiStart, dataSoal.durasiEnd)
        $('.textTitleBodyPending').html('Bersiap untuk memulai soal '+dataSoal.nama_kolom)

        $('.bodyPendingCountDown, .bodyWelcome, .bodySoal').hide()
        $('.bodyPendingCountDown').show()
        var xin = 4
        $('#textPendingCountDown').html(5)
        var x = setInterval(function(){
            $('#textPendingCountDown').html(xin)
            if(xin==0){
                initKolom()
                initSubSoal()
                $('.bodyPendingCountDown').hide()
                $('.bodySoal').show()
                clearInterval(x)
            }
            xin = xin-1
        }, 1000)

    }

    function initKolom(){
        var dataSoal    = dataSoals[indexKolom]
        if(ivCountdown) clearInterval(ivCountdown)
        runCountDown(dataSoal.durasiStart, dataSoal.durasiEnd)
        $('.table-pattern .nama-kolom td').html(dataSoal.nama_kolom)
        $.each(dataSoal.orgPattern, function(i,v){
            $('.table-pattern .pattern td:eq('+i+') div').html(v)
        })
    }

    function initSubSoal(){
        var dataSoal    = dataSoals[indexKolom]
        var subSoal     = dataSoal.subSoals[indexSubSoal]        
        $('.table-soal .pattern td').html(subSoal.soal.join(""))
        $('#textNoSoal').html("Soal Ke "+(indexSubSoal+1))
    }

    function nextSoal(){
        var lSubSoal = dataSoals[indexKolom].subSoals.length,
            lSoal = dataSoals.length

        if(indexSubSoal>=(lSubSoal-1) && indexKolom>=(lSoal-1)){
            return updateUjianSiswa();
        }else if(indexSubSoal>=(lSubSoal-1)){
            indexSubSoal = 0
            indexKolom = indexKolom+1
            return startSoal()
        }

        indexSubSoal = indexSubSoal+1
        return initSubSoal()
    }

    function jawabSubSoal(iss){
        dataSoals[indexKolom].jumlah_terjawab = dataSoals[indexKolom].jumlah_terjawab+1
        if(dataSoals[indexKolom].subSoals[indexSubSoal].kunci_jawaban==iss){
            dataSoals[indexKolom].jumlah_benar = dataSoals[indexKolom].jumlah_benar+1
            jumlah_benar = jumlah_benar+1
        }
        dataSoals[indexKolom].subSoals[indexSubSoal].jawaban = iss
        
        jumlah_terjawab = jumlah_terjawab+1
        return nextSoal()
    }

    var updatingUjianSiswa = false
    function updateUjianSiswa(el = false){
        
        if(updatingUjianSiswa || !dataSoals) return false            
        $.ajax({
            url: "<?=base_url("cat/updateujiansiswak");?>",
            type: "post",
            data: {
                ujian_id: <?=$ujian->ujian_id;?>,
                dataSoals: dataSoals,
                jumlah_benar: jumlah_benar,
                jumlah_terjawab: jumlah_terjawab
            },
            beforeSend: function(){
                $('.bodyPendingCountDown, .bodyWelcome, .bodySoal').hide()
                $('.bodySaving').show()

                if(el) $(el).prop('disabled', true).html('Menyimpan ulang . .')
                $('#bodySaving').show()
                $('#resultJudul').html('Sedang menyimpan hasil tes . .')
                $('#resultSubjudul').html('Mohon tunggu proses ini selesai agar hasil ujian kamu berhasil disimpan.')
            },
            error: function(a,b,c){
                if(el) $(el).prop('disabled', false).html('Simpan ulang')
                $('#resultJudul').html('Gagal menyimpan')
                $('#resultSubjudul').html("Error message : "+b)
                $('.btnSimpanUlang').show()
            },
            success: function(res){
                if(el) $(el).prop('disabled', false).html('Simpan ulang')
                if(res.status=="berhasil"){
                    $('.btnSimpanUlang').hide()
                    $('#resultJudul').html('Berhasil disimpan')
                    $('#resultSubjudul').html('Hasil ujian berhasil disimpan')
                    $('.btnToBeranda').show()
                    $('#resultNilai').html(res.result.nilai)
                    $('#resultTerjawab').html(res.result.jumlah_terjawab+" dari "+res.result.jumlah_soal+" soal")
                    dataSoals = false
                    return false
                }
                $('.btnSimpanUlang').show()
                $('#resultJudul').html('Gagal menyimpan')
                $('#resultSubjudul').html(res.pesan)

            }
        })

    }

</script>

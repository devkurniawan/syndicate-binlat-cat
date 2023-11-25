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
                        <!-- <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100 mb-4">
                            <?=$ujian->nama_ujian;?>
                        </h2> -->
                        <div x-data="usePopper({placement:'bottom-end',offset:4})" @click.outside="if(isShowPopper) isShowPopper = false" class="inline-flex">
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <div class="avatar h-16 w-16">
                                <img class="rounded-full" src="<?=resource_url('assets-cat/images/avatar/user.png');?>" alt="image" />
                            </div>
                            <div>
                                <p>Waktu Kamu</p>
                                <p id="quizTimer" class="text-xl font-medium text-slate-700 dark:text-navy-100">
                                    00:00
                                </p>
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
                        <div class="space-y-3 text-xs+">
                            <div class="flex justify-between">
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    Jumlah Soal
                                </p>
                                <p class="text-right"><?=count($soals);?> Soal</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    Durasi
                                </p>
                                <p class="text-right"><?=$ujian->durasi;?> Menit</p>
                            </div>
                            <?php if($sujiansiswa):?>
                            <div class="bodyLastUjian flex justify-between">
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    Nilai Kamu Sebelumnya
                                </p>
                                <p class="text-right" style="font-weight: 600"><?=$sujiansiswa->nilai;?></p>
                            </div>
                            <div class="bodyLastUjian flex justify-between">
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    Jumlah Soal Terjawab
                                </p>
                                <p class="text-right"><?=$sujiansiswa->jumlah_terjawab;?> dari <?=$sujiansiswa->jumlah_soal;?> soal</p>
                            </div>
                            <div class="bodyLastUjian flex justify-between">
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    Waktu Mulai
                                </p>
                                <p class="text-right"><?=date("d/m/Y, H:i", strtotime($sujiansiswa->waktu_mulai));?></p>
                            </div>
                            <div class="bodyLastUjian flex justify-between">
                                <p class="font-medium text-slate-700 dark:text-navy-100">
                                    Waktu Selesai
                                </p>
                                <p class="text-right"><?=date("d/m/Y, H:i", strtotime($sujiansiswa->waktu_selesai));?></p>
                            </div>
                            <?php endif;?>

                        </div>


                        <div class="mt-4 titleNav" style="text-align: center;font-weight: 600;display:none">Navigasi Soal</div>
                        <div class="row bodyNav text-center" style="display: none">
                            <?php foreach($soals as $no=>$soal):?>
                            <div class="navQuiz mr-2 mb-2 navQuiz<?=$soal->soal_id;?>" id="navigasiSoal<?=$no+1;?>" onclick="changeNavigasi(this, <?=$soal->soal_id;?>, <?=$no+1;?>)">
                                <?=$no+1;?>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <div id="nextPrevNav" style="display: none">
                            <div class="flex justify-between">
                                <p class="">
                                    <button class="btn border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90" id="btnPrevSoal" onclick="prevSoal(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"></path></svg>
                                    </button>
                                </p>
                                <p class="text-right">
                                    <button class="btn border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90" style="display: inline" id="btnNextSoal" onclick="nextSoal(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"></path></svg>
                                    </button>
                                </p>
                            </div>
                        </div>


                        <div id="containerNavigasi" class="col-md-12 text-center">
                            <div class="bodyBtnTes mt-2 p-2" style="display:none">
                                <button id="btnAkhiriTes" class="h-11 btn bg-warning/10 font-medium text-warning hover:bg-warning/20 focus:bg-warning/20 active:bg-warning/25" style="width: 100%">AKHIRI SEKARANG</button>
                            </div>
                            <div class="bodyBtnMulaiQuiz mt-2 p-2" style="display: none">
                                <button id="btnMulaiQuiz" class="h-11 btn bg-success font-medium text-white hover:bg-success-focus focus:bg-success-focus active:bg-success-focus/90" style="width: 100%"><?=$sujiansiswa ? 'MULAI TES ULANG' : 'MULAI';?></button>
                            </div>
                        </div>


                        <div id="containerResult" class="col-md-12  my-5 py-5" style="display:none">
                            <div class="text-center">
                                <div class="mb-2">Kamu menjawab <span id="resultTerjawab">0</span> dari total <span id="resultTotalsoal">0</span> pertanyaan.</div>
                                <div>Nilai Kamu</div>
                                <span style="font-size: 35px; font-weight: 600;line-height:1" id="resultNilai">0</span>
                            </div>
                            <div class="bodyBtnMulaiQuiz mt-2 p-2 text-center" style="display: none">
                                <a href="javascript:;" onclick="location.reload()" class="h-11 btn bg-info font-medium text-white hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90">ULANGI TES INI</a>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
        <div class="col-span-12 lg:col-span-8 xl:col-span-9">
            <div id="containerBeforeSoal" style="<?=isset($ujiansiswa) && $ujiansiswa ? 'display:none':null;?>">
                <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100 mb-4">
                    <?=$ujian->nama_ujian;?>
                </h2>
                <p>
                    <?=$ujian->deskripsi;?>
                </p>
            </div>
            <div id="containerSoal" style="display:none">
                <form id="formUjian">
                <?php 
                    $jawabans = isset($ujiansiswa->detailquiz) && $ujiansiswa->detailquiz ? @unserialize($ujiansiswa->detailquiz) : array();
                    $first_soal_id = 0;
                    foreach($soals as $no=>$soal):
                        if($no==0) $first_soal_id = $soal->soal_id;
                ?>
                <div class="mb-5 bodysoal bodySoal<?=$no+1;?>" id="bodysoal<?=$soal->soal_id;?>">
                    <div class="mb-3" style="font-size: 140%">
                        <div class="mb-4" style="font-size: 24px">
                            <strong>Soal Nomor <?=$no+1;?></strong>
                        </div>
                        <?php if($soal->keterangan):?>
                        <div class="mb-3" style="font-weight: 600"><?=$soal->keterangan;?></div>
                        <?php endif;?>
                        <?=str_replace(['<p>', '</p>'], '', $soal->soal);?>
                    </div>
                    <div>
                        <div type="A" style="margin-left: 40px;" class="bodyJawaban grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
                            <?php 
                                $abjads = ["A","B","C","D","E","F","G","H","I","J"];
                                foreach((isset($soal->jawabans) ? $soal->jawabans : []) as $key=>$jawaban):
                                    $checked = isset($jawabans[$soal->soal_id]) && $jawabans[$soal->soal_id]==$jawaban->jawaban_id ? "checked" : null;
                            ?>
                            <div class="childJawaban col-span-12 sm:col-span-6 lg:col-span-4 xl:col-span-4">
                                <label style="cursor: pointer;padding: 10px 0; width: 100%;">
                                    <input type="radio" style="position: absolute;margin-left: -38px;margin-top: 5px;" onclick="setNavChecked(<?=$soal->soal_id;?>)" name="jawaban[<?=$soal->soal_id;?>]" value="<?=$jawaban->jawaban_id;?>" <?=$checked;?>> 
                                    <div class="mb-2" style="font-weight: 600">Jawaban <?=$abjads[$key];?></div>
                                    <div class="p-2">
                                        <?=$jawaban->jawaban;?>
                                    </div>
                                </label>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
                </form>
            </div>

        </div>
    </div>
</main>


<script type="text/javascript">

    var x = null,
        intervalUpdateTes = null,
        is_start = false,
        jumlah_soal = <?=count($soals);?>,
        current_soal = 1,
        ujiansiswa_id = false,
        pelanggaran = 1

    const handleVisibilityChange = function() {
        if(!is_start) return false
        if (document.visibilityState === 'visible') return false
        if(pelanggaran<=3) return Swal.fire({
            title: "Peringatan ke "+(pelanggaran),
            text: 'Kamu tidak diperbolehkan pindah dari tab/window ujian ini. Jika selanjutnya kamu melakukannya lagi maka ujian kamu akan langsung berakhir.',
            icon: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Mengerti'
        }).then((result) => {
            pelanggaran = pelanggaran+1
        })
        return updateUjianSiswa('#btnAkhiriTes')

    }
    document.addEventListener("visibilitychange", handleVisibilityChange);

    function setNavChecked(s_id){
        $(".navQuiz"+s_id).addClass("checked")
    }

    function nextSoal(){
        
        if(current_soal>=jumlah_soal) return false

        current_soal = current_soal+1

        $('.bodysoal').each(function(i,v){
            if($(this).hasClass('show')) $(this).removeClass("show")
        })
        
        $('.navQuiz').each(function(i,v){
            if($(this).hasClass('selected')) $(this).removeClass("selected")
        })
        
        $(".bodySoal"+current_soal).addClass("show")
        $('#navigasiSoal'+current_soal).addClass("selected")
        
        initNextPrevBtn()

    }

    
    function initPage(){
        $('#containerNavigasi').removeClass('col-md-12').addClass('col-md-4')
        $('#nextPrevNav, #containerSoal, .titleNav, .bodyNav').show()
    }
    
    function destroyPage(){
        $('.bodyBtnMulaiQuiz, #containerBeforeSoal').show()
        $('.bodyBtnTes').hide()

        $('#containerNavigasi').removeClass('col-md-4').addClass('col-md-12')
        $('#nextPrevNav, #containerSoal, .titleNav, .bodyNav').hide()
        
        clearInterval(x);
        clearInterval(intervalUpdateTes);
        $('#quizTimer').html("<?=$ujian->durasi;?> Menit")
    }


    function prevSoal(){
        
        if(current_soal<=1) return false
        
        current_soal = current_soal-1
        

        $('.bodysoal').each(function(i,v){
            if($(this).hasClass('show')) $(this).removeClass("show")
        })
        
        $('.navQuiz').each(function(i,v){
            if($(this).hasClass('selected')) $(this).removeClass("selected")
        })
        
        $(".bodySoal"+current_soal).addClass("show")
        $('#navigasiSoal'+current_soal).addClass("selected")
        
        initNextPrevBtn()
    
    }
    
    initNextPrevBtn()
    function initNextPrevBtn(){
        
        if(current_soal <= 1){
            $('#btnPrevSoal').hide()
        }else{
            $('#btnPrevSoal').show()
        }
        if(current_soal >= jumlah_soal) {
            $('#btnNextSoal').hide()
        }else{
            $('#btnNextSoal').show()
        }

    }

    <?php if(isset($ujiansiswa) && $ujiansiswa):?>
        startCountDown("<?=date("Y-m-d H:i:s");?>","<?=$ujiansiswa->waktu_akhir;?>")
        document.getElementById("quizTimer").innerHTML = "00:00:00"
        $('.bodyBtnTes').show()
        ujiansiswa_id = <?=$ujiansiswa->ujiansiswa_id;?>
        
        updateTes()
        initPage()
    <?php else:?>
        $('.bodyBtnMulaiQuiz').show()
    <?php endif;?>

    
    $('#btnAkhiriTes').click(function(){
        var el = this

        Swal.fire({
          title: 'Akhiri Tes Ini',
          text: "Apakah anda yakin untuk mengakhiri tes ini ?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Batal',
          confirmButtonText: 'Akhiri Tes'
        }).then((result) => {
            if (result.isConfirmed) {
                updateUjianSiswa(el)
            }
        })

    })


    var updatingUjianSiswa = false
    function updateUjianSiswa(el=false){
        
        if(updatingUjianSiswa) return false
        
        if(el) var lhtml = $(el).html()
        
        var formUjian = new FormData($('#formUjian')[0])
            formUjian.append('ujiansiswa_id', ujiansiswa_id)
            if(el) formUjian.append('is_quisdiakhiri', true)
            
        $.ajax({
            url: "<?=base_url("cat/updateujiansiswa");?>",
            type: "post",
            cache: false,
            processData: false,
            contentType: false,
            data: formUjian,
            beforeSend: function(){
                if(el) $(el).prop('disabled', true).html('Mengakhiri . .')
            },
            error: function(a,b,c){
                if(el) $(el).prop('disabled', false).html(lhtml)
            },
            success: function(res){
                if(el){
                    is_start = false
                    destroyPage()
                    $(el).prop('disabled', false).html(lhtml)
                    $('#containerResult').show()
                    $('#containerNavigasi, #nextPrevNav').hide()
                    $('#resultTerjawab').html(res.result.jumlah_terjawab)
                    $('#resultTotalsoal').html(res.result.jumlah_soal)
                    $('#resultNilai').html(res.result.nilai)
                } 
            }
        })

    }
    
    $('#btnMulaiQuiz').click(function(){
        var lhtml = $(this).html(),
        el = this

        Swal.fire({
          title: 'Mulai Tes',
          text: "Anda akan memulai tes ini dengan jumlah soal sebanyak <?=count($soals);?> soal, dalam waktu <?=$ujian->durasi;?> menit.",
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Batal',
          confirmButtonText: 'Mulai Sekarang'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?=base_url("cat/domulaites/".$ujian->ujian_id);?>",
                    type: "get",
                    beforeSend: function(){
                        $(el).prop('disabled', true).html('Memulai . .')
                    },
                    error: function(a,b,c){
                        $(el).prop('disabled', false).html(lhtml)
                    },
                    success: function(res){
                        $(el).prop('disabled', false).html(lhtml)
                        $('.bodyBtnMulaiQuiz, .bodyLastUjian, #containerBeforeSoal').hide()
                        $('.bodyBtnTes').show()
                        is_start = true
                        console.log(res.result);
                        startCountDown(res.result.waktu_mulai, res.result.waktu_akhir)
                        ujiansiswa_id = res.result.ujiansiswa_id
                        updateTes()
                        initPage()
                    }
                })
            }
        })
    })
    
    changeNavigasi($('.navQuiz')[0], <?=$first_soal_id;?>, 1)
    function changeNavigasi(el, soal_id, no){

        $('.bodysoal').each(function(i,v){
            if($(this).hasClass('show')) $(this).removeClass("show")
        })
        
        $('.navQuiz').each(function(i,v){
            if($(this).hasClass('selected')) $(this).removeClass("selected")
        })
        
        $("#bodysoal"+soal_id).addClass("show")
        $(el).addClass("selected")
        
        current_soal = no
        initNextPrevBtn()

    }

    function startCountDown(_now, dt){
        var countDownDate = new Date(dt).getTime();
        x = setInterval(function() {
            var el          = document.getElementById("quizTimer")
            var now         = new Date(_now).getTime();
            var distance    = countDownDate - now;
            var hours       = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes     = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds     = Math.floor((distance % (1000 * 60)) / 1000);
            hours           = hours < 10 ? hours = "0" + hours : hours
            minutes         = minutes < 10 ? minutes = "0" + minutes : minutes
            seconds         = seconds < 10 ? seconds = "0" + seconds : seconds
        
            el.innerHTML    = distance < 1 ? "00:00:00" : hours + ":" + minutes + ":" + seconds;
            _now = now+(1000)
            // console.log(now);
            if (distance < 0) {
                $('.bodyBtnTes').hide()
                clearInterval(x);
                clearInterval(intervalUpdateTes);
                Swal.fire({
                  title: 'Waktu Kamu Telah Habis',
                  icon: 'warning',
                  showCancelButton: true,
                  cancelButtonColor: '#d33',
                  cancelButtonText: 'Tutup',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Lihat hasil'
                }).then((result) => {
                    if (result.isConfirmed) {
                        updateUjianSiswa('#btnAkhiriTes')
                    }
                })

            }
        }, 1000);
    }
    
    function updateTes(){
        intervalUpdateTes = setInterval(function() {
            updateUjianSiswa()
        }, (1000 * 10));
    }



</script>

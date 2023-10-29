<!-- Main Content Wrapper -->
<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
        <div class="col-span-12 lg:col-span-8 xl:col-span-9">
            <div :class="$store.breakpoints.smAndUp && 'via-purple-300'" class="card mt-12 bg-gradient-to-l from-pink-300 to-indigo-400 p-5 sm:mt-0 sm:flex-row">
                <div class="flex justify-center sm:order-last">
                    <img class="-mt-16 h-40 sm:mt-0" src="<?=base_url();?>assets/images/illustrations/teacher.svg" alt="" />
                </div>
                <div class="mt-2 flex-1 pt-2 text-center text-white sm:mt-0 sm:text-left">
                    <h3 class="text-xl">Selamat datang, <span class="font-semibold"><?=session()->get('siswa')['nama'];?></span></h3>
                    <?php if(isset($ujianterbaru->nama_ujian)):?>
                    <p class="mt-2 leading-relaxed">
                        Ada test baru untukmu,
                        <span class="font-semibold text-navy-700 text-white"><?=$ujianterbaru->nama_ujian;?></span> telah dibuka untukmu.
                    </p>
                    <p>Klik tombol dibawah ini untuk memulai tes, <span class="font-semibold">Semoga berhasil</span></p>

                    <a href="<?=base_url('cat/mulaites/'.$ujianterbaru->ujian_id);?>" class="btn mt-6 bg-slate-50 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80">
                        Mulai Tes Sekarang
                    </a>
                    <?php else:?>
                    <p class="mt-4">di Sistem Aplikasi CAT (Computer Assisted Test) Syndicate Bina Latihan</p>
                    <?php endif;?>
                </div>
            </div>


            <div class="mt-4 sm:mt-5 lg:mt-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                        Daftar Tes Untuk Kamu
                    </h2>
                </div>
                <!-- <div class="card mt-3"> -->
                <div class="card mt-3" style="--tw-shadow: none;--tw-shadow-colored: none;background-color: unset;">
                    <?=$HelperModel->getAlert('alertUjian');?>
                    <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                        <table class="is-hoverable is-zebra w-full text-left" id="datatable">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                        NAMA TES
                                    </th>
                                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                        DESKRIPSI
                                    </th>
                                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                        TANGGAL
                                    </th>
                                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                        STATUS
                                    </th>
                                    <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                        MASUK PADA
                                    </th>

                                    <th class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-4 xl:col-span-3">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-1 lg:gap-6">
                <?php if(isset($ujianterbaru->nama_ujian)):?>
                <div class="sm:col-span-2 lg:col-span-1">
                    <div class="flex h-8 items-center justify-between">
                        <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
                            Ranking Nilai <?=$ujianterbaru->nama_ujian;?>
                        </h2>
                    </div>
                    <div class="mt-3 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-x-5 lg:grid-cols-1">
                        <?php foreach($ranks as $rank):?>
                        <div class="card p-3">
                            <div class="flex items-center justify-between space-x-2">
                                <div class="flex items-center space-x-3">
                                    <div class="avatar h-10 w-10">
                                        <img class="rounded-full" src="<?=resource_url();?>assets-cat/images/avatar/user.png" alt="avatar" />
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100">
                                            <?=$rank->nama_siswa;?>
                                        </p>
                                        <p class="mt-0.5 text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                                        <?=$rank->nik;?>
                                        </p>
                                    </div>
                                </div>
                                <div class="relative cursor-pointer">
                                    <?=$rank->nilai;?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</main>


<script>
    drawdatatable()
    function drawdatatable(){
        $('#datatable').DataTable().clear()
        $('#datatable').DataTable().destroy()
        dataTable = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            dom: '<"top">rt<"bottom"><\'mt-3\'p><"clear">',
            paging: false,
            pageLength: $('#tampilkan_datatable').val(),
            language: {
                url: datatablesLanguage
            },
            responsive: true,
            order: [[ 1, "asc" ]],
            ajax: {
                url: "<?=base_url('cat/getdatatable');?>",
                type: "post",
                data: {
                },
                beforeSend: function(){
                }
            },
            fnInitComplete: function(settings, json) {
            },
            drawCallback: function( settings ) {
            },
            columnDefs: [
                { 
                    orderable: false, 
                    targets: "_all"
                },
            ]
        })
    }
</script>
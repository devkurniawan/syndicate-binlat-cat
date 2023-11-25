<!-- Main Content Wrapper -->
<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
        <div class="col-span-12 lg:col-span-12 xl:col-span-12">
            <div :class="$store.breakpoints.smAndUp && 'via-purple-300'" class="card mt-12 bg-gradient-to-l from-pink-300 to-indigo-400 p-5 sm:mt-0 sm:flex-row">
                <div class="flex justify-center sm:order-last">
                    <img class="-mt-16 h-40 sm:mt-0" src="<?=base_url();?>assets/images/illustrations/teacher.svg" alt="" />
                </div>
                <div class="mt-2 flex-1 pt-2 text-center text-white sm:mt-0 sm:text-left">
                    <h3 class="text-xl">Selamat datang, <span class="font-semibold"><?=session()->get('siswa')['nama'];?></span></h3>
                    <?php if(isset($ujianagenda->nama_agenda)):?>
                    <p class="mt-2 leading-relaxed">
                        <span class="font-semibold text-navy-700 text-white"><?=$ujianagenda->nama_agenda;?></span> telah dibuka untukmu
                    </p>
                    <?php if(isset($ujianterbaru->nama_ujian)):?>
                        <p>Klik tombol dibawah ini untuk memulai <strong><?=$ujianterbaru->nama_ujian;?></strong>, Semoga hasilnya terbaik</p>
                        <a href="<?=base_url('cat/mulaites/'.$ujianterbaru->ujian_id);?>" class="btn mt-6 bg-slate-50 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80">
                            Mulai Tes Sekarang
                        </a>
                    <?php endif;?>
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
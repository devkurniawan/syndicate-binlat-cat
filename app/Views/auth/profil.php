<!-- Main Content Wrapper -->
<main class="main-content w-full px-[var(--margin-x)] pb-8">
    <div class="flex items-center space-x-4 py-5 lg:py-6">
        <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
            Profil Saya
        </h2>
        <div class="hidden h-full py-1 sm:flex">
        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
        </div>
        <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
        <li class="flex items-center space-x-2">
            <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent" href="<?=base_url();?>">Dashboard</a>
            <svg
            x-ignore
            xmlns="http://www.w3.org/2000/svg"
            class="h-4 w-4"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 5l7 7-7 7"
            />
            </svg>
        </li>
        <li>Profil Saya</li>
        </ul>
    </div>

    <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
        <div class="col-span-12">
            <div class="card">
                <div class="p-2">
                <?=$HelperModel->getAlert('flashAlert');?>
                </div>

                <form method="post" id="formData" enctype="multipart/form-data">
                <div class="p-4 sm:p-5">
                    <div class="flex flex-col">
                        <span class="text-base font-medium text-slate-600 dark:text-navy-100">Foto Profil</span>
                        <div class="avatar mt-1.5 h-20 w-20">
                            <img
                                class="mask is-squircle"
                                src="<?=resource_url(session()->get('siswa')['foto'] ? session()->get('siswa')['foto'] : "assets-cat/images/avatar/user.png");?>"
                                alt="avatar"
                            />
                            <div class="absolute bottom-0 right-0 flex items-center justify-center rounded-full bg-white dark:bg-navy-700">
                                <button type="button" onclick="$('.bodyFieldFoto').show()" class="btn h-6 w-6 rounded-full border border-slate-200 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:border-navy-500 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mt-2 bodyFieldFoto" style="<?=!isset($errors['foto']) ? 'display: none' : null;?>">
                            <input type="file" name="foto" id="foto">
                            <?=isset($errors['foto']) ? '<div class="text-tiny+ text-error mt-2">'.$errors['foto'].'</div>' : null;?>
                        </div>
                </div>
                <div class="" style="max-width: 800px">
                <?php 
                        $fname  = "nama";
                        $ftitle = "Nama";
                        $req    = true;
                    ?>
                    <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
                        <div class="col-span-12 lg:col-span-5 xl:col-span-4 pt-3">
                            <span><?=$ftitle;?></span> <?=$req ? '<sup class="text-error">*</sup>' : null;?>
                        </div>  
                        <div class="col-span-12 lg:col-span-7 xl:col-span-8">
                            <input name="<?=$fname;?>" id="<?=$fname;?>" value="<?=isset($user[$fname]) && $user[$fname] ? $user[$fname] : null?>" class="form-input peer <?=isset($errors[$fname]) ? 'border-error' : null;?> rounded-lg w-full border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Masukkan <?=$ftitle;?>" type="text" <?=$req ? null : null;?>/>
                            <?=isset($errors[$fname]) ? '<span class="text-tiny+ text-error">'.$errors[$fname].'</span>' : null;?>
                        </div>  
                    </div>  

                    <?php 
                        $fname  = "nik";
                        $ftitle = "NIK";
                        $req    = false;
                    ?>
                    <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
                        <div class="col-span-12 lg:col-span-5 xl:col-span-4 pt-3">
                            <span><?=$ftitle;?></span> <?=$req ? '<sup class="text-error">*</sup>' : null;?>
                        </div>  
                        <div class="col-span-12 lg:col-span-7 xl:col-span-8">
                            <input name="<?=$fname;?>" id="<?=$fname;?>" value="<?=isset($user[$fname]) && $user[$fname] ? $user[$fname] : null?>" class="form-input peer <?=isset($errors[$fname]) ? 'border-error' : null;?> rounded-lg w-full border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Masukkan <?=$ftitle;?>" type="number" <?=$req ? null : null;?>/>
                            <?=isset($errors[$fname]) ? '<span class="text-tiny+ text-error">'.$errors[$fname].'</span>' : null;?>
                        </div>  
                    </div>  

                    <?php 
                        $fname  = "jenis_kelamin";
                        $ftitle = "Jenis Kelamin";
                        $req    = true;
                    ?>
                    <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
                        <div class="col-span-12 lg:col-span-5 xl:col-span-4 pt-3">
                            <span><?=$ftitle;?></span> <?=$req ? '<sup class="text-error">*</sup>' : null;?>
                        </div>  
                        <div class="col-span-12 lg:col-span-7 xl:col-span-8">
                            <input name="<?=$fname;?>" id="<?=$fname;?>" value="<?=isset($user[$fname]) && $user[$fname] ? $user[$fname] : null?>" class="form-input peer <?=isset($errors[$fname]) ? 'border-error' : null;?> rounded-lg w-full border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Masukkan <?=$ftitle;?>" type="text" <?=$req ? null : null;?>/>
                            <?=isset($errors[$fname]) ? '<span class="text-tiny+ text-error">'.$errors[$fname].'</span>' : null;?>
                        </div>  
                    </div>  

                    <?php 
                        $fname  = "tempat_lahir";
                        $ftitle = "Tempat Lahir";
                        $req    = true;
                    ?>
                    <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
                        <div class="col-span-12 lg:col-span-5 xl:col-span-4 pt-3">
                            <span><?=$ftitle;?></span> <?=$req ? '<sup class="text-error">*</sup>' : null;?>
                        </div>  
                        <div class="col-span-12 lg:col-span-7 xl:col-span-8">
                            <input name="<?=$fname;?>" id="<?=$fname;?>" value="<?=isset($user[$fname]) && $user[$fname] ? $user[$fname] : null?>" class="form-input rounded-lg peer w-full border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Masukkan <?=$ftitle;?>" type="text" <?=$req ? null : null;?>/>
                            <?=isset($errors[$fname]) ? '<span class="text-tiny+ text-error">'.$errors[$fname].'</span>' : null;?>
                        </div>  
                    </div>  

                    <?php 
                        $fname  = "tanggal_lahir";
                        $ftitle = "Tanggal Lahir";
                        $req    = true;
                    ?>
                    <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
                        <div class="col-span-12 lg:col-span-5 xl:col-span-4 pt-3">
                            <span><?=$ftitle;?></span> <?=$req ? '<sup class="text-error">*</sup>' : null;?>
                        </div>  
                        <div class="col-span-12 lg:col-span-7 xl:col-span-8">
                            <label class="relative flex">
                                <input
                                x-init="$el._x_flatpickr = flatpickr($el)"
                                class="form-input peer <?=isset($errors[$fname]) ? 'border-error' : null;?> rounded-lg w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Pilih Tanggal"
                                value="<?=isset($user[$fname]) && $user[$fname] ? $user[$fname] : null?>"
                                type="text"
                                name="<?=$fname;?>" id="<?=$fname;?>" 
                                <?=$req ? null : null;?>
                                />
                                <span
                                class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                                >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 transition-colors duration-200"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                >
                                    <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>
                                </span>
                            </label>
                            <?=isset($errors[$fname]) ? '<span class="text-tiny+ text-error">'.$errors[$fname].'</span>' : null;?>
                        </div>  
                    </div>  

                    <?php 
                        $fname  = "alamat";
                        $ftitle = "Alamat";
                        $req    = true;
                    ?>
                    <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
                        <div class="col-span-12 lg:col-span-5 xl:col-span-4 pt-3">
                            <span><?=$ftitle;?></span> <?=$req ? '<sup class="text-error">*</sup>' : null;?>
                        </div>  
                        <div class="col-span-12 lg:col-span-7 xl:col-span-8">
                            <textarea name="<?=$fname;?>" id="<?=$fname;?>" class="form-input peer <?=isset($errors[$fname]) ? 'border-error' : null;?> rounded-lg w-full border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Masukkan <?=$ftitle;?>" type="text" <?=$req ? null : null;?>><?=isset($user[$fname]) && $user[$fname] ? $user[$fname] : null?></textarea>
                            <?=isset($errors[$fname]) ? '<span class="text-tiny+ text-error">'.$errors[$fname].'</span>' : null;?>
                        </div>  
                    </div>  

                    <?php 
                        $fname  = "nomor_hp";
                        $ftitle = "Nomor HP";
                        $req    = true;
                    ?>
                    <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
                        <div class="col-span-12 lg:col-span-5 xl:col-span-4 pt-3">
                            <span><?=$ftitle;?></span> <?=$req ? '<sup class="text-error">*</sup>' : null;?>
                        </div>  
                        <div class="col-span-12 lg:col-span-7 xl:col-span-8">
                            <input name="<?=$fname;?>" id="<?=$fname;?>" value="<?=isset($user[$fname]) && $user[$fname] ? $user[$fname] : null?>" class="form-input peer <?=isset($errors[$fname]) ? 'border-error' : null;?> rounded-lg w-full border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Masukkan <?=$ftitle;?>" type="number" <?=$req ? null : null;?>/>
                            <?=isset($errors[$fname]) ? '<span class="text-tiny+ text-error">'.$errors[$fname].'</span>' : null;?>
                        </div>  
                    </div>  

                    <?php 
                        $fname  = "email";
                        $ftitle = "E-Mail";
                        $req    = true;
                    ?>
                    <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
                        <div class="col-span-12 lg:col-span-5 xl:col-span-4 pt-3">
                            <span><?=$ftitle;?></span> <?=$req ? '<sup class="text-error">*</sup>' : null;?>
                        </div>  
                        <div class="col-span-12 lg:col-span-7 xl:col-span-8">
                            <input name="<?=$fname;?>" id="<?=$fname;?>" value="<?=isset($user[$fname]) && $user[$fname] ? $user[$fname] : null?>" class="form-input peer <?=isset($errors[$fname]) ? 'border-error' : null;?> rounded-lg w-full border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" placeholder="Masukkan <?=$ftitle;?>" type="email" <?=$req ? null : null;?>/>
                            <?=isset($errors[$fname]) ? '<span class="text-tiny+ text-error">'.$errors[$fname].'</span>' : null;?>
                        </div>  
                    </div>  


                    <div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
                        <div class="col-span-12 lg:col-span-5 xl:col-span-4 pt-3">
                        </div>  
                        <div class="col-span-12 lg:col-span-7 xl:col-span-8">
                            <button id="btnSubmit" class="btn min-w-[7rem] bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">SIMPAN</button>
                        </div>  
                    </div>  
                </div>
                </form>

            </div>
        </div>
    </div>
</main>
<script>
    window.addEventListener("DOMContentLoaded", () => Alpine.start());
    $('#formData').submit(function(){
        $('#btnSubmit').prop('disabled', true).html('Memuat . .')
    })
</script>

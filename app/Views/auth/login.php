<?php
    $db             = \Config\Database::connect();
    $HelperModel    = new \App\Models\HelperModel();
    $dataSitus      = $db->table('tb_pengaturan_situs')->where('website_id', 1)->get()->getRow();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta tags  -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

        <title><?=$title;?></title>
        <link rel="icon" type="image/png" href="<?=resource_url."/".str_replace("../","",$dataSitus->logo_favicon);?>" />

        <!-- CSS Assets -->
        <link rel="stylesheet" href="<?=resource_url('assets-cat/css/app.css');?>" />
        <link rel="stylesheet" href="<?=resource_url('assets-cat/css/custom.css');?>" />

        <!-- Javascript Assets -->
        <script src="<?=resource_url('assets-cat/js/app.js');?>" defer></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com/" />
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
    </head>
    <body x-data class="is-header-blur" x-bind="$store.global.documentBody">
        <!-- App preloader-->
        <div class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50 dark:bg-navy-900">
            <div class="app-preloader-inner relative inline-block h-48 w-48"></div>
        </div>

        <!-- Page Wrapper -->
        <div id="root" class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900" x-cloak>
            <main class="grid w-full grow grid-cols-1 place-items-center">
                <div class="w-full max-w-[26rem] p-4 sm:px-5">
                    <div class="text-center">
                        <img class="mx-auto h-16" src="<?=resource_url($dataSitus->logo);?>" alt="logo" />
                        <div class="mt-4">
                            <h2 class="text-2xl font-semibold text-slate-600 dark:text-navy-100">
                                Selamat Datang
                            </h2>
                            <p class="text-slate-400 dark:text-navy-300">
                                Silahkan login menggunakan username dan password anda untuk melanjutkan
                            </p>
                        </div>
                    </div>
                    <div class="card mt-5 rounded-lg p-5 lg:p-7">
                        <?=$HelperModel->getAlert('flashAlert');?>
                        <form id="formData" method="post">
                            <label class="block">
                                <span>Username:</span>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        class="form-input <?=isset($errors['username']) ? 'border-error' : null;?> peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter Username"
                                        type="text"
                                        name="username"
                                        autofocus
                                    />
                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                </span>
                                <?=isset($errors['username']) ? '<span class="text-tiny+ text-error">'.$errors['username'].'</span>' : null;?>
                            </label>
                            <label class="mt-4 block">
                                <span>Password:</span>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        class="form-input <?=isset($errors['password']) ? 'border-error' : null;?> peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        placeholder="Enter Password"
                                        type="password"
                                        name="password"
                                    />
                                    <span class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </span>
                                </span>
                                <?=isset($errors['password']) ? '<span class="text-tiny+ text-error">'.$errors['password'].'</span>' : null;?>
                            </label>
                            <div class="mt-4 flex items-center justify-between space-x-2">
                                <label class="inline-flex items-center space-x-2">
                                    <input
                                        class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                                        type="checkbox"
                                    />
                                    <span class="line-clamp-1">Remember me</span>
                                </label>
                                <a href="#" class="text-xs text-slate-400 transition-colors line-clamp-1 hover:text-slate-800 focus:text-slate-800 dark:text-navy-300 dark:hover:text-navy-100 dark:focus:text-navy-100">Forgot Password?</a>
                            </div>
                            <button 
                                id="btnSubmit" 
                                class="btn mt-5 w-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                Masuk
                            </button>
                            <div class="mt-4 text-center text-xs+">
                            </div>

                        </form>
                    </div>
                    <div class="mt-8 flex justify-center text-xs text-slate-400 dark:text-navy-300">
                        <a href="#">Privacy Notice</a>
                        <div class="mx-3 my-1 w-px bg-slate-200 dark:bg-navy-500"></div>
                        <a href="#">Term of service</a>
                    </div>
                </div>
            </main>
        </div>

        <div id="x-teleport-target"></div>
        <script>
            window.addEventListener("DOMContentLoaded", () => Alpine.start());
            $('#formData').submit(function(){
                $('#btnSubmit').prop('disabled', true).html('Memuat . .')
            })
        </script>
    </body>
</html>

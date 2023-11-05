<!-- Main Sidebar -->
<div class="main-sidebar">
    <div class="flex h-full w-full flex-col items-center border-r border-slate-150 bg-white dark:border-navy-700 dark:bg-navy-800">
        <!-- Application Logo -->
        <div class="flex pt-4">
            <!-- <a href="<?=base_url();?>assets-cat/index.html">
                <img class="h-11 w-11 transition-transform duration-500 ease-in-out hover:rotate-[360deg]" src="<?=resource_url($dataSitus->logo_favicon);?>" alt="logo" />
            </a> -->
            <!-- Profile -->
            <div x-data="usePopper({placement:'right-end',offset:12})" @click.outside="if(isShowPopper) isShowPopper = false" class="flex">
                <button @click="isShowPopper = !isShowPopper" x-ref="popperRef" class="avatar h-12 w-12">
                    <img class="rounded-full" src="<?=resource_url(session()->get('siswa')['foto'] ? session()->get('siswa')['foto'] : "assets-cat/images/avatar/user.png");?>" alt="avatar" />
                    <span class="absolute right-0 h-3.5 w-3.5 rounded-full border-2 border-white bg-success dark:border-navy-700"></span>
                </button>

                <div :class="isShowPopper && 'show'" class="popper-root fixed" x-ref="popperRoot">
                    <div class="popper-box w-64 rounded-lg border border-slate-150 bg-white shadow-soft dark:border-navy-600 dark:bg-navy-700">
                        <div class="flex items-center space-x-4 rounded-t-lg bg-slate-100 py-5 px-4 dark:bg-navy-800">
                            <div class="avatar h-14 w-14">
                                <img class="rounded-full" src="<?=resource_url(session()->get('siswa')['foto'] ? session()->get('siswa')['foto'] : "assets-cat/images/avatar/user.png");?>" alt="avatar" />
                            </div>
                            <div>
                                <a href="<?=base_url();?>assets-cat/#" class="text-base font-medium text-slate-700 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
                                    <?=session()->get('siswa')['nama'];?>
                                </a>
                                <p class="text-xs text-slate-400 dark:text-navy-300">
                                    <?=session()->get('siswa')['nik'];?>
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col pt-2 pb-5">
                            <div class="mt-3 px-4">
                                <a href="<?=base_url('logout');?>"
                                    class="btn h-9 w-full space-x-2 bg-primary text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Main Sections Links -->
        <div class="is-scrollbar-hidden flex grow flex-col space-y-4 overflow-y-auto pt-6" style="justify-content: center;">
            <!-- Dashobards -->
            <!-- <a
                href="<?=base_url();?>"
                class="flex h-11 w-11 items-center justify-center rounded-lg <?=isset($menu) && $menu=="home" ? 'bg-primary/10 dark:bg-navy-600':null;?> outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
                x-tooltip.placement.right="'Dashboards'"
            >
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M5 14.0585C5 13.0494 5 12.5448 5.22166 12.1141C5.44333 11.6833 5.8539 11.3901 6.67505 10.8035L10.8375 7.83034C11.3989 7.42938 11.6795 7.2289 12 7.2289C12.3205 7.2289 12.6011 7.42938 13.1625 7.83034L17.325 10.8035C18.1461 11.3901 18.5567 11.6833 18.7783 12.1141C19 12.5448 19 13.0494 19 14.0585V19C19 19.9428 19 20.4142 18.7071 20.7071C18.4142 21 17.9428 21 17 21H7C6.05719 21 5.58579 21 5.29289 20.7071C5 20.4142 5 19.9428 5 19V14.0585Z"
                        fill-opacity="0.3"
                        class="<?=isset($menu) && $menu=="home" ? 'fill-primary dark:fill-accent':'fill-slate-500 dark:fill-navy-200';?>"
                    />
                    <path
                        d="M3 12.3866C3 12.6535 3 12.7869 3.0841 12.8281C3.16819 12.8692 3.27352 12.7873 3.48418 12.6234L10.7721 6.95502C11.362 6.49625 11.6569 6.26686 12 6.26686C12.3431 6.26686 12.638 6.49625 13.2279 6.95502L20.5158 12.6234C20.7265 12.7873 20.8318 12.8692 20.9159 12.8281C21 12.7869 21 12.6535 21 12.3866V11.9782C21 11.4978 21 11.2576 20.8983 11.0497C20.7966 10.8418 20.607 10.6944 20.2279 10.3995L13.2279 4.95502C12.638 4.49625 12.3431 4.26686 12 4.26686C11.6569 4.26686 11.362 4.49625 10.7721 4.95502L3.77212 10.3995C3.39295 10.6944 3.20337 10.8418 3.10168 11.0497C3 11.2576 3 11.4978 3 11.9782V12.3866Z"
                        class="<?=isset($menu) && $menu=="home" ? 'fill-primary dark:fill-accent':'fill-slate-500 dark:fill-navy-200';?>"
                    />
                    <path
                        d="M12.5 15H11.5C10.3954 15 9.5 15.8954 9.5 17V20.85C9.5 20.9328 9.56716 21 9.65 21H14.35C14.4328 21 14.5 20.9328 14.5 20.85V17C14.5 15.8954 13.6046 15 12.5 15Z"
                        class="<?=isset($menu) && $menu=="home" ? 'fill-primary dark:fill-accent':'fill-slate-500 dark:fill-navy-200';?>"
                    />
                    <rect x="16" y="5" width="2" height="4" rx="0.5" class="<?=isset($menu) && $menu=="home" ? 'fill-primary dark:fill-accent':'fill-slate-500 dark:fill-navy-200';?>" />
                </svg>
            </a> -->

            <!-- Apps -->
            <a
                href="<?=base_url('cat');?>"
                class="flex h-11 w-11 items-center justify-center rounded-lg <?=isset($menu) && $menu=="cat" ? 'bg-primary/10 dark:bg-navy-600':null;?> outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                x-tooltip.placement.right="'CAT (Computer Assisted Test)'"
            >
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M13.3111 14.75H5.03356C3.36523 14.75 2.30189 12.9625 3.10856 11.4958L5.24439 7.60911L7.24273 3.96995C8.07689 2.45745 10.2586 2.45745 11.0927 3.96995L13.1002 7.60911L14.0627 9.35995L15.2361 11.4958C16.0427 12.9625 14.9794 14.75 13.3111 14.75Z" class="<?=isset($menu) && $menu=="cat" ? 'fill-primary dark:fill-accent':'fill-slate-500 dark:fill-navy-200';?>"></path>
                  <path fill-opacity="0.3" d="M21.1667 15.2083C21.1667 18.4992 18.4992 21.1667 15.2083 21.1667C11.9175 21.1667 9.25 18.4992 9.25 15.2083C9.25 15.0525 9.25917 14.9058 9.26833 14.75H13.3108C14.9792 14.75 16.0425 12.9625 15.2358 11.4958L14.0625 9.36C14.4292 9.28666 14.8142 9.25 15.2083 9.25C18.4992 9.25 21.1667 11.9175 21.1667 15.2083Z" class="<?=isset($menu) && $menu=="cat" ? 'fill-primary dark:fill-accent':'fill-slate-500 dark:fill-navy-200';?>"></path>
                </svg>
            </a>


        </div>

        <!-- Bottom Links -->
        <div class="flex flex-col items-center space-y-3 py-3">
            <!-- Settings -->
            <a
                href="<?=base_url();?>assets-cat/form-layout-5.html"
                class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
            >
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        class="fill-slate-500 dark:fill-navy-200"
                        fill-opacity="0.3"
                        fill="currentColor"
                        d="M2 12.947v-1.771c0-1.047.85-1.913 1.899-1.913 1.81 0 2.549-1.288 1.64-2.868a1.919 1.919 0 0 1 .699-2.607l1.729-.996c.79-.474 1.81-.192 2.279.603l.11.192c.9 1.58 2.379 1.58 3.288 0l.11-.192c.47-.795 1.49-1.077 2.279-.603l1.73.996a1.92 1.92 0 0 1 .699 2.607c-.91 1.58-.17 2.868 1.639 2.868 1.04 0 1.899.856 1.899 1.912v1.772c0 1.047-.85 1.912-1.9 1.912-1.808 0-2.548 1.288-1.638 2.869.52.915.21 2.083-.7 2.606l-1.729.997c-.79.473-1.81.191-2.279-.604l-.11-.191c-.9-1.58-2.379-1.58-3.288 0l-.11.19c-.47.796-1.49 1.078-2.279.605l-1.73-.997a1.919 1.919 0 0 1-.699-2.606c.91-1.58.17-2.869-1.639-2.869A1.911 1.911 0 0 1 2 12.947Z"
                    />
                    <path
                        class="fill-slate-500 dark:fill-navy-200"
                        fill="currentColor"
                        d="M11.995 15.332c1.794 0 3.248-1.464 3.248-3.27 0-1.807-1.454-3.272-3.248-3.272-1.794 0-3.248 1.465-3.248 3.271 0 1.807 1.454 3.271 3.248 3.271Z"
                    />
                </svg>
            </a>

        </div>
    </div>
</div>

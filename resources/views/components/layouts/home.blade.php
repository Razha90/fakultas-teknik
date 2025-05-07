<!DOCTYPE html>
<html lang="{{ Cookie::get('locale', 'id') }}">

<head>
    @include('partials.app')
    <style>
        /* Default style */
        body.nprogress-page #nprogress .bar {
            background: #FCF259;
            height: 4px;
        }

        /* Warna untuk reading progress */
        body.nprogress-reading #nprogress .bar {
            background: #0ea5e9;
            height: 4px;
        }
    </style>
</head>

<body class="max-w-full">
    <livewire:component.nav />

    {{ $slot }}

    <div x-cloak x-data="{ alert: false, message: '' }"
        x-on:success.window="(event) => {
        alert = true;
        message = event.detail[0].message;
        
        setTimeout(() => {
            alert = false;
        }, 4000);
    }"
        x-show="alert" x-transition id="toast-success"
        class="fixed bottom-3 left-3 z-30 mb-4 flex w-full max-w-xs items-center rounded-lg bg-white p-4 text-gray-500 shadow-sm"
        role="alert">
        <div class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-green-100 text-green-500">
            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal" x-text="message"></div>
        <button @click="alert = false" type="button"
            class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300"
            data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>

    <div x-cloak x-data="{ alert: false, message: '' }"
        x-on:failed.window="(event) => {
        alert = true;
        message = event.detail[0].message;
        
        setTimeout(() => {
            alert = false;
        }, 4000);
    }"
        id="toast-danger" x-show="alert" x-transition
        class="fixed bottom-3 left-3 z-30 mb-4 flex w-full max-w-xs items-center rounded-lg bg-white p-4 text-gray-500 shadow-sm"
        role="alert">
        <div class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-500">
            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
            </svg>
            <span class="sr-only">Error icon</span>
        </div>
        <div class="ms-3 text-sm font-normal" x-text="message"></div>
        <button @click="alert = false" type="button"
            class="-mx-1.5 -my-1.5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-gray-300"
            data-dismiss-target="#toast-danger" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>

    <div x-cloak x-data="{ shown: false }" x-on:searching.window="(event) => {
        shown = true;
    }"
        class="fixed inset-0 z-40 flex items-center justify-center bg-black/60" x-transition x-show="shown">
        <div class="w-md h-[100px] max-w-md" @click.away="shown=false">
            <div class="relative">
                <input type="text"
                    class="border-primary w-full border-b-2 px-4 py-2 text-3xl text-white focus:outline-none focus:ring-0"
                    placeholder="{{ __('nav.seach') }}">
                <div class="text-accent-white bg-primary absolute right-2 top-2 rounded-full p-2 transition-all">
                    <svg class="h-[20px] w-[20px]" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M11 6C13.7614 6 16 8.23858 16 11M16.6588 16.6549L21 21M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        <div class="hover:text-secondary-warn text-accent-white absolute right-7 top-7 cursor-pointer transition-all hover:rotate-90"
            @click="shown=false">
            <svg class="h-[35px] w-[35px]" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path fill="currentColor"
                        d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z">
                    </path>
                </g>
            </svg>
        </div>
    </div>

    <nav x-cloak x-data="{ shown: false,haveOne:'' }" x-on:navigation.window="(event) => {
        shown = true;
    }"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full opacity-0 bg-secondary-accent/0"
        x-transition:enter-end="translate-x-0 opacity-100 bg-secondary-accent/30"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-full opacity-0"
        class="bg-secondary-accent/30 fixed inset-0 z-50 flex justify-end" x-show="shown">
        <div class="bg-secondary-accent/80 relative h-full overflow-y-auto max-w-[300px]" @click.away="shown=false">
            <div>
                <div class="text-accent-white mt-16 pl-4 pr-5 text-xl">
                    <div class="" x-data="{ height: '' }">
                        <div class="group flex cursor-pointer flex-row items-center justify-between gap-x-1"
                             @click="haveOne='about'; height = $refs.menu.scrollHeight;">
                            <div x-bind:class=" haveOne=='about' ? 'text-secondary-warn' : 'text-accent-white'"
                                class="group-hover:text-secondary-warn transition-all">
                                {{ __('nav.about') }}</div>
                            <div class="flex flex-row">
                                <div class="group-hover:bg-secondary-warn h-[2px] w-[10px] rounded-full transition-all"
                                    x-bind:class=" haveOne=='about' ? 'rotate-0 bg-secondary-warn' : 'rotate-45 bg-accent-white'">
                                </div>
                                <div class="bg-accent-white group-hover:bg-secondary-warn relative right-1 h-[2px] w-[10px] rounded-full transition-all"
                                    x-bind:class=" haveOne=='about' ? 'rotate-0 bg-secondary-warn' : '-rotate-45 bg-accent-white'">
                                </div>
                            </div>
                        </div>
                        <ul x-ref="menu" x-bind:style=" haveOne == 'about' ? `height: ${height}px` : 'height: 0px'"
                            class="mt-2 space-y-3 overflow-hidden pl-3 transition-all duration-300 ease-in-out">
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    {{ __('nav.profile_short') }}</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    {{ __('nav.symbols.mottos.logos') }}</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    {{ __('nav.hymne.mars') }}</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    {{ __('nav.cooperation') }}</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    {{ __('nav.performance') }}</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    {{ __('nav.statistic') }}</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    {{ __('nav.history') }}</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    {{ __('nav.vision.misi') }}</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    {{ __('nav.organize') }}</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    {{ __('nav.akreditasi') }}</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    {{ __('nav.documents') }}</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    {{ __('nav.info.money') }}</p>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="hover:text-secondary-warn text-accent-white absolute right-5 top-5 cursor-pointer transition-all hover:rotate-90"
                    @click="shown=false">
                    <svg class="h-[25px] w-[25px]" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path fill="currentColor"
                                d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z">
                            </path>
                        </g>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-accent-white mt-3 pl-4 pr-5 text-xl">
                    <div class="" x-data="{ height: '' }">
                        <div class="group flex cursor-pointer flex-row items-center justify-between gap-x-1"
                             @click="height = $refs.menu.scrollHeight; haveOne='jurusan'">
                            <div x-bind:class="haveOne=='jurusan' ? 'text-secondary-warn' : 'text-accent-white'"
                                class="group-hover:text-secondary-warn transition-all">
                                {{ __('nav.jurusan_dan_program_studi') }}</div>
                            <div class="flex flex-row">
                                <div class="group-hover:bg-secondary-warn h-[2px] w-[10px] rounded-full transition-all"
                                    x-bind:class="haveOne=='jurusan' ? 'rotate-0 bg-secondary-warn' : 'rotate-45 bg-accent-white'">
                                </div>
                                <div class="bg-accent-white group-hover:bg-secondary-warn relative right-1 h-[2px] w-[10px] rounded-full transition-all"
                                    x-bind:class="haveOne=='jurusan' ? 'rotate-0 bg-secondary-warn' : '-rotate-45 bg-accent-white'">
                                </div>
                            </div>
                        </div>
                        <ul x-ref="menu" x-bind:style="haveOne=='jurusan' ? `height: ${height}px` : 'height: 0px'"
                            class="mt-2 space-y-3 overflow-hidden pl-3 transition-all duration-300 ease-in-out">
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    Pendidikan
                                    Tata Busana</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    Pendidikan
                                    Teknik Informatika dan Komputer</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    Pendidikan
                                    Tata Boga</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    Pendidikan
                                    Teknik Bangunan</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    Manajemen
                                    Konstruksi</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    Arsitektur
                                </p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    Pendidikan
                                    Tata Rias</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">Gizi</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    Pendidikan
                                    Teknik Mesin</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    Pendidikan
                                    Teknik Elektro</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">Teknik
                                    Elektro</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    Pendidikan
                                    Teknik Otomotif</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">Profesi
                                    Insinyur</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">D3
                                    Teknik
                                    Sipil</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">D3
                                    Teknik
                                    Mesin</p>
                            </li>
                            <li class="group flex cursor-pointer flex-row items-center gap-x-5">
                                <div
                                    class="bg-accent-white group-hover:bg-secondary-warn h-[4px] w-[4px] rounded-full transition-all">
                                </div>
                                <p class="text-accent-white group-hover:text-secondary-warn transition-colors">
                                    S2-Pendidikan Guru Vokasi</p>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </nav>
    <livewire:component.footer />

</body>

</html>

<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.home')] class extends Component {
}; ?>

<div x-data="initHome" x-init="init">
    <div class="bg-primary w-full">
        <livewire:component.nav />

        @push('meta')
            <meta name="keywords" content="universitas, pendidikan, Medan, kampus, unimed, mahasiswa, akademik">
            <meta name="description"
                content="Website resmi Universitas Negeri Medan - informasi akademik, berita kampus, dan layanan mahasiswa.">
        @endpush
        <!-- <div class="bg-primary h-[1000px] w-full"></div> -->
        <div tabindex="1" class="mx-auto min-h-[990px] max-w-[var(--max-width)]">
            <div class="relative px-10" x-cloak x-data="{
                play: false,
                svgLoaded: false,
                init() {
                    const img = new Image();
                    img.src = '{{ asset('img/mask.svg') }}';
                    img.onload = () => {
                        this.svgLoaded = true;
                    };
                    setTimeout(() => {
                        this.play = true;
                    }, 3000);
                },
            }">
                <div x-init="init" style="will-change: opacity;"
                    class="mask-image shadow-3xl animate-fade relative min-h-[990px] w-full overflow-hidden rounded-xl bg-gray-300">
                    <div x-show="svgLoaded" class="absolute left-0 top-0 h-[120%] w-full bg-black opacity-50"></div>
                    <video x-show="svgLoaded" autoplay muted loop playsinline class="w-full" @canplay="play = true"
                        x-init="play = false" :class="{ 'hidden': !play }">
                        <source src="{{ asset('vid/bg.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                    <div x-show="!play" class="my-[10px] min-h-[990px] w-full"></div>

                    <div role="status" x-show="!play"
                        class="absolute top-0 flex h-full w-full animate-pulse items-center justify-center rounded-lg bg-gray-300 dark:bg-gray-700">
                        <svg class="h-10 w-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                            <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                            <path
                                d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM9 13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2Zm4 .382a1 1 0 0 1-1.447.894L10 13v-2l1.553-1.276a1 1 0 0 1 1.447.894v2.764Z" />
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="bg-primary bottom-15 left-30 absolute rounded-tr-2xl px-2 py-2 text-white"
                    x-data="{ shown: false }" x-intersect="shown = true">
                    <div x-show="shown" class="text-center text-8xl font-bold">
                        <p class="animate-fade tracking-widest">FAKULTAS</p>
                        <p class="animate-delay-500 animate-fade tracking-widest">TEKNIK</p>
                    </div>
                    <p x-show="shown" class="animate-delay-1000 animate-fade text-center">
                        {{ __('home.welcome') }}
                    </p>
                </div>
            </div>
            <div class="h-2 w-full"></div>
            <div class="mb-15 mt-20 h-[4px] w-full max-w-[var(--max-width)] overflow-hidden rounded-full px-[10%]"
                x-data="{ shown: false }" x-intersect="shown = true">
                <div x-show="shown" x-transition:enter="transition-all duration-700 ease-out"
                    x-transition:enter-start="w-0 opacity-0" x-transition:enter-end="w-full opacity-100"
                    class="bg-primary-dark h-full rounded-full">
                </div>
            </div>

            <div class="text-primary">.</div>
        </div>
        <style>
            .mask-image {
                mask-image: url('{{ asset('img/mask.svg') }}');
                mask-size: contain;
                mask-repeat: no-repeat;
                mask-position: center;

                /* Untuk compatibility Safari */
                -webkit-mask-image: url('{{ asset('img/mask.svg') }}');
                -webkit-mask-size: contain;
                -webkit-mask-repeat: no-repeat;
                -webkit-mask-position: center;
            }
        </style>
    </div>

    <div class="border-primary mx-auto flex w-full max-w-[var(--max-width)] flex-row justify-between border-b-2 pl-10"
        x-cloak x-data="{
            greeting: '{{ __('home.message') }}',
            light: false,
            image: false,
            shown: false,
            init() {
                const img = new Image();
                img.src = '{{ asset('img/dekan.jpg') }}';
                img.onload = () => {
                    this.image = true;
                };
            }
        }" @mouseover="light=true" @mouseout="light=false" x-intersect="shown = true">
        <div class="py-10">
            <div x-show="shown" class="animate-fade-right">
                <div>
                    <h2
                        class="text-primary text-primary relative inline-block text-4xl font-bold after:absolute after:-bottom-1 after:left-0 after:block after:h-[4px] after:w-1/4 after:rounded-full after:bg-green-400 after:transition-all after:duration-300 hover:after:w-full">
                        {{ __('home.sambutan_dekan') }}</h2>
                </div>
            </div>
            <div x-show="shown" style="clip-path: polygon(0% 0%, 100% 0%, 85% 100%, 0% 100%);" class="relative">
                <p class="text-secondary-accent animate-fade-right animate-delay-200 mt-5 indent-10 text-2xl italic">
                    {{ __('home.assalamualaikum') }}</p>
                <p class="text-secondary-accent animate-fade-right animate-delay-400 mt-4 pr-14 indent-8 text-xl">
                    {{ __('home.message1') }}</p>
                <p class="text-secondary-accent animate-fade-right animate-delay-600 mt-4 pr-24 indent-8 text-xl">
                    {{ __('home.message2') }}</p>
                <p class="text-secondary-accent animate-fade-right animate-delay-800 mt-4 pr-36 indent-8 text-xl">
                    {{ __('home.message3') }}</p>
                <p class="text-secondary-accent animate-fade-right animate-delay-1000 mt-4 pr-40 indent-8 text-xl">
                    {{ __('home.message4') }}</p>
                <p class="text-secondary-accent animate-fade-right animate-delay-1200 mt-5 indent-10 text-2xl italic">
                    {{ __('home.waalaikumn') }}</p>
                <p class="text-primary animate-fade-right animate-delay-1400 mt-6 text-xl font-bold">
                    {{ __('home.dekan') }}</p>
                <p class="text-secondary-accent animate-fade-right animate-delay-1600 text-xl">
                    {{ __('home.name_Dekan') }}</p>
                <div
                    class="animate-growing animate-delay-2000 absolute right-24 top-0 w-[3px] rotate-[18deg] rounded-full bg-green-500">
                </div>
            </div>
        </div>
        <div x-init="init">
            <div style="clip-path: polygon(35% 0%, 100% 0%, 100% 100%, 0% 100%);"
                class="w-2xl h-[800px] min-h-[800px] max-w-2xl overflow-hidden">
                <div x-show="!image"
                    class="flex h-full w-full animate-pulse items-center justify-center rounded-sm bg-gray-300 dark:bg-gray-700">
                    <svg class="h-10 w-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                    </svg>
                </div>
                <img class="animate-fade w-full object-cover transition-all"
                    :class="{ 'brightness-50': !light, 'brightness-80': light }" src="{{ asset('img/dekan.jpg') }}"
                    alt="Dekan Unimed" />

            </div>
        </div>
    </div>
    <div class="bg-primary h-[200px] w-full">

    </div>

    <!-- <div class="relative h-[300px] w-full overflow-hidden">
        <img src="{{ asset('img/layered.svg') }}" class="absolute bottom-0 w-full" />
    </div> -->
    <div>
        <livewire:component.news-content/>
    </div>
    <div class="h-[200px]">
        <div class="hero_area h-full">
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave"
                        d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(4, 108, 60, 0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(5, 136, 74, 0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(6, 156, 83, 0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(7, 159, 86, 0.3)" />
                </g>
            </svg>
        </div>
    </div>
    <style>
        .hero_area {
            position: relative;
        }

        .waves {
            position: absolute;
            width: 100%;
            height: 15vh;
            min-height: 100px;
            max-height: 150px;
            bottom: 0;
            left: 0;
        }

        .parallax>use {
            animation: move-forever 25s cubic-bezier(.55, .5, .45, .5) infinite;
        }

        .parallax>use:nth-child(1) {
            animation-delay: -2s;
            animation-duration: 7s;
        }

        .parallax>use:nth-child(2) {
            animation-delay: -3s;
            animation-duration: 10s;
        }

        .parallax>use:nth-child(3) {
            animation-delay: -4s;
            animation-duration: 13s;
        }

        .parallax>use:nth-child(4) {
            animation-delay: -5s;
            animation-duration: 20s;
        }

        @keyframes move-forever {
            0% {
                transform: translate3d(-90px, 0, 0);
            }

            100% {
                transform: translate3d(85px, 0, 0);
            }
        }


        /*Shrinking for mobile*/

        @media (max-width: 768px) {
            .waves {
                height: 40px;
                min-height: 40px;
            }
        }
    </style>

        <livewire:component.footer />

</div>
<script>
    function initHome() {
        return {
            init() {}
        }
    }
</script>

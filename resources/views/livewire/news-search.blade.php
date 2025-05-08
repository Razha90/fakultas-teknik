<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\News;

new #[Layout('components.layouts.home')] class extends Component {
    public $category;
    public $data;

    public function mount()
    {
        $this->category = request()->query('category');
        $this->search();
    }

    public function search($search = '', $sort = 'asc', $page = 1, $limit = 10, $category = '', $dateStart = '', $dateWhen = '')
    {
        try {
            // $this->data = News::with('categories')
            // ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
            // ->when($category, fn($q) => $q->where('category_id', $category))
            // ->orderBy('created_at', $sort)
            // ->paginate($limit, ['*'], 'page', $page)->toArray();
            $this->data = News::with('categories', 'user')
                ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
                ->when($category, fn($q) => $q->where('category_id', $category))
                ->when($dateStart, function ($q) use ($dateStart, $dateWhen) {
                    if ($dateWhen === '') {
                        $q->whereDate('created_at', '>=', $dateStart);
                    } else {
                        $q->whereBetween('created_at', [$dateStart, $dateWhen]);
                    }
                })
                ->orderBy('created_at', $sort)
                ->paginate($limit, ['*'], 'page', $page)
                ->toArray();
        } catch (\Throwable $th) {
            $this->error = __('news.not_found');
        }
    }
}; ?>

<div>
    @push('meta')
        <meta name="keywords" content="universitas, pendidikan, Medan, kampus, unimed, mahasiswa, akademik">
        <meta name="description"
            content="Website resmi Universitas Negeri Medan - informasi akademik, berita kampus, dan layanan mahasiswa.">
    @endpush
    <div x-data="initNewsSearch" x-init="initSearch">
        <div x-data="{
            image: false,
            init() {
                const img = new Image();
                img.src = '{{ asset('img/bg.jpg') }}';
                img.onload = () => {
                    this.image = true;
                };
            },
        }">
            <template x-if="image">
                <div class="relative overflow-hidden pb-32 pt-60">
                    <img src="{{ asset('img/bg.jpg') }}" class="absolute left-0 top-0 object-cover" />
                    <div class="absolute inset-0 left-0 top-0 z-10 bg-black/50"></div>
                    <h1 class="text-accent-white relative z-30 text-center text-5xl font-bold">
                        {{ __('news.portal_news_tenik') }}
                    </h1>
                </div>
            </template>
            <template x-if="!image">
                <div
                    class="flex h-[420px] w-full animate-pulse items-center justify-center rounded-lg bg-gray-300 dark:bg-gray-700">
                    <svg class="h-10 w-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </template>
        </div>

        <div class="w-full border-2 border-gray-100 py-2">
            <div class="mx-auto flex max-w-[var(--max-width)] flex-row justify-between px-10">
                <div class="flex flex-row gap-x-4">
                    <div class="flex flex-row gap-x-2 rounded-xl border border-gray-400 p-2">
                        <div class="rounded-xl border border-gray-400 p-1">
                            <svg class="w-[25px] rotate-90 text-gray-400" viewBox="0 -0.5 25 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.30524 15.7137C6.4404 14.8306 5.85381 13.7131 5.61824 12.4997C5.38072 11.2829 5.50269 10.0233 5.96924 8.87469C6.43181 7.73253 7.22153 6.75251 8.23924 6.05769C10.3041 4.64744 13.0224 4.64744 15.0872 6.05769C16.105 6.75251 16.8947 7.73253 17.3572 8.87469C17.8238 10.0233 17.9458 11.2829 17.7082 12.4997C17.4727 13.7131 16.8861 14.8306 16.0212 15.7137C14.8759 16.889 13.3044 17.5519 11.6632 17.5519C10.0221 17.5519 8.45059 16.889 7.30524 15.7137V15.7137Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M11.6702 7.20292C11.2583 7.24656 10.9598 7.61586 11.0034 8.02777C11.0471 8.43968 11.4164 8.73821 11.8283 8.69457L11.6702 7.20292ZM13.5216 9.69213C13.6831 10.0736 14.1232 10.2519 14.5047 10.0904C14.8861 9.92892 15.0644 9.4888 14.9029 9.10736L13.5216 9.69213ZM16.6421 15.0869C16.349 14.7943 15.8741 14.7947 15.5815 15.0879C15.2888 15.381 15.2893 15.8559 15.5824 16.1485L16.6421 15.0869ZM18.9704 19.5305C19.2636 19.8232 19.7384 19.8228 20.0311 19.5296C20.3237 19.2364 20.3233 18.7616 20.0301 18.4689L18.9704 19.5305ZM11.8283 8.69457C12.5508 8.61801 13.2384 9.02306 13.5216 9.69213L14.9029 9.10736C14.3622 7.83005 13.0496 7.05676 11.6702 7.20292L11.8283 8.69457ZM15.5824 16.1485L18.9704 19.5305L20.0301 18.4689L16.6421 15.0869L15.5824 16.1485Z"
                                        fill="currentColor"></path>
                                </g>
                            </svg>
                        </div>
                        <input type="text" x-model.debounce.500="search" class="focus:outline-none"
                            placeholder="{{ __('news.search_news') }}" />
                    </div>
                    <div class="relative" x-data="{
                        opened: false,
                        clicked(val) {
                            sort = val;
                            this.opened = false;
                        }
                    }" @click.away="opened=false">
                        <div @click="opened=!opened"
                            class="flex cursor-pointer select-none flex-row items-center gap-x-1 rounded-xl border border-gray-400 p-2 transition-all hover:bg-gray-100">
                            <div class="rounded-xl border border-gray-400 p-1 text-gray-400">
                                <svg class="w-[25px]" fill="currentColor" x-show="sort == 'asc'" viewBox="0 0 32 32"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M30,11.67H29L25.71.71s0,0-.05-.08a.61.61,0,0,0-.09-.18c0-.06-.08-.1-.12-.15L25.31.19a.69.69,0,0,0-.19-.1L25,0h-.58l-.08,0a.69.69,0,0,0-.19.1.69.69,0,0,0-.13.11l-.13.15a1,1,0,0,0-.09.18s0,.05-.05.08l-3.28,11h-1a1,1,0,0,0,0,2H23a1,1,0,0,0,0-2h-.41l.9-3H26l.9,3H26.5a1,1,0,0,0,0,2H30a1,1,0,0,0,0-2Zm-5.91-5,.66-2.19.66,2.19Z">
                                        </path>
                                        <path
                                            d="M7.25,0a1,1,0,0,0-1,1V28.67l-3.56-3.4a1,1,0,0,0-1.42,0,1,1,0,0,0,0,1.41l5.25,5c0,.05.1.06.15.1a.86.86,0,0,0,.16.1.94.94,0,0,0,.76,0,1.51,1.51,0,0,0,.17-.1s.1-.06.14-.1l5.25-5a1,1,0,0,0,0-1.41,1,1,0,0,0-1.42,0l-3.56,3.4V1A1,1,0,0,0,7.25,0Z">
                                        </path>
                                        <path
                                            d="M30,28.33a1,1,0,0,0-1,1V30H21.75l9-10a1,1,0,0,0,.17-1.07,1,1,0,0,0-.91-.6H19.5a1,1,0,0,0-1,1V21a1,1,0,0,0,2,0v-.67h7.26l-9,10A1,1,0,0,0,19.5,32H30a1,1,0,0,0,1-1V29.33A1,1,0,0,0,30,28.33Z">
                                        </path>
                                    </g>
                                </svg>
                                <svg class="w-[25px]" fill="currentColor" x-show="sort == 'desc'" viewBox="0 0 32 32"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M30,29.88H29L25.71,18.93s0-.06-.05-.09a.76.76,0,0,0-.09-.18l-.12-.14-.14-.12-.19-.1-.08,0H25l-.2,0-.2,0h-.09l-.08,0-.19.1a.74.74,0,0,0-.13.12.64.64,0,0,0-.13.15.91.91,0,0,0-.09.17s0,.05-.05.09l-3.28,11h-1a1,1,0,0,0,0,2H23a1,1,0,0,0,0-2h-.41l.9-3H26l.9,3H26.5a1,1,0,0,0,0,2H30a1,1,0,0,0,0-2Zm-5.91-5,.66-2.18.66,2.18Z">
                                        </path>
                                        <path
                                            d="M2.69,6.72,6.25,3.33V31a1,1,0,0,0,2,0V3.33l3.56,3.39A1,1,0,0,0,12.5,7a1,1,0,0,0,.73-.31,1,1,0,0,0,0-1.42L7.94.27A1.1,1.1,0,0,0,7.8.18a1.51,1.51,0,0,0-.17-.1,1,1,0,0,0-.76,0,.86.86,0,0,0-.16.1.75.75,0,0,0-.15.09l-5.25,5A1,1,0,1,0,2.69,6.72Z">
                                        </path>
                                        <path
                                            d="M30,10.12a1,1,0,0,0-1,1v.67H21.75l9-10A1,1,0,0,0,30.91.71,1,1,0,0,0,30,.12H19.5a1,1,0,0,0-1,1V2.79a1,1,0,0,0,2,0V2.12h7.26l-9,10a1,1,0,0,0-.17,1.07,1,1,0,0,0,.91.6H30a1,1,0,0,0,1-1V11.12A1,1,0,0,0,30,10.12Z">
                                        </path>
                                    </g>
                                </svg>
                            </div>
                            <p class="text-gray-400">{{ __('news.sort') }}: </p>
                            <p class="text-gray-400" x-show="sort == 'asc'">{{ __('news.asc') }}</p>
                            <p class="text-gray-400" x-show="sort == 'desc'">{{ __('news.desc') }}</p>
                        </div>
                        <div class="bg-accent-white absolute -bottom-[95px] flex w-full flex-col items-center justify-center gap-y-2 rounded-xl border border-gray-400 p-2"
                            x-show="opened" x-transition>
                            <p @click="clicked('asc')" class="w-full rounded-xl py-1 text-center"
                                x-bind:class="sort == 'asc' ? 'bg-gray-200 text-gray-600' :
                                    'hover:bg-gray-200 text-gray-600 cursor-pointer'">
                                {{ __('news.asc') }}</p>
                            <p @click="clicked('desc')" class="w-full rounded-xl py-1 text-center"
                                x-bind:class="sort == 'desc' ? 'bg-gray-200 text-gray-600' :
                                    'hover:bg-gray-200 text-gray-600 cursor-pointer'">
                                {{ __('news.desc') }}</p>
                        </div>
                    </div>
                </div>
                <div></div>
            </div>
        </div>

        <div class="mx-auto max-w-[var(--max-width)] px-10">
            <div></div>
            <livewire:component.news-recomendation />
        </div>
    </div>
</div>
<script>
    function initNewsSearch() {
        return {
            search: '',
            sort: 'asc',
            initStop: false,
            datas: @entangle('data').live,
            initSearch() {
                if (this.initStop) return;
                this.initStop = true;
                console.log(this.datas);

                // this.$watch('search', (value) => {

                // });
                // this.$watch('sort', (value) => {

                // });
            }
        }
    }
</script>

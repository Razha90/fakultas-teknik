<?php

use Livewire\Volt\Component;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\DB;

new class extends Component {
    public $data;
    public function search($page = 0, $coloumns)
    {
        try {
            $this->data = News::with('categories', 'user')
                ->orderBy('created_at', 'desc')
                ->paginate($coloumns, ['*'], 'page', $page)
                ->toArray();
        } catch (\Throwable $th) {
            $this->dispatch('failed', [
                'message' => __('news.error'),
            ]);
        }
    }

    public function createNews()
    {
        try {
            $user = User::get()->first();
            $news = new News();
            $news->user_id = $user->id;
            $news->title = 'New Title';
            $news->content = 'New Content';
            $news->image = 'https://i.ytimg.com/vi/9zB01qk3M-w/maxresdefault.jpg';
            $news->save();

            $categories = Category::inRandomOrder()->limit(3)->get();

            $categoryIds = $categories->pluck('id')->toArray();
            foreach ($categoryIds as $categoryId) {
                DB::table('category_news')->insert([
                    'id' => (string) Str::uuid(), // Menghasilkan UUID secara manual
                    'news_id' => $news->id,
                    'category_id' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } catch (\Throwable $th) {
            Log::error('Error creating news: ' . $th->getMessage());
            // Handle the error as needed
        }
    }

    public function makeCategory()
    {
        $category = new Category();
        $category->name = 'Unimed';
        $category->save();
    }
}; ?>

<div x-data="initNewsContent" x-init="init" x-ref="content" class="flex w-full flex-row justify-start gap-x-7"
    x-intersect="shown = true">
    <div class="animate-fade flex items-center"
        x-bind:class="news && news.current_page && news.current_page != '1' ? 'visible' : 'invisible'">
        <div class="bg-primary/20 hover:bg-primary/50 flex cursor-pointer items-center px-2 py-8 transition-colors"
            @click="prevPage">
            <svg viewBox="0 0 24 24" fill="none" class="text-accent-white w-[40px]" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M16.1795 3.26875C15.7889 2.87823 15.1558 2.87823 14.7652 3.26875L8.12078 9.91322C6.94952 11.0845 6.94916 12.9833 8.11996 14.155L14.6903 20.7304C15.0808 21.121 15.714 21.121 16.1045 20.7304C16.495 20.3399 16.495 19.7067 16.1045 19.3162L9.53246 12.7442C9.14194 12.3536 9.14194 11.7205 9.53246 11.33L16.1795 4.68297C16.57 4.29244 16.57 3.65928 16.1795 3.26875Z"
                        fill="currentColor"></path>
                </g>
            </svg>
        </div>
    </div>
    <template x-if="!news || (Array.isArray(news) && news.length === 0) || loadPage">
        <template x-for="index in itemsPerRow" :key="index">
            <div x-show="shown" class="animate-fade w-[340px] rounded-xl border border-gray-300 shadow-sm">
                <div
                    class="flex h-[200px] w-full animate-pulse items-center justify-center rounded-t-xl bg-gray-300 dark:bg-gray-700">
                    <svg class="h-10 w-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                    </svg>
                </div>
                <div class="mt-3 px-5">
                    <div class="mb-4 h-4 w-48 animate-pulse rounded-full bg-gray-200 dark:bg-gray-700">
                    </div>
                    <div class="mb-2.5 h-3 max-w-[480px] animate-pulse rounded-full bg-gray-200 dark:bg-gray-700">
                    </div>
                    <div class="mb-2.5 h-3 animate-pulse rounded-full bg-gray-200 dark:bg-gray-700"></div>
                </div>
                <div class="my-5 h-[1px] w-full overflow-hidden rounded-full px-5">
                    <div class="h-full w-full bg-gray-200"></div>
                </div>
                <div class="mb-5 mt-4 flex animate-pulse items-center px-5">
                    <svg class="me-3 h-10 w-10 text-gray-200 dark:text-gray-700" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                    </svg>
                    <div>
                        <div class="mb-2 h-2.5 w-32 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                        <div class="h-2 w-48 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                    </div>
                </div>
            </div>
        </template>
    </template>

    <template x-if="news && Array.isArray(news.data) && news.data.length > 0 && !loadPage">
        <template x-for="(data, index) in news.data" :key="index">
            <div x-show="shown" class="animate-fade animate-fade w-[340px] rounded-xl border border-gray-300 shadow-sm">
                <div x-data="{ isLoaded: false }" @click="goToNews(data.id)"
                    class="h-[200px] w-full cursor-pointer overflow-hidden rounded-t-xl">
                    <div x-show="!isLoaded"
                        class="flex animate-pulse items-center justify-center bg-gray-300 dark:bg-gray-700">
                        <svg class="h-10 w-10 text-gray-200 dark:text-gray-600" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z" />
                        </svg>
                    </div>
                    <img x-bind:src="data.image" x-on:load="isLoaded = true"
                        class="h-full w-full brightness-75 transition-all hover:scale-125 hover:brightness-100" />
                </div>
                <div class="mt-3 px-5">
                    <div class="flex flex-wrap gap-3">
                        <template x-if="data.categories && data.categories.length > 0">
                            <template x-for="(item, key) in data.categories">
                                <div x-text="item.name"
                                    class="cursor-pointer bg-gray-200 px-4 py-1 text-sm text-gray-400 transition-all hover:scale-110">
                                </div>
                            </template>
                        </template>
                    </div>
                    <div class="truncate-line-clamp-2 mt-4 text-gray-500" x-text="data.title"></div>
                </div>
                <div @click="goToNews(data.id)" class="my-4 h-[1px] w-full overflow-hidden rounded-full px-5">
                    <div class="h-full w-full bg-gray-200"></div>
                </div>
                <div class="mb-5 flex flex-row items-center justify-between px-5">
                    <div class="flex flex-row items-center" @click="goToNews(data.id)">
                        <template x-if="!data.user.image">
                            <div class="flex items-center">
                                <svg class="me-3 h-9 w-9 text-gray-200 dark:text-gray-700" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                                </svg>
                            </div>
                        </template>
                        <template x-if="data.user.image">
                            <div class="me-3">
                                <img x-bind:src="data.user.image" :alt="data.user.name" class="h-9 w-9 rounded-full" />
                            </div>
                        </template>
                        <p class="max-w-[100px] truncate text-base text-gray-500" x-text="data.user.name">
                        </p>
                        <p class="mx-1 text-sm text-gray-300"> - </p>
                        <p class="text-sm text-gray-300" x-text="changeDate(data.created_at)"></p>
                    </div>
                   
                </div>
            </div>
        </template>
    </template>
    <template x-if="news && news.current_page != news.last_page">
        <div class="animate-fade flex items-center">
            <div class="bg-primary/20 hover:bg-primary/50 flex cursor-pointer items-center px-2 py-8 transition-colors"
                @click="nextPage">
                <svg viewBox="0 0 24 24" fill="none" class="text-accent-white w-[40px] rotate-180"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M16.1795 3.26875C15.7889 2.87823 15.1558 2.87823 14.7652 3.26875L8.12078 9.91322C6.94952 11.0845 6.94916 12.9833 8.11996 14.155L14.6903 20.7304C15.0808 21.121 15.714 21.121 16.1045 20.7304C16.495 20.3399 16.495 19.7067 16.1045 19.3162L9.53246 12.7442C9.14194 12.3536 9.14194 11.7205 9.53246 11.33L16.1795 4.68297C16.57 4.29244 16.57 3.65928 16.1795 3.26875Z"
                            fill="currentColor"></path>
                    </g>
                </svg>
            </div>
        </div>
    </template>
</div>

<script>
    function initNewsContent() {
        return {
            news: @entangle('data').live,
            itemsPerRow: 0,
            stopInit: false,
            shown: false,
            loadPage: false,
            init() {
                if (this.stopInit) return;
                this.stopInit = true;
                this.$watch('itemsPerRow', (newValue) => {
                    this.paginate(0, newValue);
                });

                window.addEventListener('resize', () => {
                    this.calculateColumns();
                });
                this.$nextTick(() => {
                    this.calculateColumns();
                });
            },
            goToNews(id) {
                const dummy = '{{ route('news-page', ['id' => '__DUMMY_ID__']) }}'.replace('__DUMMY_ID__', id);
                goToPage(dummy);
            },
            async nextPage() {
                if (this.loadPage) return;
                this.loadPage = true;
                await this.$wire.search(this.news.current_page + 1, this.itemsPerRow);
                this.loadPage = false;
            },
            async prevPage() {
                if (this.loadPage) return;
                this.loadPage = true;
                await this.$wire.search(this.news.current_page - 1, this.itemsPerRow);
                this.loadPage = false;
            },
            changeDate(createdAt) {
                const formattedTime = moment(createdAt).fromNow();
                return formattedTime;
            },
            calculateColumns() {
                let container = this.$refs.content;
                let containerWidth = container.clientWidth;
                let itemWidth = 340;
                let gap = 20;
                let arrow = 40;
                let totalItemWidth = itemWidth + gap + arrow;
                this.itemsPerRow = Math.floor((containerWidth) / totalItemWidth);
            },
            paginate(page = 0, itemsPerRow) {
                this.$wire.search(page, itemsPerRow);
            },

        }
    }
</script>

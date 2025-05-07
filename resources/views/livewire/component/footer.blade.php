<?php

use Livewire\Volt\Component;

new class extends Component {}; ?>

<footer class="bg-primary" x-data="{show:false}" x-intersect="show=true">
    <div class="flex max-w-[--max-width] justify-between px-10 py-8 text-base">
        <div class="flex flex-row text-white gap-x-7">
            <p class="hover:text-secondary-warn transition-colors cursor-pointer" x-bind:class="show ? 'animate-fade animate-delay-200' : 'opacity-0'">{{ __('home.term') }}</p>
            <p class="hover:text-secondary-warn transition-colors cursor-pointer" x-bind:class="show ? 'animate-fade animate-delay-400' : 'opacity-0'">{{ __('home.faq') }}</p>
            <p class="hover:text-secondary-warn transition-colors cursor-pointer" x-bind:class="show ? 'animate-fade animate-delay-600' : 'opacity-0'">{{ __('home.copyright') }}</p>
            <p class="hover:text-secondary-warn transition-colors cursor-pointer" x-bind:class="show ? 'animate-fade animate-delay-800' : 'opacity-0'">{{ __('home.contact') }}</p>
        </div>
        <div>
            <p class="text-accent-white">Copyright © 2025 by Fakultas Teknik UNIMED</p>
        </div>
    </div>
</footer>

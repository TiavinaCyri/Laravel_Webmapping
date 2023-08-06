<div x-data="map()" x-init="initComponent()">
    <div x-ref="map" class="relative h-[75vh] overflow-clip rounded-md border border-slate-300 shadow-lg">
        <div class="absolute top-2 right-8 z-10 rounded-md bg-white bg-opacity-75">
            <div class="ol-unselectable ol-control">
                <button x-on:click.prevent="legendOpened = ! legendOpened" title="Open/Close legend"
                    class="absolute inset-0 flex items-center justify-center">
                    <!-- Heroicon name: outline/globe -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 pl-0.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
            </div>
        </div>

        <div x-cloak x-show="legendOpened" x-transition:enter="transition-opacity duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute right-0 top-16 left-2 bottom-2 z-10 max-w-sm rounded-md border border-slate-300 bg-white bg-opacity-50 shadow-sm">
            <div class="absolute inset-1 rounded-md bg-white bg-opacity-75 p-2">
                <div class="flex items-start justify-between">
                    <h3 class="text-lg font-medium text-slate-700">Legend</h3>
                    <button x-on:click.prevent="legendOpened = false"
                        class="text-2xl font-black text-slate-400 transition hover:text-[#3369A1] focus:text-[#3369A1] focus:outline-none">&times;</button>
                </div>
                <ul class="mt-2 space-y-1 rounded-md border border-slate-300 bg-white p-2">
                    <template x-for="(layer, index) in map.getAllLayers().reverse()" :key="index">
                        <li class="flex items-center px-2 py-1">
                            <div x-id="['legend-range']" class="w-full">
                                <label x-bind:for="$id('legend-range')" class="flex items-center">
                                    <span class="text-sm text-slate-600" x-text="layer.get('label')"></span>
                                </label>
                                <div class="mt-1 text-sm text-slate-600">
                                    <input class="w-full accent-[#3369A1]" type="range" min="0" max="1" step="0.01"
                                        x-bind:id="$id('legend-range')" x-bind:value="layer.getOpacity()"
                                        x-on:change="layer.setOpacity(Number($event.target.value))">
                                </div>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
        <div x-cloak x-ref="popup" class="ol-popup ol-control transition">
            <div class="p-2 m-0.5 bg-white rounded-md">
                <div class="flex justify-between">
                    <h3 class="text-xs font-medium text-slate-400">Monument</h3>
                    <a href="#" title="Close" x-on:click.prevent="closePopup"
                        class="-mt-1 font-black text-slate-400 transition hover:text-slate-600 focus:text-slate-600 focus:outline-none">&times;</a>
                </div>
                <div x-ref="popupContent" class="mt-2 overflow-y-auto min-h-[200px]"></div>
            </div>
        </div>
    </div>
</div>

@once
    @push('styles')
        @vite(['resources/css/components/map.css'])
    @endpush
    @push('scripts')
        @vite(['resources/js/components/map.js'])
    @endpush
@endonce
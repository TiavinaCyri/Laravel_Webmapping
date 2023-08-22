<div class="grid grid-cols-5 gap-5" x-data="map()" x-init="initComponent()">
    {{-- legend --}}
    <div class="h-[70vh]">

        {{-- Menus --}}
        <div class="z-10 h-full max-w-sm bg-white shadow-xl p-4 rounded-2xl">
            <div class="inset-1 overflow-y-auto rounded-md bg-white bg-opacity-75 p-2 pt-1">
                <div class="flex items-center justify-between pr-1">
                    <div class="flex justify-start space-x-3">
                        <h3 x-on:click.prevend="activeTab = 'legend'" class="cursor-pointer text-lg text-slate-900" x-bind:class="activeTab === 'legend' && 'font-bold'">Legend</h3>
                        <h3 x-on:click.prevend="activeTab = 'batiments'" class="cursor-pointer text-lg text-slate-900" x-bind:class="activeTab === 'batiments' && 'font-bold'">Batiments</h3>
                        <h3 x-on:click.prevend="activeTab = 'routes'" class="cursor-pointer text-lg text-slate-900" x-bind:class="activeTab === 'routes' && 'font-bold'">Routes</h3>
                    </div>
                </div>
                <ul x-show="activeTab === 'legend'" x-transition:enter="transition-opacity duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="mt-2 p-1 space-y-1 bg-white">
                    <template x-for="(layer, index) in map.getAllLayers().reverse()" :key="index">
                        <li class="flex items-center p-0.5">
                            <div x-id="['legend-range']" class="w-full px-2 py-1">
                                <div class="space-y-1">
                                    <label x-bind:for="$id('legend-range')" class="flex items-center">
                                        <span class="text-lg text-current" x-text="layer.get('label')"></span>
                                    </label>
                                    <div class="text-sm" x-show="layer.get('label') === 'Routes'">
                                        <div class="w-10 h-[2px] bg-blue-700"></div>
                                    </div>
                                    <div class="text-sm" x-show="layer.get('label') === 'Forêts'">
                                        <div class="w-5 h-5 bg-[#22c55e] border-2 border-[#14532d]"></div>
                                    </div>
                                    <div class="text-sm" x-show="layer.get('label') === 'Batiments'">
                                        <div class="w-5 h-5 bg-[#7c807c65] border-2 border-[#272727]"></div>
                                    </div>
                                </div>
                                <div class="mt-2 text-sm text-slate-600">
                                    <input class="w-full accent-sky-500" type="range" min="0" max="1" step="0.01" x-bind:id="$id('legend-range')" x-bind:value="layer.getOpacity()" x-on:change="layer.setOpacity(Number($event.target.value))">
                                </div>
                            </div>
                        </li>
                    </template>
                    {{-- Stats --}}
                    <livewire:stats>
                </ul>
                <div x-show="activeTab === 'batiments'" x-transition:enter="transition-opacity duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="mt-2 p-1 rounded-md border border-slate-300 bg-white h-[600px] overflow-y-auto">
                    <livewire:batiments.index />
                </div>
                <div x-show="activeTab === 'routes'" x-transition:enter="transition-opacity duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="mt-2 p-1 rounded-md border border-slate-300 bg-white">
                    <livewire:routes.index />
                </div>
            </div>
        </div>

        {{-- modals info batiments --}}
        <div x-cloak x-ref="popup" class="w-[300px] h-[300px] px-6 transition">
            <div class="m-4 rounded-2xl bg-white w-[300px] px-6 h-[200px] p-2">
                <div class="flex justify-end mt-4">
                    <a href="#" title="Close" x-on:click.prevent="closePopup" class="-mt-1 font-black text-slate-400 transition hover:text-slate-600 focus:text-slate-600 focus:outline-none">&times;</a>
                </div>
                <div>
                    <h1 class="text-3xl font-semibold">Batiments</h1>
                </div>
                <div x-ref="popupContent" class="mt-2 overflow-y-auto"></div>
            </div>
        </div>
    </div>
    {{-- map --}}
    <div x-ref="map" class="h-[70vh] col-span-4 shadow-2xl rounded-2xl"></div>

</div>

@once
@push('styles')
@vite(['resources/css/components/map.css'])
@endpush
@push('scripts')
@vite(['resources/js/components/map.js'])
@endpush
@endonce

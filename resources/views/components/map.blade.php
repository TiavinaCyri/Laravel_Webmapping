<div class="grid grid-cols-5 gap-5" x-data="map()" x-init="initComponent()">
    {{-- legend --}}
    <div class="h-[75vh]">
        <div class="z-10 h-full max-w-sm rounded-md border border-slate-300 bg-white bg-opacity-50 shadow-sm">
            <div class="inset-1 overflow-y-auto rounded-md bg-white bg-opacity-75 p-2 pt-1">
                <div class="flex items-center justify-between pr-1">
                    <div class="flex justify-start space-x-3">
                        <h3 x-on:click.prevend="activeTab = 'legend'" class="cursor-pointer text-slate-700" x-bind:class="activeTab === 'legend' && 'font-bold'">Legend</h3>
                        <h3 x-on:click.prevend="activeTab = 'monuments'" class="cursor-pointer text-slate-700" x-bind:class="activeTab === 'monuments' && 'font-bold'">Monuments</h3>
                    </div>
                    <button x-on:click.prevent="legendOpened = false" class="mb-1 text-2xl font-black text-slate-400 transition hover:text-[#3369A1] focus:text-[#3369A1] focus:outline-none">&times;</button>
                </div>
                <ul x-show="activeTab === 'legend'" x-transition:enter="transition-opacity duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="mt-2 p-1 space-y-1 rounded-md border border-slate-300 bg-white">
                    <template x-for="(layer, index) in map.getAllLayers().reverse()" :key="index">
                        <li class="flex items-center p-0.5">
                            <div x-id="['legend-range']" class="w-full rounded-md border border-gray-300 px-2 py-1">
                                <div class="space-y-1">
                                    <label x-bind:for="$id('legend-range')" class="flex items-center">
                                        <span class="text-sm text-slate-600" x-text="layer.get('label')"></span>
                                    </label>
                                    <div x-show="hasLegend(layer)">
                                        <img x-bind:src="legendUrl(layer)" alt="Legend">
                                    </div>
                                </div>
                                <div class="mt-2 text-sm text-slate-600">
                                    <input class="w-full accent-[#3369A1]" type="range" min="0" max="1" step="0.01" x-bind:id="$id('legend-range')" x-bind:value="layer.getOpacity()" x-on:change="layer.setOpacity(Number($event.target.value))">
                                </div>
                            </div>
                        </li>
                    </template>
                </ul>
                <div x-show="activeTab === 'monuments'" x-transition:enter="transition-opacity duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="mt-2 p-1 rounded-md border border-slate-300 bg-white">
                    Monuments
                </div>
            </div>
        </div>
        <div x-cloak x-ref="popup" class="w-[300px] h-[300px] px-6 transition">
            <div class="m-0.5 rounded-md bg-white w-[300px] px-6 h-[200px] p-2">
                <div class="flex justify-end">
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
    <div x-ref="map" class="h-[75vh] col-span-4 border border-slate-300 shadow-lg"></div>

</div>

@once
@push('styles')
@vite(['resources/css/components/map.css'])
@endpush
@push('scripts')
@vite(['resources/js/components/map.js'])
@endpush
@endonce

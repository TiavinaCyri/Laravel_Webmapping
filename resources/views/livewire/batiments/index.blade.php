<div class="px-1 py-2">
    <ul class="space-y-2">
        @forelse($batiments as $batiment)
        <li class="flex justify-between">
            <h1 class="capitalize">{{ $batiment->nom_bati === null ? "Pas d'information" : $batiment->nom_bati }}</h1>
            <h1 class="capitalize flex items-center gap-3">
                {{ $batiment->type_bati }}
                <button x-on:click.prevent="infoBatiModal({{ $batiment->geojson }})" class="text-slate-500 transition hover:text-slate-800 focus:text-slate-800 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                </button>
            </h1>
        </li>
        @empty
        <li>Pas de batiments</li>
        @endforelse
    </ul>
</div>

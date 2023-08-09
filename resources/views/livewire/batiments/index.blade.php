<div class="px-1 py-2">
    <ul class="space-y-2">
        @forelse($batiments as $batiment)
            <li class="flex justify-between">
                <h1 class="capitalize">{{ $batiment->nom_bati === null ? "Pas d'information" : $batiment->nom_bati }}</h1>
                <h1 class="capitalize">{{ $batiment->type_bati }}</h1>
            </li>
        @empty
            <li>Pas de batiments</li>
        @endforelse
    </ul>
</div>
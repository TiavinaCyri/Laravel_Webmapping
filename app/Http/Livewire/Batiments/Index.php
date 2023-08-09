<?php

namespace App\Http\Livewire\Batiments;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $batiments;

    public function mount()
    {
        $this->batiments = DB::table('bati')->selectRaw('bati.nom_bati as nom_bati , bati.type_bati as type_bati , st_asgeojson(bati.*) as geojson')->orderBy('bati.nom_bati')->get();
    }

    public function render()
    {
        return view('livewire.batiments.index');
    }
}

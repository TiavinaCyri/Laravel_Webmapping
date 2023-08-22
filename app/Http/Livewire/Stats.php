<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Stats extends Component
{
    public $bati_area;
    public $foret_area;

    public function mount()
    {
        $query_bati = DB::select("SELECT ST_Area(ST_Transform(geom, 32738)) AS area_bati_sq_m FROM bati");
        $this->bati_area = number_format(array_sum(array_column($query_bati,"area_bati_sq_m")),0);

        $query_foret = DB::select("SELECT ST_Area(ST_Transform(geom, 32738)) AS area_foret_sq_m FROM foret");
        $this->foret_area = number_format(array_sum(array_column($query_foret,"area_foret_sq_m")),0);
    }

    public function render()
    {
        return view('livewire.stats', [
            "bati" => DB::table('bati')->get(),
            "foret" => DB::table('foret')->get(),
            "route" => DB::table('route')->get(),
        ]);
    }
}

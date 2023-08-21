<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Stats extends Component
{
    public function render()
    {
        return view('livewire.stats',[
            "bati" => DB::table('bati')->get(),
            "foret" => DB::table('foret')->get(),
            "route" => DB::table('route')->get(),
        ]);
    }
}

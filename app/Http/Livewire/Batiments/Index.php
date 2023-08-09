<?php

namespace App\Http\Livewire\Batiments;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $batiments;

    public function mount()
    {
        $this->batiments = DB::table('bati')->orderBy('nom_bati')->get();
    }

    public function render()
    {
        return view('livewire.batiments.index');
    }
}

<?php

namespace App\Http\Livewire\Routes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $routes;

    public function mount()
    {
        $this->routes = DB::table('route')->orderBy('nom')->get();
    }
    public function render()
    {
        return view('livewire.routes.index');
    }
}

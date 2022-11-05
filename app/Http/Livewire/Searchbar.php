<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Searchbar extends Component
{
    public $search;
    public function search() {
        $url = '/products?search=' .$this->search;
        return redirect($url);
    }
    public function render()
    {
        return view('livewire.searchbar');
    }
}

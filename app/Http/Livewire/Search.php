<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Product_category;
use Exception;
use Livewire\Component;


class Search extends Component
{
    public $search = [];

    public function filter()
    {  
        $str = "/products?category=" .implode(',', $this->search);
        return redirect($str);
    }

    public function render()
    {
        return view('livewire.search', [
            'categories' => Product_category::all()
        ]);
    }
}

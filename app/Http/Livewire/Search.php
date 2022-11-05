<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Product_category;
use Exception;
use Livewire\Component;


class Search extends Component
{
    public $search_category = [];
    public $min_price;
    public $max_price;

    public function filter()
    {
        $url = "/products?category=";
        if (count($this->search_category) ?? 0) {
            $url .= implode(',', $this->search_category);
        }
        if ($this->min_price ?? false) {
            $url .= "&min_price=" .$this->min_price;
        }
        if ($this->max_price ?? false) {
            $url .= "&max_price=" . $this->max_price;
        }
        return redirect($url);
    }

    public function render()
    {
        return view('livewire.search', [
            'categories' => Product_category::all()
        ]);
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Product_category;
use Livewire\Component;

class CategoryDrop extends Component
{
    public function render()
    {
        return view('livewire.category-drop', [
            'categories' => Product_category::all()
        ]);
    }
}

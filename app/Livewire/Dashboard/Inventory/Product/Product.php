<?php

namespace App\Livewire\Dashboard\Inventory\Product;

use App\Models\Product as ModelsProduct;
use App\Models\ProductUnit;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function render()
    {
        $products = ModelsProduct::with(['base_warehouse_unit', 'base_unit', 'brand', 'categories', 'images' => function ($query) {
            $query->where('is_main', 1);
        }])
            ->where('name', 'ilike', '%' . $this->search . '%')
            ->orderBy('name', 'asc')
            ->paginate($this->perPage);
            
        return view('livewire.dashboard.inventory.product.product', [
            'products' => $products,
        ]);
    }
}

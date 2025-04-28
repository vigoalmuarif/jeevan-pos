<?php

namespace App\Livewire\Dashboard\Inventory\Product\Show;

use App\Models\Product;
use App\Models\ProductUnit;
use App\Models\Unit;
use Livewire\Component;

class Show extends Component
{
    public $slug;
    public $product;

    public function mount() 
    {
        $product = Product::with(['base_unit', 'brand', 'categories', 'images'])
        ->where('business_id', auth()->user()->current_active_business_id)
        ->where('slug', $this->slug)
        ->firstOrFail();

        $this->product = $product;

    }

    public function render()
    {
        $units = Unit::where('status', 1)
            ->where('business_id', auth()->user()->current_active_business_id)
            ->get();

        $unitConversions = ProductUnit::with('unit')->where('product_id', $this->product->id)->get();

        return view('livewire.dashboard.inventory.product.show.show', [
            'units' => $units,
            'unitConversions' => $unitConversions
        ]);
    }
}

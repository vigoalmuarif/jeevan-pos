<?php

namespace App\Livewire\Dashboard\Inventory\Product\Price;

use App\Models\ProductPrice;
use App\Models\StockAlocation;
use Livewire\Attributes\On;
use Livewire\Component;

class Price extends Component
{
    public $product;

    public function mount()
    {
        
    }

    #[On('price-created')]
    public function updateListPrices()
    {

    }

    public function render()
    {
        $prices = ProductPrice::with('unit', 'alocation', 'conversion')->where('product_id', $this->product->id)
            ->where('status', 1)
            ->get();
        $alocations = StockAlocation::with('warehouse')->where('product_id', $this->product->id)
            ->whereIn('status', [2,3])
            ->get();
            
        return view('livewire.dashboard.inventory.product.price.price',[
            'prices' => $prices,
            'alocations' => $alocations
        ]);
    }
}

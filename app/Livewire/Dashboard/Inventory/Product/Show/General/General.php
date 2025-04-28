<?php

namespace App\Livewire\Dashboard\Inventory\Product\Show\General;

use App\Models\Product;
use App\Models\StockCard;
use Livewire\Attributes\On;
use Livewire\Component;

class General extends Component
{
    public $slug;
    public $product;

    #[On('price-created')]
    public function updateStock()
    {

    }
    
    public function render()
    {
        $total_stock = StockCard::where('product_id', $this->product->id)->latest()->first();
        return view('livewire.dashboard.inventory.product.show.general.general',[
            'total_stock' => $total_stock
        ]);
    }
}

<?php

namespace App\Livewire\Dashboard\Sales;

use App\Models\Product;
use App\Models\Unit;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    use LivewireAlert;
    public $carts = [];
    public $subtotal = 0;
    public $total = 0;
    public $discountTransaction = 0;
    public $tax = 0;

    public function rekalkulasiTotal()
    {
        $this->subtotal = 0;
        $this->total = 0;
        $discount = konversi_harga_with_rp($this->discountTransaction);
        foreach($this->carts as $cart){
            $this->subtotal += $cart['qty'] * $cart['price'];
            $this->total = ($this->subtotal - $discount) + $this->tax;
        }
    }

    public function updatedDiscountTransaction($value)
    {
        $this->rekalkulasiTotal();
    }

    #[On('add-to-cart')]
    public function addToCart($product)
    {
        $found = false;

        foreach($this->carts as $index => $cart){
            if($product['product']['id'] == $cart['product']['id'] && $product['satuan']['id'] == $cart['satuan']['id']){
                $this->carts[$index]['qty'] += $product['qty'];
                $found = true;
                break;
            }
        }

        if(!$found){
            $this->carts[] =  [
                'product' => $product['product'],
                'satuan' => $product['satuan'],
                'qty' => $product['qty'],
                'price' => $product['price']
            ];
        }
       
        $this->rekalkulasiTotal();
    }

    public function delete($index)
    {
        $this->confirm('Hapus Produk Dari Keranjang?', [
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'confirmButtonText' => 'Hapus',
            'cancelButtonText' => 'Tidak',
            'onConfirmed' => 'confirmedDelete',
            'data' => [
                'data' => $index
            ]
        ]);
    }

    #[On('confirmedDelete')]
    public function confirmDeleteConversion($data)
    {
        unset($this->carts[$data['data']]);
        $this->rekalkulasiTotal();
    }

    public function deleteAll()
    {
        $this->confirm('Kosongkan Keranjang?', [
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'confirmButtonText' => 'Kosongkan',
            'cancelButtonText' => 'Tidak',
            'onConfirmed' => 'confirmedDeleteAll',
        ]);
    }

    #[On('confirmedDeleteAll')]
    public function confirmDeleteAll($data)
    {
        $this->carts = [];
        $this->rekalkulasiTotal();
    }

    public function proccessPayment()
    {
        $this->dispatch('openModal', component : 'dashboard.sales.payment', arguments: [
            'carts' => $this->carts, 
            'subtotal' => $this->subtotal, 
            'total' => $this->total, 
            'discountTransaction' => konversi_harga_with_rp($this->discountTransaction), 
            'tax' => $this->tax
        ], advancedMode: true );  
    }
    public function render()
    {
        return view('livewire.dashboard.sales.cart');
    }
}

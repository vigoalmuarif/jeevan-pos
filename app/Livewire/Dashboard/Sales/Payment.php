<?php

namespace App\Livewire\Dashboard\Sales;

use LivewireUI\Modal\ModalComponent;

class Payment extends ModalComponent
{
    public $carts;
    public $subtotal;
    public $total;
    public $discountTransaction;
    public $tax;
    public $pay = 0;

    public function addNumber($value)
    {
        $this->pay .= $value;
    }
    public static function modalMaxWidth(): string
    {
        return 'lg';
    }
    public function render()
    {
        return view('livewire.dashboard.sales.payment');
    }
}

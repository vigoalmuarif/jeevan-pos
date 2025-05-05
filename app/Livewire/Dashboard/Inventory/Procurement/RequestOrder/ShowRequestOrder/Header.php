<?php

namespace App\Livewire\Dashboard\Inventory\Procurement\RequestOrder\ShowRequestOrder;

use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Header extends Component
{
    public $requestOrder;
    public $requestOrderItems = [];
    public $totalPending = 'Menghitung...';
    public $totalReject = 'Menghitung...';
    public $totalPartial = 'Menghitung...';
    public $totalFulFilled = 'Menghitung...';



    #[On('updating-header')]
    public function updateHeader($data = null)
    {
        if ($data) {
            $this->requestOrderItems = $data['requestOrderItems'];
        } 

        $this->runAllCalculations();
    }

    public function calculatePartialApproved()
    {
        $total = collect($this->requestOrderItems)
            ->filter(function ($item) {
                return  floatval($item['qtyApproved']) < floatval($item['qty_request']) && floatval($item['qtyApproved']) > 0;
            })
            ->count();
        
        $this->totalPartial = $total .' Item';
    }

    public function calculatePending()
    {
        $total = collect($this->requestOrderItems)
            ->filter(function ($item) {
                return $item['status'] === '' || $item['status'] === null;
            })
            ->count();

        $this->totalPending = $total .' Item';
    }

    public function calculateReject()
    {
        $total = collect($this->requestOrderItems)->where('status', 'rejected')->count();

        $this->totalReject = $total .' Item';

        if($total == count($this->requestOrderItems)){
            $this->dispatch('handle-button-save', ['show' => false]);
        }else{
            $this->dispatch('handle-button-save', ['show' => true]);
        }


    }

    public function calculateFulFilled()
    {
        $total = collect($this->requestOrderItems)
            ->filter(function ($item) {
                return $item['status'] === 'approved' && floatval($item['qtyApproved']) >= floatval($item['qty_request']);
            })
            ->count();
        
        $this->totalFulFilled = $total .' Item';
    }

   
    public function runAllCalculations()
    {
        $this->calculatePending();
        $this->calculateReject();
        $this->calculateFulFilled();
        $this->calculatePartialApproved();
    }

    public function render()
    {
        return view('livewire.dashboard.inventory.procurement.request-order.show-request-order.header');
    }
}

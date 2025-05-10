<?php

namespace App\Livewire\Dashboard\Inventory\Procurement\RequestOrder\ShowRequestOrder;

use App\Models\Product;
use App\Models\RequestOrder;
use App\Models\RequestOrderApprovalLog;
use App\Models\RequestOrderDelivery;
use App\Models\RequestOrderDeliveryItem;
use App\Models\RequestOrderItem;
use App\Models\StockAlocation;
use App\Models\StockCard;
use App\Models\Warehouses;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class RequestOrderItems extends Component
{
    use LivewireAlert;
    public $fromWarehouse;
    public $toWarehouse;
    public $searchProduct;
    public $stockSourceWarehouse;
    public $qtyRequest = 0;
    public $note;
    public $is_draft = 0;
    public $listProducts = [];
    public $productSelected = [];

    public $noorder; // diambil dari url
    public $type;
    public RequestOrder $requestOrder;
    public $requestOrderItems = [];
    public $orderItems = [];
  
    public $showProsesSimpan = true;
    public $editing = false;

    public function mount()
    {
        
        $this->dispatch('updating-header');

    }

    public function reject($index)
    {
        if ($this->requestOrderItems[$index]['status'] == 'rejected') {
            $this->requestOrderItems[$index]['status'] = '';
            $this->requestOrderItems[$index]['reject_reason'] = null;
            $this->requestOrderItems[$index]['qtyApproved'] = number_format(0, 2);

            $this->dispatch('updating-header', [
                'requestOrderItems' => $this->requestOrderItems
            ]);

        } else {
            $this->confirm('Alasan Ditolak', [
                'icon' => 'warning',
                'showConfirmButton' => true,
                'showCancelButton' => true,
                'cancelButtonText' => 'Batal',
                'confirmButtonText' => 'Tolak',
                'onConfirmed' => 'rejectConfirmed',
                'input' => 'text',
                'inputAttributes' => [
                    'autocomplete' => 'off', // Menonaktifkan autocomplete
                ],
                'inputValidator' => '(value) => {
                    return new Promise((resolve) => {
                        resolve(value ? undefined : "Alasan tidak boleh kosong");
                    });
                }',
                'allowOutsideClick' => false,
                'timer' => null,
                'data' => [
                    'index' => $index
                ]
            ]);
        }
    }

    #[On('rejectConfirmed')]
    public function rejectConfirmed($value, $data): void
    {
        $this->requestOrderItems[$data['index']]['reject_reason'] = $value;
        $this->requestOrderItems[$data['index']]['status'] = 'rejected';
        $this->requestOrderItems[$data['index']]['qtyApproved'] = 0;

        $this->dispatch('updating-header', [
            'requestOrderItems' => $this->requestOrderItems
        ]);

    }

    #[On('handle-button-save')]
    public function handleBtnSave($data)
    {
          //sembunyikan btn proses simpan jika semua barang direject
          if ($data['show'] == true) {
            $this->showProsesSimpan = true;
        } else {
            $this->showProsesSimpan = false;
        }
    }

    public function validasiQtyApproved($index)
    {
        $qtyRequest = $this->requestOrderItems[$index]['qty_request'];
        $qtyApproved = $this->requestOrderItems[$index]['qtyApproved'];
        // tidak boleh kosong
        if ($qtyApproved < 0 || $qtyApproved == '') {
            Toaster::warning('Qty Approved Tidak Boleh Kosong');
            return;
        }

        // harus numeric
        else if (!is_numeric($qtyApproved)) {
            Toaster::warning('Qty Approved Harus Angka');
            return;
        }

        //belum diproses
        if ($qtyRequest > $qtyApproved && $qtyApproved == 0) {
            $this->requestOrderItems[$index]['status'] = '';
        }
        //partial approved
        elseif ($qtyRequest > $qtyApproved && $qtyApproved > 0) {
            $this->requestOrderItems[$index]['status'] = 'partial_approved';
        }
        //melebihi qty request
        elseif ($qtyRequest < $qtyApproved) {
            $this->requestOrderItems[$index]['status'] = 'over_qty';
        }
        //approved
        else {
            $this->requestOrderItems[$index]['status'] = 'approved';
        }

        $this->dispatch('updating-header', [
            'requestOrderItems' => $this->requestOrderItems
        ]);
    

    }

    public function save()
    {

        //apakah ada yang belum divalid
        $checkItem = collect($this->requestOrderItems)
            ->filter(function ($item) {
                return $item['status']  == '';
            })
            ->count();

        if ($checkItem > 0) {
            Toaster::warning('Terdapat ' . $checkItem . ' Item belum diproses. Silahkan cek ulang.');
            return;
        }

        //apakah reject all
        $checkItem = collect($this->requestOrderItems)
            ->filter(function ($item) {
                return $item['status']  == 'rejected';
            })
            ->count();

        if ($checkItem == count($this->requestOrderItems)) {
            Toaster::warning('Semua produk telah ditolak, harap pilih Tolak Permintaan!');
            return;
        }

        $this->confirm('Proses Perminataan?', [
            'text' => 'pastikan semua data sudah benar.',
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'confirmButtonText' => 'Proses',
            'cancelButtonText' => 'Tidak',
            'confirmButtonColor' => '#9333ea',
            'cancelButtonColor' => '#94a3b8',
            'onConfirmed' => 'proses-simpan',
        ]);
    }

    #[On('proses-simpan')]
    public function proccesSaving()
    {
        $checkItem = collect($this->requestOrderItems)
            ->filter(function ($item) {
                return $item['status']  == 'partial_approved';
            })
            ->count();

        if ($this->requestOrder->status == 'requested' || $this->requestOrder->status == 'reviewed') {
            $status = $checkItem > 0 ? 'partial_approved' : 'approved';
        }
        //status approved
        else if ($this->requestOrder->status == 'approved' || $this->requestOrder->status == 'partial_approved') {
            $status = 'ready_to_send';
        }
        //status ready to send
        else if ($this->requestOrder->status == 'ready_to_send') {
            $status = 'shipped';
        }
        //status shipped
        else if ($this->requestOrder->status == 'shipped') {
            $status = 'received';
        }
        // status received
        else if ($this->requestOrder->status == 'received') {
            $status = 'completed';
        }


        DB::beginTransaction();
        try {
            //update detail
            if ($this->requestOrder->status == 'requested' || $this->requestOrder->status == 'reviewed') {
                // update header
                $RequestOrderHeader = $this->requestOrder->update([
                    'status' => $status,
                    'approved_by' => auth()->user()->id,
                    'approved_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                //insert delivery header
                $deliveryHeader = RequestOrderDelivery::create([
                    'request_order_id' => $this->requestOrder->id,
                    'delivery_number' => $this->generateNoDelivery(),
                    'status' => 'New',
                ]);

                // $units = collect($this->requestOrderItems)->pluck('satuanApproved')->toArray();

                $products  = collect($this->requestOrderItems)->pluck('product_id')->toArray();

                //gudang yang meminta
                $destinationWarehouse = StockAlocation::select('stock_alocations.*', 'product_unit_conversions.conversion_factor')
                    ->whereIn('stock_alocations.product_id', $products)
                    ->where('stock_alocations.location_id', $this->requestOrder->from_warehouse_id)
                    ->join('product_unit_conversions', function ($q) {
                        $q->on('product_unit_conversions.id', 'stock_alocations.product_unit_conversion_id')
                            ->on('stock_alocations.product_unit_id', 'product_unit_conversions.product_unit_id')
                            ->limit(1);
                    })
                    ->distinct()
                    ->get();


                //gudang yang diminta, 
                $sourceWarehouse = StockAlocation::selectRaw("
                        stock_alocations.*,
                        product_unit_conversions.conversion_factor
                    ")
                    ->where('stock_alocations.location_id', $this->requestOrder->to_warehouse_id)
                    ->join('product_unit_conversions', function ($q) {
                        $q->on('product_unit_conversions.id', 'stock_alocations.product_unit_conversion_id');
                    })
                    ->whereIn('stock_alocations.product_id', $products)
                    ->distinct()
                    ->get();

                //conversi satuan
                $fromWarehouse = [];
                $toWarehouse = [];

                foreach ($destinationWarehouse as $index => $value) {
                    $fromWarehouse[$value->product_id] = [
                        'id' => $value->id,
                        'product' => $value->product_id,
                        'stock' => $value->quantity,
                        'stockConversion' => $value->quantity * $value->conversion_factor,
                        'unit' => $value->product_unit_id,
                        'conversion_factor' => $value->conversion_factor,
                    ];
                }
                foreach ($sourceWarehouse as $index => $value) {
                    $toWarehouse[$value->product_id] = [
                        'id' => $value->id,
                        'product' => $value->product_id,
                        'quantity' => $value->quantity,
                        'stockConversion' => $value->quantity * $value->conversion_factor,
                        'unit' => $value->product_unit_id,
                        'conversion_factor' => $value->conversion_factor
                    ];
                }


                // update detail order
                $dataItem = [];
                $destinationwarehouseStocMutationInsert = [];

                foreach ($this->requestOrderItems as $index => $value) {
                    if ($value['status'] == 'approved' || $value['status'] == 'partial_approved') {
                        if ($value['qty_request'] > $value['qtyApproved']) {
                            $status = 'partial_approved';
                        } else {
                            $status = 'approved';
                        }
                    } else {
                        $status = 'rejected';
                    }

                    //untuk item order
                    $dataItem = RequestOrderItem::where('id', $value['id'])->first()->update([
                        'qty_approved' => $value['qtyApproved'],
                        'satuan_request_id' => $value['satuan_request_id'],
                        'reject_reason' => $value['reject_reason'],
                        'status' => $status
                    ]);

                    //insert ke log approval
                    RequestOrderApprovalLog::create([
                        'request_order_id' => $this->requestOrder->id,
                        'request_order_item_id' => $value['id'],
                        'qty_approved' => $value['qtyApproved'],
                        'created_by' => auth()->user()->id
                    ]);

                    //insert delivery item
                    RequestOrderDeliveryItem::create([
                        'request_order_delivery_id' => $deliveryHeader->id,
                        'request_order_item_id' => $value['id'],
                        'product_id' => $value['product_id'],
                        'unit_requested_id' => $value['satuan_request_id'],
                        'qty_requested' => $value['qty_request'],
                        'total_qty_approved' => $value['qtyApproved'],
                        'qty_delivered' => $value['qtyApproved'],
                        'status' => $status,
                    ]);

                    // //conversi satuan dari satuan order ke satuan origin alokasi gudang yang meminta
                    // $qtyApprovedConversion = $value->qtyApproved * $value->conversion_factor / $fromWarehouse[$value->product_id]['conversion_factor'];

                    // //untuk update stok alokasi destinationWarehouse / gudang yang meminta
                    // $destinationwarehouseStockUpdate[] = [
                    //     ['quantity' => $fromWarehouse[$value->product_id]['quantity'] - $qtyApprovedConversion],
                    //     ['id' => $fromWarehouse[$value->product_id]['id']]
                    // ];

                    //conversi satuan dari satuan order ke satuan origin alokasi gudang yang diminta
                    $qtyApprovedConversion = $value['qtyApproved'] * $value['conversion_factor'] / $toWarehouse[$value['product_id']]['conversion_factor'];

                    //untuk update stok alokasi sourceWarehouse / gudang yang diminta
                    $sourceWarehouseStockUpdate =  StockAlocation::where('product_id', $value['product_id'])
                        ->where('location_id', $value['to_warehouse_id'])
                        ->update([
                            'quantity' => $toWarehouse[$value['product_id']]['quantity'] - $qtyApprovedConversion
                        ]);

                    //insert stock movement / pergerakan stock untuk gudang yang diminta
                    $sourcewarehouseStocMutationkInsert[] = [
                        'product_id' => $value['product_id'],
                        'product_unit_id' => $value['product']['base_unit_id'],
                        'warehouse_id' => $value['to_warehouse_id'],
                        'user_proccess_id' => auth()->user()->id,
                        'movement_type' => 'out',
                        'qty_awal' => $toWarehouse[$value['product_id']]['quantity'] * $toWarehouse[$value['product_id']]['conversion_factor'],
                        'qty' => $value['qtyApproved'] * $value['conversion_factor'],
                        'qty_akhir' => ($toWarehouse[$value['product_id']]['quantity'] * $toWarehouse[$value['product_id']]['conversion_factor']) - ($value['qtyApproved'] * $value['conversion_factor']),
                        'desc' => 'Request Order',
                        'reference_type' => 'App\Models\RequestOrder',
                        'reference_id' => $value['request_order_id'],
                        'transaction_date' => date('Y-m-d H:i:s'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                }
                // $updateorderItems = RequestOrderItem::save($dataItem);
                // $updatestockalocation = stockAlocation::savey($sourceWarehouseStockUpdate);
                $insertkartuStok = StockCard::insert($sourcewarehouseStocMutationkInsert);
            }
            DB::commit();

            Toaster::success('Data berhasil disimpan!');
        } catch (\Throwable $e) {
            DB::rollBack();
            Toaster::warning($e->getMessage() . '-' . $e->getLine());
            Log::error($e->getMessage());
        }

        // Toaster::warning('ada apa');
    }

    public function generateNoDelivery()
    {
        $now = Carbon::now();

        $prefix = 'DV';
        $month = $now->format('m');     // 01-12
        $year = $now->format('y');      // ambil angka belakang misal 2025 -> 25

        $base = $prefix . $month . $year; // RO0425

        // Hitung jumlah order bulan ini
        $lastOrder = RequestOrder::where('no_order', 'ilike', $base . '%')
            ->orderBy('no_order', 'desc')
            ->first();
           

        if ($lastOrder) {
            // Ambil nomor urut terakhir dan tambah 1
            $lastNumber = (int) substr($lastOrder->no_order, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $base . $newNumber;
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="text-center pt-20">
            <!-- Loading spinner... -->
            <p>Sedang memuat data....</p>
        </div>
        HTML;
    }

    public function render()
    {
        $warehouses = Warehouses::where('business_id', auth()->user()->current_active_business_id)->get();
        $products = Product::with(['alocations.unit', 'alocations' => function ($q) {
            $q->where('location_id', $this->fromWarehouse);
        }])->where('business_id', auth()->user()->current_active_business_id)
            ->whereHas('alocations', function ($q) {
                $q->where('location_id', $this->fromWarehouse);
            })
            ->when($this->listProducts, function ($q) {
                $q->whereNotIn('id', collect($this->listProducts)->pluck('productID')->toArray());
            })
            ->get();

        return view('livewire.dashboard.inventory.procurement.request-order.show-request-order.request-order-items', [
            'warehouses' => $warehouses,
            'products' => $products,
        ]);
    }
}

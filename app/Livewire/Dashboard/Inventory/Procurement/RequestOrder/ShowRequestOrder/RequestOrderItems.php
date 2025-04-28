<?php

namespace App\Livewire\Dashboard\Inventory\Procurement\RequestOrder\ShowRequestOrder;

use App\Models\Product;
use App\Models\RequestOrder;
use App\Models\RequestOrderItem;
use App\Models\StockAlocation;
use App\Models\StockCard;
use App\Models\Warehouses;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\On;
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
    public $calculatePending = 0;
    public $totalReject = 0;
    public $totalPartial = 0;
    public $totalFulFilled = 0;
    public $showProsesSimpan = true;
    public function mount()
    {
        $this->requestOrderItems = RequestOrderItem::selectRaw("
            request_order_items.*,
            request_orders.from_warehouse_id,
            request_orders.to_warehouse_id,
            product_units.name as request_order_product_unit_name,
            request_order_unit_conversion.conversion_factor,
            request_orders.status as order_status,
            (
                SELECT DISTINCT 
                    (stock_alocations.quantity * puc_source.conversion_factor / request_order_unit_conversion.conversion_factor) as stockSourceWarehouse
                FROM 
                    stock_alocations
                JOIN 
                    product_unit_conversions as puc_source
                    ON  stock_alocations.product_id = puc_source.product_id 
                    AND  request_order_items.satuan_request_id = puc_source.product_unit_id
                WHERE 
                    stock_alocations.product_id = request_order_items.product_id
                AND
                    stock_alocations.location_id = request_orders.to_warehouse_id
                lIMIT 1
            ) AS stock_source_warehouse,

            (
                SELECT DISTINCT 
                    (stock_alocations.quantity * puc_destination.conversion_factor / request_order_unit_conversion.conversion_factor) as stockDestinationWarehouse
                FROM 
                    stock_alocations
                JOIN 
                    product_unit_conversions as puc_destination
                    ON  stock_alocations.product_id = puc_destination.product_id 
                    AND  request_order_items.satuan_request_id = puc_destination.product_unit_id
                WHERE 
                    stock_alocations.product_id = request_order_items.product_id
                AND
                    stock_alocations.location_id = request_orders.from_warehouse_id
                lIMIT 1
            ) AS stock_destination_warehouse
        ")
            ->with(['product', 'unitSourceWarehouse', 'unitDestinationWarehouse', 'unitApproved'])
            ->join('request_orders', 'request_orders.id', '=', 'request_order_items.request_order_id')
            ->join('product_units', 'request_order_items.satuan_request_id', '=', 'product_units.id')
            ->join('product_unit_conversions as request_order_unit_conversion', function ($join) {
                $join->on('request_order_items.satuan_request_id', '=', 'request_order_unit_conversion.product_unit_id')
                    ->on('request_order_items.product_id', '=', 'request_order_unit_conversion.product_id')
                    ->limit(1);
            })
            ->where('request_order_id', $this->requestOrder->id)
            ->distinct()
            ->orderBy('request_order_items.id', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    ...$item->toArray(), // semua kolom
                    'qtyApproved' =>  $item->status == 'rejected' ? 0 : ($item->status == '' ? number_format(0, 2) : number_format($item->qty_approved, 2)),
                    'sisa_source_warehouse' => $item->stock_source_warehouse - $item->qty_request,
                    'reject_reason' => ''
                ];
            })
            ->toArray();

        $this->calculateReject();
        $this->calculateFulFilled();
        // $this->calculateQtyApproved($index);
        $this->calculatePending();
        $this->calculatePartialApproved();

        // dd(count($this->requestOrderItems));
    }


    public function calculatePartialApproved($index = null)
    {
        $this->totalPartial = collect($this->requestOrderItems)
            ->filter(function ($item) {
                return  floatval($item['qtyApproved']) < floatval($item['qty_request']) && floatval($item['qtyApproved']) > 0;
            })
            ->count();
    }

    public function calculatePending()
    {
        $this->calculatePending = collect($this->requestOrderItems)
            ->filter(function ($item) {
                return $item['status'] === '';
            })
            ->count();
        // $this->calculateFulFilled();
    }

    public function calculateReject()
    {
        $this->totalReject = collect($this->requestOrderItems)->where('status', 'rejected')->count();
    }

    public function calculateFulFilled()
    {
        $this->totalFulFilled = collect($this->requestOrderItems)
            ->filter(function ($item) {
                return $item['status'] === 'approved' && floatval($item['qtyApproved']) >= floatval($item['qty_request']);
            })
            ->count();
    }

    public function reject($index)
    {
        if ($this->requestOrderItems[$index]['status'] == 'rejected') {
            $this->requestOrderItems[$index]['status'] = '';
            $this->requestOrderItems[$index]['reject_reason'] = null;
            $this->requestOrderItems[$index]['qtyApproved'] = number_format(0, 2);

            $this->calculateReject();
            $this->calculateFulFilled();
            $this->calculatePending();
            $this->calculatePartialApproved();

            //sembunyikan btn proses simpan jika semua barang direject
            if ($this->totalReject == count($this->requestOrderItems)) {
                $this->showProsesSimpan = false;
            } else {
                $this->showProsesSimpan = true;
            }
        } else {
            $this->confirm('Alasan Ditolak', [
                'icon' => 'warning',
                'showConfirmButton' => true,
                'showCancelmButton' => true,
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

        $this->calculateReject();
        $this->calculateFulFilled();
        $this->calculatePending();
        $this->calculatePartialApproved();

        //sembunyikan btn proses simpan jika semua barang direject
        if ($this->totalReject == count($this->requestOrderItems)) {
            $this->showProsesSimpan = false;
        } else {
            $this->showProsesSimpan = true;
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

        $this->calculateReject();
        $this->calculateFulFilled();
        $this->calculatePending();
        $this->calculatePartialApproved();
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
        if ($this->requestOrder->status == 'requested' || $this->requestOrder->status == 'reviewed') {
            $status = $this->totalPartial > 0 ? 'partial_approved' : 'approved';
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
                $header = $this->requestOrder->update([
                    'status' => $status,
                    'approved_by' => auth()->user()->id,
                    'approved_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                $units = collect($this->requestOrderItems)->pluck('satuanApproved')->toArray();

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
                    if ($value['approve'] == true) {
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
                        'product_unit_approved_id' => $value['product_unit_id'],
                        'qty_warehouse_destination' => $value['stock_destination_warehouse'],
                        'qty_warehouse' => $value['stock_source_warehouse'],
                        'product_unit_warehouse_id' => $value['product_unit_id'],
                        'product_unit_destination_id' => $value['product_unit_id'],
                        'status' => $status
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

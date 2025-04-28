<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\ProductUnit;
use App\Models\Sale;
use App\Models\SaleCart;
use App\Models\SaleItem;
use App\Models\SalePayment;
use App\Models\StockAlocation;
use App\Models\StockCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Masmerise\Toaster\Toaster;
use Yajra\DataTables\Facades\DataTables;

class SalesController extends Controller
{

    protected $cashier;

    public function __construct()
    {
        $this->cashier = Cashier::where('user_id', Auth::id())
            ->where('business_id', Auth::user()->current_active_business_id)
            ->first();
    }

    public function index()
    {
        $selectedCategory = null;

        $categories = Category::withCount([
            'products as allocated_products_count' => function ($q) {
                $q->whereHas('alocations', function ($query) {
                    $query->where('location_id', $this->cashier->warehouse_id)
                        ->where('status', 2);
                });
            }
        ])
            ->where('business_id', $this->cashier->business_id)
            ->where('status', 1)->get();

        return view('dashboard.transaction.cashier.index', compact('categories', 'selectedCategory'));
    }

    public function getSales()
    {
        return view('dashboard.transaction.cashier.sales.index');
    }
    public function fetchSales()
    {
        $collection = Sale::with(['branch', 'payments'])
            ->withCount('items')
            ->where('branch_id', $this->cashier->warehouse_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return DataTables::of($collection)
            ->addIndexColumn()
            ->addColumn('transaction_date', function ($data) {
                return  date('d-m-Y H:i', strtotime($data->created_at));
            })
            ->addColumn('subtotal', function ($data) {
                return  'Rp ' . number_format($data->subtotal, 2);
            })
            ->addColumn('discount', function ($data) {
                return 'Rp ' . number_format($data->discount, 2);
            })
            ->addColumn('tax', function ($data) {
                return 'Rp ' . number_format($data->tax, 2);
            })
            ->addColumn('final_total', function ($data) {
                return 'Rp ' . number_format($data->final_total, 2);
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 'success') {
                    return '<span class="inline-flex items-center gap-x-1.5 py-0.5 px-3 rounded-full text-xs font-medium bg-green-400/20 text-green-600 dark:text-green-400 dark:bg-green-700/30">success</span>';
                } else {
                    return '<x-badge color="danger" label="return" />';
                }
            })
            ->addColumn('action', function ($data) {
                return '<button class="btnSecondary py-1 me-2 sales-edit" onclick="salesEdit(' . $data->id . ')">Edit</button><button class="btnSecondary py-1 me-2" onclick="salesShow(' . $data->id . ')">View</button>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function salesEdit(Request $request)
    {
        $sale = Sale::with(['branch', 'payments'])
            ->withCount('items')
            ->where('id', $request->saleID)
            ->where('branch_id', $this->cashier->warehouse_id)
            ->first();

        if ($sale) {
            return response()->json([
                'status' => true,
                'message' => 'Penjualan ditemukan',
                'data' => $sale
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops, Produk tidak ditemukan!',
                'data' => ''
            ]);
        }
    }
    public function salesShow($id)
    {
        $sale = Sale::with(['items', 'branch', 'payments.method', 'cashier', 'items.unit', 'items.product'])
            ->withCount('items')
            ->where('id', $id)
            ->where('branch_id', $this->cashier->warehouse_id)
            ->first();

        if ($sale) {
            return response()->view('dashboard.transaction.cashier.sales.show', compact('sale'));
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Oops, Penjualan tidak ditemukan!',
                'data' => ''
            ]);
        }
    }

    public function getProducts(Request $request)
    {
        $cashier = $this->cashier;

        $products = Product::selectRaw("
                products.*, 
               (
                    SELECT 
                        conversion_factor 
                    FROM 
                        product_unit_conversions 
                    WHERE 
                        product_unit_conversions.product_id = stock_alocations.product_id
                    AND
                        product_unit_conversions.product_unit_id = stock_alocations.product_unit_id
                    LIMIT 1
                ) AS stock_conversion_alocation,
                stock_alocations.quantity
                ")
            ->with([
                'prices' => function ($q) use ($cashier) {
                    $q->select('product_id', 'selling_price', 'cost_price', 'warehouse_id', 'product_unit_id', 'product_unit_conversion_id')
                        ->with(['unit', 'conversion' => function ($q) {
                            $q->orderBy('conversion_factor', 'asc');
                        }])
                        ->orderBy('selling_price', 'asc');
                },

            ])
            ->whereHas('prices', function ($q) use ($cashier) {
                return $q->where('warehouse_id', $cashier->warehouse_id)
                    ->where('status', 1);
            })
            ->join('stock_alocations', function ($join) {
                $join->on('products.id', 'stock_alocations.product_id')
                    ->where('stock_alocations.location_id', $this->cashier->warehouse_id)
                    ->where('stock_alocations.status', 2)
                    ->where(function ($q) {
                        $q->where('stock_alocations.status_proses', false)
                            ->orWhere('stock_alocations.status_proses', null);
                    });
            })
            ->when($request->categoryID != null, function ($q) use ($request) {
                return $q->whereHas('categories', function ($query) use ($request) {
                    $query->where('product_category_id', $request->categoryID);
                });
            })
            ->when($request->search != null, function ($q) use ($request) {
                return $q->where(function ($query) use ($request) {
                    $query->where('products.name', 'ilike', '%' . $request->search . '%')
                        ->orWhere('products.sku', 'ilike', '%' . $request->search . '%');
                });
            })
            ->where('products.status', 1)
            ->limit(20)
            ->get();

        foreach ($products as $index => $product) {
        }
        // dd($products);

        return response()->view('dashboard.transaction.cashier.products.index', compact('products', 'cashier'));
    }

    public function scanProduct(Request $request)
    {
        $product = Product::selectRaw('product_prices.selling_price, products.base_selling_price, products.id as productID, product_prices.product_unit_id as satuanID, products.profile_product_filename')
            ->leftJoin('product_prices', function ($join) {
                $join->on('product_prices.product_id', 'products.id')
                    ->on('product_prices.product_unit_id', 'products.base_unit_id')
                    ->where('product_prices.warehouse_id', $this->cashier->warehouse_id);
            })
            ->join('stock_alocations', function ($join) {
                $join->on('stock_alocations.product_id', 'products.id')
                    ->where('stock_alocations.location_id', $this->cashier->warehouse_id)
                    ->where('stock_alocations.status', 2);
            })
            ->where('barcode', $request->barcode)
            ->first();

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Oops, Produk tidak ditemukan!',
                'data' => ''
            ]);
        }
        $statusProses = StockAlocation::where('location_id', $this->cashier->warehouse_id)
            ->where('product_id', $product->productID)
            ->where(function ($q) {
                $q->where('stock_alocations.status_proses', true)
                    ->orWhere('stock_alocations.status_proses', operator: 1);
            })
            ->first();

        if ($statusProses) {
            return response()->json([
                'status' => false,
                'message' => 'Oops, Produk sedang dalam penyesuaian stok.',
                'data' => ''
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Produk ditemukan',
            'data' => $product
        ]);
    }

    public function addToCart(Request $request)
    {
        $cashier = $this->cashier;

        $product = Product::with('prices')
            ->whereHas('alocations',  function ($q) use ($cashier) {
                return $q->where('location_id', $cashier->warehouse_id);
            })->where('id', $request->product)
            ->first();

        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Oops, Produk tidak ditemukan!',
                'data' => ''
            ]);
        }

        $statusProses = StockAlocation::where('location_id', $cashier->warehouse_id)
            ->where('product_id', $request->product)
            ->where(function ($q) {
                $q->where('status_proses', true)
                    ->orWhere('status_proses', operator: 1);
            })
            ->first();
        if ($statusProses) {
            return response()->json([
                'status' => false,
                'message' => 'Oops, Produk sedang dalam penyesuaian stok.',
                'data' => ''
            ]);
        }

        $unit_price = ProductPrice::with('conversion')
            ->whereHas('alocation',  function ($q) use ($cashier) {
                return $q->where('warehouse_id', $cashier->warehouse_id);
            })
            ->where('product_id', $request->product)
            ->where('product_unit_id', $request->unit)
            ->first();


        if (!$unit_price) {
            return response()->json([
                'status' => false,
                'message' => 'Harga dengan satuan tersebut tidak ditemukan!',
                'data' => ''
            ]);
        }

        $data = [
            'product' => $product,
            'price' => $unit_price,
            'qty' => $request->qty,
            'index' => $request->index,
        ];

        return response()->view('dashboard.transaction.cashier.carts.product', compact('data'));

        // DB::beginTransaction();
        // try {
        //     $cart = SaleCart::where('cashier_id', Auth::id())
        //         ->where('product_id', $product->id)
        //         ->first();

        //     if ($cart) {
        //         SaleCart::where('id', $cart->id)
        //             ->update([
        //                 'qty' => (int) $cart->qty + $request->qty
        //             ]);
        //     } else {
        //         SaleCart::create([
        //             'cashier_id' => $cashier->id,
        //             'business_id' => Auth::user()->current_active_business_id,
        //             'warehouse_id' => $cashier->warehouse_id,
        //             'product_id' => $product->id,
        //             'product_price_id' => $product->prices->where('product_unit_id', $request->unit)->first()->id,
        //             'product_unit_id' => $request->unit,
        //             'qty' => $request->qty
        //         ]);
        //     }
        //     DB::commit();
        //     return response()->json([
        //         'status' => true,
        //         'message' => 'Product berhasil ditambakan.',
        //         'data' => $product
        //     ]);
        // } catch (\Throwable $e) {
        //     DB::rollBack();
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Terjadi kesalahan sistem.',
        //         'data' => $product
        //     ]);
        // }
    }

    public function deleteItemCart(Request $request)
    {
        $cart = SaleCart::with('product')
            ->where('id', $request->cartID)
            ->where('cashier_id', $this->cashier->user_id)
            ->where('business_id', $this->cashier->business_id)
            ->first();
        if (!$cart) {
            return response()->json([
                'status' => false,
                'message' => 'Anda tidak diizinkan untuk mengahpus produk ini dari keranjang.',
                'data' => ''
            ]);
        }

        $cart->delete();
        return response()->json([
            'status' => true,
            'message' => 'produk berhasil dihapus dari keranjang',
            'data' => ''
        ]);
    }

    public function getCategories(Request $request)
    {
        $selectedCategory = null;

        $categories = Category::withCount([
            'products as allocated_products_count' => function ($q) {
                $q->whereHas('alocations', function ($query) {
                    $query->where('location_id', 2)
                        ->where('status', 2);
                });
            }
        ])
            ->where('business_id', $this->cashier->business_id)
            ->where('status', 1)->get();
        dd($categories);

        return response()->view('dashboard.transaction.cashier.products.category', [
            'categories' => $categories,
            'selectedCategory' => $selectedCategory
        ]);
    }

    public function getCarts()
    {
        $carts = SaleCart::with(['product', 'price', 'unit'])->where('cashier_id', Auth::id())->get();
        $tax = 0;
        $discount = 0;

        return response()->view('dashboard.transaction.cashier.carts.index', compact('carts', 'tax', 'discount'));
    }

    public function checkStockAlocation(Request $request)
    {
        //convert dari satuan yang dialokasikan ke branch ke satuan terkecil
        $alocation = StockAlocation::join('product_unit_conversions', 'stock_alocations.product_unit_id', 'product_unit_conversions.product_unit_id')
            ->where('stock_alocations.product_id', $request->productID)
            ->where('location_id', $request->warehouseID)
            ->first();

        $product = Product::select('products.id as productID', 'products.name as product', 'stock_alocations.product_unit_id as unitAlocation', 'conversion_factor', 'stock_alocations.quantity as qty_warehouse', 'product_units.name as unit', 'stock_alocations.product_unit_id as satuan_warehouse')
            ->join('stock_alocations', 'products.id', 'stock_alocations.product_id')
            ->join('product_unit_conversions', function ($join) {
                $join->on('stock_alocations.product_id', 'product_unit_conversions.product_id');
            })
            ->join('product_units', 'product_unit_conversions.product_unit_id', 'product_units.id')
            ->where('stock_alocations.product_id', $request->productID)
            ->where('stock_alocations.location_id', $request->warehouseID)
            ->where('product_unit_conversions.product_unit_id', $request->unitID)
            ->first();
        $convert = (float) $alocation->quantity * $alocation->conversion_factor / $product->conversion_factor;
        if ($convert >= $request->qty) {
            return response()->json([
                'status' => true,
                'message' => 'Stok Mencukupi',
                'data' => $product
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Qty ' . $product->product . ' tidak Mencukupi, yang tersedia hanya ' . number_format($convert, 0, '.', ',') . ' ' . $product->unit,
                'data' => $product
            ]);
        }
    }

    public function payment(Request $request)
    {
        DB::beginTransaction();
        try {
            //apakah ada qty yang 0
            foreach ($request->item as $key => $item) {
                if ($item['product'] == null || $item['product'] == '') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Terdapat produk yang tidak valid',
                        'data' => $item
                    ]);
                }
                if ($item['qty'] == 0 || $item['qty'] == '') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Terdapat produk dengan qty 0',
                        'data' => $item
                    ]);
                }
                if ($item['price'] == 0 || $item['price'] == '') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Terdapat produk dengan harga yang tidak valid.',
                        'data' => $item
                    ]);
                }
                if ($item['unit_id'] == 0 || $item['unit_id'] == '') {
                    return response()->json([
                        'status' => false,
                        'message' => 'Terdapat produk dengan satuan yang tidak valid.',
                        'data' => $item
                    ]);
                }
            }

            //check stok
            foreach ($request->item  as $item) {
                $alocation = StockAlocation::with('product')
                    ->join('product_unit_conversions', function ($j) {
                        $j->on('stock_alocations.product_id', 'product_unit_conversions.product_id')
                            ->on('stock_alocations.product_unit_id', 'product_unit_conversions.product_unit_id');
                    })
                    ->where('stock_alocations.product_id', $item['product'])
                    ->where('location_id', $item['warehouse_id'])
                    ->where('stock_alocations.status', 2)
                    ->first();

                $conversion = ProductUnit::where('product_id', $item['product'])
                    ->where('product_unit_id', $item['unit_id'])
                    ->first();

                if (!$alocation) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Sistem mendeteksi terdapat produk yang tidak sinkron.',
                        'data' => $item
                    ]);
                }
                $convert = floatval($alocation->quantity * $alocation->conversion_factor / $conversion->conversion_factor);
                if ($convert < $item['qty']) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Qty ' . $alocation->product->name . ' melebihi stok. Stok yang tersedia ' . number_format($convert, 0, '.', ',') . ' ' . $conversion->unit->name,
                        'data' => $item
                    ]);
                }
            }

            if ($request['nominalBayar'] < $request['total']) {
                return response()->json([
                    'status' => false,
                    'message' => 'Nominal pembayaran belum memnuhi syarat!.',
                    'data' => [
                        'payment' => $request['nominalBayar'],
                        'total' => $request['total']
                    ]
                ]);
            }

            $subtotal = 0;
            $total = 0;
            foreach ($request->item as $item) {
                $subtotal += ($item['qty'] * $item['price']) - $item['discount_item'];
                $total = $subtotal + $request['tax'] - $request['discount_transaction'];
            }

            $sale = Sale::create([
                'no_transaction' => Sale::generateOrderNumber(),
                'type' => 'Offline',
                'branch_id' => $this->cashier->warehouse_id,
                'customer_id' => null,
                'cashier_id' => $this->cashier->user_id,
                'subtotal' => $subtotal,
                'discount' => $request['discount_transaction'],
                'tax' => $request['tax'],
                'final_total' => $total,
                'promo_id' => null,
                'status' => 'success'
            ]);
            // dd($sale);

            $orders = [];
            foreach ($request->item as $item) {
                $orders[] = [
                    'sale_id' => $sale->id,
                    'product_id' => $item['product'],
                    'unit_id' => $item['unit_id'],
                    'product_price_id' => ProductPrice::where('product_id', $item['product'])->where('product_unit_id', $item['unit_id'])->first()->id,
                    'discount_id' => 1,
                    'qty' => $item['qty'],
                    'cost_unit_price' => $item['cost_price'],
                    'selling_unit_price' => $item['price'],
                    'discount_amount' => 0,
                    'subtotal' => $item['qty'] * $item['price'],
                    'final_subtotal' => $item['qty'] * $item['price'] - $item['discount_item'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            SaleItem::insert($orders);

            SalePayment::create([
                'sale_id' => $sale->id,
                'payment_method_id' => 1,
                'payment_category' => null,
                'amount_paid' => $request['nominalBayar'],
                'amount_balance' => $request['nominalBayar'] - $request['total'],
                'payment_status' => ($request['nominalBayar'] - $request['total']) >= 0 ? 'Lunas' : 'Hutang',
                'ref' => $sale->no_transaction,
            ]);

            //pemotongan stock
            $mutasiStock = [];
            $alokasiStock = [];
            foreach ($request->item as $item) {

                //ambil satuan alokasi
                $alocation = StockAlocation::with('product')
                    ->join('product_unit_conversions', function ($j) {
                        $j->on('stock_alocations.product_id', 'product_unit_conversions.product_id')
                            ->on('stock_alocations.product_unit_id', 'product_unit_conversions.product_unit_id');
                    })
                    ->where('stock_alocations.product_id', $item['product'])
                    ->where('location_id', $item['warehouse_id'])
                    ->where('stock_alocations.status', 2)
                    ->first();

                //ambil satuan  terkecil
                $product = Product::where('products.id', $item['product'])
                    ->join('product_unit_conversions', function ($join) {
                        $join->on('products.id', 'product_unit_conversions.product_id')
                            ->on('products.base_unit_id', 'product_unit_conversions.product_unit_id');
                    })
                    ->first();

                //conversi satuan order
                $conversion_unit_order = ProductUnit::where('product_id', $item['product'])
                    ->where('product_unit_id', $item['unit_id'])
                    ->first();

                $qty_awal = $alocation->quantity * $alocation->conversion_factor;
                $qty_sale = $item['qty'] * $conversion_unit_order->conversion_factor / $product->conversion_factor;
                $qty_akhir = $qty_awal - $qty_sale;
                // dd( (float) 0.59 * $alocation->conversion_factor);

                $mutasiStock[] = [
                    'product_id' => $item['product'],
                    'warehouse_id' => $item['warehouse_id'],
                    'stock_batch_id' => null,
                    'product_unit_id' => $product->base_unit_id,
                    'user_proccess_id' => $this->cashier->user_id,
                    'movement_type' => 'Out',
                    'qty_awal' => $qty_awal,
                    'qty' => $qty_sale,
                    'qty_akhir' => $qty_akhir,
                    'desc' => 'Penjualan Offline',
                    'reference_type' => 'App\Models\Sale',
                    'reference_id' => $sale->id,
                    'transaction_date' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];


                $stock = StockAlocation::where('product_id', $item['product'])
                    ->where('location_id', $item['warehouse_id'])
                    ->lockForUpdate()
                    ->first();

                StockAlocation::where('product_id', $item['product'])
                    ->where('location_id', $item['warehouse_id'])
                    ->update([
                        'quantity' => bcdiv($qty_akhir, $alocation->conversion_factor, 10)
                    ]);
            }

            StockCard::insert($mutasiStock);



            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Pembeyaran sukses',
                'data' => [
                    'kembalian' => number_format($request['nominalBayar'] - $request['total'], 2, ',', '.')
                ]
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'gagal',
                'data' => [
                    'error' => $e->getMessage() . ' - ' . $e->getLine(),
                ]
            ]);
        }
    }
}

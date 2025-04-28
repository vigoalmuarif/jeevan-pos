<?php

use App\Livewire\Admin\Role\Role;
use App\Livewire\Admin\User\User;
use App\Livewire\Dashboard\Inventory\Product\Show\Show;
use App\Livewire\Dashboard\Inventory\StockManagement\KartuStockProduk\KartuStockProduk;
use App\Livewire\Dashboard\Master\Warehouse\Warehouse;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard\Dashbaord;
use App\Livewire\Admin\Permission\Permission;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Dashboard\Transaction\SalesController;
use App\Http\Controllers\Export\Pdf\Inventory\PermintaanBarangController;
use App\Livewire\Dashboard\Inventory\Procurement\RequestOrder\CreateRequestOrder;
use App\Livewire\Dashboard\Inventory\Procurement\RequestOrder\RequestOrder;
use App\Livewire\Dashboard\Inventory\Procurement\RequestOrder\ShowRequestOrder\ShowRequestOrder;
use App\Livewire\Dashboard\Inventory\Product\CreateProduct;
use App\Livewire\Dashboard\Inventory\Product\Product;
use App\Livewire\Dashboard\Inventory\StockManagement\KartuStockGudang\KartuStockGudang;
use App\Livewire\Dashboard\Inventory\StockManagement\KartuStockGudang\Show as KartuStockGudangShow;
use App\Livewire\Dashboard\Inventory\StockManagement\StockAdjustment\CreateStockAdjustment;
use App\Livewire\Dashboard\Inventory\StockManagement\StockAdjustment\StockAdjustment;
use App\Livewire\Dashboard\Master\Product\Brand\Brand;
use App\Livewire\Dashboard\Master\Product\Category\Category;
use App\Livewire\Dashboard\Master\Product\Supplier\Supplier;
use App\Livewire\Dashboard\Master\Product\Unit\Unit;
use App\Livewire\Dashboard\Setting\WarehouseAssigment\WarehouseAssigment;
use Illuminate\Support\Facades\Http;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'create']);

    // Route::get('register', [RegisteredUserController::class, 'create'])
    //     ->name('register');



    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware(['auth'])->group(function () {

    Route::name('dashboards.')->group(function () {

        Route::get('/dashboard', Dashbaord::class)->name('dashboard');

        Route::prefix('/master')->name('master.')->group(function () {
            Route::name('warehouses.')->group(function () {
                Route::get('/warehouses', Warehouse::class)->name('index');
            });

            Route::prefix('products')->name('products.')->group(function () {
                Route::name('suppliers.')->group(function () {
                    Route::get('/suppliers', Supplier::class)->name('index');
                });

                Route::name('units.')->group(function () {
                    Route::get('/units', Unit::class)->name('index');
                });

                Route::name('categories.')->group(function () {
                    Route::get('/categories', Category::class)->name('index');
                });

                Route::name('brands.')->group(function () {
                    Route::get('/brands', Brand::class)->name('index');
                });
            });

            Route::name('roles.')->group(function () {
                Route::get('/roles', Role::class)->name('index');
            });

            Route::name('permissions.')->group(function () {
                Route::get('/permissions', Permission::class)->name('index');
            });
        });

        Route::prefix('/inventories')->name('inventories.')->group(function () {
            Route::name('products.')->group(function () {
                Route::get('/products', Product::class)->name('index');
                Route::get('/product/create', CreateProduct::class)->name('create');
                Route::get('/product/{slug}', Show::class)->name('show');
            });
            Route::name('stock_managements.')->group(function () {
                Route::prefix('kartu-stock-gudang')->name('kartu_stock_gudang.')->group(function () {
                    Route::get('/', KartuStockGudang::class)->name('index');
                    Route::get('/{warehouse}/{slug}', KartuStockGudangShow::class)->name('show');
                });
                Route::prefix('kartu-stock-produk')->name('kartu_stock_produk.')->group(function () {
                    Route::get('/', KartuStockProduk::class)->name('index');
                    Route::get('/{warehouse}/{slug}', KartuStockGudangShow::class)->name('show');
                });
                Route::prefix('stock-adjustments')->name('stock_adjustments.')->group(function () {
                    Route::get('/', StockAdjustment::class)->name('index');
                    Route::get('/create', CreateStockAdjustment::class)->name('create');
                    Route::get('/{warehouse}/{slug}', KartuStockGudangShow::class)->name('show');
                });
            });

            // pengadaan barang
            Route::name('procurements.')->group(function () {
                Route::name('request_orders.')->group(function () {
                    Route::name('inbound_requests.')->group(function () {
                        Route::get('/inbound', RequestOrder::class)->name('index');
                        Route::get('/inbound/create', action: CreateRequestOrder::class)->name('create');
                        Route::get('/inbound/{noorder}/show', ShowRequestOrder::class)->name('show');
                        // Route::get('/product/{warehouse}/', action: CreateRequestOrder::class)->name('product');
                    });
                    Route::name('outbound_requests.')->group(function () {
                        Route::get('/outbound-requests', RequestOrder::class)->name('index');
                        Route::get('/outbound-request/create', action: CreateRequestOrder::class)->name('create');
                        Route::get('/outbound-request/{noorder}/show', ShowRequestOrder::class)->name('show');
                        // Route::get('/product/{warehouse}/', action: CreateRequestOrder::class)->name('product');
                    });
                    
                   
                    Route::get('/request-order/{noorder}/pdf', [PermintaanBarangController::class, 'requestOrder'])->name('pdf');

                    // Route::get('/stock-transfers', StockTransfer::class)->name('index');
                    // Route::get('/stock-transfer/create', action: CreateStockTransfer::class)->name('create');
                    // Route::get('/stock-transfer/{noorder}/show', ShowStockTransfer::class)->name('show');
                    // Route::get('/product/{warehouse}/', action: CreateRequestOrder::class)->name('product');
                });
            });

            Route::name('permissions.')->group(function () {
                Route::get('/permissions', Permission::class)->name('index');
            });
        });

        Route::prefix('/user-managements')->name('user_managements.')->group(function () {
            Route::name('users.')->group(function () {
                Route::get('/users', User::class)->name('index');
            });

            Route::name('roles.')->group(function () {
                Route::get('/roles', Role::class)->name('index');
            });

            Route::name('permissions.')->group(function () {
                Route::get('/permissions', Permission::class)->name('index');
            });
        });


        Route::prefix('/settings')->name('settings.')->GROUP(function () {
            Route::name('warehouse_assigments.')->group(function () {
                Route::get('/warehouse-assigments', WarehouseAssigment::class)->name('index');
            });
        });


        Route::prefix('/cashier')->name('cashier.')->group(function () {
            Route::get('/home', [SalesController::class, 'index'])->name('home');
            Route::get('/', [SalesController::class, 'index'])->name('index');
            Route::get('/products', [SalesController::class, 'getProducts'])->name('products');
            Route::get('/scan-product', [SalesController::class, 'scanProduct'])->name('scan_product');
            Route::get('/categories', [SalesController::class, 'getCategories'])->name('categories');
            Route::get('/carts', [SalesController::class, 'getCarts'])->name('carts');
            Route::get('/add-to-cart', [SalesController::class, 'addToCart'])->name('add_to_cart');
            Route::get('/check-stock', [SalesController::class, 'checkStockAlocation'])->name('check_stock');
            Route::get('/delete-item-cart', [SalesController::class, 'deleteItemCart'])->name('delete_item_cart');
            Route::post('/payment', [SalesController::class, 'payment'])->name('payment');

            Route::prefix('/sales')->name('sales.')->group(function () {
                Route::get('/', [SalesController::class, 'getSales'])->name('get_sales');
                Route::get('/sales-data', [SalesController::class, 'fetchSales'])->name('fetch_sales');
                Route::get('/{id}', [SalesController::class, 'salesShow'])->name('show');
                Route::get('/{id}/edit', [SalesController::class, 'salesEdit'])->name('edit');
            });
        });
    }); // end dashboards



    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');




    Route::get('/test-http', function () {
        $response = Http::get('https://www.google.com');

        if ($response->successful()) {
            return "Bisa akses internet!";
        } else {
            return "Tidak bisa akses internet! Error: " . $response->status();
        }
    });
});

<?php

namespace App\Livewire\Forms\Invetory;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductUnit;
use App\Models\StockAlocation;
use App\Models\StockCard;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use function PHPUnit\Framework\isFloat;

class ProductForm extends Form
{

    #[Validate()]
    public $warehouse_id, $name, $sku, $brand_id, $categories = [], $product_id = null, $supplier_id, $barcode, $min_stock = 0, $stock_awal = 0, $base_warehouse_unit_id, $base_unit_id, $index, $sell_online = true, $base_cost_price, $base_selling_price, $description = '', $images = [];

    protected function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('products', 'name')->where(fn($q) => $q->where('business_id', auth()->user()->current_active_business_id))->ignore($this->product_id)
            ],
            'sku' => [
                'required',
                Rule::unique('products', 'sku')->where(fn($q) => $q->where('business_id', auth()->user()->current_active_business_id))->ignore($this->product_id)
            ],
            'warehouse_id' => [
                'required',
            ],
            'brand_id' => [
                'required',
            ],
            'categories' => [
                'required',
            ],
            'supplier_id' => [
                'required',
            ],
            'base_warehouse_unit_id' => [
                'required',
            ],
            'base_unit_id' => [
                'required',
            ],
            'index' => [
                'required',
            ],
            'base_cost_price' => [
                'required',
            ],
            'base_selling_price' => [
                'required',
            ],
            'stock_awal' => [
                'nullable',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'description' => [
                'required',
                'max:1000'
            ],
            // 'images.*' => [
            //     'nullable',
            //     'image',
            //     'max:1024',
            //     'mimes:jpg,jpeg,png'
            // ],
        ];
    }

    protected function messages()
    {
        return [
            'warehouse_id.required' => 'Harap pilih gudang/cabang.',
            'name.required' => 'Harap masukan nama product.',
            'name.unique' => 'Role sudah digunakan.',
            'sku.required' => 'Harap masukan SKU product.',
            'sku.unique' => 'SKU sudah digunakan.',
            'brand_id.required' => 'Harap pilih merk.',
            'categories.required' => 'Harap pilih kategori.',
            'supplier_id.required' => 'Harap pilih suppplier.',
            'base_unit_id.required' => 'Harap pilih satuan kecil yang dijual.',
            'base_warehouse_unit_id.required' => 'Harap pilih satuan besar/gudang',
            'index.required' => 'Harap masukan index.',
            'base_cost_price.required' => 'Harap masukan harga beli satuan terkecil',
            'base_selling_price.required' => 'Harap masukan harga jual satuan terkecil',
            'stock_awal.numeric' => 'Harap masukan angka.',
            'description.required' => 'Harap masukan deskripsi produk',
            'description.max' => 'Maksimal 1000 karakter.',
            'images.*.image' => 'File bukan berupa gambar.',
            'images.*.max' => 'Ukuran gambar maksimal 1MB.',
            'images.*.mimes' => 'Format yang diperbolehkan jpg, jpeg, png.',

        ];
    }

    public function store()
    {
        $this->validate();

        $harga_beli = konversi_harga_with_rp($this->base_cost_price);
        $harga_jual = konversi_harga_with_rp($this->base_selling_price);

        if ($harga_beli >= $harga_jual) {
            return session()->flash('error', 'Harga jual tidak boleh sama atau lebih kecil dari harga beli!');
        }

        if ($this->base_warehouse_unit_id) {
            $qty_awal = ($this->stock_awal * $this->index) / $this->index;
        } else {
            DB::rollBack();
            session()->flash('error', 'Satuan Awal tidak valid. Gunakan referensi dari satuan besar atau satuan kecil.');
            return false;
        }

        DB::beginTransaction();
        $uploadFiles = [];
        try {

            //apakah ada gambar utama yg diunggah
            if (isset($this->images[0]) && $this->images[0]) {

                // $extension = $this->images[0]->getClientOriginalExtension();
                // $filepath = 'storage/images/products';
                // $filename = 'main_' . auth()->user()->current_active_business_id . '_' . date('YmdHis') . '.' . $extension;

                // $this->images[0]->storeAs('images/products', $filename, 'public');
                // $uploadedFiles[] = 'public/images/products/' . $filename; // Simpan untuk rollback

            } else {
                $filename = null;
                $filepath = null;
            }


            $product = Product::create([
                'business_id' => auth()->user()->current_active_business_id,
                'warehouse_id' => $this->warehouse_id,
                'supplier_id' => $this->supplier_id,
                'product_brand_id' => $this->brand_id,
                'base_warehouse_unit_id' => $this->base_warehouse_unit_id,
                'base_unit_id' => $this->base_unit_id,
                'index' => $this->index,
                'name' => $this->name,
                'sku' => $this->sku,
                'barcode' => $this->barcode,
                'start_stock' => 0,
                'base_cost_price' => $harga_beli,
                'base_selling_price' => $harga_jual,
                'stock_awal_warehouse' => $this->stock_awal ?? 0,
                'min_stock' => $this->min_stock ?? 0,
                'sell_online' => $this->sell_online ?? 0,
                'desc' => $this->description,
                'slug' =>  Str::of($this->name)->slug('-'),
                'profile_product_filename' =>  $filename,
                'profile_product_filepath' =>  $filepath,
                'status' => 1,
            ]);

            $product_category = [];
            foreach ($this->categories as $index => $value) {
                $product_category[] = [
                    'product_id' => $product->id,
                    'product_category_id' => $value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }

            //insert ke product_category
            $category = DB::table('product_category')->insert($product_category);

            ProductUnit::insert([
                [
                    'product_id' => $product->id,
                    'product_unit_id' => $this->base_unit_id,
                    'conversion_factor' => 1,
                    'is_reversible' => 1,
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'product_id' => $product->id,
                    'product_unit_id' => $this->base_warehouse_unit_id,
                    'conversion_factor' => $this->index,
                    'is_reversible' => 1,
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);

            //jika qty awal tidak 0 maka masukan pada stock kartu stok
            if ($this->stock_awal > 0) {
                StockCard::create([
                    'product_id' => $product->id,
                    'warehouse_id' => $this->warehouse_id,
                    'product_unit_id' => $product->base_unit_id,
                    'movement_type' => 'In',
                    'qty_awal' => 0,
                    'qty' => $qty_awal * $this->index,
                    'qty_akhir' => $qty_awal * $this->index,
                    'desc' => 'stock awal',
                    'reference_type' => 'App\Models\Product',
                    'reference_id' => $product->id,
                    'transaction_date' => $product->created_at,
                    'user_proccess_id' => auth()->user()->id,
                ]);
            }

            //sekalian alokasi ke unit gudang
            StockAlocation::create([
                'product_id' => $product->id,
                'location_id' => $this->warehouse_id,
                'product_unit_id' => $this->base_warehouse_unit_id,
                'minimal_stock' => 0,
                'maximal_stock' => 0,
                'quantity_awal' => $qty_awal ?? 0,
                'quantity' => $qty_awal ?? 0,
                'status' => 1
            ]);

            //apakah ada gambar lainnya
            $images = [];
            foreach ($this->images as $index => $image) {
                if ($index !== 0) {
                    $extension = $image->getClientOriginalExtension();
                    $filepath = 'storage/images/products';
                    $filename = auth()->user()->current_active_business_id . '_' . date('YmdHis') . '_' . $index . '.' . $extension; //format businessid_waktu_index

                    $image->storeAs('images/products', $filename, 'public');
                    $uploadedFiles[] = 'public/images/products/' . $filename; // Simpan untuk rollback

                    $images[] = [
                        'product_id' => $product->id,
                        'is_main' => 0,
                        'imageable_id' => $product->id,
                        'imageable_type' => 'App\Models\Product',
                        'filename' => $filename,
                        'filepath' => $filepath,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                }
            }

            DB::table('product_images')->insert($images);

            DB::commit();
            session()->flash('success', 'Produk berhasil ditambahkan');
        } catch (\Throwable $e) {
            DB::rollBack();
            foreach ($uploadedFiles as $file) {
                if (Storage::exists($file)) {
                    Storage::delete($file);
                }
            }
            session()->flash('error', $e->getMessage());
        }
    }
}

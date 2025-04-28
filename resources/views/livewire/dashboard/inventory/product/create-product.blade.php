<div>
    <x-admin.heading class="pb-5">Tambah Produk</x-admin.heading>
    <x-card-basic class="px-4 pb-4">
        <form wire:submit="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0 md:gap-8">
                <div>
                    <div class="my-5">
                        <x-form.select-search name="form.warehouse_id" id="warehouse" placeholder="Pilih Gudang/Cabang"
                            wire:model="form.warehouse_id">
                            <option value="">Pilih Gudang/Cabang</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" wire:key="warehouse-{{ $warehouse->id }}"
                                    @selected($warehouse->id == $form->warehouse_id)>
                                    {{ $warehouse->warehouse_code . ' | ' . $warehouse->type . ' | ' . $warehouse->name }}
                                </option>
                            @endforeach
                        </x-form.select-search>
                    </div>

                    <div class="my-5">
                        <x-form.input-float label="Nama Produk" id="name" name="form.name"
                            wire:model="form.name" />
                    </div>

                    <div class="flex flex-wrap lg:flex-nowrap w-full lg:space-x-4 space-y-5 lg:space-y-0">
                        <div class="w-full">
                            <x-form.input-float label="Barcode" id="barcode" name="form.barcode"
                                wire:model="form.barcode" />
                        </div>
                        <div class="flex flex-nowrap space-x-3 items-center w-full">
                            <x-form.input-float label="SKU" id="sku" name="form.sku" wire:model="form.sku" />
                            <x-button type="button" class="btnPrimary text-nowrap" wire:click="generateSku()"
                                wire:target="generateSku()">
                                <x-slot:loading wire:target="generateSku">
                                    Generate SKU
                                </x-slot:loading>
                                <x-slot:default wire:target="generateSku">
                                    Generate SKU
                                </x-slot:default>
                            </x-button>
                        </div>
                    </div>

                    <div class="my-5">
                        <x-form.select-search name="form.brand_id" id="brand" placeholder="Pilih merk"
                            wire:model="form.brand_id">
                            <option value="">Pilih Merk</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" wire:key="brand-{{ $brand->id }}"
                                    @selected($brand->id == $form->brand_id)>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </x-form.select-search>
                    </div>

                    <div class="my-5">
                        <div wire:ignore>
                            <x-form.select-multiple placeholder="Pilih kategori" id="categories" name="form.categories"
                                wire:model="form.categories">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" wire:key="category-{{ $category->id }}">
                                        {{ $category->name }}</option>
                                @endforeach
                            </x-form.select-multiple>
                        </div>
                        @error('form.categories')
                            <p class="isInvalidMessage mt-0.5" id="error-msg-form.categories">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="my-5">
                        <x-form.select-search name="form.supplier_id" id="brand" placeholder="Pilih supplier"
                            wire:model="form.supplier_id">
                            <option value="">Pilih Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" wire:key="supplier-{{ $supplier->id }}"
                                    @selected($supplier->id == $form->supplier_id)>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </x-form.select-search>
                    </div>

                    <div class="grid grid-cols-3 gap-5">
                        <div class="">
                            <div class="flex items-center flex-nowrap">
                                <x-form.select-search name="form.base_warehouse_unit_id" id="base_warehouse_unit_id"
                                    placeholder="Satuan Besar" wire:model="form.base_warehouse_unit_id" wire:change="satuanAwal()" >
                                    <option value="">Pilih Satuan</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}" wire:key="base-warehouse-unit-{{ $unit->id }}"
                                            @selected($unit->id == $form->base_warehouse_unit_id)>
                                            {{ $unit->name }}
                                        </option>
                                    @endforeach
                                </x-form.select-search>
                                <div class="hs-tooltip [--placement:top] inline-flex">
                                    <button type="button"
                                        class="hs-tooltip-toggle ms-2 inline-flex p-0 justify-center items-center gap-0 rounded-full bg-gray-50 border border-gray-200 text-gray-600 hover:bg-blue-50 hover:border-primary-200 hover:text-primary-600 focus:outline-none focus:bg-primary-50 focus:border-primary-200 focus:text-primary-600 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-white/10 dark:hover:border-white/10 dark:hover:text-white dark:focus:bg-white/10 dark:focus:border-white/10 dark:focus:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                        </svg>

                                        <span
                                            class="hs-tooltip-content hs-tooltip-shown:opacity-100 w-full max-w-xs hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-xl shadow-sm dark:bg-neutral-700"
                                            role="tooltip">
                                            Satuan besar merupakan satuan gudang, ini penting karena
                                            akan digunakan untuk perhitungan stok barang yang memiliki beberapa satuan
                                            jual.
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="flex items-center flex-nowrap">
                                <x-form.select-search name="form.base_unit_id" id="base_unit_id"
                                    placeholder="Satuan Kecil" wire:model="form.base_unit_id">
                                    <option value="">Pilih Satuan</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}" wire:key="unit-{{ $unit->id }}"
                                            @selected($unit->id == $form->base_unit_id)>
                                            {{ $unit->name }}
                                        </option>
                                    @endforeach
                                </x-form.select-search>
                                <div class="hs-tooltip [--placement:top] inline-flex">
                                    <button type="button"
                                        class="hs-tooltip-toggle ms-2 inline-flex p-0 justify-center items-center gap-0 rounded-full bg-gray-50 border border-gray-200 text-gray-600 hover:bg-blue-50 hover:border-primary-200 hover:text-primary-600 focus:outline-none focus:bg-primary-50 focus:border-primary-200 focus:text-primary-600 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-white/10 dark:hover:border-white/10 dark:hover:text-white dark:focus:bg-white/10 dark:focus:border-white/10 dark:focus:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                        </svg>

                                        <span
                                            class="hs-tooltip-content hs-tooltip-shown:opacity-100 w-full max-w-xs hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-xl shadow-sm dark:bg-neutral-700"
                                            role="tooltip">
                                            Satuan kecil merupakan satuan terkecil yang dijual, ini penting karena
                                            akan
                                            digunakan untuk menghitung
                                            stok barang jika barang memiliki variasi satuan yang dijual.
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="flex items-center flex-nowrap">
                                <div class="w-full">
                                    <x-form.input-float type="number" label="Index" id="index"
                                        name="form.index" wire:model="form.index" />
                                </div>
                                <div class="hs-tooltip [--placement:top] inline-flex">
                                    <button type="button"
                                        class="hs-tooltip-toggle ms-2 inline-flex p-0 justify-center items-center gap-0 rounded-full bg-gray-50 border border-gray-200 text-gray-600 hover:bg-blue-50 hover:border-primary-200 hover:text-primary-600 focus:outline-none focus:bg-primary-50 focus:border-primary-200 focus:text-primary-600 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-white/10 dark:hover:border-white/10 dark:hover:text-white dark:focus:bg-white/10 dark:focus:border-white/10 dark:focus:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                        </svg>

                                        <span
                                            class="hs-tooltip-content hs-tooltip-shown:opacity-100 w-full max-w-xs hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-xl shadow-sm dark:bg-neutral-700"
                                            role="tooltip">
                                            Index merupakan conversi dari satuan besar ke satuan kecil. berapa banyak
                                            qty/isi dari satuan besar ke satuan kecil.
                                            contoh :
                                            satuan besar = box,
                                            satuan kecil = pcs,
                                            misal dalam 1 box terdapat 10 pcs atau dalam 1 box terdapat 10 index
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 my-5">

                        <div class="">
                            <x-form.input-float type="text" label="Harga Beli Satuan Kecil" id="base_cost_price"
                                name="form.base_cost_price" wire:model.defer="form.base_cost_price" />
                        </div>

                        <div class="">
                            <x-form.input-float type="text" label="Harga Jual Satuan Kecil"
                                id="base_selling_price" name="form.base_selling_price"
                                wire:model="form.base_selling_price" />
                        </div>

                    </div>


                    <div class="grid grid-cols-2 md:grid-cols-12 gap-5 my-5">
                        <div class="flex md:col-span-5">
                            <x-form.input-float type="text" label="Stock Awal Gudang" id="stock_awal" rounded="rounded-s-xl"
                            name="form.stock_awal" wire:model="form.stock_awal" />
                            <span class="px-4 inline-flex items-center min-w-fit rounded-e-xl border border-e-0 border-gray-200 bg-gray-50 text-sm text-gray-500 dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400">{{ $satuanAwalLabel }}</span>
                        </div>

                        <div class="md:col-span-4">
                            <div class="flex items-center flex-nowrap">
                                <div class="w-full">
                                    <x-form.input-float type="number" label="Minimal Stok" id="min_stock"
                                        name="form.min_stock" wire:model="form.min_stock" />
                                </div>
                                <div class="hs-tooltip [--placement:top] inline-flex">
                                    <button type="button"
                                        class="hs-tooltip-toggle ms-2 inline-flex p-0 justify-center items-center gap-0 rounded-full bg-gray-50 border border-gray-200 text-gray-600 hover:bg-blue-50 hover:border-primary-200 hover:text-primary-600 focus:outline-none focus:bg-primary-50 focus:border-primary-200 focus:text-primary-600 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-white/10 dark:hover:border-white/10 dark:hover:text-white dark:focus:bg-white/10 dark:focus:border-white/10 dark:focus:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                        </svg>

                                        <span
                                            class="hs-tooltip-content hs-tooltip-shown:opacity-100 w-full max-w-xs hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-xl shadow-sm dark:bg-neutral-700"
                                            role="tooltip">
                                            Minimal stok digunakan untuk menghitung stok jika kurang dari minimal stok
                                            yang
                                            diterapkan maka akan mendapatkan pemberitahuan dari sistem. Ini berguna
                                            untuk memastikan
                                            barang selalu ready.
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="self-center md:col-span-3">
                            <x-form.toggle label="Jual Online" name="form.sell_online" id="sell_online"
                                wire:model="form.sell_online" />
                        </div>

                    </div>

                </div>

                <div>
                    <div class="mb-5 md:mb-0 md:my-5" x-data="{ desc: '', maxLength: 1000 }">
                        <p class="text-xs text-right mx-2"><span x-text="desc.length"></span> / <span
                                x-text="maxLength"></span></p>
                        <x-form.label for="description" class="sr-only">description</x-form.label>
                        <x-form.textarea class="@if ($errors->has($form->description)) @else border-transaparent @endif"
                            rows="7" x-model="desc" id="description" name="form.description"
                            placeholder="Deskripsi" wire:model="form.description"></x-form.textarea>
                    </div>
                    <div class="my-4">
                        <div class="">Upload Gambar Produk</div>
                        <p class="mb-5">Maksimal 1 MB. Format yang didukung png, jpeg, jpg.</p>
                        <div class="flex flex-wrap gap-7 md:gap-5 justify-start">
                            @for ($i = 0; $i < 4; $i++)
                                <!-- Avatar -->
                                <div class="relative" wire:key="container-image-{{ $i }}">
                                    <div class="flex items-center justify-center w-full">
                                        <label for="dropzone-file-{{ $i }}"
                                            class="flex relative flex-col items-center justify-center aspect-square w-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-200 dark:hover:bg-slate-800 dark:bg-slate-800 hover:bg-slate-300/80 dark:border-slate-600 hover:border-primary-500 group">
                                            <div class=" flex flex-col items-center justify-center">
                                                @if (isset($form->images[$i]))
                                                    <img src="{{ $form->images[$i]->temporaryUrl() }}"
                                                        class="w-full h-full object-cover rounded-lg"
                                                        wire:key="product-image-{{ $i }}" />
                                                    <button type="button"
                                                        class="absolute -top-2 -right-2 bg-rose-500 hover:bg-rose-600 rounded-full p-0.5"
                                                        wire:click="removeImageProduct('{{ $i }}')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="currentColor" class="size-4 stroke-2">
                                                            <path fill-rule="evenodd"
                                                                d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                                                                clip-rule="evenodd" />
                                                        </svg>

                                                    </button>
                                                    @if (isset($form->images[0]) && $form->images[$i] === $form->images[0])
                                                        <div
                                                            class="absolute text-sm inset-x-0 rounded-lg bottom-0 bg-primary-800/90 m-0.5  text-slate-100 text-center">
                                                            Gambar Utama</div>
                                                    @endif
                                                @else
                                                    <div wire:loading wire:target="form.images.{{ $i }}">
                                                        <div class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-primary-600 rounded-full dark:text-primary-500"
                                                            role="status" aria-label="loading">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        wire:loading.remove
                                                        wire:target="form.images.{{ $i }}"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-8 h-8 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-primary-500">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                    </svg>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 text-center group-hover:text-primary-500"
                                                        wire:loading wire:target="form.images.{{ $i }}">
                                                        Mengunggah...</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 text-center group-hover:text-primary-500"
                                                        wire:loading.remove
                                                        wire:target="form.images.{{ $i }}">
                                                        {{ $i === 0 ? 'Gambar Utama' : 'Gambar ' . ($i + 1) . '' }}</p>
                                                @endif
                                            </div>
                                            <input id="dropzone-file-{{ $i }}" type="file"
                                                class="hidden" accept=".jpg,.jpeg,.png"
                                                wire:model="form.images.{{ $i }}"
                                                wire:loading.attr="disabled" target="form.images" />
                                        </label>
                                    </div>
                                    @error('form.images.' . $i)
                                        <p class="isInvalidMessage mt-0.5">{{ $message }}</p>
                                    @enderror

                                </div>
                                <!-- End Avatar -->
                            @endfor
                        </div>
                    </div>
                    <div class="flex justify-end mt-10 mb-4">
                        <x-button type="submit" class="btnPrimary w-full" wire:target="save">
                            <x-slot:loading wire:target="save">
                                Menyimpan...
                            </x-slot:loading>
                            <x-slot:default wire:target="save">
                                Simpan
                            </x-slot:default>
                        </x-button>
                    </div>
                </div>
            </div>


            {{-- <div class="flex w-full">
            <div class="flex bg-gray-100 hover:bg-gray-200 rounded-lg transition p-1 dark:bg-primary-800/20 dark:hover:bg-slate-800/90 w-full">
              <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-primary-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-primary-700 dark:hs-tab-active:bg-isDark py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white active" id="segment-item-1" aria-selected="true" data-hs-tab="#segment-1" aria-controls="segment-1" role="tab">
                  Tab 1
                </button>
                <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white" id="segment-item-2" aria-selected="false" data-hs-tab="#segment-2" aria-controls="segment-2" role="tab">
                  Tab 2
                </button>
                <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white" id="segment-item-3" aria-selected="false" data-hs-tab="#segment-3" aria-controls="segment-3" role="tab">
                  Tab 3
                </button>
              </nav>
            </div>
          </div>
          
          <div class="mt-3">
            <div id="segment-1" role="tabpanel" aria-labelledby="segment-item-1">
              <p class="text-gray-500 dark:text-neutral-400">
                This is the <em class="font-semibold text-gray-800 dark:text-neutral-200">first</em> item's tab body.
              </p>
            </div>
            <div id="segment-2" class="hidden" role="tabpanel" aria-labelledby="segment-item-2">
              <p class="text-gray-500 dark:text-neutral-400">
                This is the <em class="font-semibold text-gray-800 dark:text-neutral-200">second</em> item's tab body.
              </p>
            </div>
            <div id="segment-3" class="hidden" role="tabpanel" aria-labelledby="segment-item-3">
              <p class="text-gray-500 dark:text-neutral-400">
                This is the <em class="font-semibold text-gray-800 dark:text-neutral-200">third</em> item's tab body.
              </p>
            </div>
          </div> --}}

            {{-- konversi satuan --}}

        </form>
    </x-card-basic>
</div>
@push('body-scripts')
    <script>
        $(document).ready(function() {
            @error('form.categories')
            @enderror
            var hargaBeli = new AutoNumeric('#base_cost_price', {
                currencySymbol: "Rp ",
            })

            var hargaJual = new AutoNumeric('#base_selling_price', {
                currencySymbol: "Rp ",
            })
        })
    </script>
@endpush

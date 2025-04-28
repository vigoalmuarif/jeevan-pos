<div>
    <x-admin.heading class="pb-5">Products</x-admin.heading>
    <div class="">
        <x-card-basic class="">
            <div class="relative">
                <x-table count="{{ $products->count() }}">
                    <x-slot:action>

                    </x-slot>
                    <x-slot name="heading">
                        <tr>
                            <th scope="col" class="w-14">No</th>
                            <th scope="col" class="w-20">image</th>
                            <th scope="col" class="">Name</th>
                            <th scope="col" class="">SKU</th>
                            <th scope="col" class="">Brand</th>
                            <th scope="col" class="">Sat. Besar</th>
                            <th scope="col" class="">Sat. Kecil</th>
                            <th scope="col" class="">Harga Beli Sat. Kecil</th>
                            <th scope="col" class="">Harga Jual Sat. Kecil</th>
                            <th scope="col" class="">Status</th>
                            <th scope="col" class="">Action</th>
                        </tr>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($products as $product)
                            <tr class="hover:bg-slate-200 dark:hover:bg-slate-800" wire:key="{{ $product->id }}">
                                <td class="w-14">
                                    {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}</td>
                                <td class="">
                                        @if(!$product->profile_product_filename)
                                            <img src="{{ asset('assets/media/img/no_image.png') }}" alt="">
                                        @else
                                        <div class="w-20">
                                            <img src="{{ asset('storage/images/products/'. ($product->profile_product_filename) ) }}" class="w-20 h-20 rounded-full object-cover" alt="{{ $product->name }}">
                                        </div>
                                        @endif
                                </td>
                                <td class="">{{ $product->name }}</td>
                                <td class="">{{ $product->sku }}</td>
                                <td class="">{{ $product->brand->name }}</td>
                                <td class="">{{ $product->base_warehouse_unit->name }}</td>
                                <td class="">{{ $product->base_unit->name }}</td>
                                <td class="">Rp. {{ number_format($product->base_cost_price, 0, '.', ',') }}</td>
                                <td class="">Rp. {{ number_format($product->base_selling_price, 0, '.', ',') }}</td>
                                <td>
                                    <x-badge class="mb-3" color="{{ $product->status == 1 ? 'success' : 'danger' }}" label="{{ $product->status == 1 ? 'Active' : 'Inactive' }}" />
                                </td>
                                <td class="">
                                    <a href="{{ route('dashboards.inventories.products.show', $product->slug) }}" class="btnPrimary"  wire:navigate>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                    <x-slot:paginate>
                        {{ $products->links(data: ['scrollTo' => false]) }}
                    </x-slot:paginate>
                </x-table>
            </div>
        </x-card-basic>
    </div>

</div>

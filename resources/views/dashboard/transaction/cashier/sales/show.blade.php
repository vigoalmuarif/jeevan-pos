<div>
    <div class="flex flex-wrap space-x-3 items-center justify-start mb-4">
        <div
            class="inline-flex  min-w-32 flex-nowrap  bg-slate-100 dark:bg-slate-800 rounded-xl items-center gap-x-2 py-2 px-3 text-sm whitespace-nowrap font-medium text-left group">
            <div class="bg-white rounded-lg dark:bg-neutral-900 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="shrink-0 size-7 group-hover:stroke-primary-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                  </svg>
            </div>
            <div>
                <p class="text-xs font-medium  text-left  text-slate-500 dark:text-slate-400">
                    No Transasksi</p>
                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 ">{{ $sale->no_transaction }}</p>
            </div>
        </div>
        <div
            class="inline-flex  min-w-32 flex-nowrap  bg-slate-100 dark:bg-slate-800 rounded-xl items-center gap-x-2 py-2 px-3 text-sm whitespace-nowrap font-medium text-left group">
            <div class="bg-white rounded-lg dark:bg-neutral-900 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="shrink-0 size-7 group-hover:stroke-primary-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                  </svg>
            </div>
            <div>
                <p class="text-xs font-medium  text-left  text-slate-500 dark:text-slate-400">
                    Tgl Transasksi</p>
                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 ">{{ date('Y-m-d H:i', strtotime($sale->created_at)) }}</p>
            </div>
        </div>
        <div
            class="inline-flex  min-w-32 flex-nowrap  bg-slate-100 dark:bg-slate-800 rounded-xl items-center gap-x-2 py-2 px-3 text-sm whitespace-nowrap font-medium text-left group">
            <div class="bg-white rounded-lg dark:bg-neutral-900 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="shrink-0 size-7 group-hover:stroke-primary-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                  </svg>
            </div>
            <div>
                <p class="text-xs font-medium  text-left  text-slate-500 dark:text-slate-400">
                    Kasir</p>
                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 ">{{ $sale->cashier->username }}</p>
            </div>
        </div>
        <div
            class="inline-flex  min-w-32 flex-nowrap  bg-slate-100 dark:bg-slate-800 rounded-xl items-center gap-x-2 py-2 px-3 text-sm whitespace-nowrap font-medium text-left group">
            <div class="bg-white rounded-lg dark:bg-neutral-900 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="shrink-0 size-7 group-hover:stroke-primary-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                  </svg>
            </div>
            <div>
                <p class="text-xs font-medium  text-left  text-slate-500 dark:text-slate-400">
                    Pembayaran</p>
                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 ">{{ implode(',', $sale->payments->pluck('method.name')->filter()->toArray()) }}</p>
            </div>
        </div>
        <div
            class="inline-flex  min-w-32 flex-nowrap  bg-slate-100 dark:bg-slate-800 rounded-xl items-center gap-x-2 py-2 px-3 text-sm whitespace-nowrap font-medium text-left group">
            <div class="bg-white rounded-lg dark:bg-neutral-900 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="shrink-0 size-7 group-hover:stroke-primary-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                  </svg>
                  
            </div>
            <div>
                <p class="text-xs font-medium  text-left  text-slate-500 dark:text-slate-400">
                    Outlet</p>
                <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 ">{{ $sale->branch->name }}</p>
            </div>
        </div>
    </div>
    <div class=" mb-4 p-3 border border-2 border-dashed rounded-xl border-slate-400 d">
        <div>
            <table class="table table-auto w-full" style="width:100%">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Diskon Item</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                    @php
                        $subtotal = 0;
                    @endphp
                    @foreach ($sale->items as $item)
                        <tr class="hover:bg-gray-100 dark:hover:bg-neutral-700">
                            <td class="font-semibold text-slate-700 dark:text-slate-200">{{ $item->product?->name }}</td>
                            <td class="font-semibold text-slate-700 dark:text-slate-200">{{ $item->unit?->name }}</td>
                            <td>Rp {{ number_format($item->selling_unit_price, 2, '.', ',') }}</td>
                            <td>{{ number_format($item->qty, 2, '.', ',') }}</td>
                            <td>Rp {{ number_format($item->discount_amount, 2, '.', ',') }}</td>
                            <td class="text-right">Rp {{ number_format($item->final_subtotal, 2, '.', ',') }}</td>
                        </tr>
                        @php
                            $subtotal += $item->selling_unit_price * $item->qty - $item->discount_amount
                        @endphp
                    @endforeach
                <tfoot class="text-sm">
                    <tr>
                        <td colspan="10" class=" px-0 mx-0">
                            <hr class=" border-0.5 border-dashed w-full border-slate-500" />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="5" class="text-right py-1">subtotal</th>
                        <th colspan="5" class="text-right text-sm py-1">Rp {{ number_format($subtotal, 2, '.', ',') }}</th>
                    </tr>
                    <tr>
                        <th colspan="5" class="text-right py-1">Diskon Transaksi</th>
                        <th colspan="5" class="text-right text-sm py-1">Rp {{ number_format($sale->discount, 2, '.', ',') }}</th>
                    </tr>
                    <tr>
                        <th colspan="5" class="text-right py-1">Tax</th>
                        <th colspan="5" class="text-right text-sm py-1">Rp {{ number_format($sale->tax, 2, '.', ',') }}</th>
                    </tr>
                    <tr>
                        <th colspan="5" class="text-right py-1">Total</th>
                        <th colspan="5" class="text-right text-sm py-1 underline decoration-4 underline-offset-4 decoration-primary-600">Rp {{ number_format($sale->final_total, 2, '.', ',') }}</th>
                    </tr>
                </tfoot>
                </tbody>
            </table>
        </div>
    </div>
</div>

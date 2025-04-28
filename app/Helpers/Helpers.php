<?php

use App\Models\Guest;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

    if (! function_exists('generateSku')) {
        function generateSku($name = '', $categoryId = '000')
        {
            //jika nama kosong maka generate 3 huruf secara acak
            if (empty($name)) {
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $name =  substr(str_shuffle($characters), 0, 3);
            }

            // Ambil 3 huruf pertama dari nama produk
            $prefix = strtoupper(substr($name, 0, 3));

            // Format angka untuk kategori
            // $categoryCode = sprintf("%03d", $categoryId);

            // Buat kode unik dengan angka acak
            $randomNumber = mt_rand(1000, 9999);

            // Gabungkan SKU
            $sku = "{$prefix}-{$randomNumber}";

            // Pastikan SKU unik
            return ensureUniqueSku($sku);
        }
    }


    if (! function_exists('ensureUniqueSku')) {
        function ensureUniqueSku($sku)
        {
            // Cek apakah SKU sudah ada di database
            while (Product::where('sku', $sku)->where('business_id', auth()->user()->current_business_active)->exists()) {
                $sku = substr($sku, 0, -4) . mt_rand(1000, 9999);
            }

            return $sku;
        }
    }


    if (! function_exists('generateUniqueCode')) {
        function generateUniqueCode($width = 6, $format = '')
        {
            match($format){
                'lower' => $uniqueCode = Str::lower(Str::random($width)),
                'upper' => $uniqueCode = Str::upper(Str::random($width)),
                'random' => $uniqueCode = Str::random($width),
                default => $uniqueCode = Str::upper(Str::random($width)),
            };
            
             // Pastikan kode unik
            if (Guest::where('code', $uniqueCode)->exists()) {
                // Jika kode sudah ada, generate ulang
                $uniqueCode = generateUniqueCode();
            }

            return $uniqueCode;

        }
    }


    if (! function_exists('formatPhoneNumber')) {
        function formatPhoneNumber($number)
        {
            $number = preg_replace('/[^0-9]/', '', $number);

            if (substr($number, 0, 1) === '0') {
                return '+62' . substr($number, 1);
            }

            if (substr($number, 0, 1) === '6') {
                return '+' . $number;
            }

            return $number;
        }
    }

    if (! function_exists('initialName')) {
        function initialName($name)
        {
            $words = explode(' ', strtoupper($name));
            $initials = '';
            
            foreach ($words as $word) {
                $initials .= mb_substr($word, 0, 1);
            }
    
            return substr($initials, 0, 2); // Ambil 2 huruf pertama
        }
    }


    if (! function_exists('getColor')) {
       function getColor()
        {
            $colors = [
                'bg-gray-500', 'bg-red-500', 'bg-yellow-500', 'bg-green-500', 
                'bg-blue-500', 'bg-indigo-500', 'bg-purple-500', 'bg-pink-500', 'bg-teal-500', 'bg-orange-500',
                'bg-lime-500', 'bg-amber-500', 'bg-cyan-500', 'bg-sky-500', 'bg-violet-500', 'bg-fuchsia-500',
                'bg-rose-500', 'bg-neutral-500'
            ];
    
            $index = rand(0, count($colors) - 1); // Pilih warna acak
            $randomColor =  $colors[$index];
            
            return $randomColor;
        }
    }


    if (! function_exists('konversi_harga_with_rp')) {
       function konversi_harga_with_rp($value)
        {
            $price = round(str_replace([',', 'Rp '], ['', ''], $value), 2);
            
            return $price;
        }
    }



    


?>
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['products'] = Product::where('business_id', $request->business_id)
            ->whereHas('alocations', function($q) use($request){
                return $q->where('location_id', $request->warehouse_id)
                    ->where('status', 2);
            })
            ->where('status', 1)
            ->when($request->q, function ($query, $q) {
                $query->where(function($w) use ($q) {
                    $w->where('name', 'ilike', "%$q%")
                      ->orWhere('sku', 'ilike', "%$q%");
                });
            })
            
            ->get();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

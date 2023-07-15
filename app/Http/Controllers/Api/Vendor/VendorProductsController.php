<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\StoreProductRequest;
use App\Http\Requests\Vendor\UpdateProductRequest;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class VendorProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();

        return $vendor->products()->get()->toArray();
    }

    public function store(StoreProductRequest $request)
    {
        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();

        $data = $request->all();
        $data['vendor_id'] = $vendor->id;

        $product = Product::create($data);

        return response()->json([
            'data' => $product->toArray()
        ], 200);
    }

    public function show(string $id)
    {
        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();

        $product = Product::where(['vendor_id' => $vendor->id, 'id' => $id])->get();

        return response()->json([
            'data' => $product->toArray()
        ], 200);
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();

        $product = Product::where(['vendor_id' => $vendor->id, 'id' => $id]);

        if ($product) {
            $product->update($request->all());
            return response()->json([
                'data' => $product->get(),
                'message' => 'product updated successfully'
            ], 200);
        }

        return response()->json([
            'data' => [],
            'message' => 'product not found',
        ], 404);
    }

    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            if ($product->delete()) {
                return response()->json([
                    'data' => [],
                    'message' => 'product deleted successfully',
                ], 404);
            }
        }

        return response()->json([
            'data' => [],
            'message' => 'product not found',
        ], 404);
    }
}

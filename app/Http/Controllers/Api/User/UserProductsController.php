<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ListProductsRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProductsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ListProductsRequest $request)
    {
        switch ($request->filter) {
            case 'tags':
                $tags_ids = $request->tags_ids;

                $products = Product::whereHas('tags', function ($query) use ($tags_ids) {
                    $query->whereIn('id', $tags_ids);
                })->get();

                return response()->json(['data' => $products->toArray()], 200);
                break;
            case 'vendor':
                $vendor_id = $request->vendor_id;
                $products = Product::where('vendor_id', $vendor_id)->get();
                return response()->json(['data' => $products->toArray()], 200);
                break;
            case 'search':
                $product_name = $request->product_name;
                $products = Product::where('name', 'like', "%{$product_name}%")->get();
                return response()->json(['data' => $products->toArray()], 200);
                break;
            case 'preferred':
                // $products = Product::all();
                return response()->json(['message' => 'preferred'], 200);
                break;
            case '':
                $products = Product::all();
                return response()->json(['data' => $products->toArray()], 200);
                break;
            default:
                break;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::where('id', $id)->get();
        return response()->json(['data' => $product->toArray()], 200);
    }
}

<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();

        return response()->json(['data' => $vendor->orders()->get()->toArray()], 200);
    }

    public function show($id)
    {
        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();

        return response()->json(['data' => $vendor->orders()->where('id', $id)->get()->toArray()], 200);
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();

        if ($vendor) {
            $order = Order::find($id)->update($request->all());
            dd($order);
        }
    }
}

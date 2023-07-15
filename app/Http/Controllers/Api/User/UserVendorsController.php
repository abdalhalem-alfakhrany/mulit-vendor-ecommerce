<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ListVendorsRequest;
use App\Models\Vendor;
use Illuminate\Http\Request;

class UserVendorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    
    public function index(ListVendorsRequest $request)
    {
        $vendors = Vendor::where('name', 'like', "%{$request->name}%")->get();
        return response()->json([
            'message' => '',
            'data' => $vendors->toArray()
        ], 200);
    }

    public function show(string $id)
    {
        $vendor = Vendor::where('id', $id)->get();
        return response()->json([
            'message' => '',
            'data' => $vendor->toArray()
        ], 200);
    }
}

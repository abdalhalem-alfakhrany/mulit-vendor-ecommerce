<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    public function offers_preferred(Request $request)
    {
        dd('get offers of user interested in tags');
    }

    public function offers_product(Request $request)
    {
        dd('get offers of product');
    }

    public function offers_vendor(Request $request)
    {
        dd('get offers of specific vendor');
    }

    public function offers_tag(Request $request, $id)
    {
        dd('get offers of specific tag');
    }

    public function get_products_preferred(Request $request)
    {
        dd('get products and offers depends on user interested in tags');
    }

    public function get_product(Request $request, $id)
    {
        dd('get specific product with id');
    }

    public function vendor_show(Request $request, $id)
    {
        dd('show vendor data');
    }

    public function vendor_products(Request $request, $id)
    {
        dd('get vendor products');
    }
}

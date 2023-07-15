<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreShoppingCartRequest;
use App\Http\Requests\User\UpdateShoppingCartRequest;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class UserCartsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        /** @var \App\Models\User **/
        $user = Auth::user();

        return response()->json([
            'data' => $user->shopping_carts()->get()->toArray(),
        ], 200);
    }


    public function store(StoreShoppingCartRequest $request)
    {
        /** @var \App\Models\User **/
        $user = Auth::user();

        $shopping_cart = ShoppingCart::create(
            [
                'name' => $request->name,
                'user_id' => $user->id
            ]
        );
        if ($shopping_cart) {
            return response()->json(['message' => "cart $shopping_cart->name created successfully"], 200);
        }
        return response()->json(['message' => "failed to create shopping cart $request->name"], 500);
    }

    public function show(string $id)
    {
        /** @var \App\Models\User **/
        $user = Auth::user();

        $shopping_cart = $user->shopping_carts()->where('id', $id)->first();
        if ($shopping_cart) {
            return response()->json([
                'data' =>
                [
                    'cart' => $shopping_cart->name,
                    'cart_products' => $shopping_cart->products()->get()->toArray()
                ]
            ], 200);
        } else {
            return response()->json([
                'data' => [],
                'message' => 'no shopping cart for this user with this id'
            ], 200);
        }
    }

    public function update(UpdateShoppingCartRequest $request, string $id)
    {
        /** @var \App\Models\User **/
        $user = Auth::user();

        $shopping_cart = $user->shopping_carts()->where('id', $id)->first();
        if ($shopping_cart) {
            $response = ['message', 'data'];
            if ($shopping_cart->update($request->all())) {
                $response['data']['cart'] = $shopping_cart->name;
            } else {
                $response['message'] = ['message' => "failed to update shopping cart $shopping_cart->name"];
                return response()->json($response, 500);
            }

            if ($request->products_ids) {
                $shopping_cart->products()->detach();
                foreach ($request->products_ids as $product) {
                    $shopping_cart->products()->save(Product::where('id', $product)->first());
                }
                $response['data']['cart_products'] = $shopping_cart->products()->get()->toArray();
            }
            return response()->json($response, 200);
        }

        return response()->json(['message' => "failed to find shopping cart"], 500);
    }

    public function destroy(string $id)
    {
        /** @var \App\Models\User **/
        $user = Auth::user();

        $shopping_cart = $user->shopping_carts()->where('id', $id)->first();
        if ($shopping_cart) {
            if ($shopping_cart->delete()) {
                return response()->json([
                    'data' => [],
                    'message' => "cart $shopping_cart->name deleted successfully"
                ], 200);
            } else {
                return response()->json(['message' => "failed to delete shopping cart $shopping_cart->name"], 500);
            }
        }
        return response()->json(['message' => "failed to find shopping cart"], 500);
    }
}

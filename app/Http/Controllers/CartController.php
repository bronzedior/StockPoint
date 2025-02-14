<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addToCart(Request $request)
    {
        $catalog = Catalog::findOrFail($request->catalog_id);
        $cart = session()->get('cart', []);
        $newQuantity = $request->quantity;

        if (isset($cart[$catalog->id])) {
            $newQuantity += $cart[$catalog->id]['quantity'];
        }

        if ($newQuantity > $catalog->quantity) {
            return redirect()->route('catalog')->with('error', 'Cannot add more than available quantity. Please check your cart');
        }

        $cart[$catalog->id] = [
            'id' => $catalog->id,
            'category' => $catalog->category->name,
            'name' => $catalog->name,
            'price' => $catalog->price,
            'quantity' => $newQuantity,
            'image' => $catalog->image,
        ];

        session()->put('cart', $cart);

        return redirect()->route('catalog')->with('success', 'Item added to cart!');
    }

    public function showCheckout()
    {
        $cart = session()->get('cart', []);

        $catalog = Catalog::all();
        // dd($cart);

        return view('checkout', compact('cart', 'catalog'));
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $catalog = Catalog::findOrFail($id);

        if ($request->quantity > $catalog->quantity) {
            return redirect()->route('checkout')->with('error', 'Cannot update quantity beyond available stock.');
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('checkout')->with('success', 'Quantity updated successfully!');
    }

    public function delete($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('checkout')->with('success', 'Item removed from cart!');
    }
}

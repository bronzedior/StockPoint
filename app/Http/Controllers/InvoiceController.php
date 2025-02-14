<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //
    public function showInvoiceForm()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty!');
        }

        $totalAmount = array_reduce($cart, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);

        return view('invoice', compact('cart', 'totalAmount'));
    }

    public function storeInvoice(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string',
            'postal_code' => 'required|integer',
        ]);

        $cart = session()->get('cart', []);
        $invoiceNumber = 'INV-' . strtoupper(uniqid());

        Invoice::create([
            'invoice_number' => $invoiceNumber,
            'items' => $cart,
            'delivery_address' => $request->delivery_address,
            'postal_code' => $request->postal_code,
            'total_amount' => array_reduce($cart, function ($total, $item) {
                return $total + ($item['price'] * $item['quantity']);
            }, 0),
        ]);

        foreach ($cart as $item) {
            $catalog = Catalog::findOrFail($item['id']);
            $catalog->quantity -= $item['quantity'];
            $catalog->save();
        }

        session()->forget('cart');

        return redirect()->route('history')->with('success', 'Invoice generated successfully!');
    }

    public function showHistory(){
        $userInvoices = Invoice::orderBy('created_at', 'desc')->get();
        return view('history', ['invoices' => $userInvoices]);
    }
}

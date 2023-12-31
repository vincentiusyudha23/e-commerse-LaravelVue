<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOut;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $products = $request->product;
        $total = $request->totalPrice;
        $transaction = Transaction::create([
            'total_price' => $request->totalPrice,
            'user_id'=> Auth()->User()->id,
            'invoice_number'=>'CSR'.date('Ymd').Str::random(3)
        ]);

        foreach ($products as $product){
            $product_db = Product::find($product['product_id']);
            $product_db->stock -= $product['quantity'];
            $product_db->save();
            ProductOut::create([
                'id_product'=>$product['product_id'],
                'id_transaction'=>$transaction->id_transactions,
                'total_items'=>$product['quantity']
            ]);
        }

        return Redirect::route('home')->with('message','CheckOut Success');

    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}

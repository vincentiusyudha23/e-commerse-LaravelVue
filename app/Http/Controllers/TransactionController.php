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
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $products = $request->product;
        $total = $request->totalPrice;
        $transaction = Transaction::create([
            'total_price' => $request->totalPrice,
            'id_user'=> Auth()->User()->id,
            'invoice_number'=>'CSR'.date('Ymd').Str::random(3)
        ]);
        
        foreach ($products as $product){
            $product_db = Product::find($product['id']);
            $product_db->stock -= $product['quantity'];
            $product_db->save();
            ProductOut::create([
                'id_product'=>$product['id'],
                'id_transaction'=>$transaction->id,
                'total_items'=>$product['quantity']
            ]);
        }

        return Redirect::route('home')->with('message','CheckOut Success');

    }
}

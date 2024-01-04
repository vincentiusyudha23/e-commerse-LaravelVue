<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::with('users')->get();

        return response()->json($data,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('ProductAdd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price'=>'required',
            'stock'=>'required',
            'url_img'=>'required|file|image|mimes:jpeg,jpg,png'
        ]);
        $file = $request->file('url_img');
        $fileName = date('ymdhis').'.'.$file->getClientOriginalExtension();
        $file->storeAs('public',$fileName);
        
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'id_user'=> Auth()->user()->id,
            'url_img' => $fileName
        ]);
        return Redirect::route('productadd')->with('message','Succes Add Product');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $data = User::where('id',auth()->user()->id)->with('Product')->first();
        return Inertia::render('Dashboard',[
            'data'=>$data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {   
        // Product::where('product_id',$product)->update([
        //     'name'=>$request->name,
        //     'price'=>$request->price
        // ]);
        if($request->hasFile('url_img')){
            Storage::delete('public/'.$product->url_img);
            $request->validate([
                'url_img'=>'file|image|mimes:jpeg,jpg,png'
            ]);
            $file = $request->file('url_img');
            $fileName = date('ymdhis').'.'.$file->getClientOriginalExtension();
            $file->storeAs('public',$fileName);
            $product->update([
                'url_img'=>$fileName
            ]);
        }
        $product->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'stock'=>$request->stock
        ]);

        return Redirect::route('dashboard')->with('message','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {   
        // dd($product->url_img);
        // $data = Product::where('product_id',$product)->first();
        Storage::delete('public/'.$product->url_img);
        $product->delete();

        return Redirect::route('dashboard')->with('message','Delete Successfully');
    }
}

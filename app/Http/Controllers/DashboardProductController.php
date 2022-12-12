<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.products.index', [
            'products' => Product::where('user_id', auth()->user()->id)->get()
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file("photo");
        $filename = $file->hashName();
        $file->move("gambar", $filename);
        $path = $request->getSchemeAndHttpHost() . "/gambar/" . $filename;
        $payload = [
            "name" => $request->input("name"),
            "price" => $request->input("price"),
            "photo" => $path,
            "description" => $request->input("description"),
            "stock" => $request->input("stock"),
        ];
        Product::create($payload);
        return redirect('/product')->with('success', 'New Product has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product', [

            "product" => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if (null !== $request->file("photo")) {
            $file = $request->file("photo");
            $filename = $file->hashName();
            $file->move("gambar", $filename);
            $path = $request->getSchemeAndHttpHost() . "/gambar/" . $filename;
            $photo = str_replace(request()->getSchemeAndHttpHost() . '/', "", $request->input("hidden"));
            File::delete($photo);
        } else {

            $path = $request->input("hidden");
        }
        $payload = [
            "name" => $request->input("name"),
            "price" => $request->input("price"),
            "photo" => $path,
            "description" => $request->input("description"),
            "stock" => $request->input("stock"),
        ];

        Product::where('id', $product->id)->update($payload);
        return redirect('/product')->with('success', 'New Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $photo = str_replace(request()->getSchemeAndHttpHost() . '/', "", $product->photo);
        File::delete($photo);
        Product::destroy($product->id);
        return redirect('/product')->with('success', 'Post deleted!!');
    }
}

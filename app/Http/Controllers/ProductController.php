<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products', [
            "products" => Product::latest()->paginate(4)->withQueryString()

        ]);
    }

    public function show(Product $product)
    {
        return view('product', [

            "product" => $product
        ]);
    }
}

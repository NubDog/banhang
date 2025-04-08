<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Slide;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductDetail($id)
    {
        $product = Product::find($id);
        $relatedProducts = Product::where('id_type', $product->id_type)
            ->where('id', '<>', $id)
            ->take(4)
            ->get();
        $productTypes = ProductType::all();
        
        return view('product.detail', compact('product', 'relatedProducts', 'productTypes'));
    }
    
    public function getProductsByType($type_id)
    {
        $products = Product::where('id_type', $type_id)->paginate(8);
        $productType = ProductType::find($type_id);
        $productTypes = ProductType::all();
        
        return view('product.by_type', compact('products', 'productType', 'productTypes'));
    }
    
    public function getSearch(Request $request)
    {
        $key = $request->key;
        $products = Product::where('name', 'like', '%'.$key.'%')
            ->orWhere('description', 'like', '%'.$key.'%')
            ->paginate(8);
        $productTypes = ProductType::all();
        
        return view('product.search', compact('products', 'key', 'productTypes'));
    }
}
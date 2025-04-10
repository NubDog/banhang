<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('productType')->get();
        return view('admin.product.product-list', compact('products'));
    }

    public function create()
    {
        $categories = ProductType::all();
        return view('admin.product.product-add', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'id_type' => 'required',
            'unit_price' => 'required|numeric',
            'promotion_price' => 'nullable|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->id_type = $request->id_type;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->promotion_price = $request->promotion_price ?? 0;
        $product->new = $request->new;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->move('source/image/product', $fileName);
            $product->image = $fileName;
        }

        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Thêm sản phẩm thành công');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = ProductType::all();
        return view('admin.product.product-edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'id_type' => 'required',
            'unit_price' => 'required|numeric',
            'promotion_price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->id_type = $request->id_type;
        $product->description = $request->description;
        $product->unit_price = $request->unit_price;
        $product->promotion_price = $request->promotion_price ?? 0;
        $product->new = $request->new;

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($product->image && file_exists('source/image/product/' . $product->image)) {
                unlink('source/image/product/' . $product->image);
            }
            
            $file = $request->file('image');
            $fileName = time() . '_' . Str::slug($request->name) . '.' . $file->getClientOriginalExtension();
            $file->move('source/image/product', $fileName);
            $product->image = $fileName;
        }

        $product->save();

        return redirect()->route('admin.product.index')->with('success', 'Cập nhật sản phẩm thành công');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Xóa ảnh
        if ($product->image && file_exists('source/image/product/' . $product->image)) {
            unlink('source/image/product/' . $product->image);
        }
        
        $product->delete();
        
        return redirect()->route('admin.product.index')->with('success', 'Xóa sản phẩm thành công');
    }
}
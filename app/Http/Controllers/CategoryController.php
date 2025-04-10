<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function getCateList()
    {
        $cates = Category::all();
        return view('admin.category.cate-list', compact('cates'));
    }

    public function getCateAdd()
    {
        return view('admin.category.cate-add');
    }

    public function postCateAdd(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:type_products,name',
            'description' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập tên loại sản phẩm',
            'name.unique' => 'Tên loại sản phẩm đã tồn tại',
            'description.required' => 'Vui lòng nhập mô tả',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('source/image/category', $fileName);
            $category->image = $fileName;
        }
        
        $category->save();
        
        return redirect()->route('admin.getCateList')->with('success', 'Thêm loại sản phẩm thành công');
    }

    public function getCateEdit($id)
    {
        $cate = Category::find($id);
        if (!$cate) {
            return redirect()->route('admin.getCateList')->with('error', 'Không tìm thấy loại sản phẩm');
        }
        
        return view('admin.category.cate-edit', compact('cate'));
    }

    public function postCateEdit(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.getCateList')->with('error', 'Không tìm thấy loại sản phẩm');
        }
        
        $request->validate([
            'name' => 'required|unique:type_products,name,' . $id,
            'description' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập tên loại sản phẩm',
            'name.unique' => 'Tên loại sản phẩm đã tồn tại',
            'description.required' => 'Vui lòng nhập mô tả',
        ]);
        
        $category->name = $request->name;
        $category->description = $request->description;
        
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($category->image && File::exists('source/image/category/' . $category->image)) {
                File::delete('source/image/category/' . $category->image);
            }
            
            // Thêm ảnh mới
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('source/image/category', $fileName);
            $category->image = $fileName;
        }
        
        $category->save();
        
        return redirect()->route('admin.getCateList')->with('success', 'Cập nhật loại sản phẩm thành công');
    }

    public function getCateDelete($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.getCateList')->with('error', 'Không tìm thấy loại sản phẩm');
        }
        
        // Xóa ảnh nếu có
        if ($category->image && File::exists('source/image/category/' . $category->image)) {
            File::delete('source/image/category/' . $category->image);
        }
        
        $category->delete();
        
        return redirect()->route('admin.getCateList')->with('success', 'Xóa loại sản phẩm thành công');
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Http\Services\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{

    public function index()
    {
        $products = DB::table('products')->get();
        return view('dashboard.products.index',compact('products'));
    }

    public function create()
    {
        $subcategories = DB::table('subcategories')->select('id','name_en')->orderBy('name_en')->get();
        $brands = DB::table('brands')->select('id','name_en')->orderBy('name_en')->get();
        return view('dashboard.products.create',compact('subcategories','brands'));
    }

    public function edit($id)
    {
        $subcategories = DB::table('subcategories')->select('id','name_en')->orderBy('name_en')->get();
        $brands = DB::table('brands')->select('id','name_en')->orderBy('name_en')->get();
        $product = DB::table('products')->where('id',$id)->first();
        if(is_null($product)){
            abort(404);
        }
        return view('dashboard.products.edit',compact('subcategories','brands','product'));
    }

    public function store(StoreProductRequest $request)
    {
        $productImage = Media::upload($request->file('image'),'products');
        $data = $request->except('_token','image');
        $data['image'] = $productImage;
        DB::table('products')->insert($data);
        return redirect()->route('dashboard.products.index')->with('success','Product Inserted Successfully');
    }

    public function update(UpdateProductRequest $request,$id)
    {
        $product = DB::table('products')->find($id);
        if(is_null($product)){
            abort(404);
        }
        $data = $request->except('_token','_method','image');
        if($request->hasFile('image')){
            //upload image
            $productImage = Media::upload($request->file('image'),'products');
            //remove image
            $removedPhotoPath = public_path("assets\images\products\\{$product->image}");
            Media::delete($removedPhotoPath);
            // to update image in db
            $data['image'] = $productImage;
        }
        DB::table('products')->where('id',$id)->update($data);
        return redirect()->route('dashboard.products.index')->with('success','Product Updated Successfully');
    }

    public function destroy($id)
    {
        $product = DB::table('products')->find($id);
        if(is_null($product)){
            abort(404);
        }
        //remove image
        $removedPhotoPath = public_path("assets\images\products\\{$product->image}");
        Media::delete($removedPhotoPath);

        DB::table('products')->where('id',$id)->delete();
        return redirect()->route('dashboard.products.index')->with('success','Product Deleted Successfully');
    }

    public function toggleStatus(Request $request,$id)
    {
        DB::table('products')->where('id',$id)->update(['status'=>(int) ! $request->input('status')]);
        return redirect()->route('dashboard.products.index')->with('success','Product Status Updated Successfully');
    }
}

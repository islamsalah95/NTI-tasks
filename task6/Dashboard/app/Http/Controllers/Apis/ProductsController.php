<?php

namespace App\Http\Controllers\Apis;

use App\Models\Brand;
use App\Models\Product;
use App\traits\ApiTrait;
use App\Models\Subcategory;
use App\Http\Services\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::select('id','price','name_'.App::getLocale().' AS name','details_'.App::currentLocale().' AS details');
        return ApiTrait::data(compact('products'));
    }

    public function create()
    {
        $brands = Brand::select('id','name_en','name_ar')->orderBy('name_en')->get();
        $subcategories = Subcategory::select('id','name_en','name_ar')->orderBy('name_en')->get();
        return ApiTrait::data(compact('brands','subcategories'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::select('id','name_en','name_ar')->orderBy('name_en')->get();
        $subcategories = Subcategory::select('id','name_en','name_ar')->orderBy('name_en')->get();
        return ApiTrait::data(compact('product','brands','subcategories'));

    }

    public function store(StoreProductRequest $request)
    {
        $productImage = Media::upload($request->file('image'),'products');
        $data = $request->except('image');
        $data['image'] = $productImage;
        Product::create($data);
        return ApiTrait::successMessage('Product Stored Successfully',201);
    }

    public function update(UpdateProductRequest $request,$id)
    {
        $product = Product::findOrFail($id);
        $data = $request->except('image');
        if($request->hasFile('image')){
            $productImage = Media::upload($request->file('image'),'products');
            $removedPhotoPath = public_path("assets\images\products\\{$product->image}");
            Media::delete($removedPhotoPath);
            $data['image'] = $productImage;
        }
        $product->update($data);
        return ApiTrait::successMessage('Product Updated Successfully',200);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $removedPhotoPath = public_path("assets\images\products\\{$product->image}");
        Media::delete($removedPhotoPath);
        $product->delete();
        return ApiTrait::successMessage('Product Deleted Successfully',200);

    }
}

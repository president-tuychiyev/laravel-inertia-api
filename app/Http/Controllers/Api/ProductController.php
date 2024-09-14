<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attach;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $category = Category::find(request()->category_id);
        $productIds = Attach::where('category_id', request()->category_id)->pluck('product_id')->toArray();

        $products = Product::undeleted()->whereIn('id', $productIds)->with('brand', 'country', 'media')
            ->when(request()->brand_id, fn($q) => $q->where('brand_id', request()->brand_id))
            ->paginate(request()->pageSize ?? null);

        return response()->json(compact('category', 'products'));
    }

    public function show($id)
    {
        $category = Category::where('id', request()->category_id)->first();
        $product = Product::undeleted()->where('id', $id)->with('brand', 'country')->first();
        return response()->json(compact('category', 'product'));
    }
}

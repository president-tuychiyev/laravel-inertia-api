<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Attach;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $message = request()->session()->get('message');
        $categores = Category::get()->map(function ($item) {
            return [
                'label' => $item['name'],
                'value' => $item['id']
            ];
        });

        $brands = Brand::get()->map(function ($item) {
            return [
                'label' => $item['name'],
                'value' => $item['id']
            ];
        });

        $countres = Country::get()->map(function ($item) {
            return [
                'label' => $item['name'],
                'value' => $item['id']
            ];
        });

        $products = Product::undeleted()->with('media', 'brand', 'category')->paginate();

        return Inertia::render('Products', compact('categores', 'brands', 'countres', 'products', 'message'));
    }

    public function update(UpdateRequest $request)
    {
        Product::where('id', $request->id)->update($request->except('media'));
        return back()->with('message', "Success");
    }

    public function store(StoreRequest $request)
    {
        $product = Product::create($request->except('media', 'category_ids'));

        if ($request->category_ids) {
            $attaches = collect($request->category_ids)->map(function ($item) use ($product) {
                return [
                    'category_id' => $item,
                    'product_id' => $product->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            });

            Attach::insert($attaches->toArray());
        }

        return back()->with('message', "success");
    }

    public function destroy($id)
    {
        Product::where('id', $id)->update(['isDeleted' => true]);

        return back()->with('message', "success");
    }
}

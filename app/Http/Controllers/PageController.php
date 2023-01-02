<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $category =  Category::withCount('product')->get();
        $category_product =  Category::with(
            'product'
            // ['product' => function ($q) {
            //     $q->take(2)->orderBy('id', 'desc');
            // }]
        )
            ->get();
        return view('home', compact('category', 'category_product'));
    }

    public function allProduct(Request $request)
    {
        $product = Product::orderBy('id', 'desc');
        if (request()->category) {
            $category = Category::where('slug', request()->category)->first();

            $product->whereHas('category', function ($q) use ($category) {
                $q->where('product_category.category_id', $category->id);
            });
        }

        if ($brand_slug = $request->brand) {
            $brand = Brand::where('slug', $brand_slug)->first();
            $product->where('brand_id', $brand->id);
        }

        if ($search = $request->name) {
            $product->where('name', 'like', "%$search%");
        }
        $product = $product->paginate(6);

        return view('product.all', compact('product'));
    }
}

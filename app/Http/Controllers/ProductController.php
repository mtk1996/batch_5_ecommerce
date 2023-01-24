<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function review($product_slug)
    {
        $product_slug = $product_slug;
        $findProduct = Product::where('slug', $product_slug)->first();
        $review = ProductReview::where('product_id', $findProduct->id)
            ->with('user')
            ->orderBy('id', 'desc')->get();
        return response()->json($review);
        // $review = ProductReview::where
    }

    public function makeReview(Request $request)
    {
        $slug = $request->product_slug;
        $rating = $request->rating;
        $review = $request->review;

        $findProduct = Product::where('slug', $slug)->first();
        ProductReview::create([
            'product_id' => $findProduct->id,
            'user_id' => auth()->id(),
            'rating' => $rating,
            'review' => $review,
        ]);

        return 'success';
    }
}

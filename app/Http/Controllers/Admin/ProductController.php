<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Trait\Image;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAddTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use Image;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('id', 'desc')
            ->paginate(12);
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = Brand::all();
        $supplier = Supplier::all();
        $category = Category::all();
        return view('admin.product.create', compact('brand', 'supplier', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required",
            'image' => "required|mimes:png,jpg,webp,jpeg|max:500",
            'description' => "required",
            'supplier_id' => "required",
            'brand_id' => "required",
            'category_id.*' => "required",
            'sale_price' => "required",
            'discounted_price' => "required",
            'qty' => "required",
        ]);

        //image upload
        $image_name = $this->upload($request->file('image'));

        //produc table store
        $created_product = Product::create([
            'brand_id' => $request->brand_id,
            'supplier_id' => $request->supplier_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . uniqid(),
            'description' => $request->description,
            'stock_qty' => $request->qty,
            'sale_price' => $request->sale_price,
            'discounted_price' => $request->discounted_price,
            'image' => $image_name,
        ]);

        // product add tran store
        ProductAddTransaction::create([
            'product_id' => $created_product->id,
            'supplier_id' => $request->supplier_id,
            'stock_qty' => $request->qty,
            'description' => "From Product Stored",
        ]);
        // category pivot store
        $product = Product::find($created_product->id);
        $product->category()->sync($request->category_id);

        return redirect()->back()->with('success', 'Proudct Stored');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->with('category')->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product Not Found');
        }
        $brand = Brand::all();
        $supplier = Supplier::all();
        $category = Category::all();
        return view('admin.product.edit', compact('product', 'brand', 'supplier', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product =  Product::where('id', $id)->first();

        if ($file = $request->file('image')) {
            $image_name = $this->upload($file);
            $this->delete($product->image);
        } else {
            $image_name = $product->image;
        }

        $product->update([
            'brand_id' => $request->brand_id,
            'supplier_id' => $request->supplier_id,
            'name' => $request->name,
            'description' => $request->description,
            'sale_price' => $request->sale_price,
            'discounted_price' => $request->discounted_price,
            'image' => $image_name,
        ]);

        $p = Product::find($product->id);
        $p->category()->sync($request->category_id);
        return redirect()->back()->with('success', 'Product Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();
        ProductAddTransaction::where('product_id', $product->id)->delete();
        $this->delete($product->image);
        return redirect()->back()->with('success', 'Product Deleted!');
    }
}

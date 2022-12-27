<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Trait\Image;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use Image;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::latest()->paginate(10);
        return view('admin.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'image' => "required|mimes:png,jpg,jpeg,bmp,webp|max:500",
        ]);

        $image_name = $this->upload($request->file('image'));
        Category::create([
            'slug' => uniqid() . $request->name,
            'name' => $request->name,
            'image' => $image_name,
        ]);
        return redirect()->back()->with('success', 'Created');
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
        $data = Category::find($id);
        return view('admin.category.edit', compact('data'));
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
        $request->validate([
            'name' => "required",
        ]);

        $category = Category::where('id', $id)->first();

        if ($file = $request->file('image')) {
            $this->delete($category->image);
            $image_name = $this->upload($file);
        } else {
            $image_name = $category->image;
        }
        $category->update([
            'name' => $request->name,
            'image' => $image_name,
        ]);
        return redirect()->back()->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::where('id', $id)->first();
        $this->delete($data->image);
        $data->delete();
        return redirect()->back()->with('success', 'Delete');
    }
}
